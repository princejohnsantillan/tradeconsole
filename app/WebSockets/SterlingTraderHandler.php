<?php

namespace App\Websockets;

use App\Models\SterlingTraderMessage;
use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class SterlingTraderHandler implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        $this
            ->verifyAppKey($conn)
            ->generateSocketId($conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        SterlingTraderMessage::create([
            'message' => $msg,
        ]);
    }

    protected function verifyAppKey(ConnectionInterface $connection)
    {
        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');

        if (! $app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }

        $connection->app = $app;

        return $this;
    }

    protected function generateSocketId(ConnectionInterface $connection)
    {
        $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));

        $connection->socketId = $socketId;

        return $this;
    }
}
