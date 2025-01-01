<?php

namespace App\Helpers\Lead;

use App\Models\Project\Project;

class LeadHelper
{
    /*
     * Change number from '8' to '+7'.
     */
    public static function formatPhoneNumber(string $phone): string
    {
        if ($phone[0] == '8') {
            return '+7' . substr($phone, 1);
        }

        return $phone;
    }

    /*
     * Get a project with token id.
     */
    public static function getProjectByApiToken(string $api_token): ?int
    {
        return Project::where('api_token', $api_token)->value('id');
    }
}
