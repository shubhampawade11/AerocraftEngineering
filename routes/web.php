<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignalController;


Route::get('/',[SignalController::class, 'index']);
Route::post('/store-data',[SignalController::class, 'store']);
Route::get('/show-sequence',[SignalController::class, 'showSequence']);