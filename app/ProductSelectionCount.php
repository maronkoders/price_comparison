<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSelectionCount extends Model
{
    use RequestHandler, SoftDeletes;
    protected $fillable = ['visitor_id','product_attribute_id','date'];
    
    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function product_attributes()
    {
        return $this->belongsTo(ProductAttribute::class,'product_attribute_id','id');
    }
}
