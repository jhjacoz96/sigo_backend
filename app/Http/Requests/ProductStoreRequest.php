<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'image' => 'required|image',
            'price_sale' => 'required|numeric|min:0|not_in:0',
            'price_purchase' => 'required|numeric||min:0|not_in:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'sometimes|nullable|string',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
