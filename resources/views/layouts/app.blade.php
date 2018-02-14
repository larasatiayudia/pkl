<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="keywords" content="">


    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/sweetalert.css')}}">

    <!-- Optional theme -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-select.min.css')}}"/>
     @yield('styles')
</head>
<body style="background-image:url({{URL::asset('img/pattern.png')}});background-repeat: repeat-y;font-family: roboto;">

        @yield('content')


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
     <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
     <script src="{{URL::asset('js/jquery-1.12.4.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('js/bootstrap-select.min.js')}}"></script>
     @yield('script')

</html>
