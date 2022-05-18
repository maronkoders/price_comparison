<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use RequestHandler, SoftDeletes;

    protected $fillable = ['name','city_id'];
  
   public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function city()
    {
        return $this->belongsTo(City::class,"city_id", "id");
    }

}
