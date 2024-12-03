<?php

namespace App\Jobs\V1\Project;

use App\Models\Project\Project;
use Illuminate\Foundation\Queue\Queueable;

class Index
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Project::all();
    }
}
