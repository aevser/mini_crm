<?php

namespace App\Services\V1\Project;

use App\Helpers\Project\TokenHelper;
use App\Models\Project\Project;

class TokenService
{
    /**
     * Create a new class instance.
     */
    private string $config;

    public function __construct()
    {
        $this->config = env('LENGTH_GENERATE_API_TOKEN');
    }

    public function getToken(int $id): ?Project
    {
        return Project::findOrFail($id);
    }

    public function refreshToken(int $id): void
    {
        $project = Project::findOrFail($id);
        $project->update([
            'api_token' => TokenHelper::generateApiToken($this->config),
        ]);
    }
}
