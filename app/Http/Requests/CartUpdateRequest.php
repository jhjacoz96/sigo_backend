<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartUpdateRequest extends FormRequest
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
            'product_id' => ['required', 'integer', 'exists:products,id',
                Rule::exists('products', 'id')
                ->where(function($q){
                    $q->whereRaw('EXISTS(SELECT c.id FROM carts c WHERE products.id = c.product_id and c.id = '. request()->route('cart')['id'] . ')');
                })
            ],
            'client_id' => 'required|integer|exists:clients,id',
            'quantity' => 'required|integer|min:0|not_in:0|quantity_available:'.$this->product_id
        ];
    }
}
