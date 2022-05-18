<?php

namespace App\Http\Controllers\Api;

use App\CatalogPromotion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogPromotionController extends Controller
{
    public function __construct()
    { 
        $this->catalog = new CatalogPromotion();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->catalog, $request);
    }
}
