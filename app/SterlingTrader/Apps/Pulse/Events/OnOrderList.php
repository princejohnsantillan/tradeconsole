<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;

class OnOrderList extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return false;
    }

    protected function execute(array $instruction)
    {
        $this->connection->send(AdapterResponse::notify('WIP'));
    }
}
