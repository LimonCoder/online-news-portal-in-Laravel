<!doctype html>
<html lang="en" class="fixed left-sidebar-top">


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:03:33 GMT -->
<head>
    <meta charset="UTF-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="path" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Newsportal | @yield('tittle') </title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <!--load progress bar-->
    <script src="{{asset('admin/vendor/pace/pace.min.js')}}"></script>
    <link href="{{asset('admin/vendor/pace/pace-theme-minimal.css')}}" rel="stylesheet" />

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('admin/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendor/animate.css/animate.css')}}">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="{{asset('admin/vendor/toastr/toastr.min.css')}}">
    <!--Magnific popup-->
    <link rel="stylesheet" href="{{asset('admin/vendor/magnific-popup/magnific-popup.css')}}">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{asset('admin/stylesheets/css/style.css')}}">

    @yield('css')


</head>

<body>
    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        @include('layouts.includes.admin.topbar')
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            @include('layouts.includes.admin.leftbar')
            <!-- CONTENT -->
            <!-- ========================================================= -->
             @yield('content')
            
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="{{asset('admin/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/vendor/nano-scroller/nano-scroller.js')}}"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="{{ asset('admin/javascripts/template-script.min.js') }}"></script>
    <script src="{{ asset('admin/javascripts/template-init.min.js') }}"></script>
    <!-- SECTION script and examples-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <script src="{{ asset('admin/vendor/toastr/toastr.min.js') }}"></script>
    <!--morris chart-->
    <!-- <script src="{{asset('admin/vendor/chart-js/chart.min.js')}}"></script> -->
    <!--Gallery with Magnific popup-->
    <script src="{{ asset('admin/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Examples-->
    <!-- <script src="{{ asset('admin/javascripts/examples/dashboard.js') }}"></script> -->
    @yield('js')
</body>


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:05:07 GMT -->
</html>