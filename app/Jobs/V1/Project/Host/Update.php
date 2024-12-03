<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use Illuminate\Foundation\Queue\Queueable;

class Update
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $host_id,
        private int $project_id,
        private string $host,
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
        $host = Host::findOrFail($this->host_id);
        $host->update([
            'project_id' => $this->project_id,
            'host' => $this->host,
            'enabled' => $this->enabled,
        ]);

        return $host;
    }
}
