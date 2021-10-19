<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::resource('movies', MovieController::class);
