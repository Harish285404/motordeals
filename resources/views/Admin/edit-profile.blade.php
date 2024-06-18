@extends('Admin.layouts.main')


@section('content')
<main class="main2">
 <div class="page-profile">
<p>Pages / Profile </p>
<h1> Profile </h1>
 </div>

    </main>  

  <main class="main-dashboard">
       @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif



        <section class="edit-profile">
           
         
              <form  action="{{ url('admin/edit-user-data/'.Auth()->user()->id)}}" method="Post" enctype="multipart/form-data" class="account-form-detail" id="adduser">
                 @csrf
            <div class="profile-flex-box">
              
                
                <div class="user_image-block">
                    <div class="file-upload">
                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" />
                            <div class="drag-text">
                                <img src="{{asset('User-images/'.Auth()->user()->image)}}">
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                        </div>
                        <div class="upload-img">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload </button>
                        </div>
                    </div>
                     @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span><br>
                        @endif
                </div>
                <div class="user_details-1">
                    <div class="user_details">
                               
                            <div class="col">
                          
                                 <div class="col-inner">
                                <input type="text" id="first_name" name="first_name" value="{{$data[0]->full_name }}">
                                   @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span><br>
                        @endif
                            </div>
                             </div>
                             
                        <div class="col">
     
                                <div class="col-inner">
                                <input type="email" id="email" name="email" value="{{$data[0]->email}}" readonly>
                            </div>
                             </div>
                             
                            <div class="col">
                 
                                 <div class="col-inner">
                                <input type="tel" id="phone_number" name="phone_number" value="{{$data[0]->phone_number}}">
                                   @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span><br>
                        @endif
                            </div>
                             </div>
                            
                            </div>
                            <div class="account-dlt-btn account-save-btn">
                                <button type="submit" class="main-btn">Update</button>
                            </div>
                     </form>   
                     
                <form  action="{{ url('admin/update-password')}}" method="Post" enctype="multipart/form-data" class="account-form-detail" id="adduser">
                    
                 @csrf
                 <p class="change-pass">Change Password</p>
            <div class="profile-flex-2">
                <div class="user_image-block">
                </div>
                <div class="user_details-data">
                    <div class="user_details">
                               
                            <div class="col">
                          
                                 <div class="col-inner">
                                <input type="text" id="first_name" name="oldpass" >
                                   @if ($errors->has('oldpass'))
                            <span class="text-danger">{{ $errors->first('oldpass') }}</span><br>
                        @endif
                            </div>
                             </div>
                             
                        <div class="col">
     
                                <div class="col-inner">
                                <input type="text" id="email" name="newpass">
                            </div>
                             </div>
                             
                            <div class="col">
                 
                                 <div class="col-inner">
                                <input type="text" id="phone_number" name="cnewpass" >
                                   @if ($errors->has('cnewpass'))
                            <span class="text-danger">{{ $errors->first('cnewpass') }}</span><br>
                        @endif
                            </div>
                             </div>
                            
                            </div>
                            <div class="account-dlt-btn account-save-btn">
                                <button type="submit" class="main-btn">Update</button>
                            </div>
                    </div>
                     </div>
                    </form>
                    </div>
                     </div>
                  
            
     
        </section>
        
        <section class="edit-profile">
         

            
     
        </section>
         

        
    </main>


@endsection