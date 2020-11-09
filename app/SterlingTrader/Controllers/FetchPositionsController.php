<?php

namespace App\SterlingTrader\Controllers;

class FetchPositionsController extends Controller
{
    public function handle()
    {
        return [];

        return isset($this->connection->positionManager)
            ? $this->connection->positionManager->getAllPositions()
            : [];
    }
}
