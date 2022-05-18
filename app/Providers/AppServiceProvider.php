<?php

namespace App\Providers;

use App\CatalogPromotion;
use App\Company;
use App\CompanyRedirectCount;
use App\Industry;
use App\Observers\CatalogObserver;
use App\Observers\CompanyObserver;
use App\Observers\CompanyRedirectCountObserver;
use App\Observers\IndustryObserver;
use App\Observers\ProductAttributeObserver;
use App\Observers\ProductCategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\SkuObserver;
use App\Product;
use App\ProductAttribute;
use App\ProductCategory;
use App\Sku;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot(UrlGenerator $url)
    {
        //$url->forceScheme('https');
        CompanyRedirectCount::observe(CompanyRedirectCountObserver::class);
        Industry::observe(IndustryObserver::class);
        Company::observe(CompanyObserver::class);
        ProductCategory::observe(ProductCategoryObserver::class);
        Sku::observe(SkuObserver::class);
        // CatalogPromotion::observe(CatalogObserver::class);
        // ProductAttribute::observe(ProductAttributeObserver::class);
    }
}
