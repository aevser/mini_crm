<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use Illuminate\Foundation\Queue\Queueable;

class Delete
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $host_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Host::destroy($this->host_id);
    }
}
