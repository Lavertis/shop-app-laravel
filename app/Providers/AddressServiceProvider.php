<?php

namespace App\Providers;

use App\Services\Implementations\AddressService;
use App\Services\Interfaces\AddressServiceInterface;
use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AddressServiceInterface::class, AddressService::class);
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
