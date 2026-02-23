<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\AddedCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /admin/category
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.category', compact('categories'));
    }

    // GET /admin/create
    public function create()
    {
        return view('admin.categories.create');
    }

    // POST /admin/create/category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create($validated);

        AddedCategory::dispatch($category);

        return redirect()->route('admin.category')
            ->with('message', 'Category created successfully.');
    }

    // GET /admin/edit/{category}
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // PUT /admin/update/{category}
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.category')
            ->with('message', 'Category updated successfully.');
    }

    // DELETE /admin/destroy/{category}
    public function delete(Category $category)
    {
        if ($category->posts()->exists()) {
            $category->posts()->delete();
        }
        $category->delete();

        return redirect()->route('admin.category')
            ->with('message', 'Category deleted successfully.');
    }
}
