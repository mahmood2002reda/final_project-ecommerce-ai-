{{--
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets-back')}}/" data-template="vertical-menu-template-free">
  @include('back.partials.head')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Navbar -->
        @include('back.partials.navbar')
        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper layout-wrab">
            <!-- Content -->
            <div class="row">
              <!-- Sidebar -->
              <div class="col-lg-3">
                @include('back.partials.sidebar')
              </div>
              <!-- / Sidebar -->

              <!-- Main content -->
              <div class="col-lg-9">
                @yield('content')
              </div>
              <!-- / Main content -->
            </div>
            <!-- / Content -->
          </div>
          <!-- / Content wrapper -->

          <!-- Footer -->
          @include('back.partials.footer')
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('back.partials.scripts')
    @livewireScripts
  </body>
</html> --}}















 <!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets-back')}}/"
  data-template="vertical-menu-template-free"
>
 @include('back.partials.head')


  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('back.partials.sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('back.partials.navbar')



          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper layout-wrab" >
            <!-- Content -->
            @yield('content')

            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('back.partials.footer')

            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('back.partials.scripts')
    @livewireScripts
  </body>
</html>
{{--
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets-back')}}/" data-template="vertical-menu-template-free">
  @include('back.partials.head')

  <body>
    <!-- Navbar -->
    @include('back.partials.navbar')
    <!-- / Navbar -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper layout-wrab">
            <!-- Content -->
            <div class="row">
              <!-- Sidebar -->
              <div class="col-lg-3">
                @include('back.partials.sidebar')
              </div>
              <!-- / Sidebar -->

              <!-- Main content -->
              <div class="col-lg-9">
                @yield('content')
              </div>
              <!-- / Main content -->
            </div>
            <!-- / Content -->
          </div>
          <!-- / Content wrapper -->

          <!-- Footer -->
          @include('back.partials.footer')
          <!-- / Footer -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('back.partials.scripts')
    @livewireScripts
  </body>
</html> --}}
