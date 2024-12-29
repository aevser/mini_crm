<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /*
     * Success Response
     */
    public function successResponse($data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $code);
    }

    /*
     * Error Response
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST ): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $message,
            ]
        ], $code);
    }

    /*
     * Unauthorized Response
     */
    public function unauthorizedResponse($message, $code = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $message,
            ]
        ], $code);
    }
}
