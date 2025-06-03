<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

// Home Controller
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/complaints', [HomeController::class, 'store'])->name('complaints.store');

// Tracking Controller
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
