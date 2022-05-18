<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct()
    { 
        $this->product_category = new ProductCategory();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->product_category, $request);
    }
}
