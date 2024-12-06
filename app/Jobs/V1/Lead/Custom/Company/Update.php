<?php

namespace App\Jobs\V1\Lead\Custom\Company;

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
        private ?string $company
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
        $lead->company = $this->company;
        $lead->save();

        return $lead;
    }
}
