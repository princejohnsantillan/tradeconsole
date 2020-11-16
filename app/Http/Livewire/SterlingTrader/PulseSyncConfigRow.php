<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\PulseSyncConfig;
use Livewire\Component;

class PulseSyncConfigRow extends Component
{
    public $configId;

    public $source;

    public $target;

    public $weight;

    public function mount($config)
    {
        $this->configId = $config->id;
        $this->source = $config->source;
        $this->target = $config->target;
        $this->weight = $config->weight / 100;
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-config-row');
    }

    public function removeConfig()
    {
        PulseSyncConfig::destroy($this->configId);

        $this->emitUp('ConfigRemoved');
    }

    public function updated($name, $value)
    {
        $config = PulseSyncConfig::find($this->configId);

        if ($config === null) {
            return;
        }

        switch ($name) {
            case 'source':
                $config->update(['source' => $value]);
                break;

            case 'target':
                $config->update(['target' => $value]);
                break;

            case 'weight':
                $config->update(['weight' => $value * 100]);
                break;

            default:
                break;
        }
    }
}
