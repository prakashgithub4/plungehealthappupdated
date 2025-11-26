<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Success Response
     */
    protected function successResponse($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * Error Response
     */
    protected function errorResponse($message = 'Something went wrong', $code = 400, $errors = [])
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }

    /**
     * Validation Error Response
     */
    protected function validationErrorResponse($errors, $message = 'Validation failed')
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], 422);
    }

    /**
     * Unauthorized Response
     */
    protected function unauthorizedResponse($message = 'Unauthorized')
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
        ], 401);
    }

    /**
     * Not Found Response
     */
    protected function notFoundResponse($message = 'Not found')
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
        ], 404);
    }

    /**
     * Custom Response
     */
    protected function customResponse($data, $status = true, $message = '', $code = 200)
    {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}
