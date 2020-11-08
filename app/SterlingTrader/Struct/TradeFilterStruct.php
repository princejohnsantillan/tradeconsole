<?php

namespace App\SterlingTrader\Struct;

class TradeFilterStruct extends Struct
{
    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrSymbol;

    public function root(): string
    {
        return 'structSTITradeFilter';
    }
}
