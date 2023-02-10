<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessRequest extends FormRequest
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

            // "province_id" => "required",
            // "district_id" => "required",
            // "neighbourhood_id" => "required",
            // "number" => "required",
            // "archive" => "required",
            // "issueDate" => "required",
            'user_id' => 'required',
            'maritalState' => 'required',
            'genre' => 'required',
            'race' => 'required',
            // "profession" => "required",
            // "workPlace" => "required",
            'naturality' => 'required',
            'phoneNumber' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',

        ];
    }

    public function messages()
    {
        return [];
    }
}
