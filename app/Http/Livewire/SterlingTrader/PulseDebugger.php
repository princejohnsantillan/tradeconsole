<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PulseDebugger extends Component
{
    use WithPagination;

    public $tab = 'messages';

    public $connections = [];

    public $data;

    public $trader;

    public $details;

    public $showDetails = false;

    public function mount()
    {
        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $this->connections = optional($adapterAction)->fetchConnections() ?? [];
    }

    public function render()
    {
        $activeAdapter = Auth::user()->activeSterlingTraderAdapter;

        return view('livewire.sterling-trader.pulse-debugger', [
            'messages' => SterlingTraderMessage::where('adapter_id', optional($activeAdapter)->id)->latest('id')->paginate(50),
            'websocketErrors' => SterlingTraderWebsocketError::where('adapter_id', optional($activeAdapter)->id)->latest('id')->paginate(50),
        ]);
    }

    public function switchTab(string $tab)
    {
        $this->tab = $tab;

        $this->resetPage();
    }

    public function sendData()
    {
        if (empty($this->trader)) {
            return;
        }

        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        optional($adapterAction)->sendData($this->trader, $this->data);

        $this->data = null;
    }

    public function getDetails($id)
    {
        if ($this->tab === 'messages') {
            $this->details = optional(SterlingTraderMessage::find($id))->raw_message;
        } elseif ($this->tab === 'errors') {
            $this->details = optional(SterlingTraderWebsocketError::find($id))->trace;
        }

        $this->showDetails = true;
    }
}
