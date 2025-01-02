<?php

namespace App\Http\Requests\V1\Project\Classes;

use Illuminate\Foundation\Http\FormRequest;

class Assign extends FormRequest
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
            'class_id' => 'nullable|exists:lead_classes,id'
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.exists' => trans('validation.classes.class_id.exists')
        ];
    }
}
