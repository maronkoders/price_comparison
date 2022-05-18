<?php

namespace App\Observers;

use App\CompanyRedirectCount;
use App\Traits\VisitorHandler;

class CompanyRedirectCountObserver
{
    use VisitorHandler;
    public function creating(CompanyRedirectCount $companyRedirectCount)
    {
         if(request()->has('id'))
         {
            $companyRedirectCount->company_id  = request()->get('id');
            $companyRedirectCount->visitor_id  = $this->visitorDetails()->id;
         }
    }
}
