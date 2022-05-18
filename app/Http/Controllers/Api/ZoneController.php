<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    { 
        $this->zone = new Zone();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->zone, $request);
    }
}
