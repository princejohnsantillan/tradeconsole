<?php

namespace App\Http\Livewire\SterlingTrader;

use App\SterlingTrader\AdapterHttpAction;
use App\SterlingTrader\Contracts\AdapterProvider;
use Auth;
use Livewire\Component;

class PulseAppControls extends Component
{
    public $positions;

    protected $listeners = [
        'echo:SterlingTraderAdapter,PositionUpdated' => 'fetchPositions',
    ];

    public function mount()
    {
        $this->fetchPositions();
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-app-controls');
    }

    public function fetchPositions()
    {
        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $this->positions = optional($adapterAction)->fetchPositions() ?? [];
    }
}
