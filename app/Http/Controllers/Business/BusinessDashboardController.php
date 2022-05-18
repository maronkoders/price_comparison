<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessDashboardController extends Controller
{
    public function index(Request $request)
    {   
        return view('business.dashboard');
    }

    public function active(Request $request)
    {
        return view('business.active');
    }

    public function inactive(Request $request)
    {
        return view('business.inactive');
    }

}
