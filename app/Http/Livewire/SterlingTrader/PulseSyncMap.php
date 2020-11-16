<?php

namespace App\Http\Livewire\SterlingTrader;

use Livewire\Component;

class PulseSyncMap extends Component
{
    public $positionMap = [];

    protected $listeners = [
        'echo:SterlingTraderAdapter,PositionUpdated' => 'analyzePositions',
        'ConfigRemoved' => 'analyzePositions',
    ];

    public function mount()
    {
        $this->positionMap = $this->analyzePositions();
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-map');
    }

    public function analyzePositions()
    {
        return [];
    }

    public function alignPositions()
    {
    }
}
