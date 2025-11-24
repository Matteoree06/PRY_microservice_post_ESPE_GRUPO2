<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'user_id'   => 'required|integer',
            'published' => 'boolean'
        ];
    }

    /**
     * Get custom error messages for validator.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 255 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.integer' => 'El ID del usuario debe ser un número entero.',
            'published.boolean' => 'El campo publicado debe ser verdadero o falso.'
        ];
    }
}