<?php

namespace App\Http\Livewire\SterlingTrader;

use App\Jobs\AlignPositions;
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
        $this->sortField = 'Gap';
        $this->sortAsc = true;
    }

    public function render()
    {
        $positionMap = $this->analyzePositions();
        $subHeader = [
            'Symbols' => $positionMap->unique('Symbol')->count(),
            'SourceAccounts' => $positionMap->unique('SourceAccount')->count(),
            'TotalSourcePosition' => $positionMap->sum('SourcePosition'),
            'TargetAccounts' => $positionMap->unique('TragetAccount')->count(),
            'TotalTargetPosition' => $positionMap->sum('TargetPosition'),
            'TotalDiscrepancy' => $positionMap->sum('Discrepancy'),
        ];

        return view('livewire.sterling-trader.pulse-sync-map', [
            'positionMap' => $positionMap,
            'subHeader' => $subHeader,
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

            $excluded_symbols = array_map('trim', explode(',', $setting->excluded_symbols));

            foreach ($symbols as $symbol) {
                if (in_array($symbol, $excluded_symbols)) {
                    continue;
                }

                $sourcePosition = (int) optional($positions->where('Account', $setting->source)->where('Symbol', $symbol)->first())['Position'] ?? 0;
                $targetPosition = (int) optional($positions->where('Account', $setting->target)->where('Symbol', $symbol)->first())['Position'] ?? 0;

                if ($sourcePosition + $targetPosition === 0) {
                    continue;
                }

                $weight = $setting->weight / 100;
                $discrepancy = (int) round(round($sourcePosition * $weight) - $targetPosition);

                $positionMap[] = [
                    'Symbol' => $symbol,
                    'SourceAccount' => $setting->source,
                    'SourcePosition' => $sourcePosition,
                    'TargetAccount' => $setting->target,
                    'TargetPosition' => $targetPosition,
                    'Weight' =>  $weight,
                    'Discrepancy' => $discrepancy,
                    'Gap' => abs($discrepancy),
                ];
            }
        }

        return collect($positionMap)
            ->sortBy($this->sortField, SORT_NATURAL, $this->sortAsc);
    }

    public function sortPosition($field)
    {
        $this->sortAsc = $this->sortField == $field ? ! $this->sortAsc : true;

        $this->sortField = $field;
    }

    public function alignPositions()
    {
        $positionMap = $this->analyzePositions();

        AlignPositions::dispatch($positionMap, Auth::user());
    }
}
