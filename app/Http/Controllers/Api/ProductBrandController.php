<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function __construct()
    { 
        $this->product_brand = new ProductBrand();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->product_brand, $request);
    }
}
