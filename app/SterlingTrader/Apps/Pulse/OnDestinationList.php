<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\Models\SterlingTrader\PulseUserInstruction;
use App\SterlingTrader\AdapterResponse;

class OnDestinationList extends EventHandler
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
