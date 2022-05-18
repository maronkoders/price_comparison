<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use RequestHandler , SoftDeletes;
    protected $fillable = ['name','industry_id'];
   /// protected $with = ['company_selection_count'];

   public function processRequest($request)
   {
       return $this->handleIncomingRequest($this, $request);
   }


   public function product_attribute()
   {
        return $this->hasMany(ProductAttribute::class);
   }
}
