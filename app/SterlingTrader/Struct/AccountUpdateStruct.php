<?php

namespace App\SterlingTrader\Struct;

class AccountUpdateStruct extends XMLStruct
{
    /** @var bool */
    public $bSetDayBpFlag;

    /** @var bool */
    public $bSetDayFloatBpFlag;

    /** @var bool */
    public $bSetMaintExcessFlag;

    /** @var bool */
    public $bSetMaxLossFlag;

    /** @var bool */
    public $bSetNetLiqFlag;

    /** @var bool */
    public $bSetNightBpFlag;

    /** @var bool */
    public $bSetNightFloatBpFlag;

    /** @var bool */
    public $bSetStatusFlag;

    /** @var string */
    public $bstrAcct;

    /** @var float */
    public $fDayBp;

    /** @var float */
    public $fDayFloatBp;

    /** @var float */
    public $fMaintExcess;

    /** @var float */
    public $fMaxLoss;

    /** @var float */
    public $fNetLiq;

    /** @var float */
    public $fNightBp;

    /** @var float */
    public $fNightFloatBp;

    /** @var int */
    public $lStatus;

    public function root(): string
    {
        return 'structSTIAcctUpdate';
    }
}
