<?php

namespace App\Http\Livewire\SterlingTrader;

use Auth;
use Livewire\Component;

class PulsePositions extends Component
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
        return view('livewire.sterling-trader.pulse-positions');
    }

    public function fetchPositions()
    {
        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $this->positions = optional($adapterAction)->fetchPositions() ?? [];
    }
}
