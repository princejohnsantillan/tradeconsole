<?php

namespace App\Providers;

use App\SterlingTrader\ConnectionCollection;
use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use App\SterlingTrader\ModelAdapterProvider;
use Illuminate\Support\ServiceProvider;

class SterlingTraderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AdapterProvider::class, ModelAdapterProvider::class);
        $this->app->singleton(ConnectionManager::class, ConnectionCollection::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
