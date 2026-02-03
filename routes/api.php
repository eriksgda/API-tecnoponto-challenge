<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharController;
use App\Http\Controllers\LogController;

Route::get('/personagens', [CharController::class, 'show']);

Route::get('/logs', [LogController::class, 'index']);