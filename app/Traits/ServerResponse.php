<?php

namespace App\Traits;


trait ServerResponse
{

   public function success($status, $message ,$data_name, $data=null, $optional=null)
   {
       return response()->json([
           'status' => $status,
           'message' => $message,
            ($data_name == null)? "record": $data_name => $data,
           'optional' => $optional,
           'type'=>'success',
           
       ]);
   }

   public function failure($status, $message , $reason=null , $class = null, $file = null, $line = null )
   {
        \Log::channel('slackCritical')->critical('Error Occured', [
            'CLASS' => $class,
            'FILE' => $file,
            'LINE' => $line
        ]);
       return response()->json([
           'status'=> $status,
           'message' => $message,
           'reason'=> $reason,
           'type'=>'error',
       ]);
   }
}
