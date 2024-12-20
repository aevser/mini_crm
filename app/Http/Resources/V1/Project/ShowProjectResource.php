<?php

namespace App\Http\Resources\V1\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'name' => $this->name,
            'settings' => [
                'enabled' => $this->enabled,
                'color' => $this->color,
                'lead_validation_days' => $this->lead_validation_days,
                'detect_region' => $this->detect_region,
                'timezone' => $this->timezone
            ],
            'leads' => $this->leads->map(function ($lead, $index) {
                return [
                    'id' => $index + 1,
                    'name' => $lead->name,
                    'surname' => $lead->surname,
                    'patronymic' => $lead->patronymic,
                    'full_name' => $lead->full_name,
                    'phone' => $lead->phone,
                    'email' => $lead->email,
                    'entries' => $lead->entries,
                    'cost' => $lead->cost,
                    'comment' => $lead->comment,
                    'city' => $lead->city,
                    'region' => $lead->region,
                    'manual_region' => $lead->manual_region,
                    'manual_city' => $lead->manual_city,
                    'host' => $lead->host,
                    'ip' => $lead->ip,
                    'source' => $lead->source,
                    'url_query_string' => $lead->url_query_string,
                    'utm' => $lead->utm,
                    'utm_medium' => $lead->utm_medium,
                    'utm_source' => $lead->utm_source,
                    'utm_campaign' => $lead->utm_campaign,
                    'utm_content' => $lead->utm_content,
                    'utm_term' => $lead->utm_term,
                    'nextcall_date' => $lead->nextcall_date,
                ];
            }),
        ];
    }
}
