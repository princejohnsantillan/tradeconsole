<?php

namespace App\Http\Livewire\SterlingTrader;

use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Struct\OrderStruct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PulseSyncMap extends Component
{
    public $sortField;

    public $sortAsc;

    protected $listeners = [
        'echo:SterlingTraderAdapter,PositionUpdated' => '$refresh',
        'SettingRemoved' => '$refresh',
        'SettingUpdated' => '$refresh',
    ];

    public function mount()
    {
        $this->sortField = 'SourceAccount';
        $this->sortAsc = true;
    }

    public function render()
    {
        return view('livewire.sterling-trader.pulse-sync-map', [
            'positionMap' => $this->analyzePositions(),
        ]);
    }

    public function analyzePositions()
    {
        $positionMap = [];

        $syncSettings = Auth::user()->pulseSyncSettings;

        if ($syncSettings === null) {
            return;
        }

        $adapterAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        $positions = collect(optional($adapterAction)->fetchPositions() ?? []);

        foreach ($syncSettings as $setting) {
            $symbols = $positions->whereIn('Account', [$setting->source, $setting->target])->pluck('Symbol')->unique();

            foreach ($symbols as $symbol) {
                $sourcePosition = (int) optional($positions->where('Account', $setting->source)->where('Symbol', $symbol)->first())['Position'] ?? 0;
                $targetPosition = (int) optional($positions->where('Account', $setting->target)->where('Symbol', $symbol)->first())['Position'] ?? 0;
                $weight = $setting->weight / 100;

                $positionMap[] = [
                    'Symbol' => $symbol,
                    'SourceAccount' => $setting->source,
                    'SourcePosition' => $sourcePosition,
                    'TargetAccount' => $setting->target,
                    'TargetPosition' => $targetPosition,
                    'Weight' =>  $weight,
                    'Discrepancy' => (int) round(round($sourcePosition * $weight) - $targetPosition),
                ];
            }
        }

        return collect($positionMap)->sortBy($this->sortField, SORT_NATURAL, ! $this->sortAsc);
    }

    public function sortPosition($field)
    {
        $this->sortAsc = $this->sortField == $field ? ! $this->sortAsc : true;

        $this->sortField = $field;
    }

    public function alignPositions()
    {
        $positionMap = $this->analyzePositions();

        $httpAction = Auth::user()->getSterlingTraderAdapterHttpAction();

        foreach ($positionMap as $position) {
            if ($position['Discrepancy'] === 0) {
                continue;
            }

            $orderStruct = OrderStruct::build([
                'bstrAccount' => $position['TargetAccount'],
                'bstrSymbol' => $position['Symbol'],
                'bstrSide' => $position['Discrepancy'] > 0 ? 'B' : 'T',
                'nQuantity' => abs($position['Discrepancy']),
                'nPriceType' => 1,
                'bstrDestination' => 'ARCA', //TODO: Revisit. This should not be hardcoded.
                'bstrTif' => 'D',
            ]);

            $httpAction->sendData($position['TargetAccount'], AdapterResponse::submitOrderStruct($orderStruct));
        }
    }
}
