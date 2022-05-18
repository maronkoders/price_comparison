<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait RequestHandler
{
    use ModelHandler;

    protected function  handleIncomingRequest(Model $model, $request)
    {
         switch ($request->method()) {
             case 'POST':
               return   $this->createRecord($model, $request);
            break;
            
            case 'PUT':
                return   $this->updateRecord($model, $request);
            break;

            case 'DELETE':
                return   $this->deleteRecord($model, $request);
            break;
             
            default:
                return $this->retrieveRecord($model , $request);
            break;
         }
    }

}