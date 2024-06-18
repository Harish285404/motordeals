<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
   <link rel="icon" type="image/x-icon" href="{{asset('User-images/Frame 5.png')}}">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap"
        rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/belgiano" rel="stylesheet">
 <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body >
  <main class="content-main-block login-form">
      <div class="container">
<div class="login-main-content">
   
            <div class="login-main-container">
                  <div class="heading">
                    <h4>Register</h4>
                    <p>Hey, Please fill in your credentials to access your account.</p>
                </div>
                
                 @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
                 <div class="card-body">
                     @if(Session::has('success'))
                               <p class="alert alert-info">
                                    {{Session::get('success')}}
                                </p>
                            @endif
             <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="col-field-main first">
                           <!-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label> -->

                            <div class="col-field-main">
                      

              <input id="first_name"  placeholder="First Name" type="text" class="form-control @error('first_name') is-invalid @enderror"
               name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                           <!-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('LastName') }}</label> -->

                            <div class="col-field-main">
                          


                              <input id="last_name" type="text"  placeholder="Last Name"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"
                                 autocomplete="last_name" autofocus>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                   
                        </div>


                     

                            <div class="col-field-main">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label> -->

                            <div class="col-field">
                            


                                <input id="email" type="email"  placeholder="Email"  class="form-control @error('email') is-invalid @enderror"
                                 name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                 <!--<div class="col-field-main">-->
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label> -->

                 <!--           <div class="col-field">-->
                             

                 <!--               <input id="phone_number" type="text"  placeholder="Phone Number" -->
                 <!--                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"-->
                 <!--                 value="{{ old('phone_number') }}"  autocomplete="phone_number" autofocus>-->

                 <!--               @error('phone_number')-->
                 <!--                   <span class="invalid-feedback" role="alert">-->
                 <!--                       <strong>{{ $message }}</strong>-->
                 <!--                   </span>-->
                 <!--               @enderror-->
                 <!--           </div>-->
                 <!--       </div>-->


                        <div class="col-field-main">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> -->

                            <div class="col-field">
                              

                                <input id="password-fields" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
 <span toggle="#password-field" class="field-icon toggle-password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                           <div class="col-field-main">
                          <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> -->


                            <div class="col-field">
                             


                          <input id="password-field" type="password"  placeholder="Confirm Password"  class="form-control" name="password_confirmation"  autocomplete="new-password">
 <span toggle="#password-field" class=" field-icon toggle-password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>     


                        <div class="login-btn">
                            <div class="button">
                                <button type="submit" class="btn btn-primary">
                            Sign Up
                                </button>
                        <!--         <div class="or-txt-small">-->
                        <!--   <span> or </span>-->
                        <!--</div>-->
                        <!--<a href="{{ url('auth/google') }}" class="btn btn-secondary btn-block">-->
                        <!--  <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                        <!--    <path d="M10.329 8.42212V12.2948H15.8207C15.5795 13.5403 14.8559 14.5949 13.7705 15.3039L17.0822 17.8221C19.0117 16.0768 20.1249 13.5131 20.1249 10.4677C20.1249 9.75859 20.06 9.07671 19.9393 8.42223L10.329 8.42212Z" fill="#4285F4"/>-->
                        <!--    <path d="M4.61039 12.1437L3.86349 12.704L1.21967 14.7221C2.89869 17.9857 6.33998 20.2403 10.3288 20.2403C13.0838 20.2403 15.3936 19.3494 17.082 17.8222L13.7703 15.304C12.8612 15.904 11.7017 16.2676 10.3288 16.2676C7.67577 16.2676 5.42167 14.5131 4.61456 12.1495L4.61039 12.1437Z" fill="#34A853"/>-->
                        <!--    <path d="M1.21948 5.75854C0.523783 7.10394 0.124939 8.62214 0.124939 10.2403C0.124939 11.8584 0.523783 13.3766 1.21948 14.722C1.21948 14.7311 4.6147 12.1402 4.6147 12.1402C4.41062 11.5402 4.28999 10.9039 4.28999 10.2402C4.28999 9.57646 4.41062 8.94014 4.6147 8.34015L1.21948 5.75854Z" fill="#FBBC05"/>-->
                        <!--    <path d="M10.329 4.22219C11.8318 4.22219 13.1676 4.73127 14.2344 5.71309L17.1564 2.8495C15.3846 1.23135 13.0841 0.240387 10.329 0.240387C6.34019 0.240387 2.89869 2.48583 1.21967 5.75856L4.61478 8.34037C5.42178 5.97672 7.67598 4.22219 10.329 4.22219Z" fill="#EA4335"/>-->
                        <!--    </svg>-->

                        <!-- Login with Google-->
                        <!--</a>-->
                        <div class="remember-pswd-btn">
                         
                                    <a class="btn btn-link" href="{{route('login')}}">
                                        Already Have An Account? <b>Sign in here</b>
                                    </a>
                                               </div>
                           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
</div>
</main>
</body>
</html>