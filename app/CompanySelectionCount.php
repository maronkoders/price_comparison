<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySelectionCount extends Model
{
    use RequestHandler, SoftDeletes;
    protected $fillable = ['visitor_id','company_id','date'];
    
   
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
