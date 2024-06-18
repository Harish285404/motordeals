
@extends('Admin.layouts.main')


@section('content')

<main class="main2">
 <div class="page-profile">
<p>Pages / Users </p>
<h1> Users </h1>
 </div>



<main class="main-dashboard">

    @if(Session::has('message'))

    <p class="alert alert-info">{{ Session::get('message') }}</p>

    @endif
        <section class="Sales">
            <div class="main-sections-container">
               
                <div class="main-section">
                    <div class="main-table">
                        <table id="datatable-responsive">
                            <thead>
                          
                                <tr class="heading">
                                    
                                    <th>Sr No.</th>
                                    <th>Name</th>
                               
                                     <th>Phone Number</th>
                                     <th>Subscription Type</th>
                                     <th>Email Address</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                  <tbody>
                                      <?php $a=1; ?>
                                      @foreach($user as $sales)
                                <tr>
                                    <td>{{$a}}</td>
                                 <td>{{ $sales->full_name ?: '-' }}</td>
                                 <td>{{ $sales->phone_number ?: '-' }}</td>
                <td>{{ $sales->sub_type ?: 'None' }}</td>
           
                 <td>{{ $sales->email ?: '-' }}</td>
                  <td>
      <div class="button-action">
      
         
         
              <a href="{{url('admin/view-user/'.$sales->id)}}">
          
           <button class="edit">
             
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M10.5 5C5.74881 5 2 9.99968 2 9.99968C2 9.99968 5.74881 15 10.5 15C14.133 15 19 9.99968 19 9.99968C19 9.99968 14.133 5 10.5 5ZM10.5 13.1146C8.83148 13.1146 7.47337 11.7172 7.47337 9.99968C7.47337 8.28213 8.83148 6.88411 10.5 6.88411C12.1685 6.88411 13.5266 8.28213 13.5266 9.99968C13.5266 11.7172 12.1685 13.1146 10.5 13.1146ZM10.5 8.18102C10.2652 8.17646 10.0319 8.22012 9.81372 8.30945C9.59553 8.39878 9.39682 8.53199 9.22922 8.70129C9.06162 8.87059 8.92849 9.07258 8.8376 9.29546C8.74672 9.51834 8.69991 9.75763 8.69991 9.99935C8.69991 10.2411 8.74672 10.4804 8.8376 10.7032C8.92849 10.9261 9.06162 11.1281 9.22922 11.2974C9.39682 11.4667 9.59553 11.5999 9.81372 11.6893C10.0319 11.7786 10.2652 11.8222 10.5 11.8177C10.9627 11.8087 11.4035 11.6132 11.7277 11.2731C12.0518 10.9331 12.2334 10.4757 12.2334 9.99935C12.2334 9.52296 12.0518 9.06559 11.7277 8.72557C11.4035 8.38554 10.9627 8.19002 10.5 8.18102Z" fill="#0F8DC2"/>
</svg>
           </button>


         </a>
        <a href="{{url('admin/edit-user/'.$sales->id)}}">
          
          <button class="edit">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M5 13.7086V16H7.29136L14.0493 9.24203L11.758 6.95067L5 13.7086ZM15.8213 7.47005C15.878 7.41352 15.9229 7.34637 15.9536 7.27246C15.9842 7.19854 16 7.1193 16 7.03927C16 6.95925 15.9842 6.88001 15.9536 6.80609C15.9229 6.73217 15.878 6.66503 15.8213 6.6085L14.3915 5.17869C14.335 5.12205 14.2678 5.07711 14.1939 5.04645C14.12 5.01578 14.0408 5 13.9607 5C13.8807 5 13.8015 5.01578 13.7275 5.04645C13.6536 5.07711 13.5865 5.12205 13.53 5.17869L12.4118 6.29687L14.7031 8.58823L15.8213 7.47005Z" fill="#6A810B"/>
</svg>
                   </button>
        
        
                 </a>

          <form method="post" action="{{url('admin/delete-user')}}">
            @csrf
            <input type="hidden" name="id" value="{{$sales->id}}">
       
          <button class="delet show_confirm">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M14.8 4.61111H12.6L11.9714 4H8.82857L8.2 4.61111H6V5.83333H14.8M6.62857 13.7778C6.62857 14.1019 6.76102 14.4128 6.99678 14.642C7.23254 14.8712 7.5523 15 7.88571 15H12.9143C13.2477 15 13.5675 14.8712 13.8032 14.642C14.039 14.4128 14.1714 14.1019 14.1714 13.7778V6.44444H6.62857V13.7778Z" fill="#FF2121"/>
</svg>
          </button>
          </form>
                 
                 
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

