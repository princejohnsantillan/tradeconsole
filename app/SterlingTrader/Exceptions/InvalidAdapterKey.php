<?php

namespace App\SterlingTrader\Exceptions;

class InvalidAdapterKey extends WebSocketException
{
    public function __construct()
    {
        $this->message = 'Invalid Adapter Key';

        $this->code = 4002;
    }
}
