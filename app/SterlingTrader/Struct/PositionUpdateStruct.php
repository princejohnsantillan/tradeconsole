<?php

namespace App\SterlingTrader\Struct;

class PositionUpdateStruct extends XMLStruct
{
    /** @var bool */
    public $bLast;

    /** @var bool */
    public $bMsgSnapShot;

    /** @var string */
    public $bstrAcct;

    /** @var string */
    public $bstrInstrument;

    /** @var string */
    public $bstrSym;

    /** @var float */
    public $fBaseCurMultiplier;

    /** @var float */
    public $fClosePrice;

    /** @var float */
    public $fDollarsBot;

    /** @var float */
    public $fDollarsSld;

    /** @var float */
    public $fDollarsSldLong;

    /** @var float */
    public $fDollarsSldShort;

    /** @var float */
    public $fPositionCost;

    /** @var float */
    public $fPremiumMultiplier;

    /** @var float */
    public $fReal;

    /** @var int */
    public $nBullets;

    /** @var int */
    public $nConversion;

    /** @var int */
    public $nOpeningPosition;

    /** @var int */
    public $nPremiumMultiplier;

    /** @var int */
    public $nSharesBot;

    /** @var int */
    public $nSharesPerContract;

    /** @var int */
    public $nSharesSld;

    /** @var int */
    public $nSharesSldLong;

    /** @var int */
    public $nSharesSldShort;

    /** @var int */
    public $nTicketsBot;

    /** @var int */
    public $nTicketsSld;

    /** @var int */
    public $nTicketsSldLong;

    /** @var int */
    public $nTicketsSldShort;

    /** @var int */
    public $Position;

    public function root(): string
    {
        return 'structSTIPositionUpdate';
    }

    protected function computeProperties()
    {
        $this->Position = $this->nOpeningPosition + ($this->nSharesBot - $this->nSharesSld);
    }
}
