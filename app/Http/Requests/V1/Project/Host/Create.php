<?php

namespace App\Http\Requests\V1\Project\Host;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'host' => ['required', 'string', 'regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'host' => 'Хост не должен начинаться на: ' . 'http / https.'
        ];
    }
}
