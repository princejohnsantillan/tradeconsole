<?php

namespace App\SterlingTrader;

use BeyondCode\LaravelWebSockets\QueryParameters;
use Exception;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\RequestInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;

class SendMessageToSterlingTrader implements HttpServerInterface
{
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null)
    {
        //verify request via a app id and secret

        $count = app(ChannelManager::class)->connectionCount();

        $request_body = json_decode($request->getBody());

        $message = $request_body->message;
        $secret = $request_body->secret; //verify

        //identify channel/connection using the appkey/socketid?
        app(ChannelManager::class)->getConnections()['0']->send($message);

        $conn->close();
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
    }
}
