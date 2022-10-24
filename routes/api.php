<?php

use App\Http\Controllers\api\v1\SchoolReportsGradesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(['message' => 'AVA - vocacional.', 'status' => 'Connected', 'version'=>'1.0.0']);
});

/**
 * Version 1.0.0 API endpoints
 * @api /api/v1/
 */
Route::prefix('v1')->group(function () {
    Route::group(['middleware' => ['throttle:1000,1']], function () {
        /**
         * Routes without middleware
         */
        Route::group([], function () {
            Route::prefix('publics')->group(function () {
                Route::prefix('auth')->group(function () {
                    Route::post('login', [AuthController::class, 'login']);
                    Route::post('register', [AuthController::class, 'register']);
                    Route::post('refreshtoken', [AuthController::class, 'refreshToken']);
                    // Route::post('validate/email', [ValidateEmailController::class, 'store']);
                    // Route::post('validate/code', [ValidateEmailController::class, 'validateCode']);

                });
                
                Route::prefix('school')->group(function () {
                    Route::prefix('reports')->group(function () {
                        Route::resource('grades', SchoolReportsGradesController::class)->only([
                            'show', 'store', 'update', 'destroy'
                        ]);
                    });
                });

                // Route::prefix('password')->group(function () {
                //     Route::post('forgot', [ForgotPasswordController::class, 'forgot']);
                //     Route::post('reset', [ResetPasswordController::class, 'reset']);
                // });
            });
        });

        /**
         * Routes with middleware
         */
        Route::group(['middleware' => ['auth:api']], function () {
            Route::prefix('privates')->group(function () {

                //## auth routes
                Route::prefix('auth')->group(function () {
                    Route::get('logout', [AuthController::class, 'logout']);
                    Route::get('user',  [AuthController::class, 'authenticated']);
                    Route::put('user/{user}',  [AuthController::class, 'update']);
                });

            });
        });
    });
});
