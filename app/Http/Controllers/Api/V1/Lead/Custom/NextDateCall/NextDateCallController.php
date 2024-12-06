<?php

namespace App\Http\Controllers\Api\V1\Lead\Custom\NextDateCall;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lead\Custom\NextDateCall as Requests;
use App\Jobs\V1\Lead\Custom\NextDateCall as Jobs;
use Illuminate\Http\Response;

class NextDateCallController extends Controller
{
    public function update(Requests\Update $request, $lead_id)
    {
        Jobs\Update::dispatchSync(
            lead_id: $lead_id,
            nextcall_date: $request->nextcall_date
        );

        return response()->json(['message' => 'Дата следующего звонка добавлена'], Response::HTTP_OK);
    }

    public function destroy($lead_id)
    {
        Jobs\Delete::dispatchSync($lead_id);
        return response()->json(['message' => 'Дата следующего звонка удалена'], Response::HTTP_OK);
    }
}
