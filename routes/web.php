<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/store', [AuthController::class, 'store'])->name('auth.store');
    Route::get('/register-success', [AuthController::class, 'registerSuccess'])->name('auth.register.success');

    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth.auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/home', function () {
        return view('dashboard');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
