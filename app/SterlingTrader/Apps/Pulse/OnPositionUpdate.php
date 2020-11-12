<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\Events\PositionUpdated;
use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionUpdate extends EventHandler
{
    public function shouldHandle(): bool
    {
        return true;
    }

    public function execute($data)
    {
        $this->connection->positionManager->register(PositionUpdateStruct::build($data));

        event(new PositionUpdated)
    }
}
