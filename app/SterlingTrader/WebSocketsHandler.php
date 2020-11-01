<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebSocketsErrors;
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
            ->verifyAdapter()
            ->generateSocketId($connection)
            ->registerConnection($connection);

        //TODO: send connection confirmation?
    }

    public function onClose(ConnectionInterface $connection)
    {
        list($key, $trader) = explode(':', $connection->socketId);
        $this->connectionManger->removeConnection($key, $trader);
    }

    public function onError(ConnectionInterface $connection, Exception $e)
    {
        SterlingTraderWebSocketsErrors::create([
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

    protected function verifyAdapter()
    {
        $adapterKey = $this->getParameter('adapterKey');
        $adapterVersion = $this->getParameter('adapterVersion');

        $adapter = $this->adapterProvider->findByKey($adapterKey);

        if ($adapter === null) {
            throw new  Exception('Invalid adapter key.', 401);
        }

        if ($this->connectionManger->connectionCount($adapterKey) >= $adapter->getCapacity()) {
            throw new  Exception('Connection limit reached.', 401);
        }

        if ($adapterVersion !== config('sterlingtrader.adapter_version')) {
            throw new  Exception('Outdated adapter.', 401);
        }

        return $this;
    }

    protected function generateSocketId(ConnectionInterface $connection)
    {
        $connection->socketId = $this->getParameter('adapterKey').':'.$this->getParameter('traderId');

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
