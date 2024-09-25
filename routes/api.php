<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\PostAllController;
use Illuminate\Support\Facades\Route;

/**
 * API endpoints for auth
 */
Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/logout', LogoutController::class);
    /**
     * API endpoints for Post
     */
    Route::get('/posts', PostAllController::class);
});
