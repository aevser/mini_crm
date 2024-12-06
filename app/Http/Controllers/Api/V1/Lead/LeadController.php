<?php

namespace App\Http\Controllers\Api\V1\Lead;

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
            owner: $request->owner,
            company: $request->company,
            status: $request->status,
            name: $request->name,
            surname: $request->surname,
            patronymic: $request->patronymic,
            full_name: $request->full_name,
            phone: $request->phone,
            entries: $request->entries,
            email: $request->email,
            cost: $request->cost,
            comment: $request->comment,
            city: $request->city,
            region: $request->region,
            manual_region: $request->manual_region,
            manual_city: $request->manual_city,
            host: $request->host,
            ip: $request->ip,
            source: $request->source,
            url_query_string: $request->url_query_string,
            utm: $request->utm,
            utm_medium: $request->utm_medium,
            utm_source: $request->utm_source,
            utm_campaign: $request->utm_campaign,
            utm_content: $request->utm_content,
            utm_term: $request->utm_term,
            nextcall_date: $request->nextcall_date,
        );

        return response()->json(['message' => 'Лид добавлен'], Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['messages' => 'Лид удален'], Response::HTTP_OK);
    }
}
