<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\Exceptions\SterlingTraderException;

class OnExceptionMessage extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return true;
    }

    protected function execute(array $instruction)
    {
        throw new SterlingTraderException($this->data);
    }
}
