<?php

namespace App\Providers;

use App\Interfaces\Services\SchoolReportsGradesInterface;
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
