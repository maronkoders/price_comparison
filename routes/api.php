<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () 
{
    //Industries
    Route::post("newIndustry", 'IndustryController@processAllRequests');
    Route::get("getIndustries", 'IndustryController@processAllRequests');
    Route::delete("/deleteIndustry","IndustryController@processAllRequests");
    Route::put("/updateIndustry","IndustryController@processAllRequests");

    //City
    Route::post("newCity", 'ZoneController@processAllRequests');
    Route::get("getCities", 'ZoneController@processAllRequests');
    Route::put("updateCity", 'ZoneController@processAllRequests');
    Route::delete("deleteCity", 'ZoneController@processAllRequests');

    //Company
    Route::post("newCompany", 'CompanyController@processAllRequests');
    Route::get("getCompanies", 'CompanyController@processAllRequests');
    Route::put("updateCompany", 'CompanyController@processAllRequests');
    Route::delete("deleteCompany", 'CompanyController@processAllRequests');

    //Manufacturer
    Route::post("newManufacturer", 'ManufacturerController@processAllRequests');
    Route::get("getManufacturer", 'ManufacturerController@processAllRequests');
    Route::put("updateManufacturer", 'ManufacturerController@processAllRequests');
    Route::delete("deleteManufacturer", 'ManufacturerController@processAllRequests');

    //SKUs
    Route::post("newSkus", 'SkuController@processAllRequests');
    Route::get("getSkus", 'SkuController@processAllRequests');
    Route::put("updateSkus", 'SkuController@processAllRequests');
    Route::delete("deleteSkus", 'SkuController@processAllRequests');

    Route::get('getTotalCompanyCounts', 'CompanySelectionController@processAllRequests');

    //Categories
    Route::post("newCategory", 'ProductCategoryController@processAllRequests');
    Route::get("getCategories", 'ProductCategoryController@processAllRequests');
    Route::put("updateCategory", 'ProductCategoryController@processAllRequests');
    Route::delete("deleteCategory", 'ProductCategoryController@processAllRequests');

    //Products
    Route::post("/newProduct","ProductController@processAllRequests");
    Route::put("/updateProduct","ProductController@processAllRequests");
    Route::delete("/deleteProduct","ProductController@processAllRequests");
    Route::get("/getProducts","ProductController@processAllRequests");
    Route::get("/getManufacturerProducts","ProductController@getManufacturerProducts");

    //Brands
    Route::post("/newBrand","ProductBrandController@processAllRequests");
    Route::put("/updateBrand","ProductBrandController@processAllRequests");
    Route::delete("/deleteBrand","ProductBrandController@processAllRequests");
    Route::get("/getBrands","ProductBrandController@processAllRequests");

    //Newsletters
    Route::post("/newSubscriber",'NewsletterController@processAllRequests');
    Route::put("/updateSubscriber",'NewsletterController@processAllRequests');
    Route::delete("/deleteSubscriber",'NewsletterController@processAllRequests');
    Route::get("/getSubscribers",'NewsletterController@processAllRequests');

    //Visitors
    Route::post("/saveVisitorSelection",'VisitorsController@processAllRequests');

    //Products Attribute
    Route::get("/getCompanyProducts","ProductAttributesController@processAllRequests");
    Route::get("/getProductAttributes","ProductAttributesController@processAllRequests");
    Route::put("/updateProductAttributes","ProductAttributesController@processAllRequests");
    Route::delete("/deleteAttribute","ProductAttributesController@processAllRequests");

    //Company Redirect count.
    Route::post("/new","CompanyRedirectController@processAllRequests");

    //File Upload
    Route::resource('uploadFile','FileController');

    //Catalog_Promotion
    Route::post('newPromotion','CatalogPromotionController@processAllRequests');
    Route::put('updatePromotions','CatalogPromotionController@processAllRequests');
    Route::get('getPromotions','CatalogPromotionController@processAllRequests');
    Route::delete('deletePromotion','CatalogPromotionController@processAllRequests');

    Route::post('saveSubscription','SubscriptionController@save');
   //  Route::put('updatePromotions','SubscriptionController@processAllRequests');
    Route::get('getSubscriptions','SubscriptionController@getSubscriptions');

    //Users
    Route::post('newUser','UserController@processAllRequests');
    Route::put('verifyEmail','UserController@processAllRequests');
    Route::put('updateUser','UserController@processAllRequests');
    Route::get('getUserData','UserController@processAllRequests');
    Route::get('getUsers','UserController@processAllRequests');
    Route::delete('deletePromotion','UserController@processAllRequests');
    

    //Product Category Sku
    Route::get("getProductCategorySku", 'ProductCategorySkuController@processAllRequests');
    Route::put("updateProductCategorySkus", 'ProductCategorySkuController@processAllRequests');

    //Upload File
   Route::post('uploadFile','UploadFileController@uploadFile');
   Route::post('saveFileUpload','UploadFileController@processAllRequests');
   Route::get('getHeaderPromo','UploadFileController@processAllRequests');

   //Business 
   Route::get('getDashboardMetric','BusinessController@metrics');
   Route::get('getProductSelections','BusinessController@getProductSelections');
   Route::get('getManProducts','BusinessController@getManProducts');

});


Route::group(['namespace' => 'Admin'], function () 
{
   Route::get("/dashboardMetrics","DashboardController@processAllRequests");
   Route::get("/getTotalVisitors","DashboardController@getDailyVisitors");
   Route::get("/getDeviceMetrics","DashboardController@getDeviceMetrics");
   Route::get("/getCompanyProductSelection","DashboardController@getCompanyProductSelection");
   Route::get("/getCategorySelections","DashboardController@getCategorySelections");
   Route::get("/getCategorySelectionsByDates","DashboardController@getCategorySelectionsByDates");
   Route::get("/storeMetrics","DashboardController@storeMetrics");
   Route::get("/getStoreMetricByDate","DashboardController@getStoreMetricByDate");
   Route::get("/getProductsPerformance","DashboardController@getProductsPerformance");

});