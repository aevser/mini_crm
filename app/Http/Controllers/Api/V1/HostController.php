<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Host as Requests;
use App\Jobs\V1\Host as Jobs;
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
            url: $request->url,
            api_token: Str::random(60)
        );

        return response()->json(['success' => 'Хост добавлен'], Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['success' => 'Хост удален'], Response::HTTP_OK);
    }
}
