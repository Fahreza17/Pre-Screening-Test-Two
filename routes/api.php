<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Registrasi
Route::post('/register', [UserController::class, 'register']);

// Login
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// CRUD
Route::middleware('auth:sanctum')->group(function () {
    // Read
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    // Create
    Route::post('/users', [UserController::class, 'store']);

    // Update
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Delete
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

