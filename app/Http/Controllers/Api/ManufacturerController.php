<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function __construct()
    { 
        $this->manufacturer = new Manufacturer();
    }

    public function processAllRequests(Request $request)
    {
        if($request->method() == "POST")
        {
            return $this->dbOperations($this->manufacturer, $request);
        }else{
            return $this->dbOperations($this->manufacturer, $request);
        }
    }
}
