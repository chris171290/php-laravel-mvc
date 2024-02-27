<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'category_id' => $request->categoryId ?? 0,
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Category is created successfully.',
            'data' => $category,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( UpdateCategoryRequest $request, string $id)
    {
        
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->category_id = $request->categoryId;

        $response = [
            'status' => 'success',
            'message' => 'Category is updated successfully.',
            'data' => $category,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Category is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
