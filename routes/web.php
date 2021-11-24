<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MovieController;
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

Route::resource('movies', MovieController::class)->except([
    'update'
]);

Route::get('/', function () {
    return view('layouts.vue-example');
});

Route::get('/game', [GameController::class, 'show'])->name('games.show');

require __DIR__.'/auth.php';
