<?php

namespace App\Http\Controllers\Api;

use App\HeaderPromotion;
use App\Http\Controllers\Controller;
use App\Traits\ServerResponse;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    use ServerResponse;
    public function __construct()
    { 
        $this->headPromotion = new HeaderPromotion();
    }

    public function processAllRequests(Request $request)
    {
        return $this->dbOperations($this->headPromotion, $request);
    }

    public function uploadFile (Request $request)
    {   
        try{
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $fileInfo = pathinfo($file_name);
            $filename = $fileInfo['filename'];
            $newname = $filename . "." . $file_ext;
            $destinationPath =  'upload/catalog_header_promotions';
            $file->move($destinationPath, $newname);
            $filePath =url('/')."/".$destinationPath."/".$newname;
            
            return ['status'=>200, "file"=> $filePath];
        }catch(\Exception $th)
        {
            return $this->failure(500, "Failed to upload file, because". $th->getMessage());
        }
    }
}
