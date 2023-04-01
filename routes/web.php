<?php

use App\Http\Controllers\CodexController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

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

