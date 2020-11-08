<!DOCTYPE html>
<html lang="en">

  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="path" content="{{ url('/') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Newsportal | @yield('tittle') </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('web/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('web/css/modern-business.css') }}" rel="stylesheet">

    @yield('css')

  </head>

  <body>

  

    @include('layouts.includes.web.header')

    <!-- Page Content -->
    @yield('content')
      
    @include('layouts.includes.web.sidebar')

     @include('layouts.includes.web.footer')


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('web/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('web/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @yield('js')

 
</head>
  </body>

</html>
