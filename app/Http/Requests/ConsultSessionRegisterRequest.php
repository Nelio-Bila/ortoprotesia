<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultSessionRegisterRequest extends FormRequest
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
            'type' => ['required'],
            'date' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'type.required' => "Por favor indique o tipo de consulta",
            'date.required' => "Por favor indique a data",
        ];
    }
}
