<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return response()->json($warehouses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWarehouseRequest $request)
    {
        $warehouse = Warehouse::create([
            'name' => $request->name,
            'is_refrigerated' => $request->isRefrigerated,
            'location_id' => $request->locationId
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Warehouse is created successfully.',
            'data' => $warehouse,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse = Warehouse::find($id);

        if (!isset($warehouse)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Warehouse not found.'
            ], 404);
        }
        return response()->json($warehouse, 200);
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, string $id)
    {
        $warehouse = Warehouse::find($id);

        if (!isset($warehouse)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Location not found.'
            ], 404);
        }

        $warehouse->name = $request->name;
        $warehouse->is_refrigerated = $request->isRefrigerated ?? $warehouse->is_refrigerated;
        $warehouse->location_id = $request->locationId ?? $warehouse->location_id;

        $warehouse->save();

        $response = [
            'status' => 'success',
            'message' => 'Location is updated successfully.',
            'data' => $warehouse,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Warehouse::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Warehouse is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
