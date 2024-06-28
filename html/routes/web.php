<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/api/properties', [App\Http\Controllers\HomeController::class, 'index']);