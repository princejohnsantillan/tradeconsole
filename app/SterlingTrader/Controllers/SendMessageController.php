<?php

namespace App\SterlingTrader\Controllers;

use App\SterlingTrader\Exceptions\ConnectionNotFound;
use Exception;

class SendMessageController extends Controller
{
    public function handle()
    {
        $adapterKey = $this->parameters->get('adapterKey');
        $trader = $this->parameters->get('trader');
        $message = $this->getField('message');

        $connection = $this->connectionManager->getConnection($adapterKey, $trader);

        if ($connection === null) {
            throw new ConnectionNotFound;
        }

        $connection->send($message);

        return 'ok';
    }
}
