<?php

use App\Http\Controllers\MovieController;
use App\Mail\MovieUpdated;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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
    $user = User::first();
    $movie = Movie::first();
    $email = new MovieUpdated($movie, $user);
    
    Mail::to($user)->send($email);
});


require __DIR__.'/auth.php';
