<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next, $guard = null)
    {
        \Log::info(['user info'=> Auth::user()]);
        if (Auth::guard($guard)->check()) {
            if( Auth::user()->role==="isAdmin")
            {
                return redirect(RouteServiceProvider::DASHBOARD);
            }
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
