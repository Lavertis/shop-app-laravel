<?php

namespace App\Providers;

use App\Services\Implementations\HomeService;
use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HomeServiceInterface::class, HomeService::class);
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
