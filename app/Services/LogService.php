<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function log(string $action, array $details = []): void
    {
        Log::create([
            'action' => $action,
            'details' => $details,
        ]);
    }
}
