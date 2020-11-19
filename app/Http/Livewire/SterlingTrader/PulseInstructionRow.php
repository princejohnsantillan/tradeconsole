<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\PulseInstruction;
use Livewire\Component;

class PulseInstructionRow extends Component
{
    public $show;

    public $instructionId;

    public $activated;

    public $event;

    public $sourceAccount;

    public $excludedSymbols;

    public $targetAccount;

    public $side;

    public $quantity;

    public $priceMode;

    public $priceShift;

    public $destination;

    public function mount($instruction)
    {
        $this->show = true;

        $this->instructionId = $instruction->id;
        $this->activated = $instruction->activated;
        $this->event = $instruction->event;
        $this->sourceAccount = data_get($instruction->instruction, 'conditions.source_account');
        $this->excludedSymbols = data_get($instruction->instruction, 'conditions.excluded_symbols');
        $this->targetAccount = data_get($instruction->instruction, 'parameters.target_account');
        $this->side = data_get($instruction->instruction, 'parameters.side');
        $this->quantity = data_get($instruction->instruction, 'parameters.quantity');
        $this->priceMode = data_get($instruction->instruction, 'parameters.price_mode');
        $this->priceShift = data_get($instruction->instruction, 'parameters.price_shift');
        $this->destination = data_get($instruction->instruction, 'parameters.destination');
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-instruction-row');
    }

    public function updated($name, $value)
    {
        $instruction = PulseInstruction::find($this->instructionId);

        if ($instruction === null) {
            return;
        }

        switch ($name) {
            case 'activated':
                $instruction->update(['activated' => $value]);
                break;

            case 'event':
                $instruction->update(['event' => $value]);
                break;

            case 'excludedSymbols':
                $tmp = $instruction->instruction;
                $tmp['conditions']['excluded_symbols'] = strtoupper($value);
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'sourceAccount':
                $tmp = $instruction->instruction;
                $tmp['conditions']['source_account'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'targetAccount':
                $tmp = $instruction->instruction;
                $tmp['parameters']['target_account'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'side':
                $tmp = $instruction->instruction;
                $tmp['parameters']['side'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'quantity':
                $tmp = $instruction->instruction;
                $tmp['parameters']['quantity'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'priceMode':
                $tmp = $instruction->instruction;
                $tmp['parameters']['price_mode'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'priceShift':
                $tmp = $instruction->instruction;
                $tmp['parameters']['price_shift'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            case 'destination':
                $tmp = $instruction->instruction;
                $tmp['parameters']['destination'] = $value;
                $instruction->instruction = $tmp;
                $instruction->save();
                break;

            default:
                break;
        }
    }

    public function removeInstruction()
    {
        $this->show = false;

        PulseInstruction::destroy($this->instructionId);

        $this->emitUp('InstructionRemoved');
    }
}
