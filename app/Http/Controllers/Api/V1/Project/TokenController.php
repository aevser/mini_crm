<?php

namespace App\Http\Controllers\Api\V1\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Services\V1\Project\TokenService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected TokenService $tokenService
    ){}

    public function token(Project $project): JsonResponse
    {
        $this->tokenService->getToken($project->id);
        return $this->successResponse(['id' => $project->id,'token' => $project->api_token]);
    }

    public function refresh(Project $project): JsonResponse
    {
        $this->tokenService->refreshToken($project->id);
        return $this->successResponse(trans('project/messages.refresh'));
    }
}
