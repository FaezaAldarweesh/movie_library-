<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:movies|regex:/^[\p{L}\s]+$/u|max:40',
            'director' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'release_year' => 'required|numeric|min:1',
            'description' => 'required|string|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'The movie title field must contain letters only.',
        ];
    }
}
