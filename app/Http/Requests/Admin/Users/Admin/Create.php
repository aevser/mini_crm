<?php

namespace App\Http\Requests\Admin\Users\Admin;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.admin.users.user.name.required'),
            'email.required' => trans('validation.admin.users.user.email.required'),
            'password.required' => trans('validation.admin.users.user.password.required'),
            'password.min' => trans('validation.admin.users.user.password.min'),
        ];
    }
}
