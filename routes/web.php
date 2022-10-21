<?php

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\Email\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('site');

Auth::routes(['verify' => true]);

Route::prefix('email')->group(function () {
    Route::get('verify', [EmailVerificationController::class, 'index'])->name('verification.notice');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::get('verification-notification', [EmailVerificationController::class, 'verifyNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['namespace' => 'App\Http\Controllers'],function () {

    $accountTypesConstants = AccountTypePrefixConstants::getConstants();

    Route::group(['middleware' =>['auth', 'check.account.type', 'verified'], 'prefix'=>$accountTypesConstants[AccountTypePrefixConstants::USER]],function () {
        Route::get('/dashboard', 'User\HomeController@index')->name('user.dashboard');
        Route::resource('/profile', 'User\ProfileController', ['as' => 'user']);

        // change password
        Route::post('/profile/change-password', 'User\ProfileController@changePassword')->name('user.profile.change-password');
    });

});
