<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Por favor informe o token.',
            'password.required' => 'Por favor preencha a palavra passe.',
            'password_confirm.required' => 'Por favor preencha a confirmação da palavra passe.',
            'password_confirm.same' => 'Confirme a palavra passe.',
        ];
    }
}
