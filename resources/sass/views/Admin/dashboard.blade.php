@extends('Admin.layouts.main')


@section('content')
<main class="main2">
  <p>
        Pages / Dashboard
    </p>
    <h1>

                    Dashboard

                </h1>

    </main>



<main class="content-main-block">
      <section class="user-booking-section">
        <div class="main-bar-list">

         <div class="main-bar-list-item sky-box">

    <div class="total-booking">
        <h2 id="totalBookings">0</h2>
        <p>Total Bookings</p>
    </div>
</div>
          <div class="main-bar-list-item red-box">
           
            <div class="total-booking">
        <h2 id="totalcancellation">0</h2>
                <p>Cancellation</p>
    </div>
          </div>
          <div class="main-bar-list-item orange-box">
            <div class="top-content">
              <p>Total Value of Bookings Today</p>
            </div>
            <div class="total-booking">
              <h2>$0</h2>
            </div>
          </div>
          <div class="main-bar-list-item purple-box">
            <div class="top-content">
              <p>Total Value of Bookings</p>
            </div>
            <div class="total-booking">
              <h2>$136816.94</h2>
            </div>
          </div>
        </div>
      </section>
      <section class="user-Booking-Statistics">
        <div class="booking-map">
          <div class="left-side-grid">
            <div class="top-grid-content">
             
              <div class="total-price">
         <h2 id="totalcommision">$0</h2>
    <h2 id="fallbackMessage" style="display: none;">Default Message</h2>
                <p>BNet commission</p>
              </div>
            </div>
            <div class="bottom-grid-content">
           <div id="donut_single"><div style="position: relative;"><div dir="ltr" style="position: relative; width: 300px; height: 300px;"><div aria-label="A chart." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;"><svg width="300" height="300" aria-label="A chart." style="overflow: hidden;"><defs id="_ABSTRACT_RENDERER_ID_0"></defs><rect x="0" y="0" width="300" height="300" stroke="none" stroke-width="0" fill="#ffffff"></rect><g><path d="M151,151L66.23929803592202,115.22817585645447A92,92,0,0,1,151,59L151,151A0,0,0,0,0,151,151" stroke="#ffffff" stroke-width="1" fill="#f24d4d"></path><text text-anchor="start" x="99.28966250803728" y="98.00386141494153" font-family="Arial" font-size="11" stroke="none" stroke-width="0" fill="#000000">18.6%</text></g><g><path d="M151,151L151,59A92,92,0,1,1,66.23929803592202,115.22817585645447L151,151A0,0,0,1,0,151,151" stroke="#ffffff" stroke-width="1" fill="#6cb552"></path><text text-anchor="start" x="174.71033749196272" y="211.69613858505846" font-family="Arial" font-size="11" stroke="none" stroke-width="0" fill="#000000">81.4%</text></g><g></g></svg><div aria-label="A tabular representation of the data in the chart." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Effort</th><th>Amount given</th></tr></thead><tbody><tr><td>Bookings</td><td>48</td></tr><tr><td>Cancellation</td><td>11</td></tr></tbody></table></div></div></div><div aria-hidden="true" style="display: none; position: absolute; top: 310px; left: 310px; white-space: nowrap; font-family: Arial; font-size: 11px;">18.6%</div><div></div></div></div>
         
            </div>
          </div>
          <div  class="right-side-grid">
            
     
             
        </div>
      </section>
     <section class="Sales">
        <p>Recently Sold Products</p>
            <div class="main-sections-container">
               
                <div class="main-section">
                    <div class="main-table">
                        <table id="datatable-responsive">
                            <thead>
                          
                                <tr class="heading">
                                    
                                    <th>Sr No.</th>
                                    <th>Listed By</th>
                                     <th>Name of Product</th>
                                     <th>Category</th>
                                     <th>Asking Amount</th>
                                  <th>Sold On</th>
                                  <th>Action</th>
                              
                                </tr>
                                </thead>
                                  <tbody>
                                      <?php $a=1; ?>
                                      @foreach($product as $sales)
                                <tr>
                                    <td>##0{{$a}}</td>
                                                        
                       <td>{{ \App\Models\User::find($sales->user_id)->full_name }}</td>

                                    <td>{{ $sales->name}}</td>
                                    
      
                                                <td>{{ \App\Models\Category::find($sales->category_id)->name }}</td>
                                       <td>${{ $sales->asking_price}}</td>
                                        <td>{{ $sales->sold_date}}</td>
                  <td>
      <div class="button-action">
      
         
         
              <a href="{{url('admin/view-product/'.$sales->id)}}">
          
           <button class="edit">
             
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M10.5 5C5.74881 5 2 9.99968 2 9.99968C2 9.99968 5.74881 15 10.5 15C14.133 15 19 9.99968 19 9.99968C19 9.99968 14.133 5 10.5 5ZM10.5 13.1146C8.83148 13.1146 7.47337 11.7172 7.47337 9.99968C7.47337 8.28213 8.83148 6.88411 10.5 6.88411C12.1685 6.88411 13.5266 8.28213 13.5266 9.99968C13.5266 11.7172 12.1685 13.1146 10.5 13.1146ZM10.5 8.18102C10.2652 8.17646 10.0319 8.22012 9.81372 8.30945C9.59553 8.39878 9.39682 8.53199 9.22922 8.70129C9.06162 8.87059 8.92849 9.07258 8.8376 9.29546C8.74672 9.51834 8.69991 9.75763 8.69991 9.99935C8.69991 10.2411 8.74672 10.4804 8.8376 10.7032C8.92849 10.9261 9.06162 11.1281 9.22922 11.2974C9.39682 11.4667 9.59553 11.5999 9.81372 11.6893C10.0319 11.7786 10.2652 11.8222 10.5 11.8177C10.9627 11.8087 11.4035 11.6132 11.7277 11.2731C12.0518 10.9331 12.2334 10.4757 12.2334 9.99935C12.2334 9.52296 12.0518 9.06559 11.7277 8.72557C11.4035 8.38554 10.9627 8.19002 10.5 8.18102Z" fill="#0F8DC2"/>
</svg>
           </button>


         </a>
        <a href="{{url('admin/edit-product/'.$sales->id)}}">
          
          <button class="edit">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M5 13.7086V16H7.29136L14.0493 9.24203L11.758 6.95067L5 13.7086ZM15.8213 7.47005C15.878 7.41352 15.9229 7.34637 15.9536 7.27246C15.9842 7.19854 16 7.1193 16 7.03927C16 6.95925 15.9842 6.88001 15.9536 6.80609C15.9229 6.73217 15.878 6.66503 15.8213 6.6085L14.3915 5.17869C14.335 5.12205 14.2678 5.07711 14.1939 5.04645C14.12 5.01578 14.0408 5 13.9607 5C13.8807 5 13.8015 5.01578 13.7275 5.04645C13.6536 5.07711 13.5865 5.12205 13.53 5.17869L12.4118 6.29687L14.7031 8.58823L15.8213 7.47005Z" fill="#6A810B"/>
</svg>
                   </button>
        
        
                 </a>

         
                 
                 
      </div>
      </td>
      
                                </tr>
                                <?php $a++ ?>
                                @endforeach
                  
                            </tbody>
                            <tfooter></tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection