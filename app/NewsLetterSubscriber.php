<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetterSubscriber extends Model
{
    use RequestHandler, SoftDeletes;

    protected $fillable =['name','email','phone'];

    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }
}
