<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateInventoryRequest extends FormRequest
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
            'productId' => 'sometimes|numeric|exists:products,id',
            'warehouseId' => 'sometimes|numeric|exists:warehouses,id',
            'quantityAvailable' => 'sometimes|numeric|min:1',
            'minimusStockLevel' => 'sometimes|numeric|min:1',
            'maximumStockLevel' => 'sometimes|numeric|min:1',
            'reorderPoint' => 'sometimes|numeric|min:1'
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
