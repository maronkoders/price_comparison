<?php

namespace App\Observers;

use App\Company;

class CompanyObserver
{
    public function updating(Company $company)
    {    
        if(request()->is_default !=null)
        {
             $isDefault = $company::where('is_default',1)->where('industry_id',request()->get('industry_id'))->first();
             if($isDefault !=null)
             {
                $company::where('id', $isDefault->id)->where('industry_id',request()->get('industry_id'))->update(['is_default'=>0]);
             }
          
        }   
    }
}
