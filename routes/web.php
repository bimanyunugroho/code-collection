<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodexController;
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

Route::get('/home', function () {
    return view('welcome');
});

/* Route Register */
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'formRegister'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    /* Route Login */
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/conn', function() {
        $result = DB::select("SELECT * FROM version()");
        return $result[0]->version;
    });

    /* Route Type Controller */
    Route::resource('/type', TypeController::class);
    Route::get('serverside_type', [TypeController::class, 'getServersideType'])->name('getServersideType');

    /* Route Codex Controller */
    Route::resource('/codex', CodexController::class);
    Route::get('serverside_codex', [CodexController::class, 'getServersideCodex'])->name('getServersideCodex');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/{any}', function () {
        Alert::error('Error', 'Anda tidak diizinkan untuk mengakses halaman ini!');
        return redirect()->route('home');
    })->where('any', '^(?!login|register|type|codex).*$');
});

Route::middleware(['auth'])->get('/home', function () {
    return view('welcome');
})->name('home');
