<?php

namespace App\SterlingTrader\Exceptions;

class InvalidEventHandlerInstance extends WebSocketException
{
    public function __construct(string $class)
    {
        $this->code = 4007;

        $this->message = "Invalid Event Handler Instance: $class";
    }
}
