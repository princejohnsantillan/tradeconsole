<?php

namespace App\SterlingTrader\Controllers;

class FetchPositionsController extends Controller
{
    public function handle()
    {
        $connections = $this->connectionManager->getAdapterConnections($this->getParameter('adapterKey'));

        $positions = [];

        foreach ($connections as $connection) {
            if (! property_exists($connection['connection'], 'positionManager')) {
                continue;
            }
            $positions += $connection['connection']->positionManager->getAllPositions();
        }

        return $positions;
    }
}
