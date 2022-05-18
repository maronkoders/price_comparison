<?php

namespace App\Observers;

use App\CatalogPromotion;
use App\Traits\ServerResponse;

class CatalogObserver
{
    use ServerResponse;
    public function creating(CatalogPromotion $catalogPromotion)
    {
        $activePromo = $catalogPromotion::where('is_active',1)->first();
        if(!is_null($activePromo))
        {
            return $this->failure(500,$activePromo->company->name. '\'s promotion is still active');
        }
    }
}
