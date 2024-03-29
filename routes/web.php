<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodexController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
    return redirect('/home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    /* Route Type Controller */
    Route::resource('/type', TypeController::class);
    Route::get('serverside_type', [TypeController::class, 'getServersideType'])->name('getServersideType');

    /* Route Codex Controller */
    Route::resource('/codex', CodexController::class);
    Route::get('serverside_codex', [CodexController::class, 'getServersideCodex'])->name('getServersideCodex');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/{id}/edit', [AuthController::class, 'formProfile'])->name('profile.edit');
    Route::put('/profile/{id}', [AuthController::class, 'profile'])->name('profile.update');

    Route::get('/setting/{id}/edit', [AuthController::class, 'formSetting'])->name('setting.edit');
    Route::put('/setting/{id}', [AuthController::class, 'setting'])->name('setting.update');

    Route::get('/{any}', function () {
        Alert::error('Error', 'Anda tidak diizinkan untuk mengakses halaman ini!');
        return redirect()->route('home');
    })->where('any', '^(?!login|register|type|codex).*$');
});

/* Route Register */
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'formRegister'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    /* Route Login */
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
