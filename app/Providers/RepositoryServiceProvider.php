<?php

namespace App\Providers;

use App\Interfaces\Repositories\AuthInterface;
use App\Interfaces\Repositories\SchoolReportsGradesInterface;
use App\Interfaces\Repositories\PasswordResetInterface;
use App\Repositories\AuthRepository;
use App\Repositories\SchoolReportsGradesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PasswordResetRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthInterface::class, AuthRepository::class);
        $this->app->singleton(PasswordResetInterface::class, PasswordResetRepository::class);
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
