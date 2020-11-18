<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseRejects extends Component
{
    public $rejects;

    protected $listeners = [
        'echo:SterlingTraderAdapter,OrderRejected' => 'fetchRejects',
    ];

    public function mount()
    {
        $this->fetchRejects();
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-rejects');
    }

    public function fetchRejects()
    {
        $adapter = Auth::user()->activeSterlingTraderAdapter;

        $this->rejects = $adapter === null
            ? []
            : SterlingTraderMessage::where('adapter_id', $adapter->id)
                ->where('message->event', 'OrderReject')
                ->where('created_at', '>', Carbon::now()->startOfDay())
                ->orderByDesc('created_at')
                ->limit(50)
                ->get(['message', 'id', 'created_at']);
    }
}
