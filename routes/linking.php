<?php

use App\Http\Controllers\LinkingController;
use Illuminate\Support\Facades\Route;

Route::prefix('password')->group(function () {
    /**
     * Routes without middleware
     */
    Route::group([], function () {
        Route::get('reset', [LinkingController::class, 'resetPassword']);
    });
});
