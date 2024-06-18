<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserOtp;
use Validator;
use App\Mail\TestMail;
use Hash;
use DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Session;
use Twilio\Rest\Client;
use Auth;

class CommonController extends Controller
{
         /* Login Api */
    
public function login(Request $request)
{ 
    $rules = array(
        'phone_number' => 'required|string',
        'password' => 'required|string',
        'remember_me' => 'boolean',
    );
    
    $messages = array(
        'phone_number.required' => 'Please enter Phone Number.',
        'password.required' => 'Please enter Password.',
    );
    
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => $validator->errors()->first()
        ], 400);
    } else { 
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'Phone number is incorrect.'
            ], 401);
        }

        $credentials = [
            'phone_number' => $request->phone_number,
            'password' => $request->password,
            'role' => '2', 
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'Password is incorrect.'
            ], 401);
        }
        
        $tokenResult = $user->createToken('Personal Access Token');
    
        $token = $tokenResult->token;
       
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addHours(24);
        }
        
        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user_id' => $user->id,
        ]);
    }
}




    // /* Sign Up send otp api*/


   public function signupverificationcode(Request $request)
{
    $validator = Validator::make($request->all(), [
        'phone_number' => 'required',
    ], [
        'phone_number.required' => 'Please enter phone number.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => $validator->errors()->first()
        ], 400);
    } else {
        $countryCode = $request->country_code;
        $phoneNumber = $request->phone_number;
        $to = $countryCode . $phoneNumber;
        $from = '+16562204500';

    $type = $request->type;
    
    if($type=="Signup"){
        
          $existingUser = User::where('phone_number', $phoneNumber)->first();

        if ($existingUser) {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'Phone number already exists.'
            ], 400);
            
        }else{
                  $countryCode = $request->country_code;
        $phoneNumber = $request->phone_number;
        $to = $countryCode . $phoneNumber;
          
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

        // Save OTP to the database
        UserOtp::create([
            'phone_number' => $phoneNumber,
            'otp' => $otp
        ]);

        return response()->json([
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'OTP sent on your phone!',
            'otp' => $otp,
            'phone_number' => $phoneNumber
        ]);
            
        } 
        
    }else{
        
        $existingUser2 = User::where('phone_number', $phoneNumber)->first();
        if($existingUser2){
             $countryCode = $request->country_code;
        $phoneNumber = $request->phone_number;
        $to = $countryCode . $phoneNumber;
          
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

        // Save OTP to the database
        UserOtp::create([
            'phone_number' => $phoneNumber,
            'otp' => $otp
        ]);

        return response()->json([
            'status_code' => 1,
            'status_text' => 'Success',
            'message' => 'OTP sent on your phone!',
            'otp' => $otp,
            'phone_number' => $phoneNumber
        ]);
            
        }else{
            
             return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
           'message' => 'Phone number does not exists.'
            ], 400);
        }

    }
    
    
    }
}

    
    
    // /* Sign Up verify otp api*/
    
   
public function signverifyotp(Request $request) 
{   
    $phone_number = $request->input('phone_number');
    $otp = $request->input('otp');
    
    $otpdata = UserOtp::where('phone_number', $phone_number)
                      ->where('otp', $otp)
                      ->first();
                      
    if ($otpdata) {
        
        $user = User::where('phone_number', $phone_number)->first();
        
        if (!$user) {

            $newUser = new User();
            $newUser->phone_number = $phone_number;

            
            if ($newUser->save()) {

                return response()->json([
                    'status_code' => 200,
                    'status_text' => 'Success',
                    'phone_number' => $phone_number,
                    'message' => 'OTP verified successfully. New user created.'
                ]);
            } else {
                // Error saving new user
                return response()->json([
                    'status_code' => 500,
                    'status_text' => 'Internal Server Error',
                    'message' => 'Failed to create a new user.'
                ], 500);
            }
        }else{
            // User already exists
        return response()->json([
            'status_code' => 200,
            'status_text' => 'Success',
            'message' => 'User exists already.'
        ]);   
            
            
        }
     
    } else {

        return response()->json([
            'status_code' => 400,
            'status_text' => 'Bad Request',
            'message' => 'OTP does not match.'
        ], 400);
    }
}



    // /* Register Api */ 

public function signup(Request $request) 
{ 
    $rules = array(
        'phone_number' => 'required',
        'full_name' => 'required',
        'email' => 'required|string|email',
        'password' => 'required|string',
    );
    
    $messages = array(
        'phone_number.required' => 'Please enter Phone Number.',
        'full_name.required' => 'Please enter Full name.',
        'email.required' => 'Please enter Email.',
        'email.email' => 'Please enter valid Email address.',
        'password.required' => 'Please enter Password .',
    );
    
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => $validator->errors()->first()
        ], 400);
    } else { 
        $user = User::where('phone_number', $request->phone_number)->first();
        
        if ($user) {
            
           $otp = rand(1000,9999);
           $unique_user_id = '#' . rand(1000, 9999);
  
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->plane_password = $request->password;
            $user->unique_user_id = $unique_user_id;
            $user->role = '2';
            $user->status = '0';
            $user->save();

            return response()->json([
                'status_code' => 1,
                'status_text' => 'Success',
                'message' => 'User details updated successfully!'
            ], 200);
        } else {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => 'User not found for the provided phone number.'
            ], 404);
        }
    }
}

    
    // /* Forgot password send otp api*/


    public function sendverificationcode(Request $request) 
    {   
         $validator = Validator::make($request->all(), [
        'phone_number' => 'required',
    ], [
        'phone_number.required' => 'Please enter phone number.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => $validator->errors()->first()
        ], 400);
    }
    
        else
        { 
    $countryCode = $request->country_code;
    $phoneNumber = $request->phone_number;
    $to = $countryCode . $phoneNumber;
    $from = '+16562204500';
    
    // Session::put('phone_numbers',$phoneNumber);
    
    // $phone_numbers=Session::get('phone_numbers');
    
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
                $user_id = User::where('phone_number', $phoneNumber)->get(['id']);
                
                if ($user_id->isNotEmpty()) {
                    
                
                    if ($optdata->isNotEmpty()) {
                        $user = UserOtp::where('phone_number', '=', $phoneNumber)->update(['otp' => $otp]);
                        
                        return response()->json(['status_code' => 1, 'status_text' => 'Success', 'message' => 'Otp sent on your phone!', 'otp' => $otp, 'phone_number' => $phoneNumber]); 
                    } else {
                        $user = UserOtp::create([
                            'phone_number' => $phoneNumber,
                            'otp' => $otp 
                        ]);
                
                        return response()->json(['status_code' => 1, 'status_text' => 'Success', 'message' => 'Otp sent on your phone!', 'otp' => $otp, 'phone_number' => $phoneNumber]);
                    }
                } else {
                    return response()->json(['status_code' => 0, 'status_text' => 'Failed', 'message' => 'Phone number not exist.']);
                }
        }
    }
    

    
    // /* Forgot password verify otp api*/
    
   
public function verifyotp(Request $request) 
{   
    $phone_numbers = $request->input('phone_number');
    
    $otp =$request->input('otp');
    
    $optdata = UserOtp::where('phone_number', $phone_numbers)
                      ->where('otp', $otp)
                      ->first();
                      
                  
                  
    if ($optdata) {
        $user = User::where('phone_number', $phone_numbers)->first();

        if ($user) {
            $userId = $user->id;

            return response()->json([
                'status_code' => 200,
                'status_text' => 'Success',
                'message' => 'OTP verified successfully.'
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'status_text' => 'Bad Request',
                'message' => 'User not found.'
            ], 400);
        }
    } else {
        return response()->json([
            'status_code' => 400,
            'status_text' => 'Bad Request',
            'message' => 'OTP does not match.'
        ], 400);
    }
}


    
    
    /* Forgot change password api */

    public function forgot_change_password(Request $request) 
    {  
       
        $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;

        $phone_number = $request->phone_number;
        
        $rules=array(
            'phone_number' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        );
        
        $messages=array(
            'phone_number.required' => 'Please enter Email.',
            'new_password.required' => 'Please enter new Password .',
            'confirm_password.required' => 'Please enter a conform password.'
        );
        
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => $validator->errors()->first()
            ],400);
        }
        else
        {  

            $user_id = User::where('phone_number',$phone_number)->get(['id']);
    
            if(sizeof($user_id))
            {
                if($new_password == $confirm_password)            {
            
                        $password = Hash::make($request->new_password);
                       
                        $user = User::where('phone_number',$phone_number)->update(['password'=>$password,'plane_password'=>$new_password]);
                        
                        return response()->json(['status_code'=>1,'status_text'=>'Success','message'=>'Password changed successfully !']);
                }
                else
                {
                
                      return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
                }
    
            }
            else
            {
    
                return response()->json(['status_code'=>0,'status_text'=>'Failed','message'=>'Phone number not exist.']);
            }
            
        }
    }
    
    
    // /* logout API */  

    public function logout(Request $request) 
    {
        $request->user()->token()->revoke();

        return response()->json([
             'status_code' => 1,
                'status_text' => 'Success',
            
                'message' => 'Logged out successfully !'
        ]);
    }
    
    
    // /* Fetch user details */

    public function user_details(Request $request) {

        $id = Auth::user()->id;

        $user = User::where('id',$id)->get(['id','full_name','email','role','unique_user_id','phone_number','image']);
        
        $langId  = $request->langId;
        
        Session::put('langId', $langId);
       
          
        if($langId != null){
            
        
        for($i = 0;$i<count($user);$i++){
          
          $user[$i]->full_name = GoogleTranslate::trans($user[$i]->first_name,$langId);
       
           
          
        }  
        }else{
          Session::put('langId', 'en');
         $user = User::where('id',$id)->get(['id','full_name','email','role','unique_user_id','phone_number','image']);
        }
       
        if($user)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'User Data Fetched Successfully !';
            $data['data']      =         $user;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        
        return $data;
    }
    
 
 
    // /* User verify code send otp api*/


    public function userVerificationCode(Request $request) 
    {   
         $validator = Validator::make($request->all(), [
        'phone_number' => 'required',
    ], [
        'phone_number.required' => 'Please enter phone number.',
    ]);

    $phoneNumber = $request->phone_number;

        $phone_number= Auth::user()->phone_number;
        
        
        if($phoneNumber===$phone_number){
            
    if ($validator->fails()) {
        return response()->json([
            'status_code' => 0,
            'status_text' => 'Failed',
            'message' => $validator->errors()->first()
        ], 400);
    }
    
        else
        { 
               $countryCode = $request->country_code;

    $to = $countryCode . $phoneNumber;
    // $from = '+16562204500';
    
    // Session::put('phone_numbers',$phoneNumber);
    
    // $phone_numbers=Session::get('phone_numbers');
    
    $otp = rand(1000, 9999);
    
    $body = "Your verification code is: $otp. This code will expire in 10 minutes.";


//     $accountSid = 'AC7cb677b92c31e7c6133018e437b2ad0e';
    
//     $authToken = 'bbec5fd39dd2b32744c80b407731ef44';

            
//     $curl = curl_init();

//     curl_setopt_array($curl, array(
//       CURLOPT_URL => "https://api.twilio.com/2010-04-01/Accounts/AC7cb677b92c31e7c6133018e437b2ad0e/Messages.json",
//       CURLOPT_RETURNTRANSFER => true,
//       CURLOPT_ENCODING => '',
//       CURLOPT_MAXREDIRS => 10,
//       CURLOPT_TIMEOUT => 0,
//       CURLOPT_FOLLOWLOCATION => true,
//       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//       CURLOPT_CUSTOMREQUEST => 'POST',
//       CURLOPT_POSTFIELDS => "To=$to&From=$from&Body=$body",
//       CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/x-www-form-urlencoded',
//       'Authorization: Basic QUM3Y2I2NzdiOTJjMzFlN2M2MTMzMDE4ZTQzN2IyYWQwZTpiYmVjNWZkMzlkZDJiMzI3NDRjODBiNDA3NzMxZWY0NA=='
//   ),
//     ));

//               $response = curl_exec($curl);
                
//                 curl_close($curl);

     
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
                
                $responseArray = json_decode($response, true);
            
              
                $optdata = UserOtp::where('phone_number', $phoneNumber)->get(); 
                $user_id = User::where('phone_number', $phoneNumber)->get(['id']);
                
                if ($user_id->isNotEmpty()) {
                    
                
                    if ($optdata->isNotEmpty()) {
                        $user = UserOtp::where('phone_number', '=', $phoneNumber)->update(['otp' => $otp]);
                        
                        return response()->json(['status_code' => 1, 'status_text' => 'Success', 'message' => 'Otp sent on your phone!', 'otp' => $otp, 'phone_number' => $phoneNumber]); 
                    } else {
                        $user = UserOtp::create([
                            'phone_number' => $phoneNumber,
                            'otp' => $otp 
                        ]);
                
                        return response()->json(['status_code' => 1, 'status_text' => 'Success', 'message' => 'Otp sent on your phone!', 'otp' => $otp, 'phone_number' => $phoneNumber]);
                    }
                } else {
                    return response()->json(['status_code' => 0, 'status_text' => 'Failed', 'message' => 'Phone number not exist.']);
                }
        }
        
        
        
        }else{
            
               return response()->json(['status_code' => 0, 'status_text' => 'Failed', 'message' => 'Unautorized number']);
            
            
            
        }
        
        
        
        
    }
  
  
  
  
    // /* User verify otp api*/
    
   
public function userverifyotp(Request $request) 
{   
    $phone_numbers = $request->input('phone_number');
    
    
    // return $phone_numbers;
    
    $otp =$request->input('otp');
    
    $optdata = UserOtp::where('phone_number', $phone_numbers)
                      ->where('otp', $otp)
                      ->first();
                      
                  
                  
    if ($optdata) {
        
        $user = User::where('phone_number', $phone_numbers)->first();

        if ($user) {
            $userId = $user->id;

            return response()->json([
                'status_code' => 200,
                'status_text' => 'Success',
                'message' => 'OTP verified successfully.'
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'status_text' => 'Bad Request',
                'message' => 'User not found.'
            ], 400);
        }
    } else {
        return response()->json([
            'status_code' => 400,
            'status_text' => 'Bad Request',
            'message' => 'OTP does not match.'
        ], 400);
    }
}
  

    /* Change password API  */
    
   public function changepassword(Request $request) 
    {  
        
       $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;

        $phone_number = $request->phone_number;
        
        $rules=array(
            'phone_number' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        );
        
        $messages=array(
            'phone_number.required' => 'Please enter Email.',
            'new_password.required' => 'Please enter new Password .',
            'confirm_password.required' => 'Please enter a conform password.'
        );
        
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return response()->json([
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => $validator->errors()->first()
            ],400);
        }
        else
        {  

            $user_id = User::where('phone_number',$phone_number)->get(['id']);
    
            if(sizeof($user_id))
            {
			
			if ((Hash::check($new_password , auth()->user()->password))) 
                {
                    return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'New Password cannot be same as your current password!']); 
                }
			
		
                elseif($new_password == $confirm_password) {
            
                        $password = Hash::make($request->new_password);
                       
                        $user = User::where('phone_number',$phone_number)->update(['password'=>$password,'plane_password'=>$new_password]);
                        
                        return response()->json(['status_code'=>1,'status_text'=>'Success','message'=>'Password changed successfully !']);
                }
                else
                {
                
                      return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
                }
    
            }
            else
            {
    
                return response()->json(['status_code'=>0,'status_text'=>'Failed','message'=>'Phone number not exist.']);
            }
            
        }
       
       
       
    }
    
    
    // /* Delete user api*/

    // public function delete_user(Request $request)
    // {   
    //     $id = Auth::user()->id;

    //     $user = User::Where('id',$id)->delete();

    //     return response()->json(['message' => 'You have been successfully deleted your account!'], 200); 
    // }
    
    // /* Edit profile api*/

    public function edituser(Request $request)
    {

        $id = Auth::user()->id;
        
        $full_name = $request->full_name;
        
        $email = $request->email;

        $image = $request->image;
    
        $user_type = Auth::user()->role;
        
        $user = User::where('id',$id)->get();

        if($user_type=='2')
        {
            if($request->image)
            {
                $file = $request->file('image');
    
                $extention = $file->getClientOriginalExtension();
    
                $filename = time().'.'.$extention;
    
                $file->move('User-images/', $filename);
    
                $user_meta= User::where('id',$id)->update([ 'image'=>$filename]);
            }
        
            if($request->full_name)
            {
                $user_meta= User::where('id',$id)->update(['full_name'=>$full_name]);
            }
            else
            {
                $user_meta= User::where('id',$id)->update(['full_name'=>$user[0]->full_name]);
            }

            if($request->email)
            {
                $user_meta= User::where('id',$id)->update(['email'=>$email]);
            }
    
            else
            {
                $user_meta= User::where('id',$id)->update(['email'=>$user[0]->email]);
            }
            
           
            
            $user = User::where('id',$id)->get(['id','full_name','email','role','unique_user_id','phone_number','image']);
            
            $langId  = $request->langId;
        
            Session::put('langId', $langId);
           
              
            if($langId != null){
                
                  for($i = 0;$i<count($user);$i++){
                  
                  $user[$i]->full_name = GoogleTranslate::trans($user[$i]->first_name,$langId);
        
                 } 
         
            }else{
              Session::put('langId', 'en');
             $user = User::where('id',$id)->get(['id','full_name','email','role','unique_user_id','phone_number','image']);
            }
       

            if($user)
            {
                $data['status_code']    =   1;
                $data['status_text']    =   'Success';             
                $data['message']        =   'Profile Updated Successfully';
                $data['data']      =         $user;  
            }
            else
            {
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'Profile Not Updated !';
                $data['data']           =    [];  
            }
            
            return $data;

        }
        else
        {
            return response()->json(['status_code'=>0,'status_text'=>'Failed','message' => 'Unauthorized.'], 401);
        } 
    }
    
    //  public function sendVerificationCode(Request $request)
    // {
         
    //  $receiverNumber = $request->input('phone_number');
    //     $message = 'hi testing'; // Replace with your desired message

    //     $sid = "AC7cb677b92c31e7c6133018e437b2ad0e";
    //     $token = "bbec5fd39dd2b32744c80b407731ef44";
    //     $fromNumber = "+16419252861";

    //     try {
    //         $client = new Client($sid, $token);
    //         $client->messages->create($receiverNumber, [
    //             'from' => $fromNumber,
    //             'body' => $message
    //         ]);

    //         return 'SMS Sent Successfully.';
    //     } catch (Exception $e) {
    //         return 'Error: ' . $e->getMessage();
    //     }
        
        


    // }
    
    
    public function verifyPhoneNumber(Request $request)
{
    $firebase = (new Factory)
        ->withApiKey('AIzaSyBVmMKN8DTVzsjHjMrZ_ToPWOkWBN2gXcQ')
        ->create();

    $auth = $firebase->getAuth();

    $phoneNumber = $request->input('phone_number');
    $verificationCode = $request->input('verification_code');

    $verifiedIdToken = $auth->verifyPhoneNumber($phoneNumber, $verificationCode);

    // Use $verifiedIdToken to identify the authenticated user

    return response()->json(['message' => 'Phone number verified']);


$phoneNumber = $request->input('phone_number');
        $apiKey = 'AIzaSyBGmHsxMxWDfO-zHARBVsXf58MclsfqfvA';

        $url = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/sendVerificationCode?key=' . $apiKey;

        $data = [
            'phoneNumber' => $phoneNumber,
        ];

        $dataString = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString),
            'X-Client-Version: 1.0.0' // Replace with your client version
        ));

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return response()->json(['error' => 'Failed to send verification code: ' . $error], 500);
        } else {
            curl_close($ch);
            return response()->json(['message' => 'Verification code sent successfully', 'data' => json_decode($response)]);
        }

      $recaptchaSecretKey = '6LdOdmQpAAAAABRgcyrP0mflNmrUfS5RShjHLcX4';
        $recaptchaAction = 'user_registration'; // Specify the action name for reCAPTCHA

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $recaptchaSecretKey,
                'response' => '', // Dummy response to generate token
                'action' => $recaptchaAction,
            ]
        ]);

        $body = json_decode((string) $response->getBody(), true);

        if ($body['success']) {
            $recaptchaToken = $body['token'];
            // Include the reCAPTCHA token in your API response
            return response()->json(['success' => true, 'recaptchaToken' => $recaptchaToken]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to generate reCAPTCHA token','data'=>$body]);
        }
    
}

}
