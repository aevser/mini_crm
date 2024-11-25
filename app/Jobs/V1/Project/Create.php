<?php

namespace App\Jobs\V1\Project;

use App\Models\CRM\Project;
use Illuminate\Foundation\Queue\Queueable;

class Create
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $name,
        private string $api_token,
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
        $project = Project::create([
            'name' => $this->name,
            'api_token' => $this->api_token,
            'enabled' => $this->enabled,
            'leads_today' => $this->leads_today,
            'leads_total' => $this->leads_total
        ]);

        return $project;
    }
}
