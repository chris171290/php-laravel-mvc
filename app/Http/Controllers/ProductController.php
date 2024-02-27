<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'code' => $request->code,
            'barcode' => $request->barcode,
            'name' => $request->name,
            'description' => $request->description ?? '',
            'category_id' => $request->categoryId,
            'packed_weight' => $request->packedWeight ?? 0,
            'packed_height' => $request->packedHeight ?? 0,
            'packed_width' => $request->packedWidth ?? 0,
            'packed_depth' => $request->packedDepth ?? 0,
            'refrigerated' => $request->refrigerated ?? false,
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Product is created successfully.',
            'data' => $product,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        
        $product = Product::find($id);
        $product->code = $request->code;
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->description = $request->description ?? '';
        $product->category_id = $request->categoryId;
        $product->packed_weight = $request->packedWeight ?? 0;
        $product->packed_height = $request->packedHeight ?? 0;
        $product->packed_width = $request->packedWidth ?? 0;
        $product->packed_depth = $request->packedDepth ?? 0;
        $product->refrigerated = $request->refrigerated ?? false;

        $response = [
            'status' => 'success',
            'message' => 'Product is updated successfully.',
            'data' => $product,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Product is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
