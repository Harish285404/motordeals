@extends('Admin.layouts.main')


@section('content')
<main class="main2">
 <div class="page-profile">
<p>Pages / Profile </p>
<h1> Profile </h1>
 </div>

    </main>
 <main class="content-main-block">
        <section class="profile-detail">
            <div class="profile-flex-box">
                <div class="user_image-block">
                    <div class="file-upload">
                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                            <div class="drag-text">
                                <img src="{{asset('User-images/'.Auth()->user()->image)}}">
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="#" alt="your image" />
                        </div>
                        <!--<div class="upload-img">-->
                        <!--    <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Choose Image</button>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="user_details_main"> 
                    <div class="user_details">
                        <div class="profile-detail-top-section">
                            <div class="left-sec">
                                <h2 class="profile-name" >Lara Jean</h2>
                                <!--<h3>Profile Details</h3>-->
                                <!--<p>Update the picture and personal details here.</p>-->
                            </div>
                            <div class="ryt-main-btn">
                                <a class="main-btn" href="{{ url('admin/edit-profile') }}">Edit 
                                    <img src="https://motor-deals.chainpulse.tech/User-images/pencil.svg" alt=""></a>
                            </div>
                        </div>
                        <form class="account-form-detail">
                           
                            <div class="col">
                                <label>Email Address</label>
                                <div>
                                <a><?php echo $data[0]->email; ?></a>
                                </div>
                            </div>
                             <div class="col">
                                <label>Phone Number</label>
                                <div>
                                <a><?php echo $data[0]->phone_number;?></a>
                            </div>
                            </div>
                            <div class="col">
                                <label>Password</label>
                                <div>
                                <a>*********</a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection