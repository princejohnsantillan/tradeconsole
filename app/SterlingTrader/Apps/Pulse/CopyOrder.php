<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\OrderStruct;
use Illuminate\Support\Str;

class CopyOrder
{
    private $data;

    private $parameters;

    public function __construct($data, $parameters)
    {
        $this->data = $data;
        $this->parameters = $parameters;
    }

    public static function given($data, $parameters)
    {
        return new static($data, $parameters);
    }

    public function generateOrderStruct(): OrderStruct
    {
        //TODO: add validate data function

        $order = [
            'bstrAccount' => $this->parameters['target_account'],
            'bstrSymbol' => $this->data['bstrSymbol'],
            'bstrSide' => $this->side(),
            'nQuantity' => $this->quantity(),
            'nPriceType' => $this->priceType(),
            'fLmtPrice' => $this->price(),
            'bstrDestination' => $this->destination(),
            'bstrTif' => $this->timeInForce(),
            'bstrClOrderId' => $this->generateOrderId(),
        ];

        return OrderStruct::build($order);
    }

    public function isValid(): bool
    {
        //Check if required fields exist

        if ($this->quantity() === 0) {
            return false;
        }

        return true;
    }

    private function side()
    {
        $side = $this->data['bstrSide'];

        if ($this->parameters['side'] === 'reverse') {
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

    private function quantity(): int
    {
        return (int) round($this->data['nQuantity'] * $this->parameters['quantity']);
    }

    private function priceType()
    {
        return [
            'market' => 1,
            'limit' => 5,
            'copy' => $this->data['nPriceType'],
        ][$this->parameters['price_type']];
    }

    private function price(): float
    {
        $data_price = (float) array_key_exists('fExecPrice', $this->data) ? $this->data['fExecPrice'] : $this->data['fLmtPrice'];

        $price_shift = (float) $this->parameters['price_shift'];

        return $data_price + $price_shift;
    }

    private function destination()
    {
        return  array_key_exists('destination', $this->parameters) ? $this->parameters['destination'] : $this->data['destination'];
    }

    private function timeInForce()
    {
        return array_key_exists('time_in_force', $this->parameters) ? $this->parameters['time_in_force'] : $this->data['bstrTif'];
    }

    private function generateOrderId()
    {
        return "tcco-{$this->data['nOrderRecordId']}-{$this->data['nSeqNo']}-{$this->data['nDbsNo']}";
    }

    public function generateOrderIdFromLog()
    {
        return "tcco-{$this->data['nOrderRecordId']}".Str::between($this->data['bstrLogMessage'], $this->data['bstrAccount'], ')');
    }
}
