<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'featuredImage' => 'image|mimes:jpg,jpeg,png|max:20048',
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'featuredImage.mimes' => 'Por favor carrega uma imagem válida.',
            'featuredImage.image' => 'Por favor carrega uma imagem.',
            'title.required' => 'Por favor preencha o titulo.',
            'body.required' => 'Por favor preencha o conteúdo.',
            'category_id.required' => 'Por favor preencha a categoria.',
        ];
    }
}
