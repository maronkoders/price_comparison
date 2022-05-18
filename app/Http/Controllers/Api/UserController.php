<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    { 
        $this->user = new User();
    }
    
    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->user, $request);
    }
}
