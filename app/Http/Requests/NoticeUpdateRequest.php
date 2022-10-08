<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Por favor preencha o titulo.',
            'body.required' => 'Por favor preencha o conteúdo.',
            'category_id.required' => 'Por favor preencha a categoria.',
        ];
    }
}