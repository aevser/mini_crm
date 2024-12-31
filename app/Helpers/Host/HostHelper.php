<?php

namespace App\Helpers\Host;

use App\Models\Project\Host;

class HostHelper
{
    /*
     * Filters and validates the host.
     */
    public static function filterValidateHost(string $host): string
    {
        if (filter_var($host, FILTER_VALIDATE_URL)) {
            return parse_url($host, PHP_URL_HOST);
        }

        return $host;
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
}
