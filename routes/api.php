<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\PostAllController;
use App\Http\Controllers\Post\PostCreateController;
use App\Http\Controllers\Post\PostGetSpecificController;
use App\Http\Controllers\Post\PostUpdateController;
use App\Http\Controllers\User\UserGetSpecificController;
use Illuminate\Support\Facades\Route;

/**
 * I have implemented all the controllers as invokable, it is one of best practices in Laravel nowadays...
 */

/**
 * API endpoints for auth
 */
Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/logout', LogoutController::class);

    /**
     * API endpoints for User
     */
    Route::get('/users/{id}', UserGetSpecificController::class);

    /**
     * API endpoints for Post
     */
    Route::get('/posts', PostAllController::class);
    Route::get('/posts/{id}', PostGetSpecificController::class);
    Route::post('/posts', PostCreateController::class);
    Route::patch('/posts/{id}', PostUpdateController::class);
});
