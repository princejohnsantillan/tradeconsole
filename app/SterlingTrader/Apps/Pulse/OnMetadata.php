<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\Models\SterlingTrader\PulseUserInstruction;
use App\SterlingTrader\AdapterResponse;

class OnMetadata extends EventHandler
{
    public function shouldHandle(PulseUserInstruction $instruction): bool
    {
        return false;
    }

    public function execute($data)
    {
        //modify orders accordingly

        $this->connection->send(AdapterResponse::notify('WIP'));
    }
}
