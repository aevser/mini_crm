<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
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
        private string $api_token_host,
        private bool $enabled
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
            'host' => $this->host,
            'api_token_host' => $this->api_token_host,
            'enabled' => $this->enabled,
        ]);

        return $host;
    }
}
