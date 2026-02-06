<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();

    dump($token);
    $token1 = csrf_token();

    dump($token1);
});

// Post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->missing(function () {
    return redirect()->route('posts.index');
});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->missing(function () {
    return redirect()->route('posts.index');
});
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->missing(function () {
    return redirect()->route('posts.index');
});
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
