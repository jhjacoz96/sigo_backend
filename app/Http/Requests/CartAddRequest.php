<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartAddRequest extends FormRequest
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
            'client_id' =>'required|integer|exists:clients,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0|not_in:0|quantity_available:'.$this->product_id
        ];
    }
}
