<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use RequestHandler, SoftDeletes;
    protected $fillable = ['name','slug'];
  
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
