<?php

namespace App;

use App\Traits\RequestHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use RequestHandler,SoftDeletes;
    
    protected $fillable = ['name','product_category_id','industry_id'];
protected $with  = ['category','product_attributes','product_attributes.sku','industry'];
    
    public function processRequest($request)
    {   
        switch($request->method())
        {
            case "POST":
                $record = $this::where('name',$request->name)->first();
                    if($record == null)
                    {    
                        $response = $this->handleIncomingRequest($this,$request);
                        return ($response->original['status'] ==  201) ? $this->saveProductAttributes($request, $response->original['product']->id)
                                                                              : $this->failure(500, $response->original['message'] );
                    }else{
                       return  $this->saveProductAttributes($request,$record->id);
                    }
                break;
            case "GET": 

                if($request->request_option == "product_list")
                {
                    $category_ids= explode(',',$request->product_categories);
                    $data = $this::where('industry_id', $request->industry_id)
                            ->whereIn('product_category_id',$category_ids)
                            ->get();

                    // $products = [];
                    // $attributes = [];
                    // foreach($data as $item)
                    // {
                    //     foreach ($item->product_attributes as  $value) {
                    //         if(in_array($value->description, $attributes))
                    //         {
                    //             $attributes[$value->description] = [];
                    //         }else{
                    //             $attributes[$value->description] = $value;
                    //         }
                    //     }
                    //     $item->product_attributes = $attributes;
                    //     $products[] = $item;
                    // }
                    //->groupBy(function($data) { return $data->category->name;});

                    return response()->json(['status'=>200,'message'=>'products retrieved','products'=> $data]);
                }else{
                    return $this->handleIncomingRequest($this, $request); 
                }
              break;
            
              case "PUT": 
 
                return $this->handleIncomingRequest($this, $request); 
             break;
            default: 
                return $this->handleIncomingRequest($this, $request);
            break;    
        }
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }


    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    private function saveProductAttributes($request, $product_id)
    {
        try{
            foreach($request->product_prices as  $item)
                {
                    ProductAttribute::create([
                        'description'=>  $item['size'],
                        'discount' => $request->discount,
                        'price' => $item['price'],
                        'tax' => $request->tax,
                        'company_id' => $item['company_id'],
                        'product_id' => $product_id,
                        'is_show' =>1,
                        'manufacturer_report_enabled'=>1,
                        'manufacturer_id'=>$request->manufacturer_id,
                        'sku_id'=>$request->sku_id
                    ]);
                }
            return $this->success(201,"Product details have been saved", array());
        }catch(\Exception $th)
        {
            return $this->failure(500,"failed to create product attributes", $th->getMessage());
        }
    }

    private function handleIndustryProducts($data)
    {

        dd("all product data", $data);
        //TODO:: filter product attributes based on is_show value;
        $activateProductAttributes = ProductAttribute::all();
        foreach($data as $element){
                foreach($activateProductAttributes  as $attribute){
                    if($attribute->product_id == $element->id)
                    {
                       if (isset($element['product_attributes'][$attribute->id])) {
                            $element['product_attributes'][] = $attribute;
                       }            
                    }
                }
            }
       return $this->success(200, "Records retrieved",null, $data);
    }


    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
 
}
