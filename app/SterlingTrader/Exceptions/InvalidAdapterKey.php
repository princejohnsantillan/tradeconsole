<?php

namespace App\SterlingTrader\Exceptions;

class InvalidAdapterKey extends WebSocketException
{
    public function __construct()
    {
        $this->code = 4002;

        $this->message = 'Invalid Adapter Key';
    }
}
