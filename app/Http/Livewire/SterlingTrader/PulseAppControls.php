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

    private function newAdapterAction()
    {
        $adapterKey = Auth::user()->getSterlingTraderAdapterKey();

        if ($adapterKey === null) {
            return null;
        }

        $adapter = app(AdapterProvider::class)->findByKey($adapterKey);

        return new AdapterHttpAction($adapter);
    }

    public function fetchPositions()
    {
        $this->positions = optional($this->newAdapterAction())
            ->fetchPositions() ?? [];
    }
}
