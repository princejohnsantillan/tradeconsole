<?php

namespace App\SterlingTrader\Controllers;

class FetchConnectionsController extends Controller
{
    public function handle()
    {
        return $this->connectionManager
            ->getAdapterConnections($this->getParameter('adapterKey'));
    }
}
