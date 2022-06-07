<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o nome.',
            'surname.required' => 'Por favor preencha o apelido.',
            'birthdate.required' => 'Por favor preencha a data de nascimento.',
            'email.required' => 'Por favor preencha o email.',
            'email.email' => 'Por favor preencha um email válido.',
        ];
    }
}
