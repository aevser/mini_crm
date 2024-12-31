<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Services\V1\Project\Host\HostService;
use App\Http\Requests\V1\Project\Host as Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class HostController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected HostService $hostService
    ){}

    public function store(Requests\Create $request, Project $project): JsonResponse
    {
        $validated = $request->validated();
        $this->hostService->create($validated);

        return $this->successResponse(trans('host/messages.created'));
    }

    public function destroy(Project $project, int $id): JsonResponse
    {
        $this->hostService->delete($project, $id);
        return $this->successResponse(trans('host/messages.deleted'));
    }
}
