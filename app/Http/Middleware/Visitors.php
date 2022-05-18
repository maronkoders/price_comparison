<?php

namespace App\Http\Middleware;

use App\Visitor;
use Carbon\Carbon;
use Closure;

class Visitors
{
    public function handle($request, Closure $next)
    {
        //TODO:: get user device ip rather than server ip address

        $ip    = hash('sha512', $request->ip());
        $today = Carbon::now('Africa/Harare');
        if (Visitor::whereDate('date',$today)->where('ip_address', $ip)->count() < 1)
        {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->header('User-Agent'),
                'date'=> $today,
                'city'=> 'No city Data'
            ]);
        }
        return $next($request);
    }
}
