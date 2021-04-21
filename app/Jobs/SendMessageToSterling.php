<?php

namespace App\Jobs;

use App\Models\SterlingTrader\SterlingTraderAdapter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SendMessageToSterling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $adapterKey;
    protected $traderId;
    protected $message;
    protected $stamp;

    public function __construct($adapterKey, $traderId, $message)
    {
        $this->adapterKey = $adapterKey;
        $this->traderId = $traderId;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        optional(SterlingTraderAdapter::where('key', $this->adapterKey)->first())
            ->user
            ->getSterlingTraderAdapterHttpAction()
            ->sendData($this->traderId, $this->message);
    }
}
