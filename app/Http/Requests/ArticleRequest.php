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
            'featuredImage' => 'mimes:jpg,jpeg,png|max:20048',
            'title' => 'required',
            'body' => 'required',
            'postExcerpt' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ];
    }
}