@extends('Admin.layouts.main')





@section('content')


<main class="main2">
 <div class="page-profile">
<p>Pages / Brands </p>
<h1> Brands </h1>
 </div>



<main class="main-dashboard">

    @if(Session::has('message'))

    <p class="alert alert-info">{{ Session::get('message') }}</p>

    @endif

    <section class="Sales">

        <div class="main-sections-container">

            <div class="page-h1">

                <div class="packages-top-sec">





                    <form action="https://f.motordeals.net/admin/brand-list" method="get">

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





                <a href="{{url('admin/add-brand/')}}">

                    <button class="addmore">

                        + Add

                    </button>



                </a>

            </div>

            <div class="main-section">

                <div class="main-table">

                    <div class="news-flex-block">

                        @foreach($category as $sales)



                        <div class="news-main-block">

                            <div class="news-img">

                                <div class="news-image">

                                    <img src="{{asset('User-images/'.$sales->image)}}">

                                </div>





                                <div class="main-icons">

                                    <a href="{{url('admin/edit-brand/'.$sales->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
  <rect x="0.860352" width="32.5581" height="32.5581" rx="5" fill="white"/>
  <path d="M11.1396 21.0837V24H14.0559L22.657 15.3989L19.7407 12.4827L11.1396 21.0837ZM24.9122 13.1437C24.9843 13.0718 25.0415 12.9863 25.0805 12.8922C25.1196 12.7981 25.1396 12.6973 25.1396 12.5954C25.1396 12.4936 25.1196 12.3927 25.0805 12.2987C25.0415 12.2046 24.9843 12.1191 24.9122 12.0472L23.0925 10.2274C23.0205 10.1553 22.9351 10.0981 22.841 10.0591C22.7469 10.0201 22.6461 10 22.5442 10C22.4424 10 22.3415 10.0201 22.2474 10.0591C22.1534 10.0981 22.0679 10.1553 21.996 10.2274L20.5728 11.6506L23.4891 14.5668L24.9122 13.1437Z" fill="#6A810B"/>
</svg>
                                    </a>

                                   <form method="post" action="{{url('admin/delete-brand')}}">
            @csrf
            <input type="hidden" name="id" value="{{$sales->id}}">
       
          <button class="delet show_confirm">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
  <rect x="0.581055" width="32.5581" height="32.5581" rx="5" fill="white"/>
  <path d="M23.1396 8.83333H20.1396L19.2825 8H14.9968L14.1396 8.83333H11.1396V10.5H23.1396M11.9968 21.3333C11.9968 21.7754 12.1774 22.1993 12.4989 22.5118C12.8204 22.8244 13.2564 23 13.7111 23H20.5682C21.0229 23 21.4589 22.8244 21.7804 22.5118C22.1019 22.1993 22.2825 21.7754 22.2825 21.3333V11.3333H11.9968V21.3333Z" fill="#FF2121"/>
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



@endsection