<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateProductRequest extends FormRequest
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
            'code' => 'required|string|min:4',
            'barcode' => 'required|string|min:4',
            'name' => 'required|string',
            'description' => 'sometimes|string|min:10',
            'categoryId' => 'required|numeric',
            'packedWeight' => 'sometimes|numeric',
            'packedHeight' => 'sometimes|numeric',
            'packedWidth' => 'sometimes|numeric',
            'packedDepth' => 'sometimes|numeric',
            'refrigerated' => 'sometimes|boolean'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }
}
