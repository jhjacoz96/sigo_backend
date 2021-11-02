<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserUpdatePasswordRequest extends FormRequest
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
            'current_password'      => ['required',
                function ($attribute, $value, $fail) {
                    $user = User::find(request()->route('id'));
                    if (!\Hash::check($value, $user->password)) {
                        return $fail(__('validation.custom.current_password.current_password'));
                    }
                }
            ],
            'password'              => 'required|confirmed|min:8|different:current_password|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&-_]/'
        ];
    }
}
