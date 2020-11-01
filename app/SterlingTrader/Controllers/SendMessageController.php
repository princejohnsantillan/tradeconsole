<?php

namespace App\SterlingTrader\Controllers;

class SendMessageController extends Controller
{
    public function handle()
    {
        $adapterKey = $this->parameters->get('adapterKey');
        $traderId = $this->parameters->get('traderId');
        $message = $this->parameters->get('message');

        $this->connectionManager->getConnection($adapterKey, $traderId)->send($message);

        return 'ok';
    }
}
