<?php

namespace App\SterlingTrader\Struct;

class SymbolControlStruct extends XMLStruct
{
    /** @var bool */
    public $bSetMarginPctFlag;

    /** @var string */
    public $bstrAcct;

    /** @var string */
    public $bstrSymbol;

    /** @var int */
    public $lMarginPct;

    public function root(): string
    {
        return 'structSTISymbolControl';
    }
}
