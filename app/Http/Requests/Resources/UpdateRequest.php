<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array
     */
    public function rules()
    {
        return [
            'url' => [
                'required', 'string', 'max:255', 'url',
                Rule::unique('resources')->ignore($this->resource->id, 'id')
            ],
            'description' => ['max:255'],
            'is_active' => ['array']

        ];
    }
}
