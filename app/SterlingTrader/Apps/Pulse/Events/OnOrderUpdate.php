<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

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

        $targetAccount = $instruction['parameters']['target_account'];

        $targetConnection = $this->connectionManager->getConnection($this->connection->adapter->key, $targetAccount);

        if ($targetConnection === null) {
            return;
        }

        switch ($this->data['nOrderStatus']) {

            case 13: //New
                $targetConnection->send(AdapterResponse::submitOrderStruct($orderStruct));
                break;

            case 8: //Cancelled
                $targetConnection->send(AdapterResponse::cancelOrder(
                    $targetAccount,
                    0,
                    $copyOrder->generateOrderIdFromLog(),
                    uniqid('cancel-')
                ));
                break;

            case 11: //Replaced
                $targetConnection->send(AdapterResponse::replaceOrderStruct($orderStruct, 0, $copyOrder->generateOrderIdFromLog()));
                break;

            default:
                break;
        }
    }
}
