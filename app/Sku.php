<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use RequestHandler,SoftDeletes;
    
    protected $fillable = ['name','measurement'];

    public function processRequest($request)
    {
        return $this->handleIncomingRequest($this, $request);
    }

    public function product_category_sku()
    {
        return $this->hasMany(ProductCategorySku::class);
    }

    public function product_attribute()
    {
        return $this->hasOne(ProductAttribute::class);
    }
}
