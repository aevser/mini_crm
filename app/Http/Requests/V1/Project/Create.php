<?php

namespace App\Http\Requests\V1\Project;

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
            'name' => ['required', 'string', 'unique:projects,name']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название проекта обязательно для заполнения.',
            'name.unique' => 'Проект с таким названием уже существует.'
        ];
    }
}
