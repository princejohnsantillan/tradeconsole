<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseSyncSettings extends Component
{
    protected $listeners = ['SettingRemoved' => '$refresh'];

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-settings', [
            'settings' => Auth::user()->pulseSyncSettings,
        ]);
    }

    public function addSetting()
    {
        Auth::user()->PulseSyncSettings()->create([
            'source' => 'Source Account',
            'target' => 'Target Account',
            'weight' => '100',
        ]);
    }
}
