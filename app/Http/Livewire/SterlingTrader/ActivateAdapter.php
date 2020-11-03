<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivateAdapter extends Component
{
    public $downloadLink = '#';

    public $consoleAddress;

    public function mount()
    {
        $this->setConsoleAddress();
    }

    public function render()
    {
        return view('livewire.sterling-trader.activate-adapter');
    }

    private function setConsoleAddress()
    {
        $adapterKey = Auth::user()->getSterlingTraderAdapterKey();

        $this->consoleAddress = ($adapterKey === null) ? null : config('sterlingtrader.console_address').$adapterKey;
    }

    public function activate()
    {
        if (Auth::user()->sterlingTraderAdapter()->exists()) {
            Auth::user()->sterlingTraderAdapter->activate();
        } else {
            Auth::user()->sterlingTraderAdapter()->make()->saveWithFreshKeys();
        }

        $this->setConsoleAddress();
    }
}
