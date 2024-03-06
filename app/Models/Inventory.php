<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function list() {
        $inventories = DB::table('inventories')
        ->join('products', 'inventories.product_id', '=', 'products.id')
        ->join('warehouses', 'inventories.warehouse_id', '=', 'warehouses.id')
        ->select('inventories.id as id', 
                'inventories.product_id as productId',
                'products.name as productName',
                'inventories.warehouse_id as warehouseId',
                'warehouses.name as warehouseName',
                'inventories.quantity_available as quantityAvailable',
                'inventories.minimus_stock_level as minimusStockLevel',
                'inventories.maximum_stock_level as maximumStockLevel',
                'inventories.reorder_point as reorderPoint',
                'inventories.created_at as createdAt',

                )
        ->get();

        return $inventories;
    }
}   
