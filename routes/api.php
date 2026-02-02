<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharController;

Route::get('/personagens', [CharController::class, 'show']);