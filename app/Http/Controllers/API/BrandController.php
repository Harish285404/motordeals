<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Country;
use App\Models\Brand;
use App\Models\Recentsearch;
use App\Models\Wishlist;
use App\Models\CarPayment;
use App\Models\CarPaymentTransaction;
use Hash;
use DB;
use Auth;
use Session;
use Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
   
    public function get_home_info(Request $request)
    {  
        
    $langId = $request->langId;
        Session::put('language', $langId);
    
    if ($langId == 'ar') {
        
        // Fetch brands with arabic_name
        
        
        

// Calculate the date 30 days from today
$thirtyDaysFromNow = Carbon::now()->addDays(30);

$brands = Brand::withCount([
        'products as plan_type_1_count' => function ($query) use ($thirtyDaysFromNow) {
            $query->where('plan_type', 1)
                  ->where('created_at', '<=', $thirtyDaysFromNow);
        },
        'products as plan_type_2_count' => function ($query) use ($thirtyDaysFromNow) {
            $query->where('plan_type', 2)
                  ->where('created_at', '<=', $thirtyDaysFromNow);
        }
    ])
    ->orderByDesc('plan_type_1_count') // Order by the count of products with plan_type = 1
    ->orderByDesc('plan_type_2_count') // Then order by the count of products with plan_type = 2
    ->latest() // Get the latest brands after ordering by product count
    ->get(['id', 'arabic_name as translated_name', 'image']);

// Determine how many times to move plan_type 1 brands to the top
$numberOfPlanType1Moves = 9;
$numberOfPlanType2Moves = 5;

// Create an array to hold the modified brands list
$modifiedBrands = [];

// Separate brands with plan_type = 1 and plan_type = 2
$planType1Brands = $brands->where('plan_type_1_count', '>', 0)->take($numberOfPlanType1Moves);
$planType2Brands = $brands->where('plan_type_2_count', '>', 0)->take($numberOfPlanType2Moves);

// Add plan_type 1 brands 9 times to the top
for ($i = 0; $i < $numberOfPlanType1Moves; $i++) {
    if (isset($planType1Brands[$i])) {
        $modifiedBrands[] = $planType1Brands[$i];
    }
}

// Add plan_type 2 brands 5 times to the top
for ($i = 0; $i < $numberOfPlanType2Moves; $i++) {
    if (isset($planType2Brands[$i])) {
        $modifiedBrands[] = $planType2Brands[$i];
    }
}

// Add the remaining brands after the top ones
$otherBrands = $brands->diff($modifiedBrands);
$modifiedBrands = array_merge($modifiedBrands, $otherBrands->toArray());
        
        
    $categories = Category::latest()->take(5)->get(['id', 'arabic_name as translated_name','image']);
    

    $products = Product::latest()->take(5)->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
        

    
      // Fetch all products (assuming they are ordered by some criteria like ID or created_at)
    $productss = Product::where('plan_type','1')->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
    
    

    // Retrieve the index of the last displayed product from cache
    $lastDisplayedIndex = Cache::get('last_displayed_index', 0);

    $now = Carbon::now();


    $secondsIn20Seconds = 24 * 60 * 60; // 24 hours in seconds
    $currentTimestamp = $now->timestamp;
    $elapsedIntervals = floor($currentTimestamp / $secondsIn20Seconds);
    $currentProductIndex = $elapsedIntervals % count($productss);


    if ($currentProductIndex !== $lastDisplayedIndex) {
        // Update the index of the last displayed product in cache
        Cache::put('last_displayed_index', $currentProductIndex);


        $bannerproducts = $productss->get($currentProductIndex);
    } else {
  
        $bannerproducts = $productss->get($lastDisplayedIndex);
    }
        
        
   
        
        
        
    } else {
        
        
$categories = Category::get(['id', 'name as translated_name','image']);
       
       

$thirtyDaysFromNow = Carbon::now()->addDays(30);

$brands = Brand::withCount([
        'products as plan_type_1_count' => function ($query) use ($thirtyDaysFromNow) {
            $query->where('plan_type', 1)
                  ->where('created_at', '<=', $thirtyDaysFromNow);
        },
        'products as plan_type_2_count' => function ($query) use ($thirtyDaysFromNow) {
            $query->where('plan_type', 2)
                  ->where('created_at', '<=', $thirtyDaysFromNow);
        }
    ])
    ->orderByDesc('plan_type_1_count') // Order by the count of products with plan_type = 1
    ->orderByDesc('plan_type_2_count') // Then order by the count of products with plan_type = 2
    ->latest() // Get the latest brands after ordering by product count
    ->get(['id', 'arabic_name as translated_name', 'image']);

// Determine how many times to move plan_type 1 brands to the top
$numberOfPlanType1Moves = 9;
$numberOfPlanType2Moves = 5;

// Create an array to hold the modified brands list
$modifiedBrands = [];

// Separate brands with plan_type = 1 and plan_type = 2
$planType1Brands = $brands->where('plan_type_1_count', '>', 0)->take($numberOfPlanType1Moves);
$planType2Brands = $brands->where('plan_type_2_count', '>', 0)->take($numberOfPlanType2Moves);

// Add plan_type 1 brands 9 times to the top
for ($i = 0; $i < $numberOfPlanType1Moves; $i++) {
    if (isset($planType1Brands[$i])) {
        $modifiedBrands[] = $planType1Brands[$i];
    }
}

// Add plan_type 2 brands 5 times to the top
for ($i = 0; $i < $numberOfPlanType2Moves; $i++) {
    if (isset($planType2Brands[$i])) {
        $modifiedBrands[] = $planType2Brands[$i];
    }
}

// Add the remaining brands after the top ones
$otherBrands = $brands->diff($modifiedBrands);
$modifiedBrands = array_merge($modifiedBrands, $otherBrands->toArray());





    
    
    
    
    
    

    $products = Product::latest()->take(5)->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
    
    
  // Fetch all products (assuming they are ordered by some criteria like ID or created_at)
    $productss = Product::where('plan_type','1')->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);

    // Retrieve the index of the last displayed product from cache
    $lastDisplayedIndex = Cache::get('last_displayed_index', 0);

    $now = Carbon::now();

    // Calculate the index of the next product to display based on the current time
    $secondsIn20Seconds = 24 * 60 * 60; // 24 hours in seconds
    $currentTimestamp = $now->timestamp;
    $elapsedIntervals = floor($currentTimestamp / $secondsIn20Seconds);
    $currentProductIndex = $elapsedIntervals % count($productss);

    // Check if it's time to display the next product
    if ($currentProductIndex !== $lastDisplayedIndex) {
        // Update the index of the last displayed product in cache
        Cache::put('last_displayed_index', $currentProductIndex);

        // Fetch the product to display
        $bannerproducts = $productss->get($currentProductIndex);
    } else {
        // Fetch the product to display (same product as last interval)
        $bannerproducts = $productss->get($lastDisplayedIndex);
    }
        
        
        
    }

 
    $minPrice = $products->min('asking_price');
    $maxPrice = $products->max('asking_price');
    
    
    $minYear = $products->min(function($product) {
        return $product->created_at->year;
    });
    
    $maxYear = $products->max(function($product) {
        return $product->created_at->year;
    }); 
    
    if ($minYear == $maxYear) {
         $minYear= $maxYear - 1;
    }
    
    if ($minPrice == $maxPrice) {
        $minPrice = $maxPrice - 10;
    }
    


    $data = [
        'banner' =>$bannerproducts,
        'categories' => $categories,
        'brand' => $modifiedBrands,
        'products' => $products,
           
    ];

    if (!empty($data)) {
        $response = [
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'Data Fetched Successfully!',
            'min_year' => $minYear,
            'max_year' => $maxYear,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'data' => $data,
        ];
    } else {
        $response = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $response;
}





    public function get_home_main(Request $request)
    {  
        
        $langId = $request->langId;
                Session::put('language', $langId);
    
    if ($langId == 'ar') {
        
        // Fetch brands with arabic_name
    $brands = Brand::latest()->take(5)->get(['id', 'arabic_name as translated_name', 'image', 'created_at']);
        
        
    $categories = Category::latest()->take(5)->get(['id', 'arabic_name as translated_name','image']);
    

    $products = Product::latest()->take(5)->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
    
        $bannerproducts = Product::select(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at'])->take(4)->get();
        
        
    } else {
        
        
       $categories = Category::get(['id', 'name as translated_name','image']);
    $brands = Brand::latest()->take(5)->get(['id', 'name as translated_name', 'image']);

    $products = Product::latest()->take(5)->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
        $bannerproducts = Product::select(['id', 'name as translated_name', 'asking_price', 'image', 'created_at'])->take(4)->get();
    }

 
    $minPrice = $products->min('asking_price');
    $maxPrice = $products->max('asking_price');
    
    
    $minYear = $products->min(function($product) {
        return $product->created_at->year;
    });
    
    $maxYear = $products->max(function($product) {
        return $product->created_at->year;
    }); 
    
    if ($minYear == $maxYear) {
         $minYear= $maxYear - 1;
    }
    
    if ($minPrice == $maxPrice) {
        $minPrice = $maxPrice - 10;
    }
    


    $data = [
        'banner' =>$bannerproducts,
        'categories' => $categories,
        'brand' => $brands,
        'products' => $products,
           
    ];

    if (!empty($data)) {
        $response = [
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'Data Fetched Successfully!',
            'min_year' => $minYear,
            'max_year' => $maxYear,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'data' => $data,
        ];
    } else {
        $response = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $response;
}


 public function get_products_by_category(Request $request)
{  
    $langId  = $request->langId;
    Session::put('language', $langId);

    $category_id = $request->input('category_id');
    
    if ($category_id) {
        
        
        
    if ($langId == 'ar') {
      $products = Product::select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at')
                   ->where('category_id', $category_id)
                   ->paginate(6);
    } else {
          $products = Product::select('id', 'name as translated_name', 'asking_price', 'image', 'created_at')
                   ->where('category_id', $category_id)
                   ->paginate(6);
    }
        
        
       
        
        if ($products->isNotEmpty()) {
            // Get the minimum and maximum price
            $minPrice = $products->min('asking_price');
            $maxPrice = $products->max('asking_price');

            // Get the minimum and maximum year
            $minYear = $products->min(function($product) {
                return $product->created_at->year;
            });

            $maxYear = $products->max(function($product) {
                return $product->created_at->year;
            });

            // Adjust min and max year if they are the same
            if ($minYear == $maxYear) {
                $minYear = $maxYear - 1;
            }

            // Adjust min and max price if they are the same
            if ($minPrice == $maxPrice) {
                $minPrice = $maxPrice - 10;
            }
            
            
          $products->appends(['langId' => $langId]);     
            
            
            $data = [
                'status_code' => 1,
                'status_text' => 'Success',
                'message' => 'Products Fetched Successfully!',
                'min_year' => $minYear,
                'max_year' => $maxYear,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'data' => $products
            ];
        } else {
            $data = [
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'No Products Found for the given Category',
                'data' => []
            ];
        }
    } else {
        $data = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'Data Not Found',
            'data' => []
        ];
    }

    return $data;
}

    
    
      public function product_detail(Request $request)
    {  
         $langId  = $request->langId;
         
         $langyage= Session::put('language',$langId);
 
        $product_id  = $request->input('product_id');

        
         if ($product_id) {
             
                 if ($langId == 'ar') {
              $products = Product::where('id',$product_id)->get(['id','arabic_name as translated_name','asking_price','image','created_at','arabic_description as translated_description','phone_number','whatsapp_number']);
            } else {
                           $products = Product::where('id',$product_id)->get(['id','name as translated_name','asking_price','image','created_at','description as translated_description','phone_number','whatsapp_number']);
            }
             
     
        for($i = 0;$i<count($products);$i++){
          
          $imageArray = explode(',', $products[$i]->image);
          $Image = [];
                        
                        foreach($imageArray as $imageArrays)   {          
        $Image[] = 'https://f.motordeals.net/User-images/'.$imageArrays;
                        }
       $products[$i]->image_urls = $Image;

    
    
          
        } 
        
          
            if ($products->isNotEmpty())
            {
                $data['status_code']   =    1;
                $data['status_text']   =    'Success';             
                $data['message']   =   'Products Fetched Successfully !';
                $data['data']   =   $products;
                
            } 
            else 
            {
                $data['status_code']   =   0;
                $data['status_text']   =   'Failed';             
                $data['message']       =   'No Products Found for the given Category';
                $data['data']          =   [];  
            }
        } 
        else
        {
            $data['status_code']    =     0;
            $data['status_text']    =    'Failed';             
            $data['message']    =    'Data Not Found';
            $data['data']    =    [];  
        }
        
        return $data;
    } 
    
    public function home_filter(Request $request)
{  
    $langId  = $request->langId;
    
    $langyage= Session::put('language',$langId);
    
    $validatedData = $request->validate([
        'category_id' => 'required|integer',
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric|gte:min_price',
        'start_manufacture_year' => 'nullable|integer',
        'end_manufacture_year' => 'nullable|integer|gte:start_manufacture_year',
    ]);


    $brand_id = $validatedData['category_id'];
    $min_price = $validatedData['min_price'] ?? 0;
    $max_price = $validatedData['max_price'] ?? PHP_INT_MAX;
    $start_manufacture_year = $validatedData['start_manufacture_year'] ?? 0;
    $end_manufacture_year = $validatedData['end_manufacture_year'] ?? PHP_INT_MAX;

        
            if ($langId == 'ar') {
                
    $products = Product::where('category_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year')
        ->get();
    } else {
   $products = Product::where('category_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year')
        ->get();
    }
        

    if ($products->isNotEmpty()) {
        $data = [
            'success' => true,
            'message' => 'Products Fetched Successfully!',
            'data' => $products
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'No Products Found for the given Criteria',
            'data' => []
        ];
    }

    return $data;
}
    
 
public function brands(Request $request)
{
    $langId = $request->langId;

    if ($langId == 'ar') {
        // Fetch brands with arabic_name
        $brands = Brand::get(['id', 'arabic_name as translated_name', 'image', 'created_at']);
    } else {
        // Fetch brands with name
        $brands = Brand::get(['id', 'name as translated_name', 'image', 'created_at']);
    }

    $response = [
        'status_code' => 1,
        'status_text' => 'Success',
        'message' => 'Brand List Fetched Successfully!',
        'data' => $brands
    ];

    return response()->json($response);
}



public function get_products_by_brand(Request $request)
{
    $langId = $request->langId;
    Session::put('language', $langId);

    $brand_id = $request->input('brand_id');

    if ($brand_id) {
        if ($langId == 'ar') {
            $products = Product::select('id', 'plan_type', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at')
                ->where('brand_id', $brand_id)
                ->whereIn('plan_type', [1, 2, 3])
                ->orderByRaw("FIELD(plan_type, 1, 2, 3), created_at DESC")
                ->get();
        } else {
            $products = Product::select('id', 'plan_type', 'name as translated_name', 'asking_price', 'image', 'created_at')
                ->where('brand_id', $brand_id)
                ->whereIn('plan_type', [1, 2, 3])
                ->orderByRaw("FIELD(plan_type, 1, 2, 3), created_at DESC")
                ->get();
        }

        if ($products->isNotEmpty()) {
            // Retrieve the index of the last displayed product for each plan type from cache
            $lastDisplayedIndex = Cache::get('last_displayed_index', ['plan1' => 0, 'plan2' => 0, 'plan3' => 0]);

            // Ensure the retrieved value is an array
            if (!is_array($lastDisplayedIndex)) {
                $lastDisplayedIndex = ['plan1' => 0, 'plan2' => 0, 'plan3' => 0];
            }

            $now = Carbon::now();
            $intervalSeconds = 86400; // Change interval to 10 seconds
            $currentTimestamp = $now->timestamp;
            $elapsedIntervals = floor(($currentTimestamp % (count($products) * $intervalSeconds)) / $intervalSeconds);

            $bannerProducts = [];

            // Define a map for plan types to cache keys
            $planTypeCacheKeys = ['1' => 'plan1', '2' => 'plan2', '3' => 'plan3'];

            foreach ($planTypeCacheKeys as $planType => $cacheKey) {
                // Filter products by plan type
                $filteredProducts = $products->where('plan_type', $planType)->values();

                if ($filteredProducts->isNotEmpty()) {
                    // Determine current product index based on elapsed intervals
                    $currentProductIndex = $elapsedIntervals % $filteredProducts->count();

                    // Update the index of the last displayed product in cache for the current plan type
                    if (array_key_exists($cacheKey, $lastDisplayedIndex)) {
                        $lastDisplayedIndex[$cacheKey] = $currentProductIndex;
                        Cache::put('last_displayed_index', $lastDisplayedIndex);

                        // Fetch the product to display for the current plan type
                        $bannerProducts[] = $filteredProducts[$currentProductIndex];
                    }
                }
            }

            // Ensure all products are included in bannerProducts
            foreach ($products as $product) {
                if (!in_array($product, $bannerProducts)) {
                    $bannerProducts[] = $product;
                }
            }

            // Paginate the combined banner products list
            $perPage = 6;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $totalItems = count($bannerProducts);
            $currentItems = collect($bannerProducts)->slice(($currentPage - 1) * $perPage, $perPage);
            $paginator = new LengthAwarePaginator($currentItems, $totalItems, $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => ['langId' => $langId]
            ]);

            // Get the minimum and maximum price from displayed products
            $minPrice = collect($bannerProducts)->min('asking_price');
            $maxPrice = collect($bannerProducts)->max('asking_price');

            // Get the minimum and maximum year from displayed products
            $minYear = collect($bannerProducts)->min(function ($product) {
                return optional($product['created_at'])->year;
            });

            $maxYear = collect($bannerProducts)->max(function ($product) {
                return optional($product['created_at'])->year;
            });

            // Adjust min and max year if they are the same
            if ($minYear == $maxYear) {
                $minYear = $maxYear - 1;
            }

            // Adjust min and max price if they are the same
            if ($minPrice == $maxPrice) {
                $minPrice = $maxPrice - 10;
            }

            $data = [
                'status_code' => 1,
                'status_text' => 'Success',
                'message' => 'Products Fetched Successfully!',
                'min_year' => $minYear,
                'max_year' => $maxYear,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'data' => $paginator
            ];
        } else {
            $data = [
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'No Products Found for the given Brand',
                'data' => []
            ];
        }
    } else {
        $data = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'Brand Not Found',
            'data' => []
        ];
    }

    return response()->json($data);
}


   
public function brand_filter(Request $request)
{  
    $langId  = $request->langId;
    $langyage= Session::put('language',$langId);
    
    $validatedData = $request->validate([
        'brand_id' => 'required|integer',
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric|gte:min_price',
        'start_manufacture_year' => 'nullable|integer',
        'end_manufacture_year' => 'nullable|integer|gte:start_manufacture_year',
    ]);


    $brand_id = $validatedData['brand_id'];
    $min_price = $validatedData['min_price'] ?? 0;
    $max_price = $validatedData['max_price'] ?? PHP_INT_MAX;
    $start_manufacture_year = $validatedData['start_manufacture_year'] ?? 0;
    $end_manufacture_year = $validatedData['end_manufacture_year'] ?? PHP_INT_MAX;


    // $products = Product::where('brand_id', $brand_id)
    //     ->where('asking_price', '>=', $min_price)
    //     ->where('asking_price', '<=', $max_price)
    //     ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
    //     ->select('id', 'name', 'asking_price', 'image', 'created_at', 'year','brand_id')
    //     ->get();
        
        
        if ($langId == 'ar') {
                
    $products = Product::where('brand_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year','brand_id')
        ->get();
    } else {
   $products = Product::where('brand_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year','brand_id')
        ->get();
    }
         
    if ($products->isNotEmpty()) {
        $data = [
            'success' => true,
            'message' => 'Products Fetched Successfully!',
            'data' => $products
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'No Products Found for the given Criteria',
            'data' => []
        ];
    }

    return $data;
}



public function category_filter(Request $request)
{  
    $langId  = $request->langId;
    $langyage= Session::put('language',$langId);
    
    $validatedData = $request->validate([
        'category_id' => 'required|integer',
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric|gte:min_price',
        'start_manufacture_year' => 'nullable|integer',
        'end_manufacture_year' => 'nullable|integer|gte:start_manufacture_year',
    ]);


    $brand_id = $validatedData['category_id'];
    $min_price = $validatedData['min_price'] ?? 0;
    $max_price = $validatedData['max_price'] ?? PHP_INT_MAX;
    $start_manufacture_year = $validatedData['start_manufacture_year'] ?? 0;
    $end_manufacture_year = $validatedData['end_manufacture_year'] ?? PHP_INT_MAX;


    // $products = Product::where('category_id', $brand_id)
    //     ->where('asking_price', '>=', $min_price)
    //     ->where('asking_price', '<=', $max_price)
    //     ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
    //     ->select('id', 'name', 'asking_price', 'image', 'created_at', 'year','category_id')
    //     ->get();
        
                if ($langId == 'ar') {
                
    $products = Product::where('category_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year')
        ->get();
    } else {
   $products = Product::where('category_id', $brand_id)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year')
        ->get();
    }
        
        //  for($i = 0;$i<count($products);$i++){
          
        //   $products[$i]->name = GoogleTranslate::trans($products[$i]->name,$langId);
    
          
        // }   


    if ($products->isNotEmpty()) {
        $data = [
            'success' => true,
            'message' => 'Products Fetched Successfully!',
            'data' => $products
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'No Products Found for the given Criteria',
            'data' => []
        ];
    }

    return $data;
}

public function search_filter(Request $request)
{  
    $langId = $request->langId;
    Session::put('language', $langId);
    
    $wer = $request->query();
      
    // Define validation rules
    $validationRules = [
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric|gte:min_price',
        'start_manufacture_year' => 'nullable|integer',
        'end_manufacture_year' => 'nullable|integer|gte:start_manufacture_year',
    ];

    // Validate the request
    $validatedData = $request->validate($validationRules);

    // Extract validated data
    $query = $validatedData['query'] ?? null;
    $min_price = $validatedData['min_price'] ?? 0;
    $max_price = $validatedData['max_price'] ?? PHP_INT_MAX;
    $start_manufacture_year = $validatedData['start_manufacture_year'] ?? 0;
    $end_manufacture_year = $validatedData['end_manufacture_year'] ?? PHP_INT_MAX;

    if (!empty($query)) {
        
        
        
                       if ($langId == 'ar') {
                
    $products = Product::where('name', 'like', '%' . $query . '%')
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
        ->get();
    } else {
   $products = Product::where('name', 'like', '%' . $query . '%')
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
        ->get();
    } 
        
        
        
        
        //     // Search based on the query
        // $products = Product::where('name', 'like', '%' . $query . '%')
        //     ->where('asking_price', '>=', $min_price)
        //     ->where('asking_price', '<=', $max_price)
        //     ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        //     ->select('id', 'name', 'asking_price', 'image', 'created_at', 'year', 'category_id')
        //     ->get();   
        
        
        
        
        
        
 
    } else {
        // Fetch recent searches for the user
        $userId = Auth::id();
        $recent_searches = Recentsearch::where('user_id', $userId)->pluck('product_id')->toArray();

        // $products = Product::whereIn('id', $recent_searches)
        //     ->where('asking_price', '>=', $min_price)
        //     ->where('asking_price', '<=', $max_price)
        //     ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        //     ->select('id', 'name', 'asking_price', 'image', 'created_at', 'year', 'category_id')
        //     ->get();
            
     if ($langId == 'ar') {
                
    $products = Product::whereIn('id', $recent_searches)
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
        ->get();
    } else {
   $products = Product::where('name', 'like', '%' . $query . '%')
        ->where('asking_price', '>=', $min_price)
        ->where('asking_price', '<=', $max_price)
        ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
        ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
        ->get();
    } 
            
            
          
            
    }


    if ($products->isNotEmpty()) {
        $data = [
            'success' => true,
            'message' => 'Products Fetched Successfully!',
            'data' => $products
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'No Products Found for the given Criteria',
            'data' => []
        ];
    }

    return response()->json($data);
}

    
public function search_product(Request $request)
{
    $query = $request->input('query');
    

    $query = GoogleTranslate::trans($query, 'en');

    $langId = $request->langId;


    Session::put('language', $langId);

    $userId = Auth::id(); 

    if ($query) {

      
        
        
             if ($langId == 'ar') {
                
    // $products = Product::whereIn('id', $recent_searches)
    //     ->where('asking_price', '>=', $min_price)
    //     ->where('asking_price', '<=', $max_price)
    //     ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
    //     ->select('id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
    //     ->get();
        
        
        
          $products = Product::where('name', 'like', '%' . $query . '%')
        ->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
        
        
        
        $categories = Category::where('name', 'like', '%' . $query . '%')->get();
        $categoryProducts = collect();

        foreach ($categories as $category) {

            $categoryProducts = $categoryProducts->merge(
                Product::whereRaw("FIND_IN_SET($category->id, category_id)")->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at'])
            );
        }

  
        $results = $products->merge($categoryProducts);

        $results->each(function ($product) use ($userId) {
            Recentsearch::create([
                'user_id' => $userId,
                'product_id' => $product->id
            ]);
        }); 
        
        
        
        
    } else {
//   $products = Product::where('name', 'like', '%' . $query . '%')
//         ->where('asking_price', '>=', $min_price)
//         ->where('asking_price', '<=', $max_price)
//         ->whereBetween('year', [$start_manufacture_year, $end_manufacture_year])
//         ->select('id', 'name as translated_name', 'asking_price', 'image', 'created_at', 'year','category_id')
//         ->get();
        
        
        
          $products = Product::where('name', 'like', '%' . $query . '%')
        ->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
        
          $categories = Category::where('name', 'like', '%' . $query . '%')->get();
        $categoryProducts = collect();

        foreach ($categories as $category) {

            $categoryProducts = $categoryProducts->merge(
                Product::whereRaw("FIND_IN_SET($category->id, category_id)")->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at'])
            );
        }

  
        $results = $products->merge($categoryProducts);

        $results->each(function ($product) use ($userId) {
            Recentsearch::create([
                'user_id' => $userId,
                'product_id' => $product->id
            ]);
        }); 
        
    } 
        
        
     // Get the minimum and maximum price
$minPrice = $products->min('asking_price');
$maxPrice = $products->max('asking_price');

// Get the minimum and maximum year
$minYear = $products->min(function($product) {
    return $product->created_at->year;
});

$maxYear = $products->max(function($product) {
    return $product->created_at->year;
}); 

// Adjust min and max year if they are the same
if ($minYear == $maxYear) {
     $minYear= $maxYear - 1;
}

// Adjust min and max price if they are the same
if ($minPrice == $maxPrice) {
    $minPrice = $maxPrice - 10;
}
        

     

        if ($results->isNotEmpty()) {

            $data['status_code'] = 1;
            $data['status_text'] = 'Success';
            $data['message'] = 'Products Found Successfully!';
             $data['min_year'] = $minYear;
            $data['max_year'] = $maxYear;
            $data['min_price'] = $minPrice;
            $data['max_price'] = $maxPrice;
            $data['data'] = $results;
        } else {

            $data['status_code'] = 0;
            $data['status_text'] = 'Failed';
            $data['message'] = 'No Products Found for the given query';
            $data['data'] = [];
        }
    } else {

        $data['status_code'] = 0;
        $data['status_text'] = 'Failed';
        $data['message'] = 'Query parameter is missing';
        $data['data'] = [];
    }


    return $data;
}

  
  
  
public function brand_search_product(Request $request)
{
    $query = $request->input('query');
    $brand_id = $request->input('brand_id');
    $query = GoogleTranslate::trans($query, 'en');

     $langId  = $request->langId;

    Session::put('language', $langId);

    if ($query) {
   
        $products = Product::where('brand_id', $brand_id)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get(['id', 'name', 'asking_price', 'image', 'created_at']);
                            
                            
         if ($langId == 'ar') {

         $products = Product::where('brand_id', $brand_id)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
        
    } else {

         $products = Product::where('brand_id', $brand_id)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
    }                      

        if ($products->isNotEmpty()) {

            $data['status_code'] = 1;
            $data['status_text'] = 'Success';
            $data['message'] = 'Products Found Successfully!';
            $data['data'] = $products;
        } else {

            $data['status_code'] = 0;
            $data['status_text'] = 'Failed';
            $data['message'] = 'No Products Found for the given query';
            $data['data'] = [];
        }
    } else {
        $data['status_code'] = 0;
        $data['status_text'] = 'Failed';
        $data['message'] = 'Query parameter is missing';
        $data['data'] = [];
    }


    return $data;
}

  
  public function category_search_product(Request $request)
{
    $query = $request->input('query');
    $category_id = $request->input('category_id');
    $query = GoogleTranslate::trans($query, 'en');

     $langId  = $request->langId;

    Session::put('language', $langId);

    if ($query) {

                            
            if ($langId == 'ar') {

         $products = Product::where('category_id', $category_id)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
        
    } else {

         $products = Product::where('category_id', $category_id)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
    }  

        if ($products->isNotEmpty()) {

            $data['status_code'] = 1;
            $data['status_text'] = 'Success';
            $data['message'] = 'Products Found Successfully!';
            $data['data'] = $products;
        } else {

            $data['status_code'] = 0;
            $data['status_text'] = 'Failed';
            $data['message'] = 'No Products Found for the given query';
            $data['data'] = [];
        }
    } else {
        $data['status_code'] = 0;
        $data['status_text'] = 'Failed';
        $data['message'] = 'Query parameter is missing';
        $data['data'] = [];
    }


    return $data;
}
  
public function recomended_products(Request $request)
{  
    $langId  = $request->langId;
    
    Session::put('language', $langId);
     
    $recent_searches = Recentsearch::pluck('product_id')->toArray();  
    
      if ($langId == 'ar') {
          
        $products = Product::whereIn('id', $recent_searches)
                         ->orderBy('created_at', 'desc') // Order by the latest created_at
                         ->take(5) // Limit to the latest 5
                         ->get(['id', 'arabic_name as translated_name', 'asking_price', 'image', 'created_at']);
    } else {
        
                     $products = Product::whereIn('id', $recent_searches)
                         ->orderBy('created_at', 'desc') // Order by the latest created_at
                         ->take(5) // Limit to the latest 5
                         ->get(['id', 'name as translated_name', 'asking_price', 'image', 'created_at']);
                         
    }
// Get the minimum and maximum price
$minPrice = $products->min('asking_price');
$maxPrice = $products->max('asking_price');

// Get the minimum and maximum year
$minYear = $products->min(function($product) {
    return $product->created_at->year;
});

$maxYear = $products->max(function($product) {
    return $product->created_at->year;
}); 

// Adjust min and max year if they are the same
if ($minYear == $maxYear) {
     $minYear= $maxYear - 1;
}

// Adjust min and max price if they are the same
if ($minPrice == $maxPrice) {
    $minPrice = $maxPrice - 10;
}                    
 
    
    if (!empty($products)) {

        $data['status_code'] = 1;
        $data['status_text'] = 'Success';             
        $data['message'] = 'Data Fetched Successfully!';
        $data['min_year'] = $minYear;
        $data['max_year'] = $maxYear;
        $data['min_price'] = $minPrice;
        $data['max_price'] = $maxPrice;
        $data['data'] = $products; 
        
    } else {

        $data['status_code'] = 0;
        $data['status_text'] = 'Failed';             
        $data['message'] = 'No Data Found';
        $data['data'] = [];  
    }
    
    return $data;
}

    
    
public function my_cars(Request $request)
{  
    $langId  = $request->langId;
    Session::put('language', $langId);
    
    $userId = Auth::id();  
    


    if ($langId == 'ar') {
          
                $products = Product::select('id', 'arabic_name as translated_name', 'user_id', 'category_id', 'asking_price', 'year','arabic_description as translated_description', 'phone_number', 'whatsapp_number', 'image', 'ad_type','status', 'invoice_id', 'plan_price',
        'plan_type', 'created_at')
                   ->where('user_id', $userId)
                   ->latest()
                   ->paginate(8);
    } else {
        
                $products = Product::select('id', 'name as translated_name', 'user_id', 'category_id', 'asking_price', 'year','description as translated_description', 'phone_number', 'whatsapp_number', 'image', 'ad_type','status', 'invoice_id', 'plan_price',
        'plan_type', 'created_at')
                   ->where('user_id', $userId)
                   ->latest()
                   ->paginate(8);
                         
    }
    
    // Append langId to pagination URLs
    $products->appends(['langId' => $langId]);
    
    
     for($i = 0;$i<count($products);$i++){
          
       
          
          $imageArray = explode(',', $products[$i]->image);
          $Image = [];
                        
                        foreach($imageArray as $imageArrays)   {          
        $Image[] = 'https://f.motordeals.net/User-images/'.$imageArrays;
                        }
       $products[$i]->image_urls = $Image;

    
    
          
        }
                            
    if ($products->isNotEmpty()) {
        $data = [
            'status_code' => 1,
            'status_text' => 'Success',             
            'message' => 'Data Fetched Successfully!',
            'data' => $products,
        ];
    } else {
        $data = [
            'status_code' => 0,
            'status_text' => 'Failed',             
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $data;
}

 
public function add_car(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'category' => 'required',
        'price' => 'required',
        'image' => 'required', 
        'year' => 'required',
        'description' => 'required',
        'phone_number' => 'required',
        'invoice_id' => 'required',
        'plan_price' => 'required',
        'plan_type' => 'required',
        
        
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }

    // Regular expression pattern to match Arabic text
    $arabicPattern = '/\p{Arabic}+/u';


    $tr = new GoogleTranslate();

    $product = new Product;
    
   if (preg_match($arabicPattern, $request->name)) {
        $product->arabic_name = $request->name;
        $product->arabic_description = $request->description;
        $product->name = GoogleTranslate::trans($request->name, 'en');
         $product->description = GoogleTranslate::trans($request->description, 'en');
    } else {
              $product->name = $request->name;
              $product->description = $request->description;
              $product->arabic_name = GoogleTranslate::trans($request->name, 'ar');
              $product->arabic_description = GoogleTranslate::trans($request->description, 'ar');
          
    }
   
    
    // Assign values to fields
    $product->user_id = Auth::id(); 
    $product->category_id = $request->category;
    $product->brand_id = $request->brand; // Adjust as needed
    $product->asking_price = $request->price;
    $product->year = $request->year;
    $product->sell_type = $request->sell_type; // Adjust as needed
    $product->phone_number = $request->phone_number;
    $product->invoice_id = $request->invoice_id;
    $product->plan_type = $request->plan_type; // Adjust as needed
    $product->plan_price = $request->plan_price; // Adjust as needed

    // Handle image upload
    $images = [];
    foreach ($request->file('image') as $image) {
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('User-images', $filename);
        $images[] = $filename;
    }
    
    $product->image = implode(',', $images);
    $product->save();

    return response()->json([
        'status_code' => 1,
        'status_text' => 'Success',
        'message' => 'Car Details Successfully Inserted!',
        'data' => $product
    ], 200);
    
}
 
  
public function category(Request $request)
{
    $langId = $request->langId;



    if ($langId == 'ar') {
 
        $categories = Category::get(['id', 'arabic_name as translated_name', 'image']);
    } else {
     
        $categories = Brand::get(['id', 'name as translated_name', 'image']);
    }

                       
    if ($categories->isNotEmpty()) {
        $data = [
            'status_code' => 1,
            'status_text' => 'Success',             
            'message' => 'Data Fetched Successfully!',
            'data' => $categories,
        ];
    } else {
        $data = [
            'status_code' => 0,
            'status_text' => 'Failed',             
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $data;
}
    
    
        /* Add wishlist product*/
        
public function save_like(Request $request)
{
    // Retrieve the authenticated user's ID
    $user_id = Auth::id();

    // Get the product ID from the request
    $product_id = $request->input('product_id');

    // Check if the product already exists in the user's wishlist
    $existingWishlistItem = Wishlist::where('user_id', $user_id)
                                    ->where('product_id', $product_id)
                                    ->first();

    if ($existingWishlistItem) {
        // Toggle the status
        $existingWishlistItem->status = $existingWishlistItem->status == '1' ? '0' : '1';
        $existingWishlistItem->save();

        // Prepare message based on status
        $message = $existingWishlistItem->status == '1' ? 'Product liked' : 'Product unliked';
    } else {
        // If the item does not exist, create a new wishlist entry
        $wishlist = new Wishlist;
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $product_id;
        $wishlist->status = '1'; // Initial status is 'liked'
        $wishlist->save();

        // Prepare message
        $message = 'Product liked';
    }

    // Prepare the response data
    $data = [
        'status_code' => 1,
        'status_text' => 'Success',
        'message' => $message,
        'status' => $existingWishlistItem ? $existingWishlistItem->status : '1' // Return the current status
    ];

    // Return the response data
    return response()->json($data);
}



public function add_draft_car(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'category' => 'required',
        'price' => 'required',
        'image' => 'required', 
        'year' => 'required',
        'description' => 'required',
        'phone_number' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }

    // Regular expression pattern to match Arabic text
    $arabicPattern = '/\p{Arabic}+/u';


    $tr = new GoogleTranslate();

    $product = new Product;
    
   if (preg_match($arabicPattern, $request->name)) {
        $product->arabic_name = $request->name;
        $product->arabic_description = $request->description;
        $product->name = GoogleTranslate::trans($request->name, 'en');
         $product->description = GoogleTranslate::trans($request->description, 'en');
    } else {
              $product->name = $request->name;
              $product->description = $request->description;
              $product->arabic_name = GoogleTranslate::trans($request->name, 'ar');
              $product->arabic_description = GoogleTranslate::trans($request->description, 'ar');
          
    }
   
    
    // Assign values to fields
    $product->user_id = Auth::id(); 
    $product->category_id = $request->category;
    $product->brand_id = $request->brand; // Adjust as needed
    $product->asking_price = $request->price;
    $product->year = $request->year;
    $product->sell_type = $request->sell_type; // Adjust as needed
    $product->phone_number = $request->phone_number;
    $product->status = '2';

    // Handle image upload
    $images = [];
    foreach ($request->file('image') as $image) {
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('User-images', $filename);
        $images[] = $filename;
    }
    
    $product->image = implode(',', $images);
    $product->save();

    return response()->json([
        'status_code' => 1,
        'status_text' => 'Success',
        'message' => 'Car Details Successfully Inserted!',
        'data' => $product
    ], 200);
	

}    
    
    
public function get_draft_car(Request $request)
{  
     $langId  = $request->langId;
    Session::put('language', $langId);
    
    $userId = Auth::id();  
                   
          // Determine the fields to select based on the language
    if ($langId == 'ar') {
        $selectFields = ['id', 'arabic_name as translated_name', 'user_id', 'category_id', 'asking_price', 'year','arabic_description as translated_description', 'phone_number', 'whatsapp_number', 'image', 'ad_type','status', 'invoice_id', 'plan_price',
        'plan_type', 'created_at'];
    } else {
      $selectFields = ['id', 'name as translated_name', 'user_id', 'category_id', 'asking_price', 'year','description as translated_description', 'phone_number', 'whatsapp_number', 'image', 'ad_type','status', 'invoice_id', 
        'plan_type', 'plan_price','created_at'];
    }

    // Fetch products based on the user_id and status
    $products = Product::where('user_id', $userId)
                   ->where('status', '2')
                   ->select($selectFields)
                   ->latest() 
                   ->paginate(8);            
                   
    // Append langId to pagination URLs
    $products->appends(['langId' => $langId]);
    
    
        for($i = 0;$i<count($products);$i++){
          
       
          
          $imageArray = explode(',', $products[$i]->image);
          $Image = [];
                        
                        foreach($imageArray as $imageArrays)   {          
        $Image[] = 'https://f.motordeals.net/User-images/'.$imageArrays;
                        }
       $products[$i]->image_urls = $Image;

    
    
          
        }
        
    if ($products->isNotEmpty()) {
        $data = [
            'status_code' => 1,
            'status_text' => 'Success',             
            'message' => 'Data Fetched Successfully!',
            'data' => $products,
        ];
    } else {
        $data = [
            'status_code' => 0,
            'status_text' => 'Failed',             
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $data;
}
  


public function update_draft_car(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'category' => 'required',
        'price' => 'required',
        'image'=> 'required', 
        'year' => 'required',
        'description' => 'required',
        'phone_number' => 'required',
         'plan_price' => 'required',
        'plan_type' => 'required',
    ]);


// return $request->file('image');

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }
    
        $productId = $request->product_id;

    // Check if the product with the provided ID exists
    $product = Product::find($productId);
    
    
      if (!$product) {
        // If the product doesn't exist, return an error response
        return response()->json([
            'status' => 'error',
            'message' => 'Product not found with ID: ' . $productId
        ], 404);
    }
    
 $langId  = $request->langId;
 
 $arabicPattern = '/\p{Arabic}+/u';
        
 Session::put('language', $langId);
 if (preg_match($arabicPattern, $request->name)) {
        $product->arabic_name = $request->name;
        $product->arabic_description = $request->description;
        $product->name = GoogleTranslate::trans($request->name, 'en');
         $product->description = GoogleTranslate::trans($request->description, 'en');
    } else {
              $product->name = $request->name;
              $product->description = $request->description;
              $product->arabic_name = GoogleTranslate::trans($request->name, 'ar');
              $product->arabic_description = GoogleTranslate::trans($request->description, 'ar');
          
    }

    $product->user_id = Auth::id(); 
    $product->category_id = $request->category;


    if ($request->category == '16') {
        // if($request->brand != ""){
        $product->brand_id = $request->brand;
        // }
    }

    $product->asking_price = $request->price;
    $product->year = $request->year;


   if($request->category=='17'){
                   $product->sell_type = 'Rent';    
                }else{
                     $product->sell_type = 'Sale'; 
                }

	
    $product->phone_number = $request->phone_number;
    $product->invoice_id = $request->invoice_id;
    $product->plan_type = $request->plan_type; // Adjust as needed
    $product->plan_price = $request->plan_price; // Adjust as needed
    
    
    
    $product->status = '0';

    $images = [];
    
    foreach ($request->file('image') as $image) {
        
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('User-images', $filename);
        $images[] = $filename;
    }
    
    $product->image = implode(',', $images);
    $product->save();

    
    return response()->json([
    'status_code' => 1,
    'status_text' => 'Success',
    'message' => 'Car Details Successfully Inserted!',
    'data' => $product
], 200);
 
	

}   



public function get_home(Request $request)
{
    $langId = $request->langId;
    Session::put('language', $langId);

    // Cache keys for various data
    $categoriesCacheKey = 'categories_' . $langId;
    $brandsCacheKey = 'brands_latest_' . $langId;
    $bannerProductsCacheKey = 'banner_products';

    // Fetch categories with caching
    $categories = Cache::remember($categoriesCacheKey, 60, function () use ($langId) {
        return Category::all()->map(function ($category) use ($langId) {
            $translatedName = Cache::remember('category_name_' . $category->id . '_' . $langId, 60, function () use ($category, $langId) {
                return GoogleTranslate::trans($category->name, $langId);
            });
            return [
                'id' => $category->id,
                'name' => $translatedName,
                'image' => $category->image_url
            ];
        });
    });

    // Fetch latest brands with caching
    $brands = Cache::remember($brandsCacheKey, 60, function () use ($langId) {
        return Brand::latest()->take(5)->get()->map(function ($brand) use ($langId) {
            $translatedName = Cache::remember('brand_name_' . $brand->id . '_' . $langId, 60, function () use ($brand, $langId) {
                return GoogleTranslate::trans($brand->name, $langId);
            });
            return [
                'id' => $brand->id,
                'name' => $translatedName,
                'image' => $brand->image_url
            ];
        });
    });

    // Fetch banner products with caching
    $bannerProducts = Cache::remember($bannerProductsCacheKey, 60, function () {
        return Product::select(['id', 'name', 'asking_price', 'image', 'created_at'])->take(4)->get();
    });

    $data = [
        'banner' => $bannerProducts,
        'categories' => $categories,
        'brand' => $brands,
    ];

    if (!empty($data)) {
        $response = [
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'Data Fetched Successfully!',
            'data' => $data,
        ];
    } else {
        $response = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'No Data Found',
            'data' => [],
        ];
    }

    return response()->json($response);
}


    public function get_homes(Request $request)
    {  
        
    $langId = $request->langId;
    
    $langyage= Session::put('language',$langId);
    
    $products = Product::latest()->take(5)->get(['id', 'name', 'asking_price', 'image', 'created_at']);
    
 
    $minPrice = $products->min('asking_price');
    $maxPrice = $products->max('asking_price');
    
    
    $minYear = $products->min(function($product) {
        return $product->created_at->year;
    });
    
    $maxYear = $products->max(function($product) {
        return $product->created_at->year;
    }); 
    
    if ($minYear == $maxYear) {
         $minYear= $maxYear - 1;
    }
    
    if ($minPrice == $maxPrice) {
        $minPrice = $maxPrice - 10;
    }
    

    if (!empty($products)) {
        $response = [
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'Data Fetched Successfully!',
            'min_year' => $minYear,
            'max_year' => $maxYear,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'data' => $products,
        ];
    } else {
        $response = [
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => 'No Data Found',
            'data' => [],
        ];
    }
    
    return $response;
}







public function add_car_payment(Request $request)
{
    // Validate incoming request
    $validator = Validator::make($request->all(), [
        'CreatedDate' => 'required',
        'CustomerEmail' => 'required',
        'CustomerMobile' => 'required',
        'CustomerName' => 'required',
        'CustomerReference' => 'required',
        'ExpiryDate' => 'required',
        'InvoiceDisplayValue' => 'required',
        'InvoiceId' => 'required',
        'InvoiceReference' => 'required',
        'InvoiceStatus' => 'required',
        'InvoiceTransactions' => 'required',
        'InvoiceValue' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }

    // Store validated data into the database
    $carPayment = new CarPayment();
    $carPayment->created_date = $request->input('CreatedDate');
    $carPayment->customer_email = $request->input('CustomerEmail');
    $carPayment->customer_mobile = $request->input('CustomerMobile');
    $carPayment->customer_name = $request->input('CustomerName');
    $carPayment->customer_reference = $request->input('CustomerReference');
    $carPayment->expiry_date = $request->input('ExpiryDate');
    $carPayment->invoice_display_value = $request->input('InvoiceDisplayValue');
    $carPayment->invoice_id = $request->input('InvoiceId');
    $carPayment->invoice_reference = $request->input('InvoiceReference');
    $carPayment->invoice_status = $request->input('InvoiceStatus');
    $carPayment->invoice_value = $request->input('InvoiceValue');
    
    // Save the main car payment record
    $carPayment->save();

    // Store transactions data
    foreach ($request->input('InvoiceTransactions') as $transaction) {
        $carPaymentTransaction = new CarPaymentTransaction();
        $carPaymentTransaction->car_payment_id = $carPayment->id;
        $carPaymentTransaction->authorization_id = $transaction['AuthorizationId'];
        $carPaymentTransaction->currency = $transaction['Currency'];
        $carPaymentTransaction->customer_service_charge = $transaction['CustomerServiceCharge'];
        $carPaymentTransaction->due_value = $transaction['DueValue'];
        $carPaymentTransaction->error_code = $transaction['ErrorCode'];
        $carPaymentTransaction->paid_currency = $transaction['PaidCurrency'];
        $carPaymentTransaction->paid_currency_value = $transaction['PaidCurrencyValue'];
        $carPaymentTransaction->payment_gateway = $transaction['PaymentGateway'];
        $carPaymentTransaction->payment_id = $transaction['PaymentId'];
        $carPaymentTransaction->reference_id = $transaction['ReferenceId'];
        $carPaymentTransaction->track_id = $transaction['TrackId'];
        $carPaymentTransaction->transaction_date = $transaction['TransactionDate'];
        $carPaymentTransaction->transaction_id = $transaction['TransactionId'];
        $carPaymentTransaction->transaction_status = $transaction['TransactionStatus'];
        $carPaymentTransaction->transaction_value = $transaction['TransationValue'];
        
        // Save each transaction record
        $carPaymentTransaction->save();
    }

    return response()->json([
        'status_code' => 1,
        'status_text' => 'Success',
        'message' => 'Car Payment Details Successfully Inserted!',
        'data' => $carPayment
    ], 200);
}



   
    
}
