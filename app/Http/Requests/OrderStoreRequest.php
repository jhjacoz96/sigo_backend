<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
        $rules = [];
        foreach ($this->get('products') as $key => $product) {
            $rules['products.'.$key.'.quantity'] = [
                'required', 'integer', 'min:0', 'not_in:0', 'quantity_available:'.$product['product_id']
            ];
        }

        return array_merge($rules, [
            'type_payment' => 'required|string',
            'client_id' => 'required|integer|exists:clients,id',
            'total' => 'required|numeric|min:0|not_in:0',
            'name_delivery' => 'required|string',
            'phone_delivery' => 'required|string',
            'address_delivery' => 'required|string',
            'cost_delivery' => 'required|numeric|min:0|not_in:0',
            'comment_delivery' => 'sometimes|nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price_sale' => 'required|numeric|min:0|not_in:0',
            'products.*.quantity' => 'required|integer|min:0|not_in:0'
        ]);
    }
}
