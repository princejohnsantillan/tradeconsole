<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Jobs\SendMessageToSterling;
use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Apps\Pulse\CopyOrder;

class OnOrderUpdate extends EventHandler
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

        if ($targetConnection === null) {
            return;
        }

        $response = null;

        switch ($this->data['nOrderStatus']) {
            case 13: //New
                $response = AdapterResponse::submitOrderStruct($orderStruct);

                break;

            case 8: //Cancelled
                $response = AdapterResponse::cancelOrder(
                    $targetAccount,
                    0,
                    $copyOrder->generateOrderIdFromLog(),
                    uniqid('cancel-')
                );
                break;

            case 11: //Replaced
                $response = AdapterResponse::replaceOrderStruct($orderStruct, 0, $copyOrder->generateOrderIdFromLog());
                break;

            default:
                break;
        }

        if ($response === null) {
            return;
        }

        $delay = intval($instruction['parameters']['delay'] ?? 0);

        if ($delay > 0) {
            SendMessageToSterling::dispatch($adapterKey, $targetAccount, $response)
                ->delay(now()->addMilliseconds($delay));
        } else {
            $targetConnection->send($response);
        }
    }
}
