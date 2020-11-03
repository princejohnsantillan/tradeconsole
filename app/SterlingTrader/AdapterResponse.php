<?php

namespace App\SterlingTrader;

use App\SterlingTrader\Exceptions\WebSocketException;

class AdapterResponse
{
    public const WEBSOCKETEXCEPTION = 'WebSocketException';
    public const NOTIFY = 'Notify';

    private static function render(string $event, array $data) : string
    {
        //TODO: Add signature to increase security.
        return json_encode([
            'event' => $event,
            'data' => $data,
            // 'signature' => $signature,
        ]);
    }

    public static function webSocketException(WebSocketException $exception) : string
    {
        return static::render(static::WEBSOCKETEXCEPTION, $exception->getPayload());
    }

    public static function notify(string $message) : string
    {
        return static::render(static::NOTIFY, ['message' => $message]);
    }
}
