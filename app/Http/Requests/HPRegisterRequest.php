<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HPRegisterRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required',
            'carrier' => 'required',
            'category' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o nome.',
            'surname.required' => 'Por favor preencha o apelido.',
            'birthdate.required' => 'Por favor preencha a data de nascimento.',
            'carrier.required' => 'Por favor preencha a carreira.',
            'category.required' => 'Por favor preencha a categoria.',
            'email.required' => 'Por favor preencha o email.',
            'email.email' => 'Por favor preencha um email válido.',
            'password.required' => 'Por favor preencha a palavra passe.',
            'password.min' => 'A palavra passe deve ter 6 caracteres no minimo.',
            'password_confirm.required' => 'Por favor preencha a confirmação da palavra passe.',
            'password_confirm.same' => 'Confirme a palavra passe.',
        ];
    }
}
