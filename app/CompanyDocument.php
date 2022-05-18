<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDocument extends Model
{
    use RequestHandler, SoftDeletes;
    
    protected $fillable = ['file_path','company_id','slug'];
    // protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
