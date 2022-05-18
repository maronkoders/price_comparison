<?php

namespace App\Helpers;

class ServerResponse
{
    public  static function success($message = null, $status)
    {
        return response()->json([
            'message' => $message,
            'type' => "success",
            'status' =>  $status,
            'position' => 'top'
        ]);
    }

    public  static function error(String $message = null,  $status)
    {
        return response()->json([
            'message' => $message,
            'type' => "error",
            'status' =>  $status,
            'position' => 'top'
        ]);
    }

    public  static function defaultResponse(String $message = null, $status)
    {
        return response()->json([
            'message' => $message,
            'type' => "default",
            'status' =>  $status,
            'position' => 'top'
        ]);
    }
    public  static function info(String $message = null, $status)
    {
        return response()->json([
            'message' => $message,
            'type' => "info",
            'status' =>  $status,
            'position' => 'top'
        ]);
    }

    public  static function exceptionError($message = null)
    {
        return response()->json([
            'message' => $message,
            'type' => "error",
            'status' => 500,
            'position' => 'top'
        ]);
    }

    public  static function retrievedData($data,$status)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
        ]);
    }
}
