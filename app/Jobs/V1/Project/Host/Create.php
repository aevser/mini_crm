<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

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
        if (filter_var($this->host, FILTER_VALIDATE_URL)) {
            $this->host = parse_url($this->host, PHP_URL_HOST);
        }

        $project = Project::findOrFail($this->project_id);
        $host = Host::create([
            'project_id' => $project->id,
            'host' => Str::lower($this->host),
            'host_api_token' => $this->host_api_token,
            'host_enabled' => $this->host_enabled,
        ]);

        return $host;
    }
}
