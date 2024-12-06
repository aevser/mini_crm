<?php

namespace App\Jobs\V1\Lead\Custom\Comment;

use App\Models\Lead\Lead;
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
        $lead->comment = null;
        $lead->save();

        return $lead;
    }
}
