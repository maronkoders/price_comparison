<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategorySku;
use Illuminate\Http\Request;

class ProductCategorySkuController extends Controller
{
    public function __construct()
    { 
        $this->product_category_sku = new ProductCategorySku();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->product_category_sku, $request);
    }
}
