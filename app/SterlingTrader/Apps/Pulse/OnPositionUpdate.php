<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\Models\SterlingTrader\PulseUserInstruction;
use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionUpdate extends EventHandler
{
    public function shouldHandle(PulseUserInstruction $instruction): bool
    {
        return true;
    }

    public function execute($data)
    {
        if (! property_exists($this->connection, 'positionManager')) {
            $this->connection->positionManager = new PositionManager;
        }

        $this->connection->positionManager->register(PositionUpdateStruct::build($data));
    }
}
