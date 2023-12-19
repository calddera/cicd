<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse
{
    public static function success($data = null, $message = '', $statusCode = JsonResponse::HTTP_OK, $meta = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $statusCode);
    }

    public static function error($message, $statusCode = JsonResponse::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function created($data = null, $message = 'Created successfully'): JsonResponse
    {
        return self::success($data, $message, JsonResponse::HTTP_CREATED);
    }

    public static function updated($data = null, $message = 'Updated successfully'): JsonResponse
    {
        return self::success($data, $message, JsonResponse::HTTP_OK);
    }

    public static function deleted($message = 'Deleted successfully'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], JsonResponse::HTTP_NO_CONTENT);
    }

    public static function unauthorized($message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, JsonResponse::HTTP_UNAUTHORIZED);
    }

    public static function forbidden($message = 'Forbidden'): JsonResponse
    {
        return self::error($message, JsonResponse::HTTP_FORBIDDEN);
    }

    public static function notFound($message = 'Not found'): JsonResponse
    {
        return self::error($message, JsonResponse::HTTP_NOT_FOUND);
    }

    public static function internalError($message = 'Internal error'): JsonResponse
    {
        return self::error($message, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    public static function validationError($errors): JsonResponse
    {
        return self::error($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
