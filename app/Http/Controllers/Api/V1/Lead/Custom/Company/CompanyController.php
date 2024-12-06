<?php

namespace App\Http\Controllers\Api\V1\Lead\Custom\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lead\Custom\Company as Requests;
use App\Jobs\V1\Lead\Custom\Company as Jobs;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function update(Requests\Update $request, $lead_id)
    {
        Jobs\Update::dispatchSync(
            lead_id: $lead_id,
            company: $request->company
        );

        return response()->json(['message' => 'Компания добавлена'], Response::HTTP_OK);
    }

    public function destroy($lead_id)
    {
        Jobs\Delete::dispatchSync($lead_id);
        return response()->json(['message' => 'Компания удалена'], Response::HTTP_OK);
    }
}
