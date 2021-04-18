<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\OrderStruct;
use Exception;
use Illuminate\Support\Str;

class CopyOrder
{
    private $data;

    private $parameters;

    private $instructionId;

    public function __construct($data, $instruction)
    {
        $this->data = $data;

        $this->parameters = $instruction['parameters'];

        $this->instructionId = $instruction['id'];
    }

    public static function given($data, $instruction)
    {
        return new static($data, $instruction);
    }

    public function generateOrderStruct(): OrderStruct
    {
        //TODO: add validate data function

        $order = [
            'bstrAccount' => $this->parameters['target_account'],
            'bstrSymbol' => $this->data['bstrSymbol'],
            'bstrSide' => $this->side(),
            'nQuantity' => $this->quantity(),
            'nDisplay' => $this->quantity(),
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
        if (Str::contains($this->parameters['destination'], ':')) {
            $destination_map = [];

            try {
                foreach (explode(',', $this->parameters['destination']) as $pair) {
                    [$from, $to] = explode(':', $pair);

                    $destination_map[trim($from)] = trim($to);
                }
            } catch (Exception $e) {
                //TODO: revisit implementation
            }

            return $destination_map[$this->data['bstrDestination']] ?? $this->data['bstrDestination'];
        } else {
            return $this->parameters['destination'] ?: $this->data['bstrDestination'];
        }
    }

    private function timeInForce()
    {
        return $this->parameters['time_in_force'] ?: $this->data['bstrTif'];
    }

    private function generateOrderId()
    {
        return "tcco-{$this->instructionId}-{$this->data['nOrderRecordId']}-{$this->data['nSeqNo']}-{$this->data['nDbsNo']}";
    }

    public function generateOrderIdFromLog()
    {
        return "tcco-{$this->instructionId}-{$this->data['nOrderRecordId']}".Str::between($this->data['bstrLogMessage'], $this->data['bstrAccount'], ')');
    }
}
