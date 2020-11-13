<?php

namespace App\Models\SterlingTrader;

use App\SterlingTrader\AdapterHttpAction;
use App\SterlingTrader\Contracts\AdapterProvider;

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

    public function getSterlingTraderAdapterHttpAction()
    {
        $adapterKey = $this->getSterlingTraderAdapterKey();

        if ($adapterKey === null) {
            return null;
        }

        $adapter = app(AdapterProvider::class)->findByKey($adapterKey);

        if ($adapter === null) {
            return null;
        }

        return new AdapterHttpAction($adapter);
    }

    public function pulseInstructions()
    {
        return $this->hasMany(PulseUserInstruction::class);
    }

    public function activePulseInstructions()
    {
        return $this->hasMany(PulseUserInstruction::class)->active();
    }

    public function pulseInstructionsFor(string $event)
    {
        return $this->activePulseInstructions()->where('event', $event)->pluck('instruction', 'id');
    }
}
