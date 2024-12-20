<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Project as Jobs;
use App\Http\Requests\V1\Project as Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Jobs\Index::dispatchSync();
        return response()->json(['projects' => $projects], Response::HTTP_OK);
    }

    public function store(Requests\Create $request)
    {
        Jobs\Create::dispatchSync(
            user_id: Auth::id(),
            name: $request->name,
            api_token: Str::random(60),
            timezone: 0,
            color: $request->exists('color') ? $request->color : dechex(rand(0, 16777215)),
            enabled: 1,
            lead_validation_days: 0,
            detect_region: 0,
            calltracking: 0,
            leads_today: 0,
            leads_total: 0
        );

        return response()->json(['messages' => 'Проект создан'], Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        Jobs\Update::dispatchSync(
            project_id: $id,
            user_id: Auth::id(),
            name: $request->name,
            timezone: $request->timezone,
            color: $request->color,
            enabled: $request->enabled,
            lead_validation_days: $request->lead_validation_days,
            detect_region: $request->detect_region,
            calltracking: $request->calltracking,
            leads_today: $request->leads_today,
            leads_total: $request->leads_total
        );

        return response()->json(['messages' => 'Проект обновлен'], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['messages' => 'Проект удален'], Response::HTTP_OK);
    }

    public function journal(int $id)
    {
        $project = Jobs\Journal::dispatchSync($id);
        return response()->json(['project' => $project], Response::HTTP_OK);
    }

    public function toggle(int $id)
    {
        Jobs\Toggle::dispatchSync($id);
        return response()->json(['messages' => 'Статус проекта изменен'], Response::HTTP_OK);
    }
}
