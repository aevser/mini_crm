<?php

namespace App\Http\Controllers\Api\V1\Lead;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Lead as Jobs;
use App\Models\Lead\Lead;
use App\Models\Project\Project;
use App\Services\LeadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LeadController extends Controller
{
    public function __construct(
        protected LeadService $leadService
    ){}

    public function index()
    {
        $leads = Jobs\Index::dispatchSync();
        return response()->json(['leads' => $leads], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->leadService->leadAdd($request);

        return response()->json(['messages' => 'Лид добавлен'], Response::HTTP_CREATED);
    }

    public function destroy(int $id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json(['messages' => 'Лид удален'], Response::HTTP_OK);
    }
}
