<?php

namespace App\Http\Controllers\Api\V1\Lead;

use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use App\Models\Project\Host;
use App\Models\Project\Project;
use App\Services\V1\Lead\LeadService;
use App\Http\Requests\V1\Lead as Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected LeadService $leadService
    ){}

    public function store(Requests\Create $request)
    {
        $validate = $request->validated();

        if (!$this->leadService->validateHost($validate['host'], $validate['project_id'])) {
            return $this->leadService->handleInvalidHost();
        }

        return $this->leadService->handleLeadCreation($validate);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->leadService->delete($id);
        return $this->successResponse(trans('lead/messages.deleted'));
    }
}
