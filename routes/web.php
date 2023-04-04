<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Acl\RoleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/paineladm', function () {
    return redirect()->route('auth.index');
})->name('paineladm');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'acl.control', 'binding']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'authenticate'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.index');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.index');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm'])->name('password.confirm');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    Route::group(['middleware' => ['auth', 'acl.control', 'binding']], function () {
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
        Route::post('register', [RegisterController::class, 'register'])->name('register.save');
    });
});
