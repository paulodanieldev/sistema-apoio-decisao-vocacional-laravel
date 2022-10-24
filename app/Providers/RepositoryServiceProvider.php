<?php

namespace App\Providers;

use App\Interfaces\Repositories\SchoolReportsGradesInterface;
use App\Repositories\SchoolReportsGradesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SchoolReportsGradesInterface::class, SchoolReportsGradesRepository::class);
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
