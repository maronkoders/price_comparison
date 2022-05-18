<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;

class CompanyRedirectCount extends Model
{
    use RequestHandler;
    protected $fillable = ['visitor_id','company_id'];

    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
}
