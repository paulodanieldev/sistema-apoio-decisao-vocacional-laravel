<?php

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\Email\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
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
        Route::resource('/profile', 'Profile\ProfileController', ['as' => 'user']);

        // change password
        Route::post('/profile/change-password', 'Profile\ProfileController@changePassword')->name('user.profile.change-password');
    });

    Route::group(['middleware' =>['auth', 'check.account.type', 'verified'], 'prefix'=>$accountTypesConstants[AccountTypePrefixConstants::ADMIN]],function () {
        Route::get('/dashboard', 'Admin\HomeController@index')->name('admin.dashboard');
        Route::resource('/profile', 'Profile\ProfileController', ['as' => 'admin']);
        Route::resource('/school-reports', 'Admin\SchoolReportsController', ['as' => 'admin']);
        Route::resource('/school-subjects', 'Admin\SchoolSubjectsController', ['as' => 'admin']);
        Route::resource('/school-grades', 'Admin\SchoolGradesController', ['as' => 'admin']);
        Route::resource('/school-levels', 'Admin\SchoolLevelsController', ['as' => 'admin']);
        Route::resource('/users', 'Admin\UserController', ['as' => 'admin']);

        // delete routes
        Route::get('/school-reports/{uuid}/delete', 'Admin\SchoolReportsController@destroy')->name('admin.school-reports.delete');
        Route::get('/school-subjects/{uuid}/delete', 'Admin\SchoolSubjectsController@destroy')->name('admin.school-subjects.delete');
        Route::get('/school-grades/{uuid}/delete', 'Admin\SchoolGradesController@destroy')->name('admin.school-grades.delete');
        Route::get('/school-levels/{uuid}/delete', 'Admin\SchoolLevelsController@destroy')->name('admin.school-levels.delete');
        Route::get('/users/{uuid}/delete', 'Admin\UserController@destroy')->name('admin.users.delete');

        // change password
        Route::post('/profile/change-password', 'Profile\ProfileController@changePassword')->name('admin.profile.change-password');
    });

});
