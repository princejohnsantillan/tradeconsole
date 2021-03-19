<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Events\PositionUpdated;
use App\SterlingTrader\Struct\PositionUpdateStruct;

class OnPositionList extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        return true;
    }

    protected function execute(array $instruction)
    {
    }

    public function handle($data)
    {
        if (! is_array($data)) {
            return;
        }

        $this->connection->positionManager->reset();

        foreach ($data as $postition) {
            $this->connection->positionManager->register(PositionUpdateStruct::build($postition));
        }

        event(new PositionUpdated);
    }
}
