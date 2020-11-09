<?php

namespace App\SterlingTrader\Struct;

class OrderStruct extends XMLStruct
{
    /** @var bool */
    public $bMoc;

    /** @var bool */
    public $bMoo;

    /** @var bool */
    public $bOpportunisticTrade;

    /** @var bool */
    public $bPossDupe;

    /** @var bool */
    public $bPriceCheck;

    /** @var bool */
    public $bPriceQtyOverride;

    /** @var string */
    public $bstrAccount;

    /** @var string */
    public $bstrAccountType;

    /** @var string */
    public $bstrBatchId;

    /** @var string */
    public $bstrClOrderId;

    /** @var string */
    public $bstrCommName;

    /** @var string */
    public $bstrCoverUncover;

    /** @var string */
    public $bstrCurrency;

    /** @var string */
    public $bstrDestination;

    /** @var string */
    public $bstrEndTime;

    /** @var string */
    public $bstrExecBroker;

    /** @var string */
    public $bstrExecInst;

    /** @var string */
    public $bstrFutSettDate;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrListingExchange;

    /** @var string */
    public $bstrLocateBroker;

    /** @var string */
    public $bstrLocateTime;

    /** @var string */
    public $bstrMaturity;

    /** @var string */
    public $bstrOpenClose;

    /** @var string */
    public $bstrPairId;

    /** @var string */
    public $bstrPutCall;

    /** @var string */
    public $bstrSettCurrency;

    /** @var string */
    public $bstrSide;

    /** @var string */
    public $bstrSorPreference;

    /** @var string */
    public $bstrStartTime;

    /** @var string */
    public $bstrStrategy;

    /** @var string */
    public $bstrStrPriceType;

    /** @var string */
    public $bstrSymbol;

    /** @var string */
    public $bstrTif;

    /** @var string */
    public $bstrUnderlying;

    /** @var string */
    public $bstrUser;

    /** @var bool */
    public $bTakeLiquidity;

    /** @var float */
    public $fAvgPriceLmt;

    /** @var float */
    public $fCashComponent;

    /** @var float */
    public $fDiscretion;

    /** @var float */
    public $fExecPriceLmt;

    /** @var float */
    public $fLmtPrice;

    /** @var float */
    public $fMaxHighPctDeviation;

    /** @var float */
    public $fMaxLowPctDeviation;

    /** @var float */
    public $fPctPerSlice;

    /** @var float */
    public $fPegDiff;

    /** @var float */
    public $fPremium;

    /** @var float */
    public $fRatio;

    /** @var float */
    public $fReactPrice;

    /** @var float */
    public $fStpPrice;

    /** @var float */
    public $fStrikePrice;

    /** @var float */
    public $fTargetPctVolume;

    /** @var float */
    public $fTargetPrice;

    /** @var float */
    public $fTilt;

    /** @var float */
    public $fTrailAmt;

    /** @var float */
    public $fTrailInc;

    /** @var int */
    public $nAuction;

    /** @var int */
    public $nDisplay;

    /** @var int */
    public $nDuration;

    /** @var int */
    public $nExecAggression;

    /** @var int */
    public $nLocateQty;

    /** @var int */
    public $nLvsQty;

    /** @var int */
    public $nMarketStructure;

    /** @var int */
    public $nMaxPctVolume;

    /** @var int */
    public $nMinPctVolume;

    /** @var int */
    public $nMinQuantity;

    /** @var int */
    public $nOrderCompletion;

    /** @var int */
    public $nPingInterval;

    /** @var int */
    public $nPriceTolerance;

    /** @var int */
    public $nPriceType;

    /** @var int */
    public $nQtyTolerancePct;

    /** @var int */
    public $nQtyToleranceSize;

    /** @var int */
    public $nQuantity;

    /** @var int */
    public $nRefreshInterval;

    /** @var int */
    public $nRefreshQty;

    /** @var int */
    public $nSizeLow;

    /** @var int */
    public $nSizeMax;

    public function root(): string
    {
        return 'structSTIOrder';
    }
}
