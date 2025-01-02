<?php

namespace App\Http\Requests\V1\Project\Classes;

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
            'project_id' => 'required|exists:projects,id',
            'name'       => 'string|max:255',
            'type'       => 'string',
            'color'      => 'string|regex:/^#[0-9A-Fa-f]{6}$/'
        ];
    }

    public function messages(): array
    {
        return [
            'color.regex' => trans('validation.classes.color.regex')
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'project_id' => $this->route('project')->id
        ]);
    }
}
