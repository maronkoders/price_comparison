<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use RequestHandler, SoftDeletes;
    protected $fillable = ['name','population','time_zone','area_code','dd_latitude','dd_longitude','dms_latitude','dms_longitude','geohash_coordinates','utm_coordinates','province_id'];
    protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function suburbs()
    {
        return $this->hasMany(Suburb::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
}
