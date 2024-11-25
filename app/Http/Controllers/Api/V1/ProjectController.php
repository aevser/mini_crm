<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Project as Requests;
use App\Jobs\V1\Project as Jobs;
use Illuminate\Http\Response;
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
            name: $request->name,
            api_token: Str::random(60),
            enabled: $request->enabled,
            leads_today: $request->leads_today,
            leads_total: $request->leads_total
        );

        return response()->json(['success' => 'Проект добавлен'], Response::HTTP_CREATED);
    }

    public function update(Requests\Update $request, $id)
    {
        Jobs\Update::dispatchSync(
            project_id: $id,
            name: $request->name,
            enabled: $request->enabled,
            leads_today: $request->leads_today,
            leads_total: $request->leads_total
        );

        return response()->json(['success' => 'Проект обновлен'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['success' => 'Проект удален'], Response::HTTP_OK);
    }
}
