<?php

namespace App\SterlingTrader\Struct;

class TradeUpdateStruct extends Struct
{
    /** @var bool */
    public $bClearable;

    /** @var bool */
    public $bEcnFee;

    /** @var bool */
    public $bPossDupe;

    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrAccountType;

    /** @var string */
    public $bstrAction;

    /** @var string */
    public $bstrBatchId;

    /** @var string */
    public $bstrClOrderId;

    /** @var string */
    public $bstrContra;

    /** @var string */
    public $bstrCoverUncover;

    /** @var string */
    public $bstrCurrency;

    /** @var string */
    public $bstrDestination;

    /** @var string */
    public $bstrExchClOrderId;

    /** @var string */
    public $bstrExchExecId;

    /** @var string */
    public $bstrExchOrderId;

    /** @var string */
    public $bstrExchOrderId2;

    /** @var string */
    public $bstrExecBroker;

    /** @var string */
    public $bstrExecInst;

    /** @var string */
    public $bstrFutSettDate;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrLastMkt;

    /** @var string */
    public $bstrLiquidity;

    /** @var string */
    public $bstrLogMessage;

    /** @var string */
    public $bstrMaturity;

    /** @var string */
    public $bstrOpenClose;

    /** @var string */
    public $bstrOrderTime;

    /** @var string */
    public $bstrPutCall;

    /** @var string */
    public $bstrSettCurrency;

    /** @var string */
    public $bstrSide;

    /** @var string */
    public $bstrSpecialist;

    /** @var string */
    public $bstrSymbol;

    /** @var string */
    public $bstrTif;

    /** @var string */
    public $bstrTradeTime;

    /** @var string */
    public $bstrUnderlying;

    /** @var string */
    public $bstrUpdateTime;

    /** @var string */
    public $bstrUserId;

    /** @var float */
    public $fDiscretion;

    /** @var float */
    public $fExecPrice;

    /** @var float */
    public $fLmtPrice;

    /** @var float */
    public $fPegDiff;

    /** @var float */
    public $fStpPrice;

    /** @var float */
    public $fStrikePrice;

    /** @var int */
    public $nDbsNo;

    /** @var int */
    public $nLvsQuantity;

    /** @var int */
    public $nOrderRecordId;

    /** @var int */
    public $nPriceType;

    /** @var int */
    public $nQuantity;

    /** @var int */
    public $nSeqNo;

    /** @var int */
    public $nTradeRecordId;

    public function root(): string
    {
        return 'structSTITradeUpdate';
    }
}
