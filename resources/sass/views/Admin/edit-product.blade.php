@extends('Admin.layouts.main')


@section('content')
<main class="main2">
  <p>
        Pages / Product Listed / Edit Car
    </p>
    <h1>

                    Edit Car

                </h1>

    </main>
 <main class="main-dashboard">
          <section class="user-edit-properties">
            <div class="main-sections-container">
            
                <div class="main-section-inner-conatiner">

               @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif


<?php

?>


<form class="profile-form" action="{{ url('admin/update-product-data')}}" method="POST" enctype="multipart/form-data">
    @csrf
      <input type="hidden"  name="id"  value="{{ $product[0]->id}}">
          <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
 
      
      
         <h1 class="main--headings">Edit Car</h1>
      
                       <div class="upload__box">
    <div class="upload__btn-box">
        <label class="upload__btn">
            <p>
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.9" d="M7.8889 18.2952V10.9678H0.561523V7.88817H7.8889V0.596191H10.9685V7.88817H18.2605V10.9678H10.9685V18.2952H7.8889Z" fill="#2B3562"></path>
                </svg>
                Add
            </p>
            <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="filename[]">
        </label>
    </div>
    <div class="upload__img-wrap">
        @foreach($product[0]->image as $image=>$v)
            <?php 
                $imagePath = 'https://motor-deals.chainpulse.tech/User-images/'.$v;
                $imageData = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
            ?>
            <div class='upload__img-box'>
                <div style="background-image: url(<?php echo $imageData; ?>)" data-number='" + $(".upload__img-close").length + "' data-file='" + $v + "' class='img-bg'>
                    <div class='upload__img-close'></div>
                </div>
                <input type="hidden" class="image-input" name="images[<?php echo $v; ?>]" value="">
            </div>
        @endforeach
    </div>
</div>

      
      
     
      
     <div class="profile-info">
       
        <input type="text" id="username" name="name" placeholder="Name of the Car" value="{{ $product[0]->name}}">
      </div>



                          
    <div class="profile-info">
    <select id="category" name="category">
        <option value="">Selected Category</option>
        @foreach($category as $cat)
            <option value="{{ $cat->id }}" {{ $product[0]->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>
    
      <div class="profile-info">
        <input type="text" id="username" name="price" placeholder="Asking Price" value="{{ $product[0]->asking_price}}">
     </div>
    
     <div class="profile-info">
            <select id="category" name="brand" placeholder="brand">
                  <option value="">Select Brand</option>
                @foreach($brand as $catt)
          
                 <option value="{{ $catt->id }}" {{ $product[0]->brand_id == $catt->id ? 'selected' : '' }}>
                {{ $catt->name }}
            </option>
                
                
                
       
               @endforeach
            </select>
    </div>
   
      
    <div class="profile-info">
        <input type="text" id="year" name="year" placeholder="Year" value="{{ $product[0]->year}}">
     </div>
     
     
       <div class="profile-info">
            <select id="category" name="sell_type" placeholder="type">
    <option value="">Select type</option>
    <option value="Rent" {{ $product[0]->sell_type == 'Rent' ? 'selected' : '' }}>Rent</option>
    <option value="Sell" {{ $product[0]->sell_type == 'Sell' ? 'selected' : '' }}>Sell</option>
</select>

    </div>
     
      <div class="profile-info">
           <select id="category" name="cartype" placeholder="Car type">
    <option value="">Select Car type</option>
    <option value="Luxury" {{ $product[0]->type == 'Luxury' ? 'selected' : '' }}>Luxury</option>
    <option value="Hatchback" {{ $product[0]->type == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
    <option value="SUV" {{ $product[0]->type == 'SUV' ? 'selected' : '' }}>SUV</option>
    <option value="Sedan" {{ $product[0]->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
    <option value="Coupe" {{ $product[0]->type == 'Coupe' ? 'selected' : '' }}>Coupe</option>
    <option value="Buget" {{ $product[0]->type == 'Buget' ? 'selected' : '' }}>Buget</option>
    <option value="Convertible" {{ $product[0]->type == 'Convertible' ? 'selected' : '' }}>Convertible</option>
    <option value="Electric" {{ $product[0]->type == 'Electric' ? 'selected' : '' }}>Electric</option>
</select>

    </div>
     
     
      <div class="profile-info">
        <input type="text" id="ad_title" name="ad_title" placeholder="Ad title" value="{{ $product[0]->add_title}}">
     </div>
     
      <div class="profile-info">
        <input type="text" id="description" name="description" placeholder="Description" value="{{ $product[0]->description}}">
     </div>
     
     
      <div class="profile-info">
        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ $product[0]->phone_number}}">
     </div>
     
        <div class="profile-info">
        <input type="text" id="whtsapp_number" name="whtsapp_number" placeholder="Whatsapp Number" value="{{ $product[0]->whatsapp_number}}">
     </div>
     
      <button type="submit">Submit</button>
    </form>
  </div>
       </div>
               
        </section>
  </main>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>
<script>
document.getElementById('profile-picture').addEventListener('change', function (event) {
  const input = event.target;
  const previewImage = document.getElementById('preview-image');

  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      previewImage.src = e.target.result;
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    previewImage.src = '#';
  }
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.upload__img-close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function(event) {
            const imgBox = event.target.closest('.upload__img-box');
            const imgFile = imgBox.dataset.file;
            const hiddenInput = document.querySelector('input[name="images[' + imgFile + ']"]');
            
            imgBox.remove();
            if (hiddenInput) {
                hiddenInput.remove();
            }
        });
    });
});


</script>



@endsection