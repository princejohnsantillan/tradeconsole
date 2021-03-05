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
        $parameters = $instruction['parameters'];

        $copyOrder = CopyOrder::given($this->data, $parameters);

        if (! $copyOrder->isValid()) {
            return;
        }

        $orderStruct = $copyOrder->generateOrderStruct();

        $target_connection = $this->connectionManager->getConnection($this->connection->adapter->key, $parameters['target_account']);

        switch ($this->data['nOrderStatus']) {

            case 13: //New
                $target_connection->send(AdapterResponse::submitOrderStruct($orderStruct));
                break;

            case 8: //Cancelled
                $target_connection->send(AdapterResponse::cancelOrder(
                    $parameters['target_account'],
                    0,
                    $copyOrder->getOrderIdFromLog(),
                    uniqid('cancel-')
                ));
                break;

            case 11: //Replaced
                $target_connection->send(AdapterResponse::replaceOrderStruct($orderStruct, 0, $copyOrder->getOrderIdFromLog()));
                break;

            default:
                break;
        }
    }
}
