<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    { 
        $this->company = new Company();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->company, $request);
    }
}
