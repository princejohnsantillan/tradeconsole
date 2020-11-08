<?php

namespace App\SterlingTrader\Exceptions;

class EventHandlerDoesNotExist extends WebSocketException
{
    public function __construct(string $class)
    {
        $this->code = 4006;

        $this->message = "Event Handler Does Not Exist: $class";
    }
}
