<?php

namespace App\SterlingTrader\Controllers;

use App\SterlingTrader\Exceptions\ConnectionNotFound;

class SendDataController extends Controller
{
    public function handle()
    {
        $adapterKey = $this->parameters->get('adapterKey');
        $trader = $this->parameters->get('trader');
        $data = $this->getField('data');

        $connection = $this->connectionManager->getConnection($adapterKey, $trader);

        if ($connection === null) {
            throw new ConnectionNotFound;
        }

        $connection->send($data);

        return [];
    }
}
