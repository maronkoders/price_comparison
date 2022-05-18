<?php

namespace App;

use App\Traits\RequestHandler;
use App\Traits\ServerResponse;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class ProductCategory extends Model
{
    use RequestHandler, SoftDeletes, ServerResponse;

    protected $fillable = ['name','slug','industry_id','is_active'];

    public function processRequest($request)
    {
        if($request->method() == "PUT")
        {
            return $request->updateType == "status" 
                    ? $this->updateStatus($request)
                    : $this->updateTheRecords($request);
        }else if($request->method() == "GET"){

            if(is_null(Cache::get('categories')))
            {
                $data = $this->handleIncomingRequest($this, $request);
                Cache::set('categories',$data);
                return $data;
            }else{
                    return Cache::get('categories');
            }
        }   
        else{
            return $this->handleIncomingRequest($this, $request);
        }   
    }

    protected function updateStatus($request)
    {
       try{
           
        $this::where('id', $request->id)->update([
            'is_active' => $request->is_active
        ]);

        return $this->success(200,"Category status was Updated",[]);

       }catch(Exception $th)
       {
           return $this->failure(500,"Failed to change category status. Because ",$th->getMessage());
       }
    }
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    private function deleteNonSelectedSku($request)
    {
            $categorsku  = ProductCategorySku::where('product_category_id', $request->id)->get();
            foreach($categorsku as $item)
            {
                 foreach($request->sku_id as $element)
                 {
                     if($element['id'] != $item->sku_id  && $item->product_category_id  == $request->id)
                     {
                        ProductCategorySku::where('id',$item->id)->delete();
                     }
                 }
            }
    }

    public function updateTheRecords($request)
    {
        try{
            $this::where('id', $request->id)->update([
                'name' => $request->name,
                'industry_id' => $request->industry_id
            ]);

            $this->deleteNonSelectedSku($request);

            foreach($request->sku_id as $element)
                {
                   $sku_record = ProductCategorySku::where('sku_id',$element['id'])->where('product_category_id', $request->id)->first();

                    if(is_null($sku_record))
                    {
                        ProductCategorySku::create([
                            'sku_id'=> $element['id'],
                            'product_category_id' => $request->id
                        ]);
                    }           
                } 

            return $this->success(200,"Category was Updated",[]);
        }
            catch(Exception $th)
        {
                \Log::critical([
                    'CATEGORY_UPDATE_ERROR' => $th->getMessage(),
                ]);

            return $this->failure(500 ,"Failed to update a category");
        }
    }
}
