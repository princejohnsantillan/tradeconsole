<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\AdapterResponse;

class OnTradeList extends EventHandler
{
    public function shouldHandle(): bool
    {
        return false;
    }

    public function execute($data)
    {
        $this->connection->send(AdapterResponse::notify('WIP'));
    }
}