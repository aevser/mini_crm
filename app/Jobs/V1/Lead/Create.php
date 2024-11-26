<?php

namespace App\Jobs\V1\Lead;

use App\Models\CRM\Lead;
use App\Services\LogService;
use Illuminate\Foundation\Queue\Queueable;

class Create
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
        private ?string $status,
        private ?string $name,
        private ?string $phone,
        private ?string $email,
        private ?string $comment,
        private ?string $city,
        private ?string $region,
        private ?string $host,
        private ?string $ip
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
            'status' => $this->status,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'comment' => $this->comment,
            'city' => $this->city,
            'region' => $this->region,
            'host' => $this->host,
            'ip' => $this->ip,
        ]);

        LogService::log(
            action: 'Получен лид',
            details: [
                'ID Проекта' => $lead->project_id,
                'Проект' => $lead->project->name,
                'Статус' => $lead->status,
                'Имя' => $lead->name,
                'Телефон' => $lead->phone,
                'Город' => $lead->city,
                'Подсадочная' => $lead->host,
                'IP' => $lead->ip,
            ]
        );

        return $lead;
    }
}
