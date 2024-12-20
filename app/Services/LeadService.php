<?php

namespace App\Services;

use App\Http\Requests\Api\LeadsRequest;
use App\Journal\Facade\Journal;
use App\Models\Leads;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use App\Jobs\V1\Lead as Jobs;
use Illuminate\Support\Facades\Log;

class LeadService
{
    public function __construct()
    {
        //
    }

    public function leadAdd(Request $request)
    {
        $request->merge(['project_id' => Project::where('api_token', $request->api_token)->value('id')]);
        $phone = $request->phone;

        if ($phone[0] == 8) {
            $phone = preg_replace('/^./', '7', $phone);
        }

        Jobs\Create::dispatchSync(
            project_id: $request->project_id,
            owner: $request->owner,
            company: $request->company,
            status: $request->status,
            name: $request->name,
            surname: $request->surname,
            patronymic: $request->patronymic,
            full_name: $request->full_name,
            phone: $phone,
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
            utm: $request->utm,
            url_query_string: $request->url_query_string,
            utm_medium: $request->utm_medium,
            utm_source: $request->utm_source,
            utm_campaign: $request->utm_campaign,
            utm_content: $request->utm_content,
            utm_term: $request->utm_term,
            nextcall_date: $request->nextcall_date,
        );
    }
}
