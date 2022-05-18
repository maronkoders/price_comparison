<?php

namespace App;

use App\Traits\RequestHandler;
use App\Traits\ServerResponse;
use Illuminate\Database\Eloquent\Model;

class CatalogPromotion extends Model
{
    use RequestHandler, ServerResponse;

    protected $fillable = ['company_id','period','end_date','promotion_text','is_active','start_date'];
    protected $with =['company'];
     
    public function processRequest($request)
    {
        return ($request->method() =="POST")
                ? $this->validatePromotions($request)
                :$this->handleIncomingRequest($this, $request);
    }

    public function company()
    {
       return $this->belongsTo(Company::class);
    }

    private function queueOthers($request)
    {
            $request['is_active'] = 0;
            return $this->handleIncomingRequest($this,$request);
    }

    private function validatePromotions($request)
    {   
        $active_promotion = $this::where('is_active', 1)->first();
         return (!is_null($active_promotion))
                    ? $this->queueOthers($request)
                    : $this->handleIncomingRequest($this, $request);
    }

}
