<?php

namespace App\Jobs\V1\Project;

use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class Toggle
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $project = Project::findOrFail($this->project_id);
        $project->update([
            'enabled' => !$project->enabled
        ]);
    }
}
