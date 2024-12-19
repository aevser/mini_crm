<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class Index
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
        $host = Host::where('project_id', $project->id)->get(['id', 'host']);

        return $host;
    }
}
