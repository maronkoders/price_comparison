<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\CompanyRepresentative;
use App\Http\Controllers\Controller;
use App\Manufacturer;
use App\ProductAttribute;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BusinessController extends Controller
{

    public function __construct(Request $request)
    {
        $this->user = User::where('slug', $request->token)->first();
        $this->companyRecord =  $this->companyRecord();
        $this->to  =  Carbon::now('Africa/Harare')->endOfMonth();
        $this->from  =  Carbon::now('Africa/Harare')->startOfMonth();
    }

    private function notFound($message)
    {
        return response()->json(['status'=> 404 ,'message'=>$message. "not found"]);
    }

    public function getManProducts(Request $request)
    {
        try {
            $recs =  \DB::table('product_attributes')
                            ->LeftJoin('products','product_attributes.product_id','=','products.id')
                            ->LeftJoin('product_categories','products.product_category_id','=','product_categories.id')
                            ->LeftJoin('skus','product_attributes.sku_id','=','skus.id')
                            ->where('product_attributes.manufacturer_id',$this->companyRecord->company_id)
                            ->where('product_attributes.is_show',$request->status)
                            ->select('products.name','product_attributes.*','skus.measurement')
                            ->get();
        return response()->json(['status'=>200, "data"=> $recs]);
        
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'message'=> $th->getMessage() ." line ". $th->getLine() ." class ".$th->getFile()]);
        }
    }

    private function getRawProductsSelections()
    {
    
        return   \DB::table('product_selection_counts')
                    ->LeftJoin('product_attributes','product_selection_counts.product_attribute_id','=','product_attributes.id')
                    ->LeftJoin('products','product_attributes.product_id','=','products.id')
                    ->LeftJoin('product_categories','products.product_category_id','=','product_categories.id')
                    ->where('product_attributes.manufacturer_id',$this->companyRecord->company_id)
                    ->where('product_attributes.manufacturer_report_enabled',1)
                    ->select('products.name','product_selection_counts.*');
    }

    public function getProductSelections()
    {   
        try {
            $productCounts = $this->getRawProductsSelections()->get();
            return response()->json(['status'=>200,'record'=>$productCounts]);
        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'message'=> $th->getMessage() ." line ". $th->getLine() ." class ".$th->getFile()]);
        }
    }

    private function companyRecord()
    {
       return CompanyRepresentative::where('user_id', $this->user->id)->first();
    }

    public function metrics()
    {   
        try {
            return  is_null($this->user)
                        ? $this->notFound("User record")
                        : $this->getDashboardData();

        } catch (\Throwable $th) {
            return response()->json(['status'=> 500,'message'=> $th->getMessage()]);
        }
    }

    private function companyData($record)
    {
        return ($record->representative_option == "manufacturers")
                    ? Manufacturer::find($record->company_id)
                    : Company::find($record->company_id);
        
    }

    private function  getProductData()
    {
        return is_null($this->companyRecord)
             ? $this->notFound("Company record")
             : $this->getCompanyData($this->companyRecord);
    }

    private  function getMonthlyCompanyImpressions()
    {
        return $this->getRawProductsSelections()->whereBetween('product_selection_counts.created_at',[$this->from, $this->to])->get();
    }

    private function getDashboardData()
    {
        $active = [];
        $inactive = [];
        foreach($this->getProductData($this->user) as $item)
        {
            if($item->is_show)
            {
                $active[] = $item;
            }else{
                $inactive[] = $item;
            }
        }

        $companyData = $this->companyData($this->companyRecord());

        return response()->json(['status' => 200 , 'data' => ['inactive' => count($inactive) ,'active'=> count($active) , 'monthly'=>  count($this->getMonthlyCompanyImpressions()) , 'user' =>$this->user , "company" => $companyData ]]);
    }

    private function getCompanyData($record)
    {
        return  $record->representative_option =="manufacturers" 
                ? $this->getManufacturerData($record)
                : $this->getShopData($record);
    }


    private function getManufacturerData($record)
    {
        return ProductAttribute::where('manufacturer_id', $record->company_id)->get();
    }
}
