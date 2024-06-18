@extends('User.layouts.main')
@section('content')

<main class="main2">
<div class="page-profile">
<p>Pages / Product Listed / View Product </p>
<h1>View Product </h1>
 </div>
 
    </main>

 <main class="main-dashboard">

        <section class="properties single-properties">

            <div class="main-sections-container">

    <!-- <h1 class="top-main--headings">
        <div class="headings-arrow">View Car</div>
    </h1> -->

                <div class="main-section-inner-conatiner">

                

                     <div class="main-slick-slider">

                        <div class="slider slider-for">
                                @foreach($products[0]->image as $image=>$v)
                                        <div class="slick-items">
                                        <img src="{{asset('User-images/'.$v)}} ">
                                        <div class="price-container">
                                    <p class="price-container-inner"><?php
                           $formattedNumber = number_format($products[0]->asking_price);
                            echo '$'.$formattedNumber;
                                   ?></p>
                                 </div>
                                 </div>
                                
                                     @endforeach
                                 
                                  </div>
                        <div class="slider slider-nav">

                             @foreach($products[0]->image as $image=>$v)

                                        <div class="slick-items">

                                        <img src="{{asset('User-images/'.$v)}} ">

                                 </div>

                                        @endforeach

                        

                        </div>

                    </div>

                </div>

                <div class="single-properties-content">
<div class="product-decs">
    <p class="product-type">{{ $products[0]->name }}</p>
    <p class="brand-name">{{ \App\Models\Brand::find($products[0]->brand_id)->name }}</p>
    <p class="decsription-text">{{ $products[0]->description }}</p>
    <ul class="desc-list">               
        <li>
            <h2>Make</h2>
            <p>{{ $products[0]->year }}</p>
        </li>
        <li>
            <h2>Category</h2>
            <p>{{ \App\Models\Category::find($products[0]->category_id)->name }}</p>
        </li>
        <li>
            <h2>For</h2>
             <p>{{ $products[0]->sell_type }}</p>
                        </li>
                        <li>
                            <h2>Asking Price</h2>
                           <p>
                           <?php
                           $formattedNumber = number_format($products[0]->asking_price);
                            echo '$'.$formattedNumber;
                                   ?>
                           
                           </p>
                        </li>
                        <li>
                          <h2>Ad Type</h2>
                   <p>{{ auth()->user()->sub_type ? auth()->user()->sub_type : 'None' }}</p>
                        </li>
                        <li>
                            <h2>Ad Title</h2>
                           <p>{{ $products[0]->add_title }}</p>
            </li>
     </ul>
     </div>
</div>

        </section>

    </main>



<!-- Add Slick Carousel CSS -->

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>



<!-- Add jQuery -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- Add Slick Carousel JS -->

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){
        $('.slick-carousel').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    });
</script>





@endsection