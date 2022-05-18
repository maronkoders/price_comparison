<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function creating()
    {
        Cache::forget('categories');
    }

    public function updating()
    {
        Cache::forget('categories');

    }
}
