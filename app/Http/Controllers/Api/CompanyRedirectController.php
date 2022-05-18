<?php

namespace App\Http\Controllers\Api;

use App\CompanyRedirectCount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyRedirectController extends Controller
{ 
    
    public function __construct()
    { 
        $this->redirect = new CompanyRedirectCount();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->redirect, $request);   
    }
     
}
