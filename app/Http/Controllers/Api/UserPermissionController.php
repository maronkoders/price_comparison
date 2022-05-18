<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function __construct()
    { 
        $this->user_permission = new UserPermission();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->user_permission, $request);
    }
}
