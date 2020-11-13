<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Struct\OrderStruct;

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
        $parameters = $instruction['parameters'];

        $orderStruct = OrderStruct::build([
            'bstrAccount' => $parameters['account'],
            'bstrSymbol' => $this->data['bstrSymbol'],
            'bstrSide' => $this->determineSide($parameters),
            'nQuantity' => $this->determineQuantity($parameters),
            'nPriceType' => $this->determinePriceType($parameters),
            'fLmtPrice' => $this->determinePrice($parameters),
            'bstrDestination' => $parameters['destination'],
            'bstrTif' => 'D',
        ]);

        $target_connection = $this->connectionManager->getConnection($this->connection->adapter->key, $parameters['account']);

        $target_connection->send(AdapterResponse::submitOrderStruct($orderStruct));
    }

    private function determineSide($parameters)
    {
        $side = $this->data['bstrSide'];
        if ($parameters['side'] === 'reverse') {
            return [
                'B' => 'S',
                'C' => 'T',
                'S' => 'B',
                'T' => 'B',
                'M' => 'P',
                'P' => 'M',
                'E' => 'B',
            ][$side];
        }

        return $side;
    }

    private function determineQuantity($parameters)
    {
        return (int) round((int) $this->data['nQuantity'] * (int) $parameters['quantity']);
    }

    private function determinePriceType($parameters): int
    {
        if ($parameters['price_mode'] === 'market') {
            return 1;
        }

        return 5;
    }

    private function determinePrice($parameters): float
    {
        $data_price = (float) $this->data['fLmtPrice'];

        $price_shift = (float) $parameters['price_shift'];

        if ($parameters['price_mode'] === 'market') {
            return $data_price;
        }

        return $data_price + $price_shift;
    }
}
