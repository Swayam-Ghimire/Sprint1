<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        return CategoryResource::collection(Category::latest()->paginate());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $category = Category::create($data);

        return response()->json([
            'message' => 'Category Created',
            'category' => new CategoryResource($category),
        ], 201);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Deleted',
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
        ]);

        $category->update($data);

        return response()->json([
            'message' => 'Category Updated',
            'category' => new CategoryResource($category),
        ]);
    }
}
