<?php

namespace App\Http\Controllers\Api\V1\Lead\Custom\Region;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\V1\Lead\Custom\Region as Jobs;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    public function update(Request $request, $lead_id)
    {
        Jobs\Update::dispatchSync(
            lead_id: $lead_id,
            region: $request->region
        );

        return response()->json(['message' => 'Регион добавлен'], Response::HTTP_OK);
    }

    public function destroy($lead_id)
    {
        Jobs\Delete::dispatchSync($lead_id);
        return response()->json(['message' => 'Регион удален'], Response::HTTP_OK);
    }
}
