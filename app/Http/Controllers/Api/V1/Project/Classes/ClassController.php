<?php

namespace App\Http\Controllers\Api\V1\Project\Classes;

use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use App\Models\Project\Classes\LeadClass;
use App\Models\Project\Project;
use App\Services\V1\Project\Classes\ClassService;
use App\Http\Requests\V1\Project\Classes as Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected ClassService $classService
    ){}

    public function store(Requests\Create $request, Project $project): JsonResponse
    {
        $validated = $request->validated();
        $this->classService->create($validated);

        return $this->successResponse(trans('classes/messages.created'));
    }

    public function update(Requests\Update  $request, Project $project, LeadClass $class): JsonResponse
    {
        $validated = $request->validated();
        $this->classService->update($class->id, $validated);

        return $this->successResponse(trans('classes/messages.updated'));
    }

    public function destroy(Project $project, int $id): JsonResponse
    {
        $this->classService->delete($id);
        return $this->successResponse(trans('classes/messages.deleted'));
    }

    public function assign(Requests\Assign $request, Project $project, Lead $lead): JsonResponse
    {
        $validated = $request->validated();
        $this->classService->assignClasses($project, $lead, $validated);

        return $this->successResponse(trans('classes/messages.assign'));
    }
}
