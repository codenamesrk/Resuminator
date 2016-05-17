<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $gateway = Config::get('indipay.gateway');
        $this->app->bind('itdprocess', 'App\PaymentSupport\Itdprocess\Itdprocess');
        $this->app->bind('App\PaymentSupport\Itdprocess\Gateways\PaymentGatewayInterface','App\PaymentSupport\Itdprocess\Gateways\PayUMoneyGateway');
    }
}
