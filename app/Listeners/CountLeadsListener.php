<?php

namespace App\Listeners;

use App\Events\LeadCount;
use App\Models\Project\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CountLeadsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LeadCount $event): void
    {
        $project = Project::findOrFail($event->lead->project_id);

        $settings = $project->settings;
        $settings['leads_total']++;

        if ($event->lead->created_at->isToday()) {
            $settings['leads_today']++;
        }

        $project->settings = $settings;
        $project->save();
    }
}
