<?php

namespace App\SterlingTrader;

use App\Events\SampleEvent;
use App\Models\SterlingTrader\SterlingTraderMessage;
use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class WebsocketsHandler implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        $this
            ->verifyAppKey($conn)
            ->generateSocketId($conn);

        $conn->send(app(ChannelManager::class)->saveConnection($conn)->connectionCount());
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
            // 'socket_id' => $conn->socketId,
            'message' => $msg,
        ]);

        $connections = app(ChannelManager::class)->getConnections();
        $conn->send('There are '.count($connections).' connections.');

        event(new SampleEvent($msg));
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
}
