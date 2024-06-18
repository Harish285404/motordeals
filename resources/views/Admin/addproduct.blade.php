@extends('Admin.layouts.main')





@section('content')

<main class="main2">
<div class="page-profile">
<p> Pages / Product Listed / Add Product</p>
<h1>Add Product </h1>
 </div>
    </main>

   

 <main class="main-dashboard">

      @if(Session::has('message'))

                <p class="alert alert-info">{{ Session::get('message') }}</p>

                @endif

        <section class="user-edit-properties">

            <div class="main-sections-container">

            

                <div class="main-section-inner-conatiner">

                  <form class="profile-form" action="{{ url('admin/add-product-data') }}" method="POST" enctype="multipart/form-data">

                       <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                        @csrf

                         <div class="upload__box">

                            <div class="upload__btn-box">

                                <label class="upload__btn">

                                <p><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">

                                    <path opacity="0.9" d="M7.8889 18.2952V10.9678H0.561523V7.88817H7.8889V0.596191H10.9685V7.88817H18.2605V10.9678H10.9685V18.2952H7.8889Z" fill="#2B3562"></path>

                                    </svg>Add</p>

                                <input type="file" multiple="" data-max_length="20" class="upload__inputfile"  name="image[]">

                                 

                                



                              </label>

                              <div class="row">

                    @if ($errors->has('image'))

                            <span class="text-danger">{{ $errors->first('image') }}</span><br>

                        @endif

                       </div>

                            </div>

                            <div class="upload__img-wrap">

                               

                            </div>

                        </div> 

                        
<div class="input-wrapper-product">
<h1 class="main--headings">Add Car Details</h1>
<div class="input-wrapper-inner">
<div class="profile-info">
    <input type="text" id="username" name="name" placeholder="Title">
            <div class="row">

                    @if ($errors->has('name'))

                            <span class="text-danger">{{ $errors->first('name') }}</span><br>

                        @endif

                       </div>
</div>
<div class="profile-info">
    
<select id="category" name="category" placeholder="Category" onchange="changeBrandSelect()">
    <option value="">Category</option>
    @foreach($category as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
    @endforeach
</select>
<div class="row">
    @if ($errors->has('category'))
        <span class="text-danger">{{ $errors->first('category') }}</span><br>
    @endif
</div>



    </div>

    

      <div class="profile-info">

        <input type="text" id="username" name="price" placeholder="Asking Price">
        <div class="row">

                    @if ($errors->has('price'))

                            <span class="text-danger">{{ $errors->first('price') }}</span><br>

                        @endif

                       </div>

     </div>

    

     <div class="profile-info">

<select id="brand" name="brand" placeholder="Brand" style="display:none; width: 100%;">
    <option value="">Brand</option>
    @foreach($brand as $catt)
        <option value="{{$catt->id}}">{{$catt->name}}</option>
    @endforeach
     
</select>
<script>
    function changeBrandSelect() {
        var categorySelect = document.getElementById("category");
        var brandSelect = document.getElementById("brand");

        // Get the selected category ID
        var categoryId = categorySelect.value;

        // Check if the selected category ID is 16
        if (categoryId === '16') {
            // Show the brand select
            brandSelect.style.display = "inline-block";
            // Clear any previous selections
            brandSelect.value = "";
        } else {
            // Hide the brand select
            brandSelect.style.display = "none";
            // Clear any previous selections
            brandSelect.value = "";
        }
    }
</script>

    </div>

    <div class="profile-info">

        <input type="text" id="year" name="year" placeholder="Year">
 <div class="row">

                    @if ($errors->has('year'))

                            <span class="text-danger">{{ $errors->first('year') }}</span><br>

                        @endif

                       </div>
     </div>

       <!-- <div class="profile-info">

            <select id="category" name="sell_type" placeholder="type">

                <option value="">Type</option>

                <option value="Rent">Rent</option>

                <option value="Sell">Sell</option>

            </select>

    </div> -->

     
<!-- 
      <div class="profile-info">

            <select id="category" name="cartype" placeholder="Car type">

                  <option value="">Sell</option>

    

                <option value="Luxury">Luxury</option>

                <option value="Hatchback">Hatchback</option>

                <option value="SUV">SUV</option>

                <option value="Sedan">Sedan</option>

                <option value="Coupe">Coupe</option>

                <option value="Buget">Buget</option>

                <option value="Convertible">Convertible</option>

                <option value="Electric">Electric</option>

            </select>

    </div>

     

     

      <div class="profile-info">

        <input type="text" id="ad_title" name="ad_title" placeholder="Ad title">

     </div> -->

     

      <div class="profile-info">

        <input type="text" id="description" name="description" placeholder="Description">
 <div class="row">

                    @if ($errors->has('description'))

                            <span class="text-danger">{{ $errors->first('description') }}</span><br>

                        @endif

                       </div>
     </div>
     <div class="profile-info">
     <p>Add Contact Details <span>*</span></p>
</div>
      <div class="profile-info">

        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number">
 <div class="row">

                    @if ($errors->has('phone_number'))

                            <span class="text-danger">{{ $errors->first('phone_number') }}</span><br>

                        @endif

                       </div>
     </div>


     
     <div class="profile-info">
      <button class ="add-product-button" type="submit">Update</button>
</div>
      </div>
</div>
    </form>

                </div>

                </div>

        </section>

    </main>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 

          var html = $(".clone").html();

          $(".increment").after(html);

      });

      $("body").on("click",".btn-danger",function(){ 

          $(this).parents(".control-group").remove();

      });

    });

</script>









@endsection