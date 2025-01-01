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

    /*
     * Lead added.
     */

    public function leadAdd($status, $message, $code = Response::HTTP_CREATED): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => $status,
                'message' => $message,
            ]
        ], $code);
    }

    /*
     * Lead repeat.
     */

    public function leadRepeat($status, $message, $code = Response::HTTP_CREATED): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => $status,
                'message' => $message,
            ]
        ], $code);
    }

    /*
     * Lead Error.
     */

    public function leadError($status, $message, $code = Response::HTTP_PRECONDITION_FAILED): JsonResponse
    {
        return response()->json([
            'data' => [
                'status' => $status,
                'message' => $message,
            ]
        ], $code);
    }
}
