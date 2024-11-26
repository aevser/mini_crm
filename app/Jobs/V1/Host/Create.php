<?php

namespace App\Jobs\V1\Host;

use App\Models\CRM\Host;
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
        private string $url,
        private string $api_token
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $host = Host::create([
            'project_id' => $this->project_id,
            'url' => $this->url,
            'api_token' => $this->api_token,
        ]);

        LogService::log(
            action: 'Хост добавлен',
            details: [
                'ID Проекта' => $host->project->id,
                'Проект' => $host->project->name,
                'URL' => $host->url,
            ]
        );

        return $host;
    }
}
