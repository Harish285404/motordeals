<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Hash;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{

  public function add_product()
      {
          $category = Category::get();
          $brand = Brand::get();

            return view('User.addproduct', ['category' => $category,'brand'=>$brand]);
      }
      
      public function add_product_data(Request $request)
      {
          
        //   dd($request->all());
          
                  $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required', 
            'image'=> 'required', 
            // 'brand' => 'required', 
            'year' => 'required',
            // 'sell_type' => 'required',
            // 'cartype' => 'required',
            // 'ad_title' => 'required',
             'description' => 'required',
            'phone_number' => 'required',
            // 'whtsapp_number' => 'required',
        ]);

                $User = new Product;
                $User->name = $request->name;
                $User->user_id = $request->user_id;
                $User->category_id = $request->category;
                
                  if($request->category=='16'){
                     $User->brand_id = $request->brand;   
                }
            
                $User->asking_price = $request->price; 
                $User->year = $request->year;
                
                  if($request->category=='17'){
                   $User->sell_type = 'Rent';    
                }else{
                     $User->sell_type = 'Sale'; 
                }
                
               
                
                
                // $User->type = $request->cartype; 
                // $User->add_title = $request->ad_title;
                $User->description = $request->description;
                $User->phone_number = $request->phone_number;
                // $User->whatsapp_number = $request->whtsapp_number;
                $User->save();
            
            // if ($request->image) {

            //       $image = $request->file('image');

            //       $name = time() . '.' . $image->getClientOriginalExtension();

            //       $destinationPath = 'User-images';

            //       $image->move($destinationPath, $name);
            //       $User->image = $name;
            // }

            // $update = $User->save();
            
            
            
     $images = []; // Initialize an array to store the filenames

foreach ($request->file('image') as $image) {
    $destinationPath = 'User-images';
    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move($destinationPath, $filename);
    $images[] = $filename; // Store the filename in the array
}

    $User->image = implode(',',($images));

    $update =  $User->save();
            

            if ($update) {
                  return redirect()->back()->with('message', 'Car Details Successfully Inserted!');
            }

           
      }
      
      
public function product_list()
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Fetch products associated with the authenticated user's ID
    $sale = Product::where('user_id', $userId)
                   ->where('sell_type', 'Sale')
                   ->where('status', '0')
                   ->where('category_id', 16)
                   ->get();

    $rent = Product::where('user_id', $userId)
                   ->where('sell_type', 'Rent')
                   ->where('category_id', 17)
                   ->get();

    $bikesale = Product::where('user_id', $userId)
                       ->where('sell_type', 'Sale')
                       ->where('status', '0')
                       ->where('category_id', 4)
                       ->get();
                       
                       
                    //   dd($bikesale);

    $partsale = Product::where('user_id', $userId)
                       ->where('sell_type', 'Sale')
                       ->where('status', '0')
                       ->where('category_id', 5)
                       ->get();

    return view('User.product-list', [
        'sale' => $sale,
        'rent' => $rent,
        'bikesale' => $bikesale,
        'partsale' => $partsale,
    ]);
}

public function product_search()
{
        $userId = Auth::id();
    $searchTerm = request()->search;
    $searchTab = request()->tab;
    $searchCondition = '%' . $searchTerm . '%';

    if ($searchTab == "set1") {
        $products = Product::where('user_id', $userId)
            ->where('sell_type', 'Sale')
            ->where('status', '0')
            ->where('category_id', 16)
            ->where('name', 'like', $searchCondition)
            ->get();
    } elseif ($searchTab == "set2") {
        $products = Product::where('user_id', $userId)
            ->where('sell_type', 'Sale')
            ->where('status', '0')
            ->where('category_id', 4)
            ->where('name', 'like', $searchCondition)
            ->get();
    } elseif ($searchTab == "set3") {
        $products = Product::where('user_id', $userId)
            ->where('sell_type', 'Sale')
            ->where('status', '0')
            ->where('category_id', 5)
            ->where('name', 'like', $searchCondition)
            ->get();
    } elseif ($searchTab == "set4") {
        $products = Product::where('user_id', $userId)
            ->where('sell_type', 'Rent')
            ->where('status', '0')
            ->where('category_id', 17)
            ->where('name', 'like', $searchCondition)
            ->get();
    } else {

        $products = [];
    }

    return response()->json($products);
}



   
      public function edit_product($id)
  {

    $data = Product::where('id', '=', $id)->get();
    $data[0]->image =  explode(',',$data[0]->image);
     $category = Category::get();
     
      $brand = Brand::get();
     
    return view('User.edit-product', ['product' => $data,'category' => $category,'brand'=>$brand]);
    
  }
  
  
        public function view_product($id)
  {

    $data = Product::where('id', '=', $id)->get();
      $data[0]->image =  explode(',',$data[0]->image);

    return view('User.view-product', ['products' => $data]);
    
  }

            public function update_product_data(Request $request)
      {
        //   dd($request->all());
        
        $id=$request->id;
        
          
            $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required', 
            // 'image'=> 'required', 
            'year' => 'required',
             'description' => 'required',
            'phone_number' => 'required',
    
        ]);

            $User = Product::find($id);
           $User->name = $request->name;
              $User->user_id = $request->user_id;
                $User->category_id = $request->category;
                   if($request->category=='16'){
                     $User->brand_id = $request->brand;   
                }
                $User->asking_price = $request->price; 
                $User->year = $request->year;
              if($request->category=='17'){
                   $User->sell_type = 'Rent';    
                }else{
                     $User->sell_type = 'Sale'; 
                }

                $User->description = $request->description;
                $User->phone_number = $request->phone_number;

            

       $names = [];
if($request->file('image')){


    foreach($request->file('image') as $image)
    {
        $destinationPath = 'User-images';
          $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $filename);
        array_push($names, $filename); 
         

    }
}

   if (!is_null($request->images) && is_array($request->images)) {
    foreach (array_keys($request->images) as $images) {
        array_push($names, $images);
    }
}

        
    $User->image = implode(',',($names));
    

       $update =  $User->save();
    

            if ($update) {
                  return redirect()->back()->with('message', 'Car Details Successfully Updated!');
            }

           
      }
      

      
       public function delete_product(Request $request)
      {
          $id = $request->id;
          
          $user = Product::find($id)->delete();
          
          
           if ($user) {
                         return redirect()->back()->with('message', 'Car Details Successfully Deleted!');
                     }
           
      }
 
 
 
}
