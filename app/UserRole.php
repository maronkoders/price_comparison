<?php

namespace App;

use App\Traits\ModelHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use ModelHandler, SoftDeletes;

    protected $fillable = ['name','slug'];
    // protected $with = ['suburbs','wards'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
