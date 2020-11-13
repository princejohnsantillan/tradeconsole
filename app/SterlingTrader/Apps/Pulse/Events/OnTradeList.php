<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;

class OnTradeList extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        $conditions = $instruction['conditions'];

        return false;
    }

    protected function execute(array $instruction)
    {
        $parameters = $instruction['parameters'];

        $this->connection->send(AdapterResponse::notify('WIP'));
    }
}
