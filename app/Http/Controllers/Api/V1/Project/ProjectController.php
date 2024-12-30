<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Services\V1\Project\ProjectService;
use App\Http\Requests\V1\Project as Requests;
use App\Traits\ApiResponse;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected ProjectService $projectService
    ){}

    public function index()
    {
        $projects = $this->projectService->getAll();
        return $this->successResponse($projects);
    }

    public function show(int $id)
    {
        $project = $this->projectService->getOne($id);
        return $this->successResponse($project);
    }

    public function store(Requests\Create $request)
    {
        $validated = $request->validated();
        $this->projectService->create($validated);

        return $this->successResponse(trans('project/messages.created'));
    }

    public function update(Requests\Update $request, int $id)
    {
        $validated = $request->validated();
        $this->projectService->update($id, $validated);

        return $this->successResponse(trans('project/messages.updated'));
    }

    public function destroy(int $id)
    {
        $this->projectService->delete($id);
        return $this->successResponse(trans('project/messages.deleted'));
    }

    public function toggle(int $id)
    {
        $this->projectService->toggleAssignment($id);
        return $this->successResponse(trans('project/messages.enabled'));
    }
}
