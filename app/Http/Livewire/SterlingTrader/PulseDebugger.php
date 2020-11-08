<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use App\SterlingTrader\AdapterHttpActions;
use App\SterlingTrader\Contracts\AdapterProvider;
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

    private function callAdapterAction()
    {
        $adapterKey = Auth::user()->getSterlingTraderAdapterKey();

        $adapter = app(AdapterProvider::class)->findByKey($adapterKey);

        return new AdapterHttpActions($adapter);
    }

    public function mount()
    {
        $this->connections = $this->callAdapterAction()
            ->fetchConnections();
    }

    public function render()
    {
        $messages = [];
        $websocketErrors = [];

        $activeAdapter = Auth::user()->activeSterlingTraderAdapter;

        if ($activeAdapter !== null) {
            if ($this->tab === 'messages') {
                $messages = SterlingTraderMessage::where('adapter_id', $activeAdapter->id)->latest()->paginate(100);
                $websocketErrors = [];
            } elseif ($this->tab === 'errors') {
                $messages = [];
                $websocketErrors = SterlingTraderWebsocketError::where('adapter_id', $activeAdapter->id)->latest()->paginate(100);
            }
        }

        return view('livewire.sterling-trader.pulse-debugger', [
            'messages' => $messages,
            'websocketErrors' => $websocketErrors,
        ]);
    }

    public function switchTab(string $tab)
    {
        $this->tab = $tab;

        $this->resetPage();
    }

    public function sendData()
    {
        if ($this->trader === null) {
            return;
        }

        $this->callAdapterAction()->sendData($this->trader, $this->data);

        $this->data = null;
    }
}
