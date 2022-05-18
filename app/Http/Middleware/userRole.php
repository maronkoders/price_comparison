<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class userRole
{
    public function handle($request, Closure $next)
    {
        $workerRoutes = 
                      ['profile', 'historic-timesheets','calendar','current-timesheets','home'];
    //     \Log::info(["user role"=>\Auth::user()->role]);
       \Log::info(['request url'=> $request->fullUrl()]);
        return $next($request);
    }
}
