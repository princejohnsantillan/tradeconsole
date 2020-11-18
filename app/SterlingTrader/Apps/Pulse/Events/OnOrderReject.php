<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Events\OrderRejected;

class OnOrderReject extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return true;
    }

    protected function execute(array $instruction)
    {
        event(new OrderRejected);
    }
}
