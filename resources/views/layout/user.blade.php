<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="keywords" content="">



    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/sweetalert.css')}}">
    <!-- Optional theme -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link href="{{URL::asset('css/toastr.min.css')}}" rel="stylesheet">
    


    @yield('styles')
  
  </head>
  <body style="background-image:url({{URL::asset('img/pattern.png')}});background-repeat: repeat-y;font-family: Roboto;">

      @yield('navbar')  
      @yield('content')

  </body>


      <script src="{{URL::asset('js/bootstrap.js')}}"></script>

      <script src="{{URL::asset('js/ajax.min.js')}}"></script>

      <script src="{{URL::asset('js/jquery-1.10.2.js')}}"></script>

      <script src="{{URL::asset('js/jquery-1.12.4.min.js')}}"></script>

       <script src="{{URL::asset('js/sweetalert.min.js')}}"></script>
       <script src="{{URL::asset('js/toastr.min.js')}}"></script>

        @yield('script')
       
</html>
