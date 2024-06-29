<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/api/properties', [App\Http\Controllers\PropertyController::class, 'index']);
Route::get('/{province?}', [App\Http\Controllers\HomeController::class, 'index']);