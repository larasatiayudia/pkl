<!DOCTYPE HTML>
<html>
<head>
<title>404 not found</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/404.css')}}">
</head>

<body>
	<div class="wrap">
	   <div class="logo">
	   <h1>404</h1>
	    <p>Error occured! - Page not Found</p>
  	      <div class="sub">
	        <p><a href="{{url()->previous()}}">Back</a></p>
	      </div>
        </div>
	</div>
</body>