@extends('Admin.layouts.main')





@section('content')

<main class="main2">
<div class="page-profile">
<p>Pages / Categories</p>
<h1>Categories</h1>
 </div>
<main class="main-dashboard">
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <section class="Sales">
      <div class="main-sections-container">
        <div class="page-h1">
            <div class="packages-top-sec">
            <form action="https://motor-deals.chainpulse.tech/admin/category-list" method="get">
             <div class="search-with-btn">
                              <div class="search-icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M17 17L13.1396 13.1396M13.1396 13.1396C13.7999 12.4793 14.3237 11.6953 14.6811 10.8326C15.0385 9.96978 15.2224 9.04507 15.2224 8.11121C15.2224 7.17735 15.0385 6.25264 14.6811 5.38987C14.3237 4.5271 13.7999 3.74316 13.1396 3.08283C12.4793 2.42249 11.6953 1.89868 10.8326 1.54131C9.96978 1.18394 9.04507 1 8.11121 1C7.17735 1 6.25264 1.18394 5.38987 1.54131C4.5271 1.89868 3.74316 2.42249 3.08283 3.08283C1.74921 4.41644 1 6.2252 1 8.11121C1 9.99722 1.74921 11.806 3.08283 13.1396C4.41644 14.4732 6.2252 15.2224 8.11121 15.2224C9.99722 15.2224 11.806 14.4732 13.1396 13.1396Z"
                                    stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <input type="search" placeholder="Search" name="search">
                            </div>

                            <div class="go-button-btn">

                                <button class="go-btn">Go</button>

                            </div>
           </div>
          </form>

            </div>
                <a href="{{url('admin/add-category/')}}">
                        <button class="addmore"> + Add   </button>
          </a>
            </div>
            <div class="main-section">
                <div class="main-table">

                    <div class="news-flex-block">

                        @foreach($category as $sales)



                        <div class="news-main-block image-category">

                            <div class="news-img">

                                <div class="news-image">

                                    <img src="{{asset('User-images/'.$sales->image)}}">

                                </div>





                                <div class="main-icons">

                                    <a href="{{url('admin/edit-category/'.$sales->id)}}">





                                        <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <g filter="url(#filter0_d_1214_955)">

                                                <circle cx="19.5" cy="15.5" r="15.5" fill="white"></circle>

                                            </g>

                                            <path
                                                d="M25.6094 20.8789H13.3906C13.0968 20.8789 12.8594 21.1163 12.8594 21.4102V22.0078C12.8594 22.0809 12.9191 22.1406 12.9922 22.1406H26.0078C26.0809 22.1406 26.1406 22.0809 26.1406 22.0078V21.4102C26.1406 21.1163 25.9032 20.8789 25.6094 20.8789ZM15.2782 19.4844C15.3114 19.4844 15.3446 19.4811 15.3778 19.4761L18.1702 18.9863C18.2034 18.9797 18.235 18.9647 18.2582 18.9398L25.2956 11.9024C25.311 11.8871 25.3232 11.8688 25.3315 11.8488C25.3399 11.8287 25.3442 11.8071 25.3442 11.7854C25.3442 11.7637 25.3399 11.7421 25.3315 11.722C25.3232 11.702 25.311 11.6837 25.2956 11.6684L22.5364 8.90752C22.5049 8.87598 22.4634 8.85938 22.4186 8.85938C22.3737 8.85938 22.3322 8.87598 22.3007 8.90752L15.2633 15.9449C15.2384 15.9698 15.2234 15.9997 15.2168 16.0329L14.7271 18.8253C14.7109 18.9142 14.7167 19.0058 14.7439 19.092C14.7711 19.1782 14.8188 19.2564 14.8831 19.32C14.9927 19.4263 15.1305 19.4844 15.2782 19.4844Z"
                                                fill="#A40404"></path>

                                            <defs>

                                                <filter id="filter0_d_1214_955" x="0" y="0" width="39" height="39"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">

                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>

                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha"></feColorMatrix>

                                                    <feOffset dy="4"></feOffset>

                                                    <feGaussianBlur stdDeviation="2"></feGaussianBlur>

                                                    <feComposite in2="hardAlpha" operator="out"></feComposite>

                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                                    </feColorMatrix>

                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_1214_955"></feBlend>

                                                    <feBlend mode="normal" in="SourceGraphic"
                                                        in2="effect1_dropShadow_1214_955" result="shape"></feBlend>

                                                </filter>

                                            </defs>

                                        </svg>
                                    </a>

                                     <form method="post" action="{{url('admin/delete-category')}}">
            @csrf
            <input type="hidden" name="id" value="{{$sales->id}}">
       
          <button class="delet show_confirm">
           <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <g filter="url(#filter0_d_1214_956)">

                                                <circle cx="19.5" cy="15.5" r="15.5" fill="white"></circle>

                                            </g>

                                            <path
                                                d="M15.25 20.4583C15.25 21.2375 15.8875 21.875 16.6667 21.875H22.3333C23.1125 21.875 23.75 21.2375 23.75 20.4583V11.9583H15.25V20.4583ZM24.4583 9.83333H21.9792L21.2708 9.125H17.7292L17.0208 9.83333H14.5417V11.25H24.4583V9.83333Z"
                                                fill="#A40404"></path>

                                            <defs>

                                                <filter id="filter0_d_1214_956" x="0" y="0" width="39" height="39"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">

                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>

                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha"></feColorMatrix>

                                                    <feOffset dy="4"></feOffset>

                                                    <feGaussianBlur stdDeviation="2"></feGaussianBlur>

                                                    <feComposite in2="hardAlpha" operator="out"></feComposite>

                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                                    </feColorMatrix>

                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_1214_956"></feBlend>

                                                    <feBlend mode="normal" in="SourceGraphic"
                                                        in2="effect1_dropShadow_1214_956" result="shape"></feBlend>

                                                </filter>

                                            </defs>

                                        </svg>
          </button>
          </form>

                                </div>



                            </div>



                            <div class="main-news-icons">

                                <div class="news-content-main">

                                    <p>{{$sales->name}}</p>

                                </div>



                            </div>

                        </div>

                        @endforeach
                    </div>
                    <div class="pagination-main">

                        {{$category->links("pagination::bootstrap-4")}}
                    </div>

                </div>

            </div>

        </div>

    </section>

</main>
</main>


@endsection