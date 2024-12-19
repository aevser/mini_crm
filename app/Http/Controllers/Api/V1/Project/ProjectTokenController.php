<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Project as Jobs;
use App\Models\Project\Project;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProjectTokenController extends Controller
{
    public function refreshToken(Project $project)
    {
        Jobs\RefreshProjectToken::dispatchSync(
            project_id: $project->id,
            api_token: Str::random(60)
        );
        return response()->json(['messages' => 'Токен обновлен у проекта'], Response::HTTP_OK);
    }
}
