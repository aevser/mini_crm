<?php

namespace App\Jobs\V1\Host;

use App\Models\CRM\Host;
use App\Services\LogService;
use Illuminate\Foundation\Queue\Queueable;

class Delete
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $host_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $host = Host::findOrFail($this->host_id);
        $host->delete();

        LogService::log(
            action: 'Хост удален',
            details: [
                'ID Проекта' => $host->project->id,
                'Проект' => $host->project->name,
                'URL' => $host->url
            ]
        );

        return $host;
    }
}
