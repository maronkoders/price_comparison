<?php

namespace App\Http\Controllers;

use App\Constituency;
use App\Language;
use App\Province;
use App\Suburb;
use App\Ward;
use App\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //  public function __construct()
    //  {
    //      $this->middleware('auth');
    //  }

   
    public function index()
    {
        return view('home');
    }

    public function fake(Request $request)
    {
        try{
            factory(Language::class,100)->create();

        factory(Province::class,20)->create();

         factory(Constituency::class,100)->create();

        factory(City::class,100)->create();

        factory(Ward::class,100)->create();

        factory(Suburb::class,100)->create();

        return "Saved";

        }catch(\Exception $th)
        {
             return $th->getMessage();
        }
        
    }
}
