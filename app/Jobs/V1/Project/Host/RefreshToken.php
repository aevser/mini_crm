<?php

namespace App\Jobs\V1\Project\Host;

use App\Models\Project\Host;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class RefreshToken
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
    public function handle()
    {
        $host = Host::findOrFail($this->host_id);
        $new_token = Str::random(60);

        $host->update([
            'api_token_host' => $new_token
        ]);

        return $host;
    }
}
