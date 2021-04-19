<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Apps\Pulse\CopyOrder;

class OnTradeUpdate extends EventHandler
{
    protected function canHandle(array $instruction): bool
    {
        $conditions = $instruction['conditions'];

        $excluded_symbols = array_map('trim', explode(',', $conditions['excluded_symbols']));

        return $conditions['source_account'] === $this->data['bstrAccount']
            && ! in_array($this->data['bstrSymbol'], $excluded_symbols);
    }

    protected function execute(array $instruction)
    {
        $copyOrder = CopyOrder::given($this->data, $instruction);

        if (! $copyOrder->isValid()) {
            return;
        }

        $orderStruct = $copyOrder->generateOrderStruct();

        $target_connection = $this->connectionManager->getConnection($this->connection->adapter->key, $instruction['parameters']['target_account']);

        sleep($instruction['parameters']['delay'] ?? 0);

        $target_connection->send(AdapterResponse::submitOrderStruct($orderStruct));
    }
}
