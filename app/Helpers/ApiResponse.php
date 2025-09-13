<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($message = 'success', $date = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'date' => $date,
            'errors' => null,
        ], $code);
    }

    public static function error($message = 'Error', $errors=[], $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'date' => null,
            'errors' => $errors,
        ], $code);
    }
}
