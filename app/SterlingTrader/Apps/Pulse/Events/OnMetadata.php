<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

class OnMetadata extends EventHandler
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
        $this->connectionManager->addAccounts($this->connection->adapterKey, $this->connection->traderId, $data['AccountList']);
    }
}
