<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

class OnDestinationList extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return false;
    }

    protected function execute(array $instruction)
    {
    }
}
