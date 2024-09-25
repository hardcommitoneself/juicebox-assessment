<?php

use App\Http\Controllers\Post\PostAllController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function() {
    /**
     * API endpoints for Post
     */
    Route::get('posts', PostAllController::class);
});
