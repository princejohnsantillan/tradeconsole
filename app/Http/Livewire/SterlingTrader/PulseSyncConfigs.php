<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseSyncConfigs extends Component
{
    protected $listeners = ['SettingRemoved' => '$refresh'];

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-settings', [
            'settings' => Auth::user()->PulseSyncSettings,
        ]);
    }

    public function addSetting()
    {
        Auth::user()->pulseSyncSettings()->create([
            'source' => 'Source Account',
            'target' => 'Target Account',
            'weight' => '100',
        ]);
    }
}