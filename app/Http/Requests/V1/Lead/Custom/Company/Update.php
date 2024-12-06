<?php

namespace App\Http\Requests\V1\Lead\Custom\Company;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'company' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'company.string' => 'Имя компании должно быть строкой.',
            'company.max' => 'Название компании не может превышать 255 символов.'
        ];
    }
}
