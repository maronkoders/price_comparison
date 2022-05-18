<?php

namespace App;

use App\Traits\RequestHandler;
use App\Traits\ServerResponse;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use RequestHandler,SoftDeletes, ServerResponse;
    
    protected $fillable = ['description','discount','price','tax','company_id','product_id','is_show','manufacturer_id','manufacturer_report_enabled','sku_id'];
    
   protected $with = ['company','manufacturer'];

    public function processRequest($request)
    {   
        if($request->method() == "PUT")
        {
            try{

                
                if($request->updateOption == "manufacturer-products")
                {
                    $this->where('id', $request->id)->update(['is_show'=> $request['is_show']]);
                }else{
                    foreach($request->all() as $item)
                    {
                        $this::where('id', $item['id'])->update(['price'=>$item['price'] , 'sku_id' =>$item['sku_id']]);
                    }
                }
               
                return $this->success(200, "Records were updated",null);
            }catch(Exception $th)
            {
                return $this->failure(500, $th->getMessage(), null);
            }
        }else if($request->method() == "DELETE")
        {
            return $this->deleteMany($request);
        }
        else{
            return $this->handleIncomingRequest($this, $request);
        }
    }

    private function deleteMany($request)
    {
        try{
            $selectedIds = explode(',',$request['ids']);
            foreach ($selectedIds  as $id) 
            {
                $this::where("id", $id)->delete();
            }
           return  $this->success(204,"Records were deleted", null);
        }catch(Exception $th){
            return $this->failure(500, "Failed to delete because ". $th->getMessage(), null);
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function product_selection_count()
    {
        return $this->hasMany(ProductSelectionCount::class);
    }
}
