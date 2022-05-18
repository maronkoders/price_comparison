<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['namespace' => 'Admin'], function () 
{
    Route::middleware(['auth' ,'checkRole'])->group(function()
    {  

       Route::get('/home','DashboardController@index');
       Route::get('/products','DashboardController@index');
       Route::get('/subscribers','DashboardController@index');
       Route::get('/product-categories','DashboardController@index');
       Route::get('/industries','DashboardController@index');
       Route::get('/companies','DashboardController@index');
       Route::get('/manufacturers','DashboardController@index');
       Route::get('/companies_redirect','DashboardController@index');
       Route::get('/skus','DashboardController@index');
       Route::get('/catalog_promotion','DashboardController@index');
       Route::get('/add_new_promotion','DashboardController@index');
       Route::get('/add_header_promotion','DashboardController@index');
       Route::get('/users','DashboardController@index');
       Route::get('/user_data','DashboardController@index');
       Route::get('/manufacturer-products','DashboardController@index');
       Route::get('/store-metrics','DashboardController@index');
       Route::get('/products-performance','DashboardController@index');
    }); 
});


Route::group(['namespace' => 'Client','middleware'=>'visitor'], function () 
{
    Route::get('/','ClientController@index'); 
    Route::get('/price-comparison','ClientController@index');
    Route::get('/set-password','ClientController@index');
    Route::get('/verify_email','ClientController@index');
});


Route::group(['namespace' => 'Business'], function () 
{
    Route::middleware(['auth'])->group(function()
    {
       Route::get('/home-page','BusinessDashboardController@index');
       Route::get('/inactive-products','BusinessDashboardController@inactive');
       Route::get('/active-products','BusinessDashboardController@active');
    }); 
});

Route::get('reset', function () 
{
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    
    return '<h1>Have cleared the env</h1>';
});
