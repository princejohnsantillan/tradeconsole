<?php

namespace App\SterlingTrader\Exceptions;

use Exception;

abstract class WebSocketException extends Exception
{
    public function getPayload() : array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }
}
