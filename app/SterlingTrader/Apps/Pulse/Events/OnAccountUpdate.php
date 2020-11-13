<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;

class OnAccountUpdate extends EventHandler
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
