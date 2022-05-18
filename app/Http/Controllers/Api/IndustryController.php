<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Industry;
use Illuminate\Http\Request;


class IndustryController extends Controller
{
    public function __construct()
    { 
        $this->industry = new Industry();
    }

    public function processAllRequests(Request $request)
    { 
        return $this->dbOperations($this->industry, $request);
    }
}
