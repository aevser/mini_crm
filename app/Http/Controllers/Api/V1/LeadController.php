<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lead as Requests;
use App\Jobs\V1\Lead as Jobs;
use Illuminate\Http\Response;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Jobs\Index::dispatchSync();
        return response()->json(['leads' => $leads], Response::HTTP_OK);
    }

    public function store(Requests\Create $request)
    {
        Jobs\Create::dispatchSync(
            project_id: $request->project_id,
            status: $request->status,
            name: $request->name,
            phone: $request->phone,
            email: $request->email,
            comment: $request->comment,
            city: $request->city,
            region: $request->region,
            host: $request->host,
            ip: $request->ip
        );

        return response()->json(['message' => 'Лид создан'], Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['success' => 'Лид удален'], Response::HTTP_OK);
    }
}
