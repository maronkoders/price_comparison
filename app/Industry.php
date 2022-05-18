<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use RequestHandler, SoftDeletes;
    
    protected $fillable = ['name','slug'];

    //protected $with =['companies'];
    // protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function companies()
    {
       // return $this->hasMany(Company::class,'industry_id','id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
