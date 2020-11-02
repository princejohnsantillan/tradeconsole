<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use App\SterlingTrader\Apps\Pulse;
use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use App\SterlingTrader\Exceptions\ConnectionLimitReached;
use App\SterlingTrader\Exceptions\InvalidAdapterKey;
use App\SterlingTrader\Exceptions\OutdatedAdapter;
use App\SterlingTrader\Exceptions\WebSocketException;
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

    private $adapterKey;

    private $traderId;

    private $adapterVersion;

    public function __construct(AdapterProvider $adapterProvider, ConnectionManager $connectionManger)
    {
        $this->adapterProvider = $adapterProvider;
        $this->connectionManger = $connectionManger;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $parameters = QueryParameters::create($connection->httpRequest);

        $this->adapterKey = $parameters->get('adapterKey');
        $this->traderId = $parameters->get('traderId');
        $this->adapterVersion = $parameters->get('adapterVersion');

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

    public function onError(ConnectionInterface $connection, Exception $exception)
    {
        SterlingTraderWebsocketError::create([
            'socket_id' => $connection->socketId,
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        if ($exception instanceof WebSocketException) {
            $connection->send(json_encode($exception->getPayload()));
            $connection->close();
        }
    }

    public function onMessage(ConnectionInterface $connection, MessageInterface $message)
    {
        SterlingTraderMessage::create([
            'adapter_key' => $this->adapterKey,
            'trader_id' => $this->traderId,
            'adapter_version' => $this->adapterVersion,
            'message' => $message,
        ]);

        Pulse::process($message);
    }

    private function verifyAdapter(ConnectionInterface $connection)
    {
        $connection->socketId = uniqid().self::SOCKET_DELIMITER.time(); //NOTE: Needed by laravel websockets' logger.

        if ($this->adapterVersion !== config('sterlingtrader.adapter_version')) {
            throw new OutdatedAdapter;
        }

        $adapter = $this->adapterProvider->findByKey($this->adapterKey);

        if ($adapter === null) {
            throw new InvalidAdapterKey;
        }

        if ($this->connectionManger->connectionCount($this->adapterKey) >= $adapter->capacity) {
            throw new ConnectionLimitReached;
        }

        $connection->app = $adapter;  //NOTE: Needed by laravel websockets' logger.

        return $this;
    }

    private function generateSocketId(ConnectionInterface $connection)
    {
        $connection->socketId = $this->adapterKey
            .self::SOCKET_DELIMITER
            .$this->traderId;

        return $this;
    }

    private function registerConnection(ConnectionInterface $connection)
    {
        $this->connectionManger->saveConnection($connection, $this->adapterKey, $this->traderId);

        return $this;
    }
}
