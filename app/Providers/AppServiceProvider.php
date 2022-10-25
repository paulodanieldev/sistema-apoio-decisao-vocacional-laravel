<?php

namespace App\Providers;

use App\Interfaces\Services\AuthInterface;
use App\Interfaces\Services\SchoolReportsGradesInterface;
use App\Interfaces\Services\MailInterface;
use App\Interfaces\Services\PasswordResetInterface;
use App\Services\AuthService;
use App\Services\SchoolReportsGradesService;
use Illuminate\Support\ServiceProvider;
use App\Services\MailService;
use App\Services\PasswordResetService;

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
        $this->app->singleton(MailInterface::class, MailService::class);
        $this->app->singleton(PasswordResetInterface::class, PasswordResetService::class);
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
