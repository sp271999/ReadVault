<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\JwtAuthController;

// Public Routes
Route::post('/register', [JwtAuthController::class, 'register']);
Route::post('/login', [JwtAuthController::class, 'login']);

// Protected Routes (JWT Required)
Route::middleware('jwt.auth')->group(function () {
    
    // Auth user info
    Route::get('/me', [JwtAuthController::class, 'me']);

    // Logout
    Route::post('/logout', [JwtAuthController::class, 'logout']);

    // Refresh token
    Route::post('/refresh', [JwtAuthController::class, 'refresh']);

    // Book API (Protected)
    // Route::apiResource('books', BookApiController::class);

    Route::get('/books', [BookApiController::class, 'index']);
Route::post('/books', [BookApiController::class, 'store']);
Route::get('/books/{id}', [BookApiController::class, 'show']);
Route::post('/books/{id}', [BookApiController::class, 'update']); // use POST + _method
Route::put('/books/{id}', [BookApiController::class, 'update']);  // real PUT
Route::patch('/books/{id}', [BookApiController::class, 'update']); 
Route::delete('/books/{id}', [BookApiController::class, 'destroy']);

});

