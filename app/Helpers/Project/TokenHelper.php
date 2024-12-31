<?php

namespace App\Helpers\Project;

use Illuminate\Support\Str;

class TokenHelper
{
    /*
     * Generate api token.
     */
    public static function generateApiToken(string $length): string
    {
        return Str::random($length);
    }
}
