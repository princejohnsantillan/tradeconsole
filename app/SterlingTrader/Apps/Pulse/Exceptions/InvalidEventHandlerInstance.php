<?php

namespace App\SterlingTrader\Apps\Pulse\Exceptions;

class InvalidEventHandlerInstance extends PulseException
{
    public function __construct(string $class)
    {
        $this->code = 5002;

        $this->message = "Invalid Event Handler Instance: $class";
    }
}
