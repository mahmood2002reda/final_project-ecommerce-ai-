<!DOCTYPE html>
@section('title','Admin forget-password')

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
              <h4 class="mb-2">Forgot Password? 🔒</h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
              <x-auth-session-status class="mb-4" :status="session('status')" />
           <form method="POST" action="{{ route('back.password.email') }}"  id="formAuthentication" class="mb-3">
             @csrf

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    :value="old('email')" 
                    autofocus
                  />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
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

