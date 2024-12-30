<?php

namespace App\Services\V1\Project;

use App\Models\Project\Project;
use Illuminate\Support\Str;

class TokenService
{
    /**
     * Create a new class instance.
     */
    private string $config;

    public function __construct()
    {
        $this->config = env('LENGTH_API_TOKEN_PROJECT');
    }

    public function getToken(int $id): ?Project
    {
        return Project::findOrFail($id);
    }

    public function refreshToken(int $id): void
    {
        $project = Project::findOrFail($id);
        $project->update([
            'api_token' => Str::random($this->config),
        ]);
    }
}
