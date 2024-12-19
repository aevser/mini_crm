<?php

namespace App\Jobs\V1\Project;

use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class RefreshProjectToken
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
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
        $project = Project::findOrFail($this->project_id);
        $project->update([
            'api_token' => $this->api_token
        ]);

        return $project;
    }
}
