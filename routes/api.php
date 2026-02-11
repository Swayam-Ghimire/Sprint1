<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories', 'list');
    Route::get('/categories/{category}', 'show');
    Route::post('/create/category', 'create');
    Route::delete('/destroy/{category}', 'delete');
    Route::put('/edit/{category}', 'update');   
});

