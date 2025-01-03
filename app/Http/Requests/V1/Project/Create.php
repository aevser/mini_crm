<?php

namespace App\Http\Requests\V1\Project;

use App\Helpers\Project\TokenHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private int $config;

    public function __construct()
    {
        $this->config = env('LENGTH_GENERATE_API_TOKEN');
    }

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
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'api_token' => 'required|string|unique:projects,api_token'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.project.name.required'),
            'name.max' => trans('validation.project.name.max')
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id(),
            'api_token' => TokenHelper::generateApiToken($this->config)
        ]);
    }
}
