<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Models\SterlingTrader\PulseSyncSetting;
use Livewire\Component;

class PulseSyncSettingRow extends Component
{
    public $settingId;

    public $source;

    public $target;

    public $weight;

    public function mount($setting)
    {
        $this->settingId = $setting->id;
        $this->source = $setting->source;
        $this->target = $setting->target;
        $this->weight = $setting->weight / 100;
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-setting-row');
    }

    public function removeSetting()
    {
        PulseSyncSetting::destroy($this->settingId);

        $this->emit('SettingRemoved');
    }

    public function updated($name, $value)
    {
        $setting = PulseSyncSetting::find($this->settingId);

        if ($setting === null) {
            return;
        }

        switch ($name) {
            case 'source':
                $setting->update(['source' => $value]);
                break;

            case 'target':
                $setting->update(['target' => $value]);
                break;

            case 'weight':
                $setting->update(['weight' => $value * 100]);
                break;

            default:
                break;
        }

        $this->emit('SettingUpdated');
    }
}
