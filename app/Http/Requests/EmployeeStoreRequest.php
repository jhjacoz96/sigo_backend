<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email|unique:employees|unique:users',
            'document' => 'required|string',
            'role_id' => 'required|string|exists:roles,name',
            'comment' => 'sometimes|nullable|string',
            'type_document_id' => 'required|integer|exists:type_documents,id',
            'password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&-_]/|confirmed',
        ];
    }
}
