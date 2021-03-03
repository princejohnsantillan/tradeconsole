<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Models\SterlingTrader\SterlingSymbol;
use App\SterlingTrader\AdapterResponse;

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

        $this->registerSymbols();
    }

    private function registerSymbols()
    {
        $adapter_connections = $this->connectionManager->getAdapterConnections($this->connection->adapter->key);

        foreach (SterlingSymbol::cursor() as $symbol) {
            foreach ($adapter_connections as $connection) {
                $connection['connection']->send(AdapterResponse::switchLinkGroupSymbol(1, $symbol->symbol));
            }
        }
    }
}
