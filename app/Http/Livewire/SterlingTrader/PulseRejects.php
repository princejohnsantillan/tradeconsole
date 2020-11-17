<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseRejects extends Component
{
    public function render()
    {
        $adapter = Auth::user()->activeSterlingTraderAdapter;

        $rejects = $adapter === null
            ? []
            : SterlingTraderMessage::where('adapter_id', $adapter->id)
                ->where('message->event', 'OrderReject')
                ->where('created_at', '>', Carbon::now()->startOfDay())
                ->orderByDesc('created_at')
                ->get(['message', 'id', 'created_at']);

        return view('livewire.sterling-trader.pulse-rejects', [
            'rejects' => $rejects,
        ]);
    }
}
