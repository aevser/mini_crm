<?php

namespace App\Helpers\Host;

use App\Models\Project\Host;
use Illuminate\Support\Str;

class HostHelper
{
    /*
     * Filters and validates the host.
     */
    public static function filterValidateHost(string $host): string
    {
        if (filter_var($host, FILTER_VALIDATE_URL)) {
            return self::toLowerHost(parse_url($host, PHP_URL_HOST));
        }

        return self::toLowerHost($host);
    }

    /*
     * Get the project id by host name.
     */
    public static function getExistsProjectId(string $host): int
    {
        $exists_host = Host::query()
            ->where('host', $host)
            ->first();

        return $exists_host ? $exists_host->project_id : 0;
    }

    /*
     * Convert host to lower case.
     */
    public static function toLowerHost(string $host): string
    {
        return Str::lower($host);
    }
}
