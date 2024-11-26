<?php

namespace App\Jobs\V1\Log;

use App\Models\Log;
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
        return Log::all();
    }
}
