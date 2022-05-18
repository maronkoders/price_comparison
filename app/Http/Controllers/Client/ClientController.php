<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $data;

    public function index(Request $request)
    {
        if(isset($request->token))
        {
            $this->data['user_email'] = User::where('slug',$request->token)->first();
        }
        
        return view('welcome')->with(['data' => $this->data]);
    }
}
