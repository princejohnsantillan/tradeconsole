<?php

namespace App\Http\Livewire\SterlingTrader;

use App\SterlingTrader\AdapterHttpActions;
use App\SterlingTrader\Contracts\AdapterProvider;
use Auth;
use Livewire\Component;

class PulseAppControls extends Component
{
    public $positions;

    private function callAdapterAction()
    {
        $adapterKey = Auth::user()->getSterlingTraderAdapterKey();

        if ($adapterKey === null) {
            return null;
        }

        $adapter = app(AdapterProvider::class)->findByKey($adapterKey);

        return new AdapterHttpActions($adapter);
    }

    public function mount()
    {
        $this->positions = optional($this->callAdapterAction())
            ->fetchPositions() ?? [];
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-app-controls');
    }
}
