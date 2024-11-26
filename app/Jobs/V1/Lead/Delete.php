<?php

namespace App\Jobs\V1\Lead;

use App\Models\CRM\Lead;
use Illuminate\Foundation\Queue\Queueable;

class Delete
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $lead_id
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
        $lead->delete();

        return $lead;
    }
}
