<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseInstructions extends Component
{
    public $toggleActivate;

    protected $listeners = ['InstructionRemoved' => '$refresh'];

    public function mount()
    {
        $this->toggleActivate = ! Auth::user()->pulseInstructions()->inActive()->exists();
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-instructions',[
            'instructions' => Auth::user()->pulseInstructions
        ]);
    }

    public function addInstruction()
    {
        Auth::user()->pulseInstructions()->create([
            'activated' => false,
            'instruction' => [
                'conditions' => [
                    'source_account' => '',
                    'excluded_symbols' => '',
                ],
                'parameters' => [
                    'account' => '',
                    'side' => 'same',
                    'quantity' => 1,
                    'price_mode' => 'shift',
                    'price_shift' => 0,
                    'destination' => 'ARCA',
                ],
            ],
        ]);
    }

    public function updatedToggleActivate()
    {
        Auth::user()->pulseInstructions()->update(['activated' => $this->toggleActivate]);
    }
}
