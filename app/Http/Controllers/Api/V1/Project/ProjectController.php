<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\Project as Requests;
use App\Jobs\V1\Project as Jobs;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Jobs\Index::dispatchSync();
        return response()->json(['projects' => $projects], Response::HTTP_OK);
    }

    public function show($id)
    {
        $project = Jobs\Show::dispatchSync($id);
        return response()->json(['project' => $project], Response::HTTP_OK);
    }

    public function store(Requests\Create $request)
    {
        Jobs\Create::dispatchSync(
            user_id: Auth::id(),
            name: $request->name,
            api_token: Str::random(60),
            timezone: $request->timezone,
            color: $request->color,
            enabled: $request->enabled,
            lead_validation_days: $request->lead_validation_days,
            detect_region: $request->detect_region,
            calltracking: $request->calltracking,
            leads_today: $request->leads_today,
            leads_total: $request->leads_total
        );

        return response()->json(['message' => 'Проект создан'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        Jobs\Update::dispatchSync(
            project_id: $id,
            user_id: Auth::id(),
            name: $request->name,
            api_token: Str::random(60),
            timezone: $request->timezone,
            color: $request->color,
            enabled: $request->enabled,
            lead_validation_days: $request->lead_validation_days,
            detect_region: $request->detect_region,
            calltracking: $request->calltracking,
            leads_today: $request->leads_today,
            leads_total: $request->leads_total
        );

        return response()->json(['message' => 'Проект обновлен'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['message' => 'Проект удален'], Response::HTTP_OK);
    }
}
