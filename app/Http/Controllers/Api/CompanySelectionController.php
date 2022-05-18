<?php

namespace App\Http\Controllers\Api;

use App\CompanySelectionCount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySelectionController extends Controller
{
    public function __construct()
    { 
        $this->companyCount = new CompanySelectionCount();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->companyCount, $request);
    }
}
