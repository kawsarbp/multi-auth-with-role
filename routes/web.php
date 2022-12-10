<?php

use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\User\DashboardController as DashboardUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Route::prefix('/admin')->name('admin.')->group(function (){
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class,'login']);
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    //forgot password route
    Route::prefix('/password')->name('password.')->group(function (){
        Route::get('/reset',[ForgotPasswordController::class,'showLinkRequestForm'])->name('request');
        Route::post('/email',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('email');
        Route::get('/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('reset');
        Route::post('/reset',[ResetPasswordController::class,'reset'])->name('update');
    });
});
//dashboard route
Route::prefix('/admin')->name('admin.')->group(function (){
    Route::get('/dashboard',[DashboardController::class,'index']);
});
Route::prefix('/user')->name('user.')->group(function (){
    Route::get('/dashboard',[DashboardUser::class,'index']);
});


Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
