<?php

namespace App\Http\Controllers\Api;

use App\CatalogDownloads;
use App\Http\Controllers\Controller;
use App\NewsLetterSubscriber;
use App\Traits\ServerResponse;
use Illuminate\Http\Request;
use Validator;

class NewsletterController extends Controller
{
    use ServerResponse;

    public function __construct()
    { 
        $this->news_letter = new NewsLetterSubscriber();
    }

    private function saveDownload($record)
    {
        try {
            $agent = new \Jenssegers\Agent\Agent;
            $deviceType =  $this->getDeviceType($agent);
            $platform = $agent->platform();
            $download = new CatalogDownloads();
            $download->subscriber_id = $record->id;
            $download->platform = $platform;
            $download->city = 'Harare';
            $download->country ='Zimbabwe';
            $download->platformVersion = $agent->version($platform);
            $download->browser = $agent->browser();
            $download->device = $agent->device();
            $download->deviceType = $deviceType;
            $download->save();

            return $this->success(201,'Your data was saved',null);
        } catch (\Throwable $th) {
            return $this->failure(500,'Something went wrong,reason: '.$th->getMessage(),null,__CLASS__,__FILE__,$th->getLine());
        }
    }

    private function getDeviceType($agent)
    {
        if($agent->isDesktop())
        {
            return "Desktop";
        }
        if($agent->isMobile())
        {
            return "Mobile";
        }  
    }

    private function saveSubscriber($request)
    { 
        
       $newsLetter =  $this->news_letter::create($request->all());
            //   $response =  $this->dbOperations($this->news_letter,$request);
        if(!is_null($newsLetter)){
                    $latestRecord = $this->news_letter::latest()->first();
                    return $this->saveDownload($latestRecord);
               }else{
                return $this->failure(500,"Failed to save subscriber",null,__CLASS__,__FILE__,__LINE__);
        }
    }
    
    public function processAllRequests(Request $request)
    {
        if($request->method() == 'POST')
        {
            $exist = \DB::table('news_letter_subscribers')->where('email',$request->email)->orWhere('phone', $request->phone)->first();

           if($request->subscriberSource =="home_page" and !is_null($exist))
           {
             return $this->failure(500,"Already subscribed",null);
           }else{
            return (!is_null($exist))
                    ? $this->saveDownload($exist)
                    : $this->saveSubscriber($request); 
           }
        }else{
            return $this->dbOperations($this->news_letter,$request);
        }
    }
}
