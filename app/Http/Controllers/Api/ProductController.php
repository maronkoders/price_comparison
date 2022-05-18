<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    { 
      $this->product = new Product();
    }

    public function getManufacturerProducts(Request $request)
    {
       try {
           $raw = \DB::table('products')
                          ->LeftJoin('product_attributes','products.id','=','product_attributes.product_id')
                          ->where('product_attributes.manufacturer_id','=',$request->manufacturer_id)
                          ->select('products.*')
                          ->get();

            $collection = collect($raw);
            $products = $collection->unique('name');

    
        return response()->json(['status'=>200,'records'=> $products]);

       } catch (\Throwable $th) {
          return response()->json(['status'=>500,'message'=> $th->getMessage()]);
       }
    }

    public function manufacturerRecord($request)
    {
       return  Manufacturer::find($request->manufacturer_id);
    }

    public function processAllRequests(Request $request)
    {
      return $this->dbOperations($this->product, $request);    
    }
}

