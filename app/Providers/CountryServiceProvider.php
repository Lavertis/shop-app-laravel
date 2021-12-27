<?php

namespace App\Providers;

use App\Services\Implementations\CountryService;
use App\Services\Interfaces\CountryServiceInterface;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CountryServiceInterface::class, CountryService::class);
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
