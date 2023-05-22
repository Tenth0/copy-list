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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'max:11'],
            'category_name_first' => ['nullable', 'max:11'],
            'category_name_second' => ['nullable', 'max:11'],
            'category_name_third' => ['nullable', 'max:11'],
            'text_content' => ['required'],
        ];
    }
}
