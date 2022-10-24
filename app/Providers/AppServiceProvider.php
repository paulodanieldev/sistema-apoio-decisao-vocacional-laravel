<?php

namespace App\Providers;

use App\Interfaces\Services\AuthInterface;
use App\Interfaces\Services\SchoolReportsGradesInterface;
use App\Services\AuthService;
use App\Services\SchoolReportsGradesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthInterface::class, AuthService::class);
        $this->app->singleton(SchoolReportsGradesInterface::class, SchoolReportsGradesService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
