<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="keywords" content="">
<<<<<<< HEAD

=======
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad


    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
<<<<<<< HEAD
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
       
=======
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


    @yield('styles')

     <script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    
    @yield('script')
    
  </head>
  <body>

      @yield('navbar')  
      @yield('content')





  </body>
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
</html>
