<?php

namespace App\Providers;

use App\SterlingTrader\AppProvider;
use App\SterlingTrader\ArrayChannelManager;
use App\SterlingTrader\ChannelManager;
use App\SterlingTrader\ModelAppProvider;
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
        $this->app->singleton(AppProvider::class, ModelAppProvider::class);
        $this->app->singleton(ChannelManager::class, ArrayChannelManager::class);
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
