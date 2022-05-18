<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
  
    public function index()
    {
        //
    }

  
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        try{
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $fileInfo = pathinfo($file_name);
            $filename = $fileInfo['filename'];
            $newname = $filename . "." . $file_ext;
            $destinationPath =  'upload/'.$request->foldername;
            $file->move($destinationPath, $newname);
            $filePath =url('/')."/".$destinationPath."/".$newname;
            return ['status'=>200, "file"=> $filePath];
        }catch(\Exception $th)
        {
            return response()->json(["status"=>500, "message"=>"Failed to upload file", "optional_data"=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
