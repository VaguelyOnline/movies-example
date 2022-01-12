<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\FanController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::user();
});

Route::prefix('/movies/{movie}')->group(function () {

    Route::put('/', [MovieController::class, 'update'])->name('movies.update');

    Route::get('/actors', [MovieController::class, 'getActors'])->name('movies.actors');

    Route::post('/actors/{actor}', [MovieController::class, 'addActor'])->name('movies.actors.store');

});

Route::get('/actors', [ActorController::class, 'getActors'])->name('actors.search');

// Route::post('/actors/{actor}/fan', [ActorController::class, 'addFan'])->name('actors.fans.store');

Route::middleware('auth:sanctum')->post('/fans', [FanController::class, 'store'])->name('fans.store');
