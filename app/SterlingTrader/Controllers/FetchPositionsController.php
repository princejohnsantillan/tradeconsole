<?php

namespace App\SterlingTrader\Controllers;

class FetchPositionsController extends Controller
{
    public function handle()
    {
        $connections = $this->connectionManager->getAdapterConnections($this->getParameter('adapterKey'));

        $positions = [];

        foreach ($connections as $connection) {
            $traderPositions = $connection['connection']->positionManager->getAllPositions();

            dump($traderPositions, $positions);
            $positions = array_merge($positions, $traderPositions);
        }

        return $positions;
    }
}
