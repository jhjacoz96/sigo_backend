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
        $employee = Employee::find(request()->route('employee'));
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => ['required', 'string', 'email', 'unique:employees,email,'.request()->route('employee'),
                Rule::unique('users')->ignore($employee->user->id)
            ],
            'document' => 'required|string',
            'comment' => 'sometimes|nullable|string',
            'status' => 'required|string',
            'user_id' => ['required','integer',
                Rule::exists('users', 'id')
                ->where(function($q) {
                    $q->whereRaw('EXISTS(SELECT e.id FROM employees e WHERE e.user_id = users.id and e.id =' . $this->route('employee') . ' )');
                })
            ],
            'type_document_id' => 'required|integer|exists:type_documents,id'
        ];
    }
}
