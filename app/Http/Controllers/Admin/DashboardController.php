<?php

namespace App\Http\Controllers\Admin;

use App\CatalogDownloads;
use App\Company;
use App\CompanySelectionCount;
use App\Http\Controllers\Controller;
use App\Industry;
use App\Manufacturer;
use App\NewsLetterSubscriber;
use App\Product;
use App\ProductAttribute;
use App\ProductCategory;
use App\ProductSelectionCount;
use App\Traits\ServerResponse;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class DashboardController extends Controller
{   
    use ServerResponse;
    public function index(Request $request)
    {
        return view('dashboard.master');
    }

    public function __construct()
    {
        $this->company = new Company();
        $this->product  = new Product();
        $this->industry  = new Industry();
        $this->category   = new ProductCategory();
        $this->subscribers = new NewsLetterSubscriber();
        $this->visitors = new Visitor();
        $this->company_selection = new CompanySelectionCount();
        $this->manufacturer    = new Manufacturer();
        $this->catalogDownloads = new CatalogDownloads();

    }

    public function processAllRequests(Request $request)
    {
        $productsCategories = [];
        foreach($this->product::all() as  $item)
        {
            $productsCategories[] = $item['product_category_id'];
        }

        $totalProducts = array_unique($productsCategories);

        $industries  = $this->industry::all();
        $companies  = $this->company::all();
        $categories = $this->category::all();
        $subscribers = $this->subscribers::all();
        $visitors = $this->visitors::all();
        $lastDateOftheMonth  =  Carbon::now('Africa/Harare')->endOfMonth();
        $firstDate  =  Carbon::now('Africa/Harare')->startOfMonth();
        $monthlyDownloads = $this->catalogDownloads::whereBetween('created_at',[$firstDate, $lastDateOftheMonth])->count();
        $top_company_id = CompanySelectionCount::whereBetween('created_at',[$firstDate, $lastDateOftheMonth])
                                ->select('company_id')
                                ->groupBy('company_id')
                                ->orderByRaw('COUNT(*) DESC')->limit(1)->get();

        $monthlyTopCompany = Company::find($top_company_id);
 
        $data =  [
            'products' =>[
                "total_products" => count($totalProducts)
            ],
            'companies' =>[
                'total_companies' => count($companies), 
                'companies' => $companies
            ],

            'industries' => [
                'total_industries' => count($industries),
                'industries' => $industries
            ],

            'categories' => [
                'total_categories' =>  count($categories),
                'categories' => $categories
            ] ,
            'subscribers' => [
                'total_subscribers' =>  count($subscribers),
                'subscribers' => $subscribers
            ],
            'visitors' => [
                'total_visitors' =>  count($visitors),
                'visitors' => $visitors
            ],
            'manufacturers' =>[
                'total_manufacturers' => $this->manufacturer::all(),
            ],
            'monthlyDownloads' =>[
                'total_monthlyDownloads' =>$monthlyDownloads,
            ],
            'monthlyTop' =>[
                'monthlyTop' =>$monthlyTopCompany,
            ]
        ];

        return $this->success(200,"Records retrieved",null, $data);
    }

    public function getDailyVisitors(Request $request)
    {
        try{
            $allVisitors =  $this->visitors::all();
            return $this->success(200, "Total visitors",null,$allVisitors);
        }catch(\Exception $th)
        {
            return $this->failure(500, "failed to get visitors", $th->getMessage());
        } 
    }

    public function getProductsPerformance(Request $request)
    {
      try {
       $products =  \DB::table('product_selection_counts')
                            ->LeftJoin('product_attributes','product_selection_counts.product_attribute_id','=','product_attributes.id')
                            ->LeftJoin('products','product_attributes.product_id','=','products.id')
                            ->LeftJoin('manufacturers','product_attributes.manufacturer_id','=','manufacturers.id')
                            ->whereYear('product_selection_counts.created_at', date('Y'))
                            ->select('products.name as product_name','product_selection_counts.*','product_attributes.manufacturer_id')
                            ->get();

                        return $this->success(200, "all products",null,  $products);
      } catch (\Throwable $th) {
         return $this->failure(500, "failed to get category counts", $th->getMessage());
      }
    }

    private function  getAll()
    {
        return \DB::table('company_selection_counts')
        ->LeftJoin('companies','company_selection_counts.company_id','=','companies.id')
        ->get();
    }

    // public function getByFilterBy($period)
    // {
    //    return  \DB::table('company_selection_counts')
    //                 ->LeftJoin('companies','company_selection_counts.company_id','=','companies.id')
    //                 ->get();
    // }

    public function getStoreMetricByDate(Request $request)
    {
        try {
            $data = \DB::table('company_selection_counts')
                           ->LeftJoin('companies','company_selection_counts.company_id','=','companies.id')
                           ->whereBetween('company_selection_counts.date',[$request['from'], $request['to']])
                           ->get();
                 
              return $this->success(200, "Category Counts",null,  $data);
               
           } catch (\Throwable $th) {
               return $this->failure(500, "failed to get category counts", $th->getMessage());
           }
    }

    public function storeMetrics(Request $request)
    {
        try {
         $data = \DB::table('company_selection_counts')
                        ->LeftJoin('companies','company_selection_counts.company_id','=','companies.id')
                        ->get();
              
           return $this->success(200, "Category Counts",null,  $data);
            
        } catch (\Throwable $th) {
            return $this->failure(500, "failed to get category counts", $th->getMessage());
        }
    }
    public function getCategorySelections(Request $request)
    {
        try {
            
           $productCounts =  \DB::table('product_selection_counts')
                                    ->LeftJoin('product_attributes','product_selection_counts.product_attribute_id','=','product_attributes.id')
                                    ->LeftJoin('products','product_attributes.product_id','=','products.id')
                                    ->LeftJoin('product_categories','products.product_category_id','=','product_categories.id')
                                    ->whereYear('product_selection_counts.created_at', date('Y'))
                                    ->select('product_categories.name as cat_name','product_selection_counts.*')
                                    ->get();
           
           return $this->success(200, "Categaory Counts",null,$productCounts);

        } catch (\Throwable $th) {
            return $this->failure(500, "failed to get category counts", $th->getMessage());
        }
    }

    public function getCategorySelectionsByDates(Request $request)
    {
        try {
   
           $productCounts =  \DB::table('product_selection_counts')
                                    ->LeftJoin('product_attributes','product_selection_counts.product_attribute_id','=','product_attributes.id')
                                    ->LeftJoin('products','product_attributes.product_id','=','products.id')
                                    ->LeftJoin('product_categories','products.product_category_id','=','product_categories.id')
                                    ->whereBetween('product_selection_counts.date',[$request['from'], $request['to']])
                                    ->select('product_categories.name as cat_name','product_selection_counts.*')
                                    ->get();
           
           return $this->success(200, "Categaory Counts",null,$productCounts);

        } catch (\Throwable $th) {
            return $this->failure(500, "failed to get category counts", $th->getMessage());
        }
    }

    public function getDeviceMetrics()
    {
        try {  
            
            $deviceData = $this->catalogDownloads::all();
            return $this->success(200, "Total DeviceData",null,$deviceData);
              
        } catch (\Throwable $th) {
            return $this->failure(500, "failed to get visitors", $th->getMessage());
        }
    }

    public function getCompanyProductSelection(Request $request)
    {
        try{
             $data = $this->company_selection::where('company_id', $request->company_id)->get();
            return $this->success(200, "Total selection",null,$data);
        }catch(\Exception $th)
        {
            return $this->failure(500, "failed to get visitors", $th->getMessage());
        }   
    }
}
