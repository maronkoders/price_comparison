<?php

namespace App;

use App\Mail\accountActivationMail;
use App\Mail\AccountVerificationMail;
use App\Mail\VerifiedMailNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\RequestHandler;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable, RequestHandler, SoftDeletes;
    protected $fillable = [
        'email',
        'password',
        'phone',
        'slug',
        'user_role_id',
        'email_verified_at',
        'gender',
        'dob',
        'is_active',
        'name'
    ];

    protected $hidden = ['password'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function processRequest($request)
    {
        if($request->method() == "PUT")
        {
            switch ($request->updateType) 
            {
                case 'status':
                    return $this->sendEmail($request);
                    break;
                
                case 'verify':
                    return $this->verifyEmail($request);
                    break;

                case 'set_password':
                    return $this->setPassword($request);
                    break;
                
                default:
                    return $this->handleIncomingRequest($this, $request); 
                    break;
            }
        } 
        
        else if($request->method() == "POST")
        {
            $request['slug'] = uniqid();
            $response = $this->handleIncomingRequest($this, $request);
           
            if($response->original['status'] == "201")
            {
                $request['user_id'] = $this::latest()->first()->id;
                CompanyRepresentative::create($request->all());
                Mail::to($request->email)->send(new AccountVerificationMail($request->email));
                return response()->json(['status'=> 201,'message'=> 'new user has been created']);
            }else{

            } 
        }

        else if($request->method() == "GET")
        {
            if(isset($request->token))
            {
                return $this->verifyEmail($request);
                $user = User::where('slug', $request->token)->first();



                   return !is_null($user)
                        ?  response()->json(['status' => 200 , 'message' => 'Password was updated','user'=> $user])
                        :  response()->json(['status' => 404 , 'message' => 'User record was not found']);
            }else{
                return $this->handleIncomingRequest($this, $request); 
            }
        }
        else{
            return $this->handleIncomingRequest($this, $request); 
        }      
    }

    private function  setPassword($request)
    {
        try{
                $user = $this::where('slug', $request->token)->first();
                if(!is_null($user))
                    {
                        $user->update(['password' => \Hash::make($request->password)]);
                        return response()->json(['status'=> 200 , 'message' =>"Password was updated"]);
                    }

                return response()->json(['status'=> 404 , 'message' =>"User record was not found"]);
            }
            catch(Exception $th){
                return response()->json(['status'=> 500 , 'message' => $th->getMessage()]);
            }
    }

    public function sendEmail($request)
    {
         $user = User::find($request->id); 
         if($user!=null)
         {
            Mail::to($user->email)->send(new accountActivationMail($user));
            $user->update(['is_active' => 1]);
            return response()->json(['status'=>200, 'message'=>'user account has been activated']);
         }else{
            return response()->json(['status'=>404 ,"message"=>"record not found"]);
         }
    }
    
    private function verifyEmail($request)
    {
        try {
                $user = User::where('slug', $request->token)->first();
                if(!is_null($user))
                {
                    if($user->email_verified_at != null)
                    {
                        return response()->json(['status'=> 204, 'message'=> "Email was verified  ".$user->email_verified_at->diffForHumans(),'user_email'=> $user->email]);
                    }else{
                        Mail::to($user->email)->send(new VerifiedMailNotification($user));
                        $user->update(['email_verified_at'=> Carbon::now()]);
                        return response()->json(['status' =>200 , 'message'=>'Email was successfully verified' ,'user_email'=> $user->email]);
                    }
            }else{
 
            }
         } catch (\Throwable $th) {
            return $th->getMessage();
         }
    }
}
