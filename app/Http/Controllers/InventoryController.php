<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = Inventory::list();
        return response()->json($inventory, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInventoryRequest $request)
    {
        //dump($request->inventory);

        $inventories = $request->inventory;

        foreach($inventories as $inventory) {
            Inventory::create([
                'product_id' => $inventory["productId"],
                'warehouse_id' => $inventory["warehouseId"],
                'quantity_available' => $inventory["quantityAvailable"],
                'minimus_stock_level' => $inventory["minimusStockLevel"],
                'maximum_stock_level' => $inventory["maximumStockLevel"],
                'reorder_point' => $inventory["reorderPoint"]
            ]);   
        }
        
        
        $response = [
            'status' => 'success',
            'message' => 'Inventory is created successfully.',
            'data' => $inventories,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventory = Inventory::find($id);

        if (!isset($inventory)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Inventory not found.'
            ], 404);
        }

        return response()->json($inventory, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, string $id)
    {
        $inventory = Inventory::find($id);

        $inventory->product_id = $request->productId ?? $inventory->product_id;
        $inventory->warehouse_id = $request->warehouseId ?? $inventory->warehouse_id;
        $inventory->quantity_available = $request->quantityAvailable ?? $inventory->quantity_available;
        $inventory->minimus_stock_level = $request->minimusStockLevel ?? $inventory->minimus_stock_level;
        $inventory->maximum_stock_level = $request->maximumStockLevel ?? $inventory->maximum_stock_level;
        $inventory->reorder_point = $request->reorderPoint ?? $inventory->reorder_point;

        $inventory->save();

        $response = [
            'status' => 'success',
            'message' => 'Inventory is updated successfully.',
            'data' => $inventory,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inventory::find($id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Inventory is deleted successfully.',
        ];

        return response()->json($response, 200);
    }
}
