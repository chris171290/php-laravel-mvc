<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inventory' => 'required|array',
            'inventory.*.productId' => 'required|numeric|exists:products,id',
            'inventory.*.warehouseId' => 'required|numeric|exists:warehouses,id',
            'inventory.*.quantityAvailable' => 'required|numeric|min:1',
            'inventory.*.minimusStockLevel' => 'required|numeric|min:1',
            'inventory.*.maximumStockLevel' => 'required|numeric|min:1',
            'inventory.*.reorderPoint' => 'sometimes|numeric|min:1'
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json([
            'success' => true,
            'message' => 'Validation errors',
            'data'    => $validator->errors()
        ], 404));
    }
}
