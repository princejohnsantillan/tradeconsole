<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionList extends EventHandler
{
    public function shouldHandle(): bool
    {
        return true;
    }

    public function execute($data)
    {
        if (! is_array($data)) {
            return;
        }

        if (! isset($this->connection->positionManager)) {
            $this->connection->positionManager = new PositionManager;
        }

        foreach ($data as $postition) {
            $this->connection->positionManager->register(PositionUpdateStruct::build($postition));
        }
    }
}
