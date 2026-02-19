<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $topCategories = Category::topCategories();
        $users = User::count();
        $posts = Post::count();
        $categories = Category::count();

        return view('admin.dashboard', compact('users', 'posts', 'categories'));
    }
}
