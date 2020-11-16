<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseSyncConfigs extends Component
{
    protected $listeners = ['ConfigRemoved' => '$refresh'];

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-configs', [
            'configs' => Auth::user()->pulseSyncConfigs,
        ]);
    }

    public function addConfig()
    {
        Auth::user()->pulseSyncConfigs()->create([
            'source' => 'Source Account',
            'target' => 'Target Account',
            'weight' => '100',
        ]);
    }
}
