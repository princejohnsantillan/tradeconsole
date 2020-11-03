<?php

namespace App\SterlingTrader\Exceptions;

class ConnectionLimitReached extends WebSocketException
{
    public function __construct()
    {
        $this->code = 4003;

        $this->message = 'Connection Limit Reached';
    }
}
