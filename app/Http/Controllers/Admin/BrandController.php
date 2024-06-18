<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use Hash;
use DB;
use Carbon\Carbon;
use Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
   public function add_brand()
      {
          
            return view('Admin.addbrand');
      }
      
      
      public function add_brand_data(Request $request)
      {
        //   dd($request->all());
          
          $request->validate([
                  'category' => 'required',
            ]);
            
            
    $arabicPattern = '/\p{Arabic}+/u';


    $tr = new GoogleTranslate();
            
            $User = new Brand;
            
        if (preg_match($arabicPattern, $request->category)) {
                  
        $User->arabic_name = $request->category;

        $User->name = GoogleTranslate::trans($request->category, 'en');
        

    } else {
              $User->name = $request->category;
              $User->arabic_name =GoogleTranslate::trans($request->category, 'ar');
  
          
    }
            
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Brand Successfully Inserted!');
            }

           
          
}
      
       public function brand_list()
      {
          
    if (request()->search) {
    $searchTerm = request()->search;
   $category = Brand::where('name', 'like', '%' . $searchTerm . '%')
                  ->paginate(9);
          return view('Admin.brand-list', ['category' => $category]);
     } else {
 
     $category = Brand::paginate(6);

    
    return view('Admin.brand-list', ['category' => $category]);
    
     } 
           
      }
      
      
      public function edit_brand($id)
  {

    $data = Brand::where('id', '=', $id)->get();

    return view('Admin.edit-brand', ['category' => $data]);
    
  }
  

           public function update_brand_data(Request $request)
      {
          
          $id = $request->id;
          
          $request->validate([
                  'category' => 'required',
            ]);
        
            
            
             $arabicPattern = '/\p{Arabic}+/u';


            $tr = new GoogleTranslate();
                    
        $User = Brand::find($id);
                    
                if (preg_match($arabicPattern, $request->category)) {
                          
                $User->arabic_name = $request->category;
        
                $User->name = GoogleTranslate::trans($request->category, 'en');
                
        
            } else {
                      $User->name = $request->category;
                      $User->arabic_name =GoogleTranslate::trans($request->category, 'ar');
          
                  
            }
            
            
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Brand Successfully Updated!');
            }

           
      }
      
      
       public function delete_brand(Request $request)
      {
          $id = $request->id;
         
          $user = Brand::find($id)->delete();
          
          
           if ($user) {
                         return redirect()->back()->with('message', 'Brand Successfully Deleted!');
                     }
           
      }
      
      
      
      
}
