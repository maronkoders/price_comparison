<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;

class HeaderPromotion extends Model
{
    use RequestHandler;
    protected $fillable = ['path'];

    public function processRequest($request)
    {
        if($request->method() == "GET")
        {
            $record = $this::latest()->first();
            return response()->json(['status'=>200, 'message'=>'Header path retrieved','path'=> $record == null ? null : $record->path]);
        }else{
            return $this->handleIncomingRequest($this, $request);
        }  
    }
}
