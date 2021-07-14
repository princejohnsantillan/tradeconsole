<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Jobs\SendMessageToSterling;
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

        $adapterKey = $this->connection->adapter->key;

        $targetAccount = $instruction['parameters']['target_account'];

        $targetConnection = $this->connectionManager->getConnection($adapterKey, $targetAccount);

        $response = AdapterResponse::submitOrderStruct($orderStruct);

        $delay = intval($instruction['parameters']['delay'] ?? 0);

        if ($delay > 0) {
            SendMessageToSterling::dispatch($adapterKey, $targetAccount, $response)
                ->delay(now()->addMilliseconds($delay));
        } else {
            $targetConnection->send($response);
        }
    }
}
