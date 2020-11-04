<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderMessage;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.sterling-trader.messages-table', [
            'messages' => SterlingTraderMessage::orderBy('id', 'desc')->paginate(100),
        ]);
    }
}
