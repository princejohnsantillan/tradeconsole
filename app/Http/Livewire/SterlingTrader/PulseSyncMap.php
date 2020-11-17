<?php

namespace App\Http\Livewire\SterlingTrader;

use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Struct\OrderStruct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseSyncMap extends Component
{
    public $positionMap;

    protected $listeners = [
        'echo:SterlingTraderAdapter,PositionUpdated' => 'analyzePositions',
        'SettingRemoved' => 'analyzePositions',
        'SettingUpdated' => 'analyzePositions',
    ];

    public function mount()
    {
        $this->analyzePositions();
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-map');
    }

    public function analyzePositions()
    {
        $this->positionMap = [];

        $syncSettings = Auth::user()->pulseSyncSettings;

        if ($syncSettings === null) {
            return;
        }

        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $positions = collect(optional($adapterAction)->fetchPositions() ?? []);

        foreach ($syncSettings as $setting) {
            $symbols = $positions->whereIn('Account', [$setting->source, $setting->target])->pluck('Symbol');

            foreach ($symbols as $symbol) {
                $sourcePosition = (int) optional($positions->where('Account', $setting->source)->where('Symbol', $symbol)->only(['Position']))->first() ?? 0;
                $targetPosition = (int) optional($positions->where('Account', $setting->target)->where('Symbol', $symbol)->only(['Position']))->first() ?? 0;
                $weight = $setting->weight;

                $this->positionMap[] = [
                    'Symbol' => $symbol,
                    'SourceAccount' => $setting->source,
                    'SourcePosition' => $sourcePosition,
                    'TargetAccount' => $setting->target,
                    'TargetPosition' => $targetPosition,
                    'Weight' =>  $setting->weight,
                    'Discrepancy' => round(round($sourcePosition * $weight) - $targetPosition),
                ];
            }
        }
    }

    public function alignPositions()
    {
        $this->analyzePositions();

        $httpAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        foreach ($this->positionMap as $position) {
            if ($position['Discrepancy'] == 0) {
                continue;
            }

            $orderStruct = OrderStruct::build([
                'bstrAccount' => $position['TargetAccount'],
                'bstrSymbol' => $position['Symbol'],
                'bstrSide' => $position['Discrepancy'] > 0 ? 'S' : 'B',
                'nQuantity' => abs($position['Discrepancy']),
                'nPriceType' => 1,
                'bstrDestination' => 'ARCA', //TODO: Revisit. This should not be hardcoded.
                'bstrTif' => 'D',
            ]);

            $httpAction->sendData($position['TargetAccount'], AdapterResponse::submitOrderStruct($orderStruct));
        }
    }
}
