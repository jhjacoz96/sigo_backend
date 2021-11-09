<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
        $employee = request()->route('employee');
        dump($employee);
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => ['required', 'string', 'email', 'unique:employees,email,'.$employee->id,
                Rule::unique('users')->ignore($employee->user->id)
            ],
            'document' => 'required|string',
            'comment' => 'sometimes|nullable|string',
            'role_id' => 'required|string|exists:roles,name',
            'status' => 'required|string',
            'user_id' => ['required','integer',
                Rule::exists('users', 'id')
                ->where(function($q) use($employee) {
                    $q->whereRaw('EXISTS(SELECT e.id FROM employees e WHERE e.user_id = users.id and e.id =' . $employee->id . ' )');
                })
            ],
            'type_document_id' => 'required|integer|exists:type_documents,id'
        ];
    }
}
