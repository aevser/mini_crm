<?php

namespace App\Jobs\V1\Project;

use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;

class Update
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $project_id,
        private int $user_id,
        private string $name,
        private bool $timezone,
        private ?string $color,
        private bool $enabled,
        private int $lead_validation_days,
        private bool $detect_region,
        private bool $calltracking,
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'timezone' => $this->timezone,
            'color' => $this->color,
            'enabled' => $this->enabled,
            'lead_validation_days' => $this->lead_validation_days,
            'detect_region' => $this->detect_region,
            'calltracking' => $this->calltracking,
            'leads_today' => $this->leads_today,
            'leads_total' => $this->leads_total,
        ]);

        return $project;
    }
}
