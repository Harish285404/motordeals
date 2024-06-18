@extends('Admin.layouts.main')
@section('content')
<main class="main2">
<div class="page-profile">
   <p>Pages /  Product Listed </p>
   <h1>  Product Listed </h1>
</div>
<main class="main-dashboard">
   @if(Session::has('message'))

          <p class="alert alert-info">{{ Session::get('message') }}</p>

        @endif

   <div class="tabbable boxed parentTabs">
      <div class="nav-tab-items">
         <ul class="nav nav-tabs">
            <li class="active"><a href="#set1" class="active">Motors</a></li>
            <li><a href="#set2">Bikes & Boats</a></li>
            <li><a href="#set3">Parts & Accessories</a></li>
               <li><a href="#set4">Car Rentals</a></li>
         </ul>
      </div>
      <div class="tab-content">
         <div class="tab-pane fade active show" id="set1">
            <div class="tabbable nav-inner-items">
            
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="sub11">
                     <section class="Sales">
                        <div class="main-sections-container">
                           <div class="page-h1">
                              <div class="packages-top-sec">
<form id="searchForm">
    <input type="hidden" name="tab" value="set1">
    <div class="search-with-btn">
        <div class="search-icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17 17L13.1396 13.1396M13.1396 13.1396C13.7999 12.4793 14.3237 11.6953 14.6811 10.8326C15.0385 9.96978 15.2224 9.04507 15.2224 8.11121C15.2224 7.17735 15.0385 6.25264 14.6811 5.38987C14.3237 4.5271 13.7999 3.74316 13.1396 3.08283C12.4793 2.42249 11.6953 1.89868 10.8326 1.54131C9.96978 1.18394 9.04507 1 8.11121 1C7.17735 1 6.25264 1.18394 5.38987 1.54131C4.5271 1.89868 3.74316 2.42249 3.08283 3.08283C1.74921 4.41644 1 6.2252 1 8.11121C1 9.99722 1.74921 11.806 3.08283 13.1396C4.41644 14.4732 6.2252 15.2224 8.11121 15.2224C9.99722 15.2224 11.806 14.4732 13.1396 13.1396Z" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="search" placeholder="Search" name="search" id="searchInput">
        </div>
    </div>
</form>

                              </div>
                              <a href="{{url('admin/add-product/')}}">
                              <button class="addmore"> + Add </button>
                              </a>
                           </div>
                           <div class="main-section">
                              <div class="main-table">
                                 <div class="news-flex-block" id="old">
                                    @foreach($sale as $sales)
                            <div class="news-main-block" id="news-main-blo-{{ $loop->iteration }}">
                                       <div class="news-img">
                                          <div class="news-image">
                                             @php     $images = explode(',', $sales->image); @endphp  @if (!empty($images))     <img src="{{ asset('User-images/' . $images[0]) }}"> @endif
                                             <div class="price-container">
                                 <p class="price-container-inner">
    <?php
    $formattedNumber = number_format($sales->asking_price);
    echo '$' . $formattedNumber;
    ?>
</p>

                                 </div>
                                            </div>
                                          <div class="main-icons">
                                             <a href="{{url('admin/view-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/edit-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                   <rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/delete-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/>
                                                </svg>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="main-news-icons">
                                          <div class="news-content-main">
                                             <p>{{$sales->name}}</p>
                                           <p class="sales-date"><?php  $formattedDate = date("d F Y", strtotime($sales->created_at));  echo $formattedDate; ?>  </p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                 <div class="news-flex-block" id="new">

                                     </div>
                                     
                                 <button class="load_more" id="load_more2">Load more</button>
                                  
<script>
$(document).ready(function() {
    // Hide all items except the first three initially
    $('[id^=news-main-blo]').slice(3).hide();

    // Attach click event to load more button
    $('#load_more2').on('click', function(e) {
        e.preventDefault(); // Prevent default behavior of button
        
        // Select the next three hidden items and slide them down
        $('[id^=news-main-blo]:hidden').slice(0, 3).slideDown();
		
        var hiddenItemsLeft = $('[id^=news-main-blo]:hidden').length;
            
        // If no hidden items left, blur the "Load more" button
        if (hiddenItemsLeft === 0) {
            $('#load_more2').addClass('blurred');
        }
    });
});
</script>


                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
       
               </div>
            </div>
         </div>
         
         
         
         <div class="tab-pane fade" id="set2">
            <div class="tabbable nav-inner-items">
       
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="sub21">
                     <section class="Sales">
                        <div class="main-sections-container">
                           <div class="page-h1">
                              <div class="packages-top-sec">
                            <form id="searchForm2">
    <input type="hidden" name="tab" value="set2">
    <div class="search-with-btn">
        <div class="search-icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17 17L13.1396 13.1396M13.1396 13.1396C13.7999 12.4793 14.3237 11.6953 14.6811 10.8326C15.0385 9.96978 15.2224 9.04507 15.2224 8.11121C15.2224 7.17735 15.0385 6.25264 14.6811 5.38987C14.3237 4.5271 13.7999 3.74316 13.1396 3.08283C12.4793 2.42249 11.6953 1.89868 10.8326 1.54131C9.96978 1.18394 9.04507 1 8.11121 1C7.17735 1 6.25264 1.18394 5.38987 1.54131C4.5271 1.89868 3.74316 2.42249 3.08283 3.08283C1.74921 4.41644 1 6.2252 1 8.11121C1 9.99722 1.74921 11.806 3.08283 13.1396C4.41644 14.4732 6.2252 15.2224 8.11121 15.2224C9.99722 15.2224 11.806 14.4732 13.1396 13.1396Z" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="search" placeholder="Search" name="search" id="searchInput2">
        </div>
    </div>
</form>
                              </div>
                              <a href="{{url('admin/add-product/')}}">
                              <button class="addmore"> + Add </button>
                              </a>
                           </div>
                           <div class="main-section">
                              <div class="main-table">
                                 <div class="news-flex-block" id="old1">
                                    @foreach($bikesale as $sales)
                              <div class="news-main-block" id="news-main-block-{{ $loop->index }}">
                                       <div class="news-img">
                                          <div class="news-image">
                                             @php     $images = explode(',', $sales->image); @endphp  @if (!empty($images))     <img src="{{ asset('User-images/' . $images[0]) }}"> @endif
                                             <div class="price-container">
                             <p class="price-container-inner">
    <?php
    $formattedNumber = number_format($sales->asking_price);
    echo '$' . $formattedNumber;
    ?>
</p>

                                 </div>
                                            </div>
                                          <div class="main-icons">
                                             <a href="{{url('admin/view-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/edit-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                   <rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/delete-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/>
                                                </svg>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="main-news-icons">
                                          <div class="news-content-main">
                                             <p>{{$sales->name}}</p>
                                           <p class="sales-date"><?php  $formattedDate = date("d F Y", strtotime($sales->created_at));  echo $formattedDate; ?>  </p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                  <div class="news-flex-block" id="new1">

                                     </div>
                             <button class="load_more" id="load_more">Load more</button>
	<script>
    $(document).ready(function() {
        // Show the first three items initially
        $('[id^=news-main-block]').slice(0, 3).show();

        // Attach click event to load more button
        $('#load_more').on('click', function(e) {
            e.preventDefault(); // Prevent default behavior of button
            
            // Select the next three hidden items and slide them down
            $('[id^=news-main-block]:hidden').slice(0, 3).slideDown();
			
			var hiddenItemsLeft = $('[id^=news-main-block]:hidden').length;
            
            // If no hidden items left, blur the "Load more" button
            if (hiddenItemsLeft === 0) {
                $('#load_more').addClass('blurred');
            }
        });
    });
</script>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
      
               </div>
            </div>
         </div>
         
         <div class="tab-pane fade" id="set3">
            <div class="tabbable nav-inner-items">
               
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="sub31">
                     <section class="Sales">
                        <div class="main-sections-container">
                           <div class="page-h1">
                              <div class="packages-top-sec">
                                                           <form id="searchForm3">
    <input type="hidden" name="tab" value="set3">
    <div class="search-with-btn">
        <div class="search-icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17 17L13.1396 13.1396M13.1396 13.1396C13.7999 12.4793 14.3237 11.6953 14.6811 10.8326C15.0385 9.96978 15.2224 9.04507 15.2224 8.11121C15.2224 7.17735 15.0385 6.25264 14.6811 5.38987C14.3237 4.5271 13.7999 3.74316 13.1396 3.08283C12.4793 2.42249 11.6953 1.89868 10.8326 1.54131C9.96978 1.18394 9.04507 1 8.11121 1C7.17735 1 6.25264 1.18394 5.38987 1.54131C4.5271 1.89868 3.74316 2.42249 3.08283 3.08283C1.74921 4.41644 1 6.2252 1 8.11121C1 9.99722 1.74921 11.806 3.08283 13.1396C4.41644 14.4732 6.2252 15.2224 8.11121 15.2224C9.99722 15.2224 11.806 14.4732 13.1396 13.1396Z" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="search" placeholder="Search" name="search" id="searchInput3">
        </div>
    </div>
</form>
                              </div>
                              <a href="{{url('admin/add-product/')}}">
                              <button class="addmore"> + Add </button>
                              </a>
                           </div>
                           <div class="main-section">
                              <div class="main-table">
                                 <div class="news-flex-block" id="old2">
                                    @foreach($partsale as $sales)
                             <div class="news-main-block" id="news-main-bclo-{{ $loop->iteration }}">
                                       <div class="news-img">
                                          <div class="news-image">
                                             @php     $images = explode(',', $sales->image); @endphp  @if (!empty($images))     <img src="{{ asset('User-images/' . $images[0]) }}"> @endif
                                             <div class="price-container">
                                                              <p class="price-container-inner">
                                <?php
                                $formattedNumber = number_format($sales->asking_price);
                                echo '$' . $formattedNumber;
                                ?>
                            </p>

                                 </div>
                                            </div>
                                          <div class="main-icons">
                                             <a href="{{url('admin/view-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/edit-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                   <rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/delete-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/>
                                                </svg>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="main-news-icons">
                                          <div class="news-content-main">
                                             <p>{{$sales->name}}</p>
                                           <p class="sales-date"><?php  $formattedDate = date("d F Y", strtotime($sales->created_at));  echo $formattedDate; ?>  </p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                  <div class="news-flex-block" id="new2">

                                     </div>
                              <button class="load_more" id="load_more3">Load more</button>
            
<script>
    $(document).ready(function() {
    // Hide all items except the first three initially
    $('[id^=news-main-bclo]').slice(3).hide();

    // Attach click event to load more button
    $('#load_more3').on('click', function(e) {
        e.preventDefault(); // Prevent default behavior of button
        
        // Select the next three hidden items and slide them down
        $('[id^=news-main-bclo]:hidden').slice(0, 3).slideDown();
		
		var hiddenItemsLeft = $('[id^=news-main-bclo]:hidden').length;
            
            // If no hidden items left, blur the "Load more" button
            if (hiddenItemsLeft === 0) {
                $('#load_more3').addClass('blurred');
            }
    });
});

</script>

                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </div>
            <div class="tab-pane fade" id="set4">
            <div class="tabbable nav-inner-items">
           
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="sub41">
                     <section class="Sales">
                        <div class="main-sections-container">
                           <div class="page-h1">
                              <div class="packages-top-sec">
                                                        <form id="searchForm4">
    <input type="hidden" name="tab" value="set4">
    <div class="search-with-btn">
        <div class="search-icon-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17 17L13.1396 13.1396M13.1396 13.1396C13.7999 12.4793 14.3237 11.6953 14.6811 10.8326C15.0385 9.96978 15.2224 9.04507 15.2224 8.11121C15.2224 7.17735 15.0385 6.25264 14.6811 5.38987C14.3237 4.5271 13.7999 3.74316 13.1396 3.08283C12.4793 2.42249 11.6953 1.89868 10.8326 1.54131C9.96978 1.18394 9.04507 1 8.11121 1C7.17735 1 6.25264 1.18394 5.38987 1.54131C4.5271 1.89868 3.74316 2.42249 3.08283 3.08283C1.74921 4.41644 1 6.2252 1 8.11121C1 9.99722 1.74921 11.806 3.08283 13.1396C4.41644 14.4732 6.2252 15.2224 8.11121 15.2224C9.99722 15.2224 11.806 14.4732 13.1396 13.1396Z" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="search" placeholder="Search" name="search" id="searchInput4">
        </div>
    </div>
</form>
                              </div>
                              <a href="{{url('admin/add-product/')}}">
                              <button class="addmore"> + Add </button>
                              </a>
                           </div>
                           <div class="main-section">
                              <div class="main-table">
                                 <div class="news-flex-block" id="old3">
                                    @foreach($rent as $sales)
                          <div class="news-main-block" id="news-main-bcloo-{{ $loop->iteration }}">
                                       <div class="news-img">
                                          <div class="news-image">
                                             @php     $images = explode(',', $sales->image); @endphp  @if (!empty($images))     <img src="{{ asset('User-images/' . $images[0]) }}"> @endif
                                             <div class="price-container">
                                 <p class="price-container-inner">
    <?php
    $formattedNumber = number_format($sales->asking_price);
    echo '$' . $formattedNumber;
    ?>
</p>

                                 </div>
                                            </div>
                                          <div class="main-icons">
                                             <a href="{{url('admin/view-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/edit-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                   <rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/>
                                                </svg>
                                             </a>
                                             <a href="{{url('admin/delete-product/'.$sales->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
                                                   <rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/>
                                                   <path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/>
                                                </svg>
                                             </a>
                                          </div>
                                       </div>
                                       <div class="main-news-icons">
                                          <div class="news-content-main">
                                             <p>{{$sales->name}}</p>
                                           <p class="sales-date"><?php  $formattedDate = date("d F Y", strtotime($sales->created_at));  echo $formattedDate; ?>  </p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                                  <div class="news-flex-block" id="new3">

                                     </div>
                                <button class="load_more" id="load_more4">Load more</button>

<script>
    $(document).ready(function() {
        // Hide all items except the first three initially
        $('[id^=news-main-bcloo]').slice(0, 3).show();

        // Attach click event to load more button
        $('#load_more4').on('click', function(e) {
            e.preventDefault(); // Prevent default behavior of button
            
            // Select the next three hidden items and slide them down
            $('[id^=news-main-bcloo]:hidden').slice(0, 3).slideDown();
			
			var hiddenItemsLeft = $('[id^=news-main-bcloo]:hidden').length;
            
            // If no hidden items left, blur the "Load more" button
            if (hiddenItemsLeft === 0) {
                $('#load_more4').addClass('blurred');
            }
        });
    });
</script>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<script>
   $("ul.nav-tabs a").click(function(e) {
   
       e.preventDefault();
   
       $(this).tab('show');
   
   });
   
</script>
<script>
$(document).ready(function(){
    $('#searchInput').on('input', function(){
        var formData = $('#searchForm').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'product-search',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                // Hide the old div
                $('#old').hide();

                // Show the new div
                $('#new').show();

                // Clear any previous search results
                $('#new').empty();

                if(response.length > 0) {
                    $.each(response, function(index, sales) {
                        // Construct the HTML for the entire sale item div
                        var divHTML = '<div class="news-main-block">';
                        divHTML += '<div class="news-img">';
                        divHTML += '<div class="news-image">';
                        var images = sales.image.split(','); // Split the image URLs
                      if (images.length > 0) {
                            var imagePath = 'https://f.motordeals.net/User-images/' + images[0];
                            divHTML += '<img src="' + imagePath + '">'; // Assuming the first image is the main image
                        }
                        divHTML += '<div class="price-container">';
                        divHTML += '<p class="price-container-inner">$' + sales.asking_price.toLocaleString() + '</p>';
                        divHTML += '</div>'; 
                        divHTML += '</div>'; 
                        divHTML += '<div class="main-icons">';
                       divHTML += '<a href="https://f.motordeals.net/admin/view-product/'+sales.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/></svg></a>';
divHTML += '<a href="https://f.motordeals.net/admin/edit-product/'+sales.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none"><rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/></svg></a>';
divHTML += '<a href="https://f.motordeals.net/admin/delete-product/'+sales.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/></svg></a>';

                        divHTML += '</div>'; // Close .main-icons
                        divHTML += '</div>'; // Close .news-img
                        divHTML += '<div class="main-news-icons">';
                        divHTML += '<div class="news-content-main">';
                        divHTML += '<p>' + sales.name + '</p>';
                        var formattedDate = new Date(sales.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                        divHTML += '<p class="sales-date">' + formattedDate + '</p>';
                        divHTML += '</div>'; // Close .news-content-main
                        divHTML += '</div>'; // Close .main-news-icons
                        divHTML += '</div>'; // Close .news-main-block

                        // Append the constructed HTML to the new div
                        $('#new').append(divHTML);
                    });
                } else {
                    // Display a message when no results are found
                    $('#new').html('<p>No results found.</p>');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });
});


</script>



<script>
    $(document).ready(function(){
        $('#searchInput2').on('input', function(){
            var formData = $('#searchForm2').serialize();
            
            $.ajax({
                type: 'POST',
              url: 'product-search', // Replace with the actual URL of your controller method
                data: formData,
 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
success: function(response) {
    $('#old1').hide();
    $('#new1').show();
    $('#new1').empty();

    if (response.length > 0) {
        $.each(response, function(index, sales1) {
            var divHTML = '<div class="news-main-block">';
            divHTML += '<div class="news-img">';
            divHTML += '<div class="news-image">';
            var images = sales1.image.split(',');
            if (images.length > 0) {
                var imagePath = 'https://f.motordeals.net/User-images/' + images[0];
                divHTML += '<img src="' + imagePath + '">'; 
            }
            divHTML += '<div class="price-container">';
            divHTML += '<p class="price-container-inner">$' + sales1.asking_price.toLocaleString() + '</p>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 
            divHTML += '<div class="main-icons">';
            divHTML += '<a href="https://f.motordeals.net/admin/view-product/'+sales1.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/edit-product/'+sales1.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none"><rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/delete-product/'+sales1.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/></svg></a>';
            divHTML += '</div>'; 
            divHTML += '</div>';
            divHTML += '<div class="main-news-icons">';
            divHTML += '<div class="news-content-main">';
            divHTML += '<p>' + sales1.name + '</p>';
            var formattedDate = new Date(sales1.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            divHTML += '<p class="sales-date">' + formattedDate + '</p>';
            divHTML += '</div>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 

            $('#new1').append(divHTML); // Corrected from $('#new2') to $('#new1')
        });
    } else {
        $('#new1').html('<p>No results found.</p>'); // Corrected from $('#new2') to $('#new1')
    }
},


                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#searchInput3').on('input', function(){
            var formData = $('#searchForm3').serialize();
            
            $.ajax({
                type: 'POST',
              url: 'product-search', // Replace with the actual URL of your controller method
                data: formData,
 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  success: function(response) {
    $('#old2').hide();
    $('#new2').show();
    $('#new2').empty();

    if (response.length > 0) {
        $.each(response, function(index, sales2) {
            var divHTML = '<div class="news-main-block">';
            divHTML += '<div class="news-img">';
            divHTML += '<div class="news-image">';
            var images = sales2.image.split(',');
            if (images.length > 0) {
                var imagePath = 'https://f.motordeals.net/User-images/' + images[0];
                divHTML += '<img src="' + imagePath + '">'; 
            }
            divHTML += '<div class="price-container">';
            divHTML += '<p class="price-container-inner">$' + sales2.asking_price.toLocaleString() + '</p>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 
            divHTML += '<div class="main-icons">';
            divHTML += '<a href="https://f.motordeals.net/admin/view-product/'+sales2.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/edit-product/'+sales2.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none"><rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/delete-product/'+sales2.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/></svg></a>';
            divHTML += '</div>'; 
            divHTML += '</div>';
            divHTML += '<div class="main-news-icons">';
            divHTML += '<div class="news-content-main">';
            divHTML += '<p>' + sales2.name + '</p>';
            var formattedDate = new Date(sales2.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            divHTML += '<p class="sales-date">' + formattedDate + '</p>';
            divHTML += '</div>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 

            $('#new2').append(divHTML); // Corrected from $('#new1') to $('#new2')
        });
    } else {
        $('#new2').html('<p>No results found.</p>'); // Corrected from $('#new1') to $('#new2')
    }
},

                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });

        
    });
</script>
<script>
    $(document).ready(function(){
        $('#searchInput4').on('input', function(){
            var formData = $('#searchForm4').serialize();
            
            $.ajax({
                type: 'POST',
              url: 'product-search', // Replace with the actual URL of your controller method
                data: formData,
 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
 success: function(response) {
    $('#old3').hide();
    $('#new3').show();
    $('#new3').empty();

    if (response.length > 0) {
        $.each(response, function(index, sales3) {
            var divHTML = '<div class="news-main-block">';
            divHTML += '<div class="news-img">';
            divHTML += '<div class="news-image">';
            var images = sales3.image.split(',');
            if (images.length > 0) {
                var imagePath = 'https://f.motordeals.net/User-images/' + images[0];
                divHTML += '<img src="' + imagePath + '">'; 
            }
            divHTML += '<div class="price-container">';
            divHTML += '<p class="price-container-inner">$' + sales3.asking_price.toLocaleString() + '</p>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 
            divHTML += '<div class="main-icons">';
            divHTML += '<a href="https://f.motordeals.net/admin/view-product/'+sales3.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M17 11C11.4104 11 7 16.4996 7 16.4996C7 16.4996 11.4104 22 17 22C21.2741 22 27 16.4996 27 16.4996C27 16.4996 21.2741 11 17 11ZM17 19.926C15.037 19.926 13.4393 18.3889 13.4393 16.4996C13.4393 14.6103 15.037 13.0725 17 13.0725C18.963 13.0725 20.5607 14.6103 20.5607 16.4996C20.5607 18.3889 18.963 19.926 17 19.926ZM17 14.4991C16.7238 14.4941 16.4493 14.5421 16.1926 14.6404C15.9359 14.7387 15.7021 14.8852 15.505 15.0714C15.3078 15.2576 15.1512 15.4798 15.0442 15.725C14.9373 15.9702 14.8822 16.2334 14.8822 16.4993C14.8822 16.7652 14.9373 17.0284 15.0442 17.2736C15.1512 17.5187 15.3078 17.7409 15.505 17.9272C15.7021 18.1134 15.9359 18.2599 16.1926 18.3582C16.4493 18.4564 16.7238 18.5045 17 18.4994C17.5444 18.4896 18.063 18.2745 18.4443 17.9005C18.8256 17.5264 19.0393 17.0233 19.0393 16.4993C19.0393 15.9753 18.8256 15.4721 18.4443 15.0981C18.063 14.7241 17.5444 14.509 17 14.4991Z" fill="#0F8DC2"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/edit-product/'+sales3.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none"><rect x="0.720703" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M11 21.0837V24H13.9163L22.5173 15.3989L19.6011 12.4827L11 21.0837ZM24.7726 13.1437C24.8447 13.0718 24.9019 12.9863 24.9409 12.8922C24.9799 12.7981 25 12.6973 25 12.5954C25 12.4936 24.9799 12.3927 24.9409 12.2987C24.9019 12.2046 24.8447 12.1191 24.7726 12.0472L22.9528 10.2274C22.8809 10.1553 22.7954 10.0981 22.7013 10.0591C22.6073 10.0201 22.5064 10 22.4046 10C22.3027 10 22.2019 10.0201 22.1078 10.0591C22.0137 10.0981 21.9282 10.1553 21.8563 10.2274L20.4332 11.6506L23.3494 14.5668L24.7726 13.1437Z" fill="#6A810B"/></svg></a>';
            divHTML += '<a href="https://f.motordeals.net/admin/delete-product/'+sales3.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><rect x="0.441406" width="32.5581" height="32.5581" rx="5" fill="white"/><path d="M23 8.83333H20L19.1429 8H14.8571L14 8.83333H11V10.5H23M11.8571 21.3333C11.8571 21.7754 12.0378 22.1993 12.3592 22.5118C12.6807 22.8244 13.1168 23 13.5714 23H20.4286C20.8832 23 21.3193 22.8244 21.6408 22.5118C21.9622 22.1993 22.1429 21.7754 22.1429 21.3333V11.3333H11.8571V21.3333Z" fill="#FF2121"/></svg></a>';
            divHTML += '</div>'; 
            divHTML += '</div>';
            divHTML += '<div class="main-news-icons">';
            divHTML += '<div class="news-content-main">';
            divHTML += '<p>' + sales3.name + '</p>';
            var formattedDate = new Date(sales3.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            divHTML += '<p class="sales-date">' + formattedDate + '</p>';
            divHTML += '</div>';
            divHTML += '</div>'; 
            divHTML += '</div>'; 

            $('#new3').append(divHTML); // Changed from $('#new2') to $('#new3')
        });
    } else {
        $('#new3').html('<p>No results found.</p>'); // Changed from $('#new2') to $('#new3')
    }
},

                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });

   
    });
</script>

@endsection