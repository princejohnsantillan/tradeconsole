<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use App\SterlingTrader\Apps\Pulse;
use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use BeyondCode\LaravelWebSockets\QueryParameters;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class WebSocketsHandler implements MessageComponentInterface
{
    private const SOCKET_DELIMITER = '::';

    private $adapterProvider;

    private $connectionManger;

    private $parameters;

    public function __construct(AdapterProvider $adapterProvider, ConnectionManager $connectionManger)
    {
        $this->adapterProvider = $adapterProvider;
        $this->connectionManger = $connectionManger;
    }

    private function getParameter($name)
    {
        return $this->parameters->get($name);
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->parameters = QueryParameters::create($connection->httpRequest);

        $this
            ->verifyAdapter($connection)
            ->generateSocketId($connection)
            ->registerConnection($connection);

        //TODO: Send connection confirmation?
    }

    public function onClose(ConnectionInterface $connection)
    {
        [$key, $trader] = explode(self::SOCKET_DELIMITER, $connection->socketId);
        $this->connectionManger->removeConnection($key, $trader);
    }

    public function onError(ConnectionInterface $connection, Exception $e)
    {
        SterlingTraderWebsocketError::create([
            'socket_id' => $connection->socketId,
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }

    public function onMessage(ConnectionInterface $connection, MessageInterface $message)
    {
        SterlingTraderMessage::create([
            'adapter_key' => $this->getParameter('adapterKey'),
            'trader_id' => $this->getParameter('traderId'),
            'adapter_version' => $this->getParameter('adapterVersion'),
            'message' => $message,
        ]);

        Pulse::process($message);
    }

    private function verifyAdapter(ConnectionInterface $connection)
    {
        $adapterKey = $this->getParameter('adapterKey');
        $adapterVersion = $this->getParameter('adapterVersion');

        $adapter = $this->adapterProvider->findByKey($adapterKey);

        $connection->socketId = 'tmp'.self::SOCKET_DELIMITER.time(); //NOTE: Needed by laravel websockets' logger.

        if ($adapter === null) {
            $this->verificationFailed($connection, 'Invalid adapter key.');
        }

        if ($this->connectionManger->connectionCount($adapterKey) >= $adapter->capacity) {
            $this->verificationFailed($connection, 'Connection limit reached.');
        }

        if ($adapterVersion !== config('sterlingtrader.adapter_version')) {
            $this->verificationFailed($connection, 'Outdated adapter.');
        }

        $connection->app = $adapter;  //NOTE: Needed by laravel websockets' logger.

        return $this;
    }

    private function verificationFailed(ConnectionInterface $connection, string $message)
    {
        $connection->send('Connection closed: '.$message); //TODO: Revisit how the adapter receives this.
        $connection->close();
        throw new  Exception($message, 401);
    }

    private function generateSocketId(ConnectionInterface $connection)
    {
        $connection->socketId = $this->getParameter('adapterKey')
            .self::SOCKET_DELIMITER
            .$this->getParameter('traderId');

        return $this;
    }

    private function registerConnection(ConnectionInterface $connection)
    {
        $adapterKey = $this->getParameter('adapterKey');
        $traderId = $this->getParameter('traderId');

        $this->connectionManger->saveConnection($connection, $adapterKey, $traderId);

        return $this;
    }
}
