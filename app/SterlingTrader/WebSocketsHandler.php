<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class WebSocketsHandler implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        $this
            ->verifyAppKey($conn)
            ->generateSocketId($conn)
            ->registerConnection($conn);

        //send connection confirmation?
    }

    public function onClose(ConnectionInterface $conn)
    {
        app(ChannelManager::class)->removeConnection($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        //track exception
        //send exception message to the connection
        //close connection
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        SterlingTraderMessage::create([
            // 'socket_id' => $conn->socketId,
            'message' => $msg,
        ]);

        PulseApp::process($msg);     //pulse app will manage what kind of event to fire, like trade updated, order updated (mirror sterling events?)
    }

    protected function verifyAppKey(ConnectionInterface $conn)
    {
        $appKey = QueryParameters::create($conn->httpRequest)->get('appKey');

        if (! $app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }

        $conn->app = $app;

        return $this;
    }

    protected function generateSocketId(ConnectionInterface $conn)
    {
        $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));

        $conn->socketId = $socketId;

        return $this;
    }

    private function registerConnection(ConnectionInterface $conn)
    {
        app(ChannelManager::class)->saveConnection($conn);

        return $this;
    }
}
