<?php

namespace App\SterlingTrader\Struct;

class CancelAllStruct extends XMLStruct
{
    /** @var bool */
    public $bExtendingOnly;

    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrSymbol;

    public function root(): string
    {
        return 'structSTICancelAll';
    }
}
