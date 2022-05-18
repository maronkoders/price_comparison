<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Visitor;
trait VisitorHandler
{

  public function visitorDetails()
  {
    $ip      = hash('sha512',request()->ip());
    $today   = Carbon::now('Africa/Harare');
    $visitor = Visitor::whereDate('date', $today)->where('ip_address', $ip)->first();
    if(!empty($visitor))
    {
       return $visitor;
    }else{
      \Log::critical([
        'NEW VISITOR ERROR' => "No visitor data was found",
      ]);
    }
  }
}
