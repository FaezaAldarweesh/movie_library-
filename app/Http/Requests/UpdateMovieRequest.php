<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
        $movieId = $this->id;

        return [
            'title' => 'regex:/^[\p{L}\s]+$/u|max:40',Rule::unique('movies')->ignore($movieId),
            'director' => 'string|max:50',
            'category_id' => 'exists:categories,id',
            'release_year' => 'numeric|min:1',
            'description' => 'string|max:150',
        ];
    }
}
