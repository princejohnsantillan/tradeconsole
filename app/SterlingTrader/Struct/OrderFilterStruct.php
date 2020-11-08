<?php

namespace App\SterlingTrader\Struct;

class OrderFilterStruct extends Struct
{
    /** @var bool */
    public $bOpenOnly;

    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrSymbol;

    public function root() : string
    {
        return 'structSTIOrderFilter';
    }
}
