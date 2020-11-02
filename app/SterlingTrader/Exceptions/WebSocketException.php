<?php

namespace App\SterlingTrader\Exceptions;

use Exception;

class WebSocketException extends Exception
{
    public function getPayload()
    {
        return [
            'event' => 'WebSocketException',
            'data' => [
                'message' => $this->getMessage(),
                'code' => $this->getCode(),
            ],
        ];
    }
}
