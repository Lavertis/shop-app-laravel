<?php

namespace App\Providers;

use App\Services\Implementations\BasketService;
use App\Services\Interfaces\BasketServiceInterface;
use Illuminate\Support\ServiceProvider;

class BasketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BasketServiceInterface::class, BasketService::class);
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
