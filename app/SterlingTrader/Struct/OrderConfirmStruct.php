<?php

namespace App\SterlingTrader\Struct;

class OrderConfirmStruct extends Struct
{
    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrClOrderId;

    /** @var string */
    public $bstrExchClOrderId;

    /** @var string */
    public $bstrExchOrderId;

    /** @var string */
    public $bstrExchOrderId2;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrMsgConfirm;

    /** @var int */
    public $nOrderRecordId;

    public function root(): string
    {
        return 'structSTIOrderConfirm';
    }
}
