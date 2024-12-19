<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class Create
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
        private string $host,
        private string $host_api_token,
        private ?bool $host_enabled
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $project = Project::findOrFail($this->project_id);
        $host = Host::create([
            'project_id' => $project->id,
            'host' => $this->host,
            'host_api_token' => $this->host_api_token,
            'host_enabled' => $this->host_enabled,
        ]);

        return $host;
    }
}
