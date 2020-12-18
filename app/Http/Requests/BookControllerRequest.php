<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookControllerRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:255'],
            'author_id' => ['required', 'numeric', 'exists:authors,id'],
            'description' => ['required', 'min:3'],
            'image' => ['mimes:jpeg,jpg,png']
        ];
    }

    public function messages()
    {
        return
        [
            'author_id.required' => 'Create an author before creating a book!',
        ];

    }
}
