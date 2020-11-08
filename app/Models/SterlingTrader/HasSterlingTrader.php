<?php

namespace App\Models\SterlingTrader;

trait HasSterlingTrader
{
    public function sterlingTraderAdapter()
    {
        return $this->hasOne(SterlingTraderAdapter::class);
    }

    public function activeSterlingTraderAdapter()
    {
        return $this->hasOne(SterlingTraderAdapter::class)->active();
    }

    public function getSterlingTraderAdapterKey()
    {
        return optional($this->activeSterlingTraderAdapter)->key;
    }

    public function pulseInstructions()
    {
        return $this->hasMany(PulseUserInstruction::class);
    }

    public function activePulseInstructions()
    {
        return $this->hasMany(PulseUserInstruction::class)->active;
    }
}
