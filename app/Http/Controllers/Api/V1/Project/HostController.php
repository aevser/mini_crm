<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\Project\Host as Requests;
use App\Jobs\V1\Project\Host as Jobs;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HostController extends Controller
{
    public function index()
    {
        $hosts = Jobs\Index::dispatchSync();
        return response()->json(['hosts' => $hosts], Response::HTTP_OK);
    }

    public function store(Requests\Create $request)
    {
        Jobs\Create::dispatchSync(
            project_id: $request->project_id,
            host: $request->host,
            api_token_host: Str::random(60),
            enabled: $request->enabled
        );

        return response()->json(['message' => 'Хост добавлен'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        Jobs\Update::dispatchSync(
            host_id: $id,
            project_id: $request->project_id,
            host: $request->host,
            enabled: $request->enabled
        );

        return response()->json(['message' => 'Хост обновлен'], Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['message' => 'Хост удален'], Response::HTTP_OK);
    }

    public function refreshHostToken($id)
    {
        Jobs\RefreshToken::dispatchSync($id);
        return response()->json(['message' => 'Токен обновлен'], Response::HTTP_OK);
    }
}
