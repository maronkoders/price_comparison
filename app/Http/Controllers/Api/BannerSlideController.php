<?php

namespace App\Http\Controllers\Api;

use App\BannerSlide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerSlideController extends Controller
{
    public function __construct()
    { 
        $this->banner = new BannerSlide();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->banner, $request);
    }
}
