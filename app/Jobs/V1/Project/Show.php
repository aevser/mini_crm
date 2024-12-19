<?php

namespace App\Jobs\V1\Project;

use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class Show
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
    public function handle()
    {
        $project = Project::findOrFail($this->project_id);
        return $project;
    }
}
