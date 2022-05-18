<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;

class ProductCategorySku extends Model
{
    use RequestHandler;
    
    protected $fillable = ['sku_id','product_category_id'];

    protected $with = ['sku'];

    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

}
