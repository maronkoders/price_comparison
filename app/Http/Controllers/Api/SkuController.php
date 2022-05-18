<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    public function __construct()
    { 
        $this->sku = new Sku();
    }

    public function processAllRequests(Request $request)
    {   
        return $this->dbOperations($this->sku, $request);
    }
}
