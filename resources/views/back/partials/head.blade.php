<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <title>@yield('title')</title>

    {{-- <meta name="description" content="" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets-back/img/logo/logo.jpg') }}" />
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets-back')}}/img/favicon/favicon.ico" /> --}}


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">
    {{-- <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="all"> --}}

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets-back')}}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets-back')}}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets-back')}}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets-back')}}/css/demo.css" />
    <style>
        .layout-wrapper {
          overflow: hidden;
          height: 100%;
          scrollbar-width: thin;
           scrollbar-color: transparent transparent;
        }

        .custom-active-item {
  background-color: red; /* Change this to the desired color for the active item */
}
      </style>
      <!-- Add these styles in your HTML file or CSS file -->


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets-back')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('assets-back')}}/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets-back')}}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets-back')}}/js/config.js"></script>

        <!-- Other head elements -->

        <!-- Livewire CSS -->


        @livewireStyles

  </head>

