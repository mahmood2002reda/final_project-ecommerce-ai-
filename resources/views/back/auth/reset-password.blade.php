<!DOCTYPE html>
@section('title','user reset-password')

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets-back')}}"
  data-template="vertical-menu-template-free"
>
   @include('back.partials.authHead')
 

  <body>
    <!-- Content -->

    
 
   
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              @include('back.partials.authlogo')
              <!-- /Logo -->
              <h4 class="mb-2">reset Password? 🔒</h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>  
           <form method="POST" action="{{ route('back.password.store') }}"  id="formAuthentication" class="mb-3">
             @csrf
             <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    :value="old('email', $request->email)" 
                    autofocus
                  />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                    <!-- Password -->
                    <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                            <input  type="password"   id="password"  class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"   aria-describedby="password"   />
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">password confirmation</label>
                  <div class="input-group input-group-merge">
                            <input  type="password"   id="password"  class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"   aria-describedby="password"   />
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      
                  </div>
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <button class="btn btn-primary d-grid w-100"> Reset password</button>
              </form>
              <div class="text-center">
                <a href="{{route('back.login')}}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>



    <!-- / Content -->

  

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('back.partials.authScripts')
    
  </body>
</html>





