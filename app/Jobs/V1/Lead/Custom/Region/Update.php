<?php

namespace App\Jobs\V1\Lead\Custom\Region;

use App\Models\Lead\Lead;
use Illuminate\Foundation\Queue\Queueable;

class Update
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $lead_id,
        private string $region
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $lead = Lead::findOrFail($this->lead_id);
        $lead->region = $this->region;
        $lead->save();

        return $lead;
    }
}
