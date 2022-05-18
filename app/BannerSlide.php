<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerSlide extends Model
{
    use RequestHandler, SoftDeletes;
    
    protected $fillable = ['show_time','company_branch_banner_id'];
    // protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
