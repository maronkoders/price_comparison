<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    { 
        $this->country = new Country();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->country, $request);
    }
}
