<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ServerResponseServiceProvider extends ServiceProvider
{

    public function register()
    {
    }


    public function boot()
    {
        App::bind('ServerResponse', function () {
            return new \App\Helpers\ServerResponse;
        });
    }
}
