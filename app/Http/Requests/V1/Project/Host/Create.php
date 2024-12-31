<?php

namespace App\Http\Requests\V1\Project\Host;

use App\Helpers\Host\HostHelper;
use App\Helpers\Project\TokenHelper;
use App\Services\V1\Project\Host\HostService;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private string $config;

    public function __construct(
        protected HostService $hostService
    )

    {
        parent::__construct();
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
            'project_id' => 'required|integer|exists:projects,id',
            'host' => 'required|string|max:255|unique:hosts,host',
            'api_token' => 'required|string|unique:hosts,api_token',
            'enabled' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'host.required' => trans('validation.host.host.required'),
            'host.unique' => trans('validation.host.host.unique', [
                'project' => HostHelper::getExistsProjectId($this->host)
            ])
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'project_id' => $this->route('project')->id,
            'host' => HostHelper::filterValidateHost($this->host),
            'enabled' => true,
            'api_token' => TokenHelper::generateApiToken($this->config)
        ]);
    }
}
