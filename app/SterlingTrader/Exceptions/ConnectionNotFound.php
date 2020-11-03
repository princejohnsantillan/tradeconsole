<?php

namespace App\SterlingTrader\Exceptions;

class ConnectionNotFound extends WebSocketException
{
    public function __construct()
    {
        $this->code = 4005;

        $this->message = 'Connection Not Found';
    }
}
