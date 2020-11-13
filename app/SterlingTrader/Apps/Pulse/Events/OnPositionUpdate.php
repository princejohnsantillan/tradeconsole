<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Events\PositionUpdated;
use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionUpdate extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return true;
    }

    protected function execute(array $instruction)
    {
        $this->connection->positionManager->register(PositionUpdateStruct::build($this->data));

        event(new PositionUpdated);
    }
}
