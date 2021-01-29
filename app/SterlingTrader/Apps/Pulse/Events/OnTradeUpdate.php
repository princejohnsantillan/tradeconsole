<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Struct\OrderStruct;
use Illuminate\Support\Facades\Cache;

class OnTradeUpdate extends EventHandler
{
    private const MINIMUM_TRADE_VALUE = 1000;
    private const MINIMUM_TRADE_QUANTITY = 100;

    protected function canHandle(array $instruction): bool
    {
        $conditions = $instruction['conditions'];

        $excluded_symbols = array_map('trim', explode(',', $conditions['excluded_symbols']));

        return $conditions['source_account'] === $this->data['bstrAccount']
            && ! in_array($this->data['bstrSymbol'], $excluded_symbols);
    }

    protected function execute(array $instruction)
    {
        if ($this->data['nLvsQuantity'] > 0) {
            return;
        }

        $parameters = $instruction['parameters'];

        $data = [
            'bstrAccount' => $parameters['target_account'],
            'bstrSymbol' => $this->data['bstrSymbol'],
            'bstrSide' => $this->determineSide($parameters),
            'nQuantity' => $this->determineQuantity($parameters),
            'nPriceType' => $this->determinePriceType($parameters),
            'bstrDestination' => $parameters['destination'],
            'bstrTif' => 'D',
            'bstrClOrderId' => uniqid('TU').md5(now()),
        ];

        if ($data['nQuantity'] === 0) {
            return;
        }

        if ($data['nPriceType'] === 5) {
            $data['fLmtPrice'] = $this->determinePrice($parameters);
        }

        $orderStruct = OrderStruct::build($data);

        $target_connection = $this->connectionManager->getConnection($this->connection->adapter->key, $parameters['target_account']);

        $target_connection->send(AdapterResponse::submitOrderStruct($orderStruct));
    }

    private function determineSide($parameters)
    {
        $side = $this->data['bstrSide'];

        if ($parameters['side'] === 'reverse') {
            return [
                'B' => 'T',
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

    private function determinePriceType($parameters): int
    {
        if ($parameters['price_mode'] === 'market') {
            return 1;
        }

        return 5;
    }

    private function determinePrice($parameters): float
    {
        $data_price = (float) $this->data['fExecPrice'];

        $price_shift = (float) $parameters['price_shift'];

        return $data_price + $price_shift;
    }

    private function determineQuantity($parameters)
    {
        $computed_price = $this->determinePrice($parameters);

        $original_quantity = (int) Cache::get("quantity-{$this->data['bstrAccount']}-{$this->data['nOrderRecordId']}", $this->data['nQuantity']);

        $computed_quantity = (int) round($original_quantity * $parameters['quantity']);

        if ($computed_quantity >= static::MINIMUM_TRADE_QUANTITY) {
            return $computed_quantity;
        }

        if (($computed_price * $computed_quantity) >= static::MINIMUM_TRADE_VALUE) {
            return $computed_quantity;
        }

        return (int) ceil(static::MINIMUM_TRADE_VALUE / $computed_price);
    }
}
