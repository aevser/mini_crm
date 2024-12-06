<?php

namespace App\Jobs\V1\Lead;

use App\Models\Lead\Lead;
use Illuminate\Foundation\Queue\Queueable;

class Create
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
        private ?string $owner,
        private ?string $company,
        private ?string $status,
        private string $name,
        private ?string $surname,
        private ?string $patronymic,
        private ?string $full_name,
        private string $phone,
        private ?string $entries,
        private ?string $email,
        private ?string $cost,
        private ?string $comment,
        private ?string $city,
        private ?string $region,
        private ?string $manual_region,
        private ?string $manual_city,
        private ?string $host,
        private ?string $ip,
        private ?string $source,
        private ?string $url_query_string,
        private ?string $utm,
        private ?string $utm_medium,
        private ?string $utm_source,
        private ?string $utm_campaign,
        private ?string $utm_content,
        private ?string $utm_term,
        private ?string $nextcall_date
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $lead = Lead::create([
            'project_id' => $this->project_id,
            'owner' => $this->owner,
            'company' => $this->company,
            'status' => $this->status,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'entries' => $this->entries,
            'email' => $this->email,
            'cost' => $this->cost,
            'comment' => $this->comment,
            'city' => $this->city,
            'region' => $this->region,
            'manual_region' => $this->manual_region,
            'manual_city' => $this->manual_city,
            'host' => $this->host,
            'ip' => $this->ip,
            'source' => $this->source,
            'url_query_string' => $this->url_query_string,
            'utm' => $this->utm,
            'utm_medium' => $this->utm_medium,
            'utm_source' => $this->utm_source,
            'utm_campaign' => $this->utm_campaign,
            'utm_content' => $this->utm_content,
            'utm_term' => $this->utm_term,
            'nextcall_date' => $this->nextcall_date,
        ]);

        return $lead;
    }
}
