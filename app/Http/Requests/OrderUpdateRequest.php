<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends FormRequest
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
            'client_id' => ['sometimes', 'nullable','integer',
                Rule::exists('clients', 'id')
                ->where(function($q) {
                    $q->whereRaw('EXISTS(SELECT o.id FROM orders o WHERE o.client_id = clients.id and o.id =' . $this->route('order')['id'] . ' )');
                })
            ],
            'total' => 'required|numeric|min:0|not_in:0',
            'status' => 'required|string|in:verificar,enviado,proceso',
            'products' => 'sometimes|nullable|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price_sale' => 'required|numeric|min:0|not_in:0',
            'products.*.quantity' => 'required|integer|min:0|not_in:0'
        ]);
    }
}
