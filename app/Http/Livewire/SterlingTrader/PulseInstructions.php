<?php

namespace App\Http\Livewire\SterlingTrader;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseInstructions extends Component
{
    protected $listeners = ['InstructionRemoved' => '$refresh'];

    public function render()
    {
        return view('livewire.sterling-trader.pulse-instructions', [
            'instructions' => Auth::user()->pulseInstructions,
        ]);
    }

    public function addInstruction()
    {
        Auth::user()->pulseInstructions()->create([
            'activated' => false,
            'instruction' => [
                'conditions' => [
                    'excluded_symbols' => '',
                    'source_account' => 'Source Account',
                ],
                'parameters' => [
                    'target_account' => 'Target Account',
                    'side' => 'same',
                    'quantity' => 1,
                    'price_mode' => 'shift',
                    'price_shift' => 0,
                    'destination' => 'ARCA',
                ],
            ],
        ]);
    }
}
