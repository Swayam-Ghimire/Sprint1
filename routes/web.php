<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Post routes
Route::middleware('auth')->group(function () {
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
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::controller(AuthController::class)->group(function () {
    // show forms
    Route::get('/login', 'showLoginForm');
    Route::get('/register', 'showRegisterForm');

    // handle submissions
    Route::post('/login', 'login')->name('login.store');
    Route::post('/register', 'register')->name('register.store');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Routes

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.user');
        Route::get('/users/role/edit/{user}', 'editRole')->name('admin.user.role.edit');
        Route::put('/users/role/update/{user}', 'updateRole')->name('admin.user.role.update');
        Route::delete('/users/delete/{user}', 'delete')->name('admin.user.destroy');
    });
    Route::controller(AdminPostController::class)->group(function () {
        Route::get('/post', 'index')->name('admin.post');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.category');
        Route::get('/edit/{category}', 'edit')->name('admin.category.edit');
        Route::get('/create', 'create')->name('admin.category.create');
        Route::post('/create/category', 'store')->name('admin.category.store');
        Route::put('/update/{category}', 'update')->name('admin.category.update');
        Route::delete('/destroy/{category}', 'delete')->name('admin.category.delete');
    });

});
// Notification
Route::get('/notification/{id}', function (string $id) {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->markAsRead();

    return back();

})->name('notification.read');
