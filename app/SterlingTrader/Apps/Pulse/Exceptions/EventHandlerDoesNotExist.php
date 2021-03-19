<?php

namespace App\SterlingTrader\Apps\Pulse\Exceptions;

class EventHandlerDoesNotExist extends PulseException
{
    public function __construct(string $class)
    {
        $this->code = 5001;

        $this->message = "Event Handler Does Not Exist: $class";
    }
}
