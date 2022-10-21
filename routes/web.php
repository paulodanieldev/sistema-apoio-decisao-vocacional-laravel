<?php

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('site');
})->name('site');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['namespace' => 'App\Http\Controllers'],function () {
    $accountTypesConstants = AccountTypePrefixConstants::getConstants();
    Route::group(['middleware' =>['auth', 'check.account.type'], 'prefix'=>$accountTypesConstants[AccountTypePrefixConstants::USER]],function () {
        Route::get('/dashboard', 'User\HomeController@index')->name('user.dashboard');
        Route::resource('/profile', 'User\ProfileController', ['as' => 'user']);

        // change password
        Route::post('/profile/change-password', 'User\ProfileController@changePassword')->name('user.profile.change-password');
    });
});
