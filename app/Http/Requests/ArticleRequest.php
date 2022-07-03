<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'featuredImage' => 'image|mimes:jpg,jpeg,png|max:20048',
            'title' => 'required',
            'body' => 'required',
            'postExcerpt' => 'required',
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
            'postExcerpt.required' => 'Por favor preencha um trecho introdutório.',
            'category_id.required' => 'Por favor preencha a categoria.',
        ];
    }
}