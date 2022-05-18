<?php

namespace App\Http\Controllers;

use App\Traits\ViewHandler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,ViewHandler;

    public function renderView(Request $request)
    {
        return $this->displayView($request);
    }

    public function dbOperations($modelInstance, $request)
    {
        return  $modelInstance->processRequest($request);
    }
}
