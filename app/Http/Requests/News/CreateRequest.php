<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'title'=>['min:5', 'required', 'string'],
            'image' => ['file', 'image', 'max:2048', 'nullable'],
            'author' =>['min:2', 'required', 'string'],
            'categories'=>['required'],
            'description' => ['min:50', 'required', 'string']
        ];
    }
}
