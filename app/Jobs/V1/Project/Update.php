<?php

namespace App\Jobs\V1\Project;

use App\Models\CRM\Project;
use Illuminate\Foundation\Queue\Queueable;

class Update
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
        private string $name,
        private bool $enabled,
        private int $leads_today,
        private int $leads_total
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
            'name' => $this->name,
            'enabled' => $this->enabled,
            'leads_today' => $this->leads_today,
            'leads_total' => $this->leads_total
        ]);

        return $project;
    }
}
