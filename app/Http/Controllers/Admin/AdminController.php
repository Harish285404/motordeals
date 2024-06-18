<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\UserOtp;
use Hash;
use DB;
use Carbon\Carbon;
use Session;

class AdminController extends Controller
{
      public function index()
      {   
          
          $currentYear = Carbon::now()->year;
$currentMonth = Carbon::now()->month;

$thisMonthDealClosedSum = Product::whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->sum('plan_price');

$thisMonthDealClosedSumFormatted = number_format($thisMonthDealClosedSum, 2);
    
    $totalproduct= Product::count();

    $productsListedThisMonth = Product::whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->count();
    
    $dealsClosedThisMonth = Product::where('sell_type', 'Sale')
    ->where('status', '1')
    ->whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->count();
          
          
          
          
         $product= Product::where('sell_type', 'Sale')->where('status', '1')->paginate(6);
         
          $user=User::where('role','!=','1')->get();
      
            return view('Admin.dashboard',['user'=>$user,'product'=>$product,'thisMonthDealClosedSumFormatted'=>$thisMonthDealClosedSumFormatted,'totalproduct'=>$totalproduct,'productsListedThisMonth'=>$productsListedThisMonth,'dealsClosedThisMonth'=>$dealsClosedThisMonth]);
      }

     

      public function profile()
      {
            $id = Auth::user()->id;

            $data = User::where('id', '=', $id)->get();

            return view('Admin.profile', ['data' => $data]);
      }

      public function edit_profile()
      {
            $id = Auth::user()->id;

            $data = User::where('id', '=', $id)->get();

            return view('Admin.edit-profile', ['data' => $data]);
      }

      /*     profile update     */

      public function update(Request $request)
      {
            $request->validate([
                  'first_name' => 'required',
                  'email' => 'required',
                  'phone_number' => 'required|max:10'
            ]);
            $User = User::find($request->id);
            $User->full_name = $request->first_name;
            $User->email = $request->email;
            $User->phone_number = $request->phone_number;
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Profile Successfully Updated!');
            }
      }
      public function change_password()
      {
            return view('Admin.change-password');
      }
      /*     forgot password     */

      public function update_password(Request $request)
      {
            $request->validate([
                  'oldpass' => 'required',
                  'newpass' => 'min:6|required',
                  'cnewpass' => 'min:6|required',
            ]);

            if (Hash::check($request->oldpass, auth()->user()->password)) {
                  if (!Hash::check($request->newpass, auth()->user()->password)) {
                        if ($request->newpass == $request->cnewpass) {


                              $user = User::find(auth()->id());
                              $user->update([
                                    'password' => bcrypt($request->newpass),
                                    'plane_password' => $request->newpass
                              ]);

                              return redirect()->back()->with('message', 'Password updated successfully!');
                        } else {

                              return redirect()->back()->with('message', 'Password mismatched!');
                        }
                  }

                  return redirect()->back()->with('message', 'New password can not be the old password!');
            }

            return redirect()->back()->with('message', 'Old password does not matched!');
      }
  
  
   
   public function forgot_password(Request $request)
   {
       
    //   dd($request->all());
       
$countryCode = $request->country_code;
$countryCodeWithoutPlus = substr($countryCode, 1);
    
    $phoneNumber = $request->phone_number;
    
    $user_id = User::where('phone_number', $phoneNumber)->get(['id']);
                    
     if ($user_id->isNotEmpty()) {
    
    $to = $countryCodeWithoutPlus . $phoneNumber;
    
    
        //   dd($to);
        
   Session::put('phone_numbers',$phoneNumber);
    
    $phone_numbers=Session::get('phone_numbers');  
          
            $otp = rand(1000, 9999);
        $body = "Your verification code is: $otp. This code will expire in 10 minutes.";

        $data = [
            "username" => "motordeals",
            "password" => "u3nSNaDUh*",
            "sender" => "KWT-SMS",
            "test" => "0",
            "mobile" => $to, // Assuming $phoneNumber is already defined
            "lang" => "1",
            "message" => "Your verification code is: $otp. This code will expire in 10 minutes."
        ];




        $payload = json_encode($data);
        
//   return $payload;      

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.kwtsms.com/API/send/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer <api_key>',
                'Content-Type: application/json',
                'Cookie: PHPSESSID=ae52ff4e8f972aed37f3c14c6c41b392'
            ),
        ));

        $response = curl_exec($curl);
              
              
                
        $optdata = UserOtp::where('phone_number', $phoneNumber)->get(); 


        if ($optdata->isNotEmpty()) {
                        $user = UserOtp::where('phone_number', '=', $phoneNumber)->update(['otp' => $otp]);
                        
                   return redirect('otp_verfication')->with('message', 'Otp sent on your phone!');
                        
                    } else {
                        $user = UserOtp::create([
                            'phone_number' => $phoneNumber,
                            'otp' => $otp 
                        ]);
                
                      return redirect('otp_verfication')->with('message', 'Otp sent on your phone!');
                      
                    }
                } else {
                    
                    return response()->back(['status_code' => 0, 'status_text' => 'Failed', 'message' => 'Phone number does not Register.']);
                }
    
       
   }
   
 
      public function otp_verfication()
      {
            return view('otp-verification');
      }
   
   
      public function reset()
      {
            return view('reset');
      }
   
public function verifyotp(Request $request) 
{   
    
        //   dd($request->all());
    
    $phone_numbers = Session::get('phone_numbers');
    
    $digit1 = $request->input('digit1');
    $digit2 = $request->input('digit2');
    $digit3 = $request->input('digit3');
    $digit4 = $request->input('digit4');
    
    $otp = $digit1 . $digit2 . $digit3 . $digit4;
    $mobileNumber = $phone_numbers;
    
    $otpFromRequest = $otp;


    $optdata = UserOtp::where('phone_number', $mobileNumber)
                  ->where('otp', $otpFromRequest)
                  ->first();
                  
                  
 $user_id = User::where('phone_number', $mobileNumber)->get(['id']);
 
 $useraa=$user_id[0]->id;
 
    Session::put('user_id',$useraa);

    if ($optdata) {
     
        return redirect('reset');
    } else {

        return redirect()->back()->with('message', 'OTP does not match!');
    }
}


 public function update_passwords(Request $request)
{
    
    
    $user_id = Session::get('user_id');

    $request->validate([
        'newpass' => 'min:6|required',
        'cnewpass' => 'min:6|required',
    ]);

    if ($request->newpass === $request->cnewpass) {
        $user = User::find($user_id);
        

        if (!Hash::check($request->newpass, $user->password)) {
            $user->update([
                'password' => bcrypt($request->newpass),
                'plane_password' => $request->newpass
            ]);

            return redirect('/');
        } else {
            return redirect()->back()->with('message', 'New password cannot be the same as the old password!');
        }
    } else {
        return redirect()->back()->with('message', 'Password mismatch!');
    }
}

   
    /*     Users     */
      
    public function users()
      {
          $user=User::where('role','!=','1')->get();
          
          return view('Admin.users',['user'=>$user]);
            
      }
    
    
      public function view_user(Request $request,$id)
      {
        
            $data = User::where('id', '=', $id)->get();

            return view('Admin.user-view', ['data' => $data]);
      }
       public function edit_user(Request $request,$id)
      {
        
            $data = User::where('id', '=', $id)->get();

            return view('Admin.edit-user', ['data' => $data]);
      }

      public function update_user_data(Request $request,$id)
      {
            
            $request->validate([
                  'first_name' => 'required',
               
            ]);
            $User = User::find($request->id);
            $User->full_name = $request->first_name;
            if ($request->image) {

                  $image = $request->file('image');

                  $name = time() . '.' . $image->getClientOriginalExtension();

                  $destinationPath = 'User-images';

                  $image->move($destinationPath, $name);
                  $User->image = $name;
            }

            $update = $User->save();

            if ($update) {
                  return redirect()->back()->with('message', 'Profile Successfully Updated!');
            }
      }
      
      public function delete_user(Request $request)
      {
         
           $id = $request->id;
          $user = User::find($id)->delete();
          
          
           if ($user) {
                         return redirect()->back()->with('message', 'User Successfully Deleted!');
                     }
           
      }
      
      
      
      public function revenue()
      {   
         $product= Product::paginate(6);
         
$currentYear = Carbon::now()->year;
$currentMonth = Carbon::now()->month;

$thisMonthDealClosedSum = Product::whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->sum('plan_price');
    
    
    // dd($thisMonthDealClosedSum);
    

$thisMonthDealClosedSumFormatted = number_format($thisMonthDealClosedSum, 2);
    
    $totalproduct= Product::count();

    $productsListedThisMonth = Product::whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->count();
    
    $dealsClosedThisMonth = Product::where('sell_type', 'Sale')
    ->where('status', '1')
    ->whereYear('created_at', $currentYear)
    ->whereMonth('created_at', $currentMonth)
    ->count();

                 
         $user=User::where('role','!=','1')->get();
         
         
        //  dd($product);
      
            return view('Admin.revenue',['user'=>$user,'product'=>$product,'thisMonthDealClosedSumFormatted'=>$thisMonthDealClosedSumFormatted,'totalproduct'=>$totalproduct,'productsListedThisMonth'=>$productsListedThisMonth,'dealsClosedThisMonth'=>$dealsClosedThisMonth]);
      }
     
     
public function chart_revenue(Request $request)
{
    $year = $request->input('year');
    
    // Fetch data for all months of the selected year
    $data = Product::selectRaw('MONTH(created_at) as month, SUM(plan_price) as total')
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month')
        ->get();

    // Initialize arrays for months and totals
    $months = [];
    $totals = [];

    // Fill in zeros for all months
    for ($i = 1; $i <= 12; $i++) {
        $months[] = substr(Carbon::create()->month($i)->format('F'), 0, 3); // Get the first character of the month name
        $totals[] = 0;
    }

    // Update totals with actual data where available
    foreach ($data as $entry) {
        $monthIndex = intval($entry->month) - 1;
        $totals[$monthIndex] = $entry->total;
    }

    return response()->json(['months' => $months, 'totals' => $totals]);
}



public function pie_revenue(Request $request)
{
    $year = $request->input('year');


    
$totalProductCount = Product::whereYear('created_at', $year)
    ->sum('plan_price');



$thisMonthListed = Product::where('sell_type', 'Rent')
   ->whereYear('created_at', $year)
    ->sum('deal_closed_amount');




$partDealsClosed = Product::where('sell_type', 'Sale')
   ->whereYear('created_at', $year)
    ->sum('plan_price');
 
    return response()->json([
        'totalProductCount' => $totalProductCount,
        'partDealsClosed' => $partDealsClosed,
        'thisMonthListed' => $thisMonthListed,
    ]);
}


 
 public function dchart_revenue(Request $request)
{
    $year = $request->input('year');
    
// Fetch count of entries for all months of the selected year based on sell_type and status
$data = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->whereYear('created_at', $year)
    ->where('sell_type', 'Sale')
    ->where('status', '1')
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('month')
    ->get();

    
    // Initialize arrays for months and totals
    $months = [];
    $totals = [];

    // Fill in zeros for all months
    for ($i = 1; $i <= 12; $i++) {
        $months[] = substr(Carbon::create()->month($i)->format('F'), 0, 3); // Get the first character of the month name
        $totals[] = 0;
    }

    // Update totals with actual data where available
    foreach ($data as $entry) {
        $monthIndex = intval($entry->month) - 1;
        $totals[$monthIndex] = $entry->total;
    }

    return response()->json(['months' => $months, 'totals' => $totals]);
}



public function dpie_revenue(Request $request)
{
    $year = $request->input('year');


    $totalProductCount = Product::whereYear('created_at', $year)->count();

 
    $partDealsClosed = Product::where('sell_type', 'Sale')
        ->where('status', '1')
        ->whereYear('created_at', $year)
        ->count();

  
    $thisMonthListed = Product::whereYear('created_at', $year)
        ->count(); 

    return response()->json([
        'totalProductCount' => $totalProductCount,
        'partDealsClosed' => $partDealsClosed,
        'thisMonthListed' => $thisMonthListed,
    ]);
}
 
 
 
 
 
      
    
}



