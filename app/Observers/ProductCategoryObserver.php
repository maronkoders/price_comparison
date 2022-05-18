<?php

namespace App\Observers;

use App\ProductCategory;
use App\ProductCategorySku;
use Illuminate\Support\Facades\Cache;

class ProductCategoryObserver
{
    public function created(ProductCategory $productCategory)
    {
        foreach(request()->get('sku_id') as $element)
            {
                ProductCategorySku::create([
                    'sku_id'=> $element['id'],
                    'product_category_id' =>$productCategory->id
                ]);
            } 
    }

    public function creating()
    {
        Cache::forget('categories');
    }

    public function updating()
    {
        Cache::forget('categories');

    }

}
