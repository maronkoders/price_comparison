<?php

namespace App\Http\Controllers\Api;

use App\CompanyDocument;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyDocumentController extends Controller
{
    public function __construct()
    { 
        $this->company_documents = new CompanyDocument();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->company_documents, $request);
    }
}
