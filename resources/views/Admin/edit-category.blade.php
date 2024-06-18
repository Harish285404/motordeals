@extends('Admin.layouts.main')





@section('content')
<main class="main2">
<p>  Pages / Categories /Edit Category</p>
    <h1>

                    Edit Category

                </h1>

    </main>



 <main class="content-main-block">

        @if(Session::has('message'))

          <p class="alert alert-info">{{ Session::get('message') }}</p>

        @endif

   

   

        <form  action="{{ url('admin/update-category-data')}}" method="Post" enctype="multipart/form-data" class=" add-category-feild-form account-form-detail" id="addnews">

            @csrf

             <input type="hidden"  name="id"  value="{{ $category[0]->id}}">

            <div class="profile-flex-box">

                <div class="user_image-block">

                    <div class="file-upload">

                      <div class="image-upload-wrap">

                       <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" id="image"/>

                        <div class="drag-text">

                          <img src="{{asset('User-images/'. $category[0]->image)}}">

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

                     <input type="text" id="username" name="category" placeholder="Name of Category" value="{{ $category[0]->name}}">

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