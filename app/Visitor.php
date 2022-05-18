<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use RequestHandler, SoftDeletes;
    protected $fillable = ['user_agent','browser','platform','ip_address','latitude','longitude','location_details','city','date','time_spent'];

    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
