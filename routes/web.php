<?php

use App\Http\Controllers\MovieController;
use App\Models\Actor;
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

Route::get('cache-example', function () {
    return Actor::first()->getNumCostarsForMovie2();
});


require __DIR__.'/auth.php';
