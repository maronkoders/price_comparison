<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyBranch extends Model
{
    use RequestHandler, SoftDeletes;
    
    protected $fillable = ['name','latitude','longitude','telephone','website','address','company_id','zone_id'];
    // protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
