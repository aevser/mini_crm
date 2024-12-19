<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Host;
use App\Models\Project\Project;
use App\Jobs\V1\Project\Host as Jobs;
use App\Http\Requests\V1\Project\Host as Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HostController extends Controller
{
    public function index(Project $project)
    {
        $hosts = Jobs\Index::dispatchSync($project->id);
        return response(['hosts' => $hosts], Response::HTTP_OK);
    }

    public function store(Requests\Create $request, Project $project)
    {
        Jobs\Create::dispatchSync(
            project_id: $project->id,
            host: $request->host,
            host_api_token: Str::random(60),
            host_enabled: $request->host_enabled
        );

        return response()->json(['messages' => 'Хост назначен проекту'], Response::HTTP_CREATED);
    }

    public function destroy(Project $project, Host $host)
    {
        Jobs\Delete::dispatchSync($host->id);
        return response(['messages' => 'Хост снят с проекта'], Response::HTTP_OK);
    }
}
