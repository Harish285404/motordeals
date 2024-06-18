<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CommonController;
use App\Http\Controllers\API\BrandController ;
use App\Http\Controllers\API\UserController ;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/* Login api */ 

Route::post('login',[App\Http\Controllers\API\CommonController::class, 'login']);


Route::post('signup-verification-code', [App\Http\Controllers\API\CommonController::class, 'signupverificationcode']);

Route::post('sign-verify-otp', [App\Http\Controllers\API\CommonController::class, 'signverifyotp']);


Route::post('send-verification-code', [App\Http\Controllers\API\CommonController::class, 'sendVerificationCode']);
Route::post('verify-phone-number', [App\Http\Controllers\API\CommonController::class, 'verifyPhoneNumber']);

/* Register api */ 

Route::post('signup', [App\Http\Controllers\API\CommonController::class, 'signup']);
    
/* Forgot password send otp api*/
    
Route::post('forgot_email', [App\Http\Controllers\API\CommonController::class, 'sendverificationcode']);

/* Forgot password verify otp api*/
    
Route::post('/forgot_verify_otp', [App\Http\Controllers\API\CommonController::class, 'verifyotp']);

/* Forgot change password api*/  

Route::post('/forgot_password_change',[App\Http\Controllers\API\CommonController::class, 'forgot_change_password']); 

Route::get('get_home', [App\Http\Controllers\API\BrandController::class, 'get_home']);

Route::get('get_homes', [App\Http\Controllers\API\BrandController::class, 'get_homes']);


Route::post('translate', [App\Http\Controllers\API\UserController::class, 'translate']);

Route::get('get_home_info', [App\Http\Controllers\API\BrandController::class, 'get_home_info']);
   
   Route::get('get_home_main', [App\Http\Controllers\API\BrandController::class, 'get_home_main']);
   

    Route::get('recomended_products', [App\Http\Controllers\API\BrandController::class, 'recomended_products']);

Route::group(['middleware'=>['auth:api']],function(){
    

    
   Route::get('brands', [App\Http\Controllers\API\BrandController ::class, 'brands']);
       
  Route::get('category', [App\Http\Controllers\API\BrandController ::class, 'category']);

  Route::post('get-products', [App\Http\Controllers\API\BrandController::class, 'get_products_by_brand']);
 
  Route::post('brand_filter', [App\Http\Controllers\API\BrandController::class, 'brand_filter']);
  
  Route::post('category_filter', [App\Http\Controllers\API\BrandController::class, 'category_filter']);
  
   Route::post('search_filter', [App\Http\Controllers\API\BrandController::class, 'search_filter']);
 
  Route::post('search-products', [App\Http\Controllers\API\BrandController::class, 'search_product']); 
  
    Route::post('brand_search_product', [App\Http\Controllers\API\BrandController::class, 'brand_search_product']); 
    
     Route::post('category_search_product', [App\Http\Controllers\API\BrandController::class, 'category_search_product']); 

    Route::post('get_products_by_category', [App\Http\Controllers\API\BrandController::class, 'get_products_by_category']); 
    
     Route::post('product_detail', [App\Http\Controllers\API\BrandController::class, 'product_detail']); 
     

     
    Route::get('my_cars', [App\Http\Controllers\API\BrandController::class, 'my_cars']);
    
     Route::post('add_car', [App\Http\Controllers\API\BrandController::class, 'add_car']);
     
    Route::post('home_filter', [App\Http\Controllers\API\BrandController::class, 'home_filter']); 
    
    Route::post('logout', [App\Http\Controllers\API\CommonController::class, 'logout']);
    
    Route::get('user_profile', [App\Http\Controllers\API\CommonController::class, 'user_details']);
    
    Route::post('update_profile', [App\Http\Controllers\API\CommonController::class, 'edituser']);
    
    Route::post('logout', [App\Http\Controllers\API\CommonController::class, 'logout']);
    
    Route::post('change_password', [App\Http\Controllers\API\CommonController::class, 'changepassword']);
    
   Route::post('user-verification-code', [App\Http\Controllers\API\CommonController::class, 'userVerificationCode']);
   
   Route::post('/user_verify_otp', [App\Http\Controllers\API\CommonController::class, 'userverifyotp']);

   Route::post('add_rating_like', [App\Http\Controllers\API\BrandController::class, 'save_like']);
  
   Route::post('add_draft_car', [App\Http\Controllers\API\BrandController::class, 'add_draft_car']);
       
   Route::get('get_draft_car', [App\Http\Controllers\API\BrandController::class, 'get_draft_car']);
   
   Route::post('update_draft_car', [App\Http\Controllers\API\BrandController::class, 'update_draft_car']);
    

   
      
         Route::post('add_car_payment', [App\Http\Controllers\API\BrandController::class, 'add_car_payment']);
 

});



