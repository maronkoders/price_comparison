<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    public function __construct()
    { 
        $this->attribute = new ProductAttribute();
    }

    public function processAllRequests(Request $request)
    {
      return $this->dbOperations($this->attribute, $request);    
    }
}
