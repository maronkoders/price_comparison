<?php

namespace App\Http\Controllers\Api;

use App\CompanyBranch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyBranchController extends Controller
{
    public function __construct()
    { 
        $this->company_branch = new CompanyBranch();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->company_branch, $request);
    }
}
