<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/categories', 'list');
    Route::get('/categories/{category}', 'show');
    Route::post('/create/category', 'create');
    Route::delete('/destroy/{category}', 'delete');
    Route::put('/edit/{category}', 'update');
});



Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});
