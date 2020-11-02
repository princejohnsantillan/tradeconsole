<?php

namespace App\SterlingTrader\Controllers;

use Exception;

class SendMessageController extends Controller
{
    public function handle()
    {
        $adapterKey = $this->parameters->get('adapterKey');
        $trader = $this->parameters->get('traderId');
        $message = $this->getField('message');

        $connection = $this->connectionManager->getConnection($adapterKey, $trader);

        if ($connection === null) {
            throw new Exception('Connection not found.', 404);
        }

        $connection->send($message);

        return 'ok';
    }
}
