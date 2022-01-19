<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TinkerController;
use Illuminate\Support\Facades\App;
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

if (App::environment('local'))
{
    Route::get('tinker', [TinkerController::class, 'tinker']);

    Route::get('phpinfo', [TinkerController::class, 'phpinfo']);
}

Route::resource('movies', MovieController::class)->except([
    'update'
]);

Route::resource('actors', ActorController::class);

Route::get('/', function () {
    return view('layouts.vue-example');
});


require __DIR__.'/auth.php';
