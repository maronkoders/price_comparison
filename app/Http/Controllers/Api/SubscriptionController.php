<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscription;
use App\User;

class SubscriptionController extends Controller
{
    private function getUserId($request)
    {
        return User::where('slug', $request->slug)->first()->id;
    }
    public function save(Request $request)
    {
        try {   
            $request['user_id'] =$this->getUserId($request);
            Subscription::create($request->all());

            return response()->json(['status'=> 201,'message'=> 'Subscription has been saved']);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'message'=> $th->getMessage()]);
        }
    }

    public function getSubscriptions(Request $request)
    {
        try {
           $all =  Subscription::where('user_id', $this->getUserId($request))->get();
            return response()->json(['status'=> 200,'message'=> 'Subscriptions retrieved','data'=>$all ]);
    
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'message'=> $th->getMessage()]);
        }
    }
}
