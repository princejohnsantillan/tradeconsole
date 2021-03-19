<?php

namespace App\Http\Livewire\SterlingTrader;

use Auth;
use Livewire\Component;

class PulsePositions extends Component
{
    public $sortField;

    public $sortAsc;

    protected $listeners = [
        'echo:SterlingTraderAdapter,PositionUpdated' => '$refresh',
    ];

    public function mount()
    {
        $this->sortField = 'Account';

        $this->sortAsc = true;
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-positions', [
            'positions' => $this->fetchPositions(),
        ]);
    }

    public function fetchPositions()
    {
        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $positions = optional($adapterAction)->fetchPositions() ?? [];

        return collect($positions)->sortBy($this->sortField, SORT_NATURAL, ! $this->sortAsc);
    }

    public function sortPosition($field)
    {
        $this->sortAsc = $this->sortField == $field ? ! $this->sortAsc : true;

        $this->sortField = $field;
    }
}
