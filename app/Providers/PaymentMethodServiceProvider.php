<?php

namespace App\Providers;

use App\Services\Implementations\PaymentMethodService;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use Illuminate\Support\ServiceProvider;

class PaymentMethodServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentMethodServiceInterface::class, PaymentMethodService::class);
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
