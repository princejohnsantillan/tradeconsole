<?php

namespace App\SterlingTrader\Controllers;

use App\SterlingTrader\Exceptions\ConnectionNotFound;

class SendDataController extends Controller
{
    public function handle()
    {
        $adapterKey = $this->parameters->get('adapterKey');
        $traderId = $this->parameters->get('traderId');
        $data = $this->getField('data');

        $connection = $this->connectionManager->getConnection($adapterKey, $traderId);

        if ($connection === null) {
            throw new ConnectionNotFound;
        }

        $connection->send($data);

        return [];
    }
}
