<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use App\SterlingTrader\Apps\Pulse;
use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use App\SterlingTrader\Exceptions\ConnectionLimitReached;
// use App\SterlingTrader\Exceptions\IncorrectSignature;
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

    // private $signature;

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
        // $this->signature = $parameters->get('signature');

        $this
            ->verifyAdapter($connection)
            // ->verifyRequestSignature($connection)
            ->generateSocketId($connection)
            ->registerConnection($connection);

        $connection->send(AdapterResponse::notify('Success! You are connected. Have a good trading day.'));

        //TODO: Add signature verification to increase security.
    }

    public function onClose(ConnectionInterface $connection)
    {
        [$key, $trader] = explode(static::SOCKET_DELIMITER, $connection->socketId);

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
            $connection->send(AdapterResponse::webSocketException($exception));
            $connection->close();
        }
    }

    public function onMessage(ConnectionInterface $connection, MessageInterface $message)
    {
        //TODO: Add signature verification to increase security.

        SterlingTraderMessage::create([
            'adapter_id' => $connection->adapter->id,
            'trader_id' => $this->traderId,
            'adapter_version' => $this->adapterVersion,
            'message' => $message,
        ]);

        Pulse::process($connection, $message);
    }

    private function verifyAdapter(ConnectionInterface $connection)
    {
        $connection->socketId = uniqid().static::SOCKET_DELIMITER.time();

        if ($this->adapterVersion !== config('sterlingtrader.adapter_version')) {
            throw new OutdatedAdapter;
        }

        $adapter = $this->adapterProvider->findByKey($this->adapterKey);

        if ($adapter === null) {
            throw new InvalidAdapterKey;
        }

        if ($this->connectionManger->adapterConnectionsCount($this->adapterKey) >= $adapter->capacity) {
            throw new ConnectionLimitReached;
        }

        $connection->adapter = $adapter;

        $connection->app = $adapter;  //NOTE: Needed by laravel websockets' logger.

        return $this;
    }

    // private function verifyRequestSignature(ConnectionInterface $connection)
    // {
    //     if ($this->signature !== $this->adapter->signRequest($connection->httpRequest)) {
    //         throw new IncorrectSignature;
    //     }

    //     return $this;
    // }

    private function generateSocketId(ConnectionInterface $connection)
    {
        $connection->socketId = $this->adapterKey
            .static::SOCKET_DELIMITER
            .$this->traderId
            .static::SOCKET_DELIMITER
            .$connection->adapter->id;

        return $this;
    }

    private function registerConnection(ConnectionInterface $connection)
    {
        $this->connectionManger->saveConnection($connection, $this->adapterKey, $this->traderId);

        return $this;
    }
}
