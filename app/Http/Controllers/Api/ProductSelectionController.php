<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductSelectionCount;
use Illuminate\Http\Request;

class ProductSelectionController extends Controller
{
    public function __construct()
    { 
        $this->productCount = new ProductSelectionCount();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->productCount, $request);
    }
}
