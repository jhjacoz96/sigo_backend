<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\client;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
        $client = Client::find(request()->route('client'));
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => ['required', 'string', 'email', 'unique:clients,email,'.request()->route('client'),
                Rule::unique('users')->ignore($client->user->id)
            ],
            'document' => 'required|string',
            'comment' => 'sometimes|nullable|string',
            'status' => 'required|string',
            'user_id' => ['required','integer',
                Rule::exists('users', 'id')
                ->where(function($q) {
                    $q->whereRaw('EXISTS(SELECT c.id FROM clients c WHERE c.user_id = users.id and c.id =' . $this->route('client') . ' )');
                })
            ],
            'type_document_id' => 'required|integer|exists:type_documents,id'
        ];
    }
}
