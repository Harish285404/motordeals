<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\GoogleSocialiteController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
      return view('auth.login');
});

Route::get('/Login', function () {
      return view('login');
});

Route::get('/forgot-password', function () {
      return view('forgot-password');
});

Route::get('/change-password', function () {
      return view('change-password');
});

Route::get('otp', function () {

    return view('otp');

});

Auth::routes();

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


 Route::post('forgot_password', [App\Http\Controllers\Admin\AdminController::class, 'forgot_password']);
  Route::get('otp_verfication ', [App\Http\Controllers\Admin\AdminController::class, 'otp_verfication']);
 Route::post('verifyotp', [App\Http\Controllers\Admin\AdminController::class, 'verifyotp']);
   Route::get('reset', [App\Http\Controllers\Admin\AdminController::class, 'reset']);
  Route::post('update_passwords', [App\Http\Controllers\Admin\AdminController::class, 'update_passwords']);

Route::group(['middleware' => 'admin'], function () {
      Route::get('admin', [App\Http\Controllers\Admin\AdminController::class, 'index']);
       Route::get('admin/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile']);
      Route::get('admin/edit-profile', [App\Http\Controllers\Admin\AdminController::class, 'edit_profile']);
      Route::get('admin/change-password', [App\Http\Controllers\Admin\AdminController::class, 'change_password']);
      Route::post('admin/update-password', [App\Http\Controllers\Admin\AdminController::class, 'update_password']);
      Route::post('admin/edit-user-data/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update']);
      
    //   category routes
      Route::get('admin/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add_category']);
      Route::post('admin/add-category-data', [App\Http\Controllers\Admin\CategoryController::class, 'add_category_data']);
      Route::get('admin/category-list', [App\Http\Controllers\Admin\CategoryController::class, 'category_list']);
      Route::get('admin/edit-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit_category']);
       Route::post('admin/update-category-data', [App\Http\Controllers\Admin\CategoryController::class, 'update_category_data']);
          Route::post('admin/delete-category', [App\Http\Controllers\Admin\CategoryController::class, 'delete_category']);

          
          
           //   Brand routes
      Route::get('admin/add-brand', [App\Http\Controllers\Admin\BrandController::class, 'add_brand']);
      Route::post('admin/add-brand-data', [App\Http\Controllers\Admin\BrandController::class, 'add_brand_data']);
      Route::get('admin/brand-list', [App\Http\Controllers\Admin\BrandController::class, 'brand_list']);
      Route::get('admin/edit-brand/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit_brand']);
       Route::post('admin/update-brand-data', [App\Http\Controllers\Admin\BrandController::class, 'update_brand_data']);
    Route::post('admin/delete-brand', [App\Http\Controllers\Admin\BrandController::class, 'delete_brand']);

          
          
          
        //   product routes
     Route::get('admin/add-product', [App\Http\Controllers\Admin\ProductController::class, 'add_product']);
      Route::post('admin/add-product-data', [App\Http\Controllers\Admin\ProductController::class, 'add_product_data']);
      Route::get('admin/product-list', [App\Http\Controllers\Admin\ProductController::class, 'product_list']);
      Route::get('admin/edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit_product']);
       Route::post('admin/update-product-data', [App\Http\Controllers\Admin\ProductController::class, 'update_product_data']);
        Route::get('admin/view-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'view_product']);
        Route::get('admin/delete-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete_product']);
        
         Route::post('admin/product-search', [App\Http\Controllers\Admin\ProductController::class, 'product_search']);
        
        
           Route::get('admin/revenue', [App\Http\Controllers\Admin\AdminController::class, 'revenue']);
           
            Route::post('admin/chart_revenue', [App\Http\Controllers\Admin\AdminController::class, 'chart_revenue']);
            Route::post('admin/pie_revenue', [App\Http\Controllers\Admin\AdminController::class, 'pie_revenue']);
            
             Route::post('admin/dchart_revenue', [App\Http\Controllers\Admin\AdminController::class, 'dchart_revenue']);
            Route::post('admin/dpie_revenue', [App\Http\Controllers\Admin\AdminController::class, 'dpie_revenue']);

// user route

  Route::get('admin/users', [App\Http\Controllers\Admin\AdminController::class, 'users']);
 Route::get('admin/edit-user/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit_user']);
  Route::post('admin/update-user-data', [App\Http\Controllers\Admin\AdminController::class, 'update_user_data']);
 Route::get('admin/view-user/{id}', [App\Http\Controllers\Admin\AdminController::class, 'view_user']);
Route::post('admin/delete-user', [App\Http\Controllers\Admin\AdminController::class, 'delete_user']);
});

Route::group(['middleware' => 'user'], function () {
    
      Route::get('user', [App\Http\Controllers\User\UserController::class, 'add_product']);
      Route::get('user/add-product', [App\Http\Controllers\User\UserController::class, 'add_product']);
      Route::post('user/add-product-data', [App\Http\Controllers\User\UserController::class, 'add_product_data']);
            Route::get('user/product-list', [App\Http\Controllers\User\UserController::class, 'product_list']);
      Route::get('user/edit-product/{id}', [App\Http\Controllers\User\UserController::class, 'edit_product']);
       Route::post('user/update-product-data', [App\Http\Controllers\User\UserController::class, 'update_product_data']);
        Route::get('user/view-product/{id}', [App\Http\Controllers\User\UserController::class, 'view_product']);
        Route::get('user/delete-product/{id}', [App\Http\Controllers\User\UserController::class, 'delete_product']);
        
         Route::post('user/product-search', [App\Http\Controllers\User\UserController::class, 'product_search']);

 



       });
