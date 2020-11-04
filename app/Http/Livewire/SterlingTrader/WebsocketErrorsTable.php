<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderWebsocketError;
use Livewire\Component;

class WebsocketErrorsTable extends Component
{
    public function render()
    {
        return view('livewire.sterling-trader.websocket-errors-table', [
            'websocketErrors' => SterlingTraderWebsocketError::orderBy('id', 'desc')->paginate(100),
        ]);
    }
}
