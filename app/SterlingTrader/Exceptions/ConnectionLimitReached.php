<?php

namespace App\SterlingTrader\Exceptions;

class ConnectionLimitReached extends WebSocketException
{
    public function __construct()
    {
        $this->message = 'Connection Limit Reached';

        $this->code = 4003;
    }
}
