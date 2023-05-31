<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateTextRequest extends FormRequest
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
            'title'                => ['required', 'max:255'],
            'category_name_first'  => ['nullable', 'max:255'],
            'category_name_second' => ['nullable', 'max:255'],
            'category_name_third'  => ['nullable', 'max:255'],
            'text_content'         => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です',
            'text_content.required' => 'テキストは必須です',
        ];
    }
}
