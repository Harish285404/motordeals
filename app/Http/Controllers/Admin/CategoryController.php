<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Hash;
use DB;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function add_category()
      {
            return view('Admin.addcategory');
      }
      
      
      public function add_category_data(Request $request)
      {
        //   dd($request->all());
          
          $request->validate([
                  'category' => 'required',
            ]);
            $User = new Category;
            $User->name = $request->category;
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Category Successfully Inserted!');
            }

           
      }
      
       public function category_list()
      {
          

  if (request()->search) {
    $searchTerm = request()->search;
   $category = Category::where('name', 'like', '%' . $searchTerm . '%')
                  ->paginate(9);
          return view('Admin.category-list', ['category' => $category]);
     } else {
 
     $category = Category::paginate(6);

    
    return view('Admin.category-list', ['category' => $category]);
    
     } 
     
     
           

      }
      
      
      public function edit_category($id)
  {

    $data = Category::where('id', '=', $id)->get();

    return view('Admin.edit-category', ['category' => $data]);
    
  }
  

           public function update_category_data(Request $request)
      {
          
          $id = $request->id;
          
          $request->validate([
                  'category' => 'required',
            ]);
            $User = Category::find($id);
            $User->name = $request->category;
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Category Successfully Updated!');
            }

           
      }
      
      
       public function delete_category(Request $request)
      {
         
           $id = $request->id;
          $user = Category::find($id)->delete();
          
          
           if ($user) {
                         return redirect()->back()->with('message', 'Category Successfully Deleted!');
                     }
           
      }
      
      
      
}
