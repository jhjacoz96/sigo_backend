<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
        $role = request()->route('role');
        return [
            'name' =>  ['required', 'string',
                Rule::unique('roles', 'name')->ignore($role['id'])
            ],
            'permissions' => 'required|array',
            'permissions.*' => 'required|string|exists:permissions,name'
        ];
    }
}
