<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
            'type_payment' => 'required|string',
            'provider_id' => 'sometimes|nullable|integer|exists:providers,id',
            'total' => 'required|numeric|min:0|not_in:0',
            'comment' => 'sometimes|nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price_purchase' => 'required|numeric|min:0|not_in:0',
            'products.*.quantity' => 'required|integer|min:0|not_in:0'
        ];
    }
}
