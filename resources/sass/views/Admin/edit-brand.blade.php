@extends('Admin.layouts.main')





@section('content')
<main class="main2">
<div class="page-profile">
<p>Pages / Brands /Edit Brand</p>
<h1>Edit Brand </h1>
 </div>

 <main class="content-main-block main-dashboard">

        @if(Session::has('message'))

          <p class="alert alert-info">{{ Session::get('message') }}</p>

        @endif
        <form  action="{{ url('admin/update-brand-data')}}" method="Post" enctype="multipart/form-data" class=" add-category-feild-form account-form-detail" id="addnews">
            @csrf
             <input type="hidden"  name="id"  value="{{ $category[0]->id}}">

            <div class="profile-flex-box">

                <div class="user_image-block">

                    <div class="file-upload">

                      <div class="image-upload-wrap">

                       <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="image" id="image"/>

                       <div class="edit-brand-img">
                        <div class="drag-text">

                          <img src="{{asset('User-images/'. $category[0]->image)}}">
                          </div>
                        </div>

                      </div>

                      <div class="file-upload-content">

                        <img class="file-upload-image" src="#" alt="your image" />

                      </div>

                      <div class="upload-img">

                        <button class="file-upload-btn full-button" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Choose Image</button>

                      </div>

                    </div>

                </div>

                <div class="user_details_main">

                  <div class="user_details">

                      <div class="col">

                        <div class="col-flex">

                     <input type="text" id="username" name="category" placeholder="Name of Brand" value="{{ $category[0]->name}}">

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
  </main>


@endsection