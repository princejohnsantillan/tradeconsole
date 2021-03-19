<?php

namespace App\Jobs;

use App\Models\User;
use App\SterlingTrader\AdapterResponse;
use App\SterlingTrader\Struct\OrderStruct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class AlignPositions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $positions;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $positions, User $user)
    {
        $this->positions = $positions;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $httpAction = $this->user->getSterlingTraderAdapterHttpAction();

        foreach ($this->positions as $position) {
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
                'bstrClOrderId' => uniqid('AP').md5(now()),
            ]);

            $httpAction->sendData($position['TargetAccount'], AdapterResponse::submitOrderStruct($orderStruct));
        }
    }
}
