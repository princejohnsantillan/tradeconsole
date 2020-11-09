<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionUpdate extends EventHandler
{
    public function shouldHandle(): bool
    {
        return true;
    }

    public function execute($data)
    {
        if (! isset($this->connection->positionManager)) {
            $this->connection->positionManager = new PositionManager;
        }

        $this->connection->positionManager->register(PositionUpdateStruct::build($data));
    }
}
