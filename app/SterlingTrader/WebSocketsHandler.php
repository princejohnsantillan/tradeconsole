<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use App\SterlingTrader\Apps\Pulse;
use App\SterlingTrader\Apps\Pulse\PositionManager;
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

    public function __construct(AdapterProvider $adapterProvider, ConnectionManager $connectionManger)
    {
        $this->adapterProvider = $adapterProvider;
        $this->connectionManger = $connectionManger;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $parameters = QueryParameters::create($connection->httpRequest);

        $connection->adapterKey = $parameters->get('adapterKey');
        $connection->traderId = $parameters->get('traderId');
        $connection->adapterVersion = $parameters->get('adapterVersion');
        // $connection->signature = $parameters->get('signature');

        $this
            ->verifyAdapter($connection)
            // ->verifyRequestSignature($connection)
            ->generateSocketId($connection)
            ->registerConnection($connection)
            ->bootstrap($connection);

        $connection->send(AdapterResponse::notify('Success! You are connected. Have a good trading day.'));
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->connectionManger->removeConnection($connection->adapterKey, $connection->traderId);
    }

    public function onError(ConnectionInterface $connection, Exception $exception)
    {
        SterlingTraderWebsocketError::create([
            'adapter_id' => isset($connection->adapter) ? $connection->adapter->id : null,
            'socket_id' => $connection->socketId,
            'class' => get_class($exception),
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

        $sterlingTraderMessage = SterlingTraderMessage::create([
            'adapter_id' => $connection->adapter->id,
            'socket_id' => $connection->socketId,
            'trader_id' => $connection->traderId,
            'adapter_version' => $connection->adapterVersion,
            'message' => json_decode($message),
        ]);

        Pulse::given($connection, $sterlingTraderMessage)->process();
    }

    private function verifyAdapter(ConnectionInterface $connection)
    {
        $connection->socketId = uniqid().static::SOCKET_DELIMITER.time();

        if (($connection->adapterVersion) !== config('sterlingtrader.adapter_version')) {
            throw new OutdatedAdapter;
        }

        $adapter = $this->adapterProvider->findByKey($connection->adapterKey);

        if ($adapter === null) {
            throw new InvalidAdapterKey;
        }

        if ($this->connectionManger->adapterConnectionsCount($connection->adapterKey) >= $adapter->capacity) {
            throw new ConnectionLimitReached;
        }

        $connection->adapter = $adapter;

        $connection->app = $adapter;  //NOTE: Needed by laravel websockets' logger.

        return $this;
    }

    // private function verifyRequestSignature(ConnectionInterface $connection)
    // {
    //     if ($connection->signature !== $connection->adapter->signRequest($connection->httpRequest)) {
    //         throw new IncorrectSignature;
    //     }

    //     return $this;
    // }

    private function generateSocketId(ConnectionInterface $connection)
    {
        $connection->socketId = $connection->adapterKey
            .static::SOCKET_DELIMITER
            .$connection->traderId
            .static::SOCKET_DELIMITER
            .time();

        return $this;
    }

    private function registerConnection(ConnectionInterface $connection)
    {
        $this->connectionManger->saveConnection($connection, $connection->adapterKey, $connection->traderId);

        return $this;
    }

    private function bootstrap(ConnectionInterface $connection)
    {
        $connection->positionManager = new PositionManager;

        $connection->send(AdapterResponse::getPositionList());

        return $this;
    }
}
