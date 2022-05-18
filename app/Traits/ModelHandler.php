<?php

namespace App\Traits;

trait ModelHandler
{
    use ServerResponse;
    protected function createRecord($model,$request)
    { 
            try{
                  $record = $model::create($request->all());
                  return $this->success(201,"New record was created",$request->data_name, $record);
            }catch(\Exception $e)
            {
                return $this->failure(500, "Internal Server Error", $e->getMessage());
            }
    }

    protected function updateRecord($model,$request)
    { 
          try{
                  $response = $this->getRecordById($model , $request)->original;
                  if($response['status'] == 200)
                  {
                    foreach($request->all() as $key =>$item)
                    {   
                        $response['record']->$key = $item;
                    }
                    $response['record']->save();
                    return $this->success(200, "A record was updated",null,$response['record']);
                  }else{
                    return $this->failure(404,"No record was found");
                  }
            }catch(\Exception $e)
            {
                return $this->failure(500, "Internal Server Error", $e->getMessage());
            }
    }

    protected function getRecords($model, $request)
    {
      try {
        $records = $model::all();
        return $this->countRecords($records, "Data records are empty", $request);
      } catch (\Exception $e) {
        return $this->failure(500, "Internal Server Error", $e->getMessage());
      }
    }

    public function retrieveRecord($model, $request)
    {
      if(count($request->all()) > 1 and  $request->id == null)
      {
          return $this->getRecordByOtherColumns($model , $request);
      }else{
        return ($request->data_name!=null and $request->id ==null ) ? $this->getRecords($model, $request):$this->getRecordById($model, $request);
      }
    }

    protected function getRecordByOtherColumns($model, $request)
    { 
        try{
            foreach($request->except('data_name') as $key => $value)
            {
                $record = $model::where($key,$value)->get();
            }
       
            return $this->countRecords($record, "Failed to get data",$request);
        }catch(\Exception $e)
        {
          return $this->failure(500, "Internal Server Error", $e->getMessage());
        }
    }

    private function getRecordsPerDefinedId($model, $request)
    {
      foreach($request->all() as $key => $value)
      {
          $records = $model::where($key,$value)->get();
      }
      return  $records;
    }

    protected function getRecordById($model, $request)
    {
        try{
              $record =  isset($request->id) 
                            ? $model::where("id",$request->id)->first()
                            : $this->getRecordsPerDefinedId($model,$request);
              return $this->countRecords($record, "No match was found",$request);
        }catch(\Exception $e)
        {
          return $this->failure(500, "Internal Server Error", $e->getMessage());
        }
    }
   

    private function countRecords($record, $message, $request)
    {
      return  ($record!=null) ? $this->success(200,"retrieved successfully",$request->data_name,$record) : $this->failure(404, $message);
    }

    protected function deleteRecord($model, $request)
    {
          try {
            $response = $this->getRecordById($model , $request)->original;
            if($response['status'] == 200)
            {
              $response[$request->data_name]->delete();
              return $this->success(204,"Record was deleted successfully","data");
            }
            return $response;
        
          } catch (\Exception $e) {
            return $this->failure(500, "Internal Server Error", $e->getMessage());
          }
    }
}
