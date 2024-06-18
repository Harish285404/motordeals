@extends('Admin.layouts.main')





@section('content')

<main class="main2">
  <div class="page-profile">
    <p>
        Pages / Brands /Add Brand
    </p>

    <h1>

      Add Brand  

    </h1>
 </div>
</main>
    



 <main class="content-main-block">

        @if(Session::has('message'))

          <p class="alert alert-info">{{ Session::get('message') }}</p>

        @endif

   

   

        <form  action="{{ url('admin/add-brand-data') }}" method="Post" enctype="multipart/form-data" class=" add-category-feild-form account-form-detail" id="addnews">

            @csrf

            <div class="profile-flex-box">

                <div class="user_image-block">

                    <div class="file-upload">

                      <div class="image-upload-wrap">

                       <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" id="image"/>

                        <div class="drag-text">

                  

                                 <img src="{{asset('User-images/SsangYong.png')}}">

                        </div>

                      </div>

                      <div class="file-upload-content">

                        <img class="file-upload-image" src="#" alt="your image" />

                      </div>

                      <div class="upload-img">

                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Choose Image</button>

                      </div>

                    </div>

                </div>

                <div class="user_details_main">

                  <div class="user_details">

                      <div class="col">

                        <div class="col-flex">

                        <input type="text" id="title" name="category" placeholder="Name of Brand">

                        </div>

                      </div>

                    

                       <div class="account-dlt-btn account-save-btn">

                        <button type="submit" class="btn">Save</button>

                      </div>         

                  </div>

                </div>

              </div>

       </form>

  </main>



@endsection