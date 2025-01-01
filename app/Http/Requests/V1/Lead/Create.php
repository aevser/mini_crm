<?php

namespace App\Http\Requests\V1\Lead;

use App\Helpers\Host\HostHelper;
use App\Helpers\Lead\LeadHelper;
use App\Models\Lead\Lead;
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
            'project_id' => 'required|exists:projects,id',
            'class_id' => 'required|integer',
            'owner' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'status' => ['nullable', 'string', 'in:' . Lead::LEAD_NEW . ',' . Lead::LEAD_EXISTS],
            'name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
            'entries' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'cost' => 'nullable|numeric',
            'comment' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'manual_region' => 'nullable|string|max:255',
            'manual_city' => 'nullable|string|max:255',
            'host' => 'nullable|string|max:255',
            'ip' => 'nullable|ip',
            'source' => 'nullable|string|max:255',
            'url_query_string' => 'nullable|string|max:255',
            'utm' => 'nullable|json',
            'nextcall_date' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => trans('validation.lead.email.email'),
            'phone.min' => trans('validation.lead.phone.min'),
            'phone.max' => trans('validation.lead.phone.max'),
            'nextcall_data.date_format' => trans('validation.lead.nextcall_date')
        ] ;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'project_id' => LeadHelper::getProjectByApiToken($this->api_token),
            'phone' => LeadHelper::formatPhoneNumber($this->phone),
            'host' => HostHelper::filterValidateHost($this->host)
        ]);
    }
}
