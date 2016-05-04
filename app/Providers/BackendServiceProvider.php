<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\UserRepositoryInterface','App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\Resume\ResumeRepositoryInterface','App\Repositories\Resume\ResumeRepository');
        $this->app->bind('App\Repositories\Report\ReportRepositoryInterface','App\Repositories\Report\ReportRepository');
        $this->app->bind('App\Repositories\Payment\PaymentRepositoryInterface','App\Repositories\Payment\PaymentRepository');
        $this->app->bind('App\Repositories\Parameter\ParameterRepositoryInterface','App\Repositories\Parameter\ParameterRepository');
    }
}
