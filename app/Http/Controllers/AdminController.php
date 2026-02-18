<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        //
        $topCategories = Category::topCategories();
        return view('admin.dashboard', compact('topCategories'));
    }
}
