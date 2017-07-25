@extends('layout.user')
@section('title', 'Refreshment Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/navbar.css">



@section('navbar')
<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">
            <div class="col-sm-2">
                <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Brand</span></h2>
                <h3 style="margin:0px;"><span class="largenav"><img src="{{ asset('img/logobsm.jpg') }}" style="height: 15%;width: 60%; padding-top: 10px;padding-bottom: 10px"/></span></h3>
            </div>
            <ul class="largenav pull-right">
            <li class="upper-links dropdown" style="margin-top: 30px">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: white">
                         <font face="poppins" size="4">{{ auth::user()->username }}</font><span class="caret"></span>
                    </a> 
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

                

            </ul>
        </div>
  
    </div>
</div>
<div id="mySidenav" class="sidenav">
    <div class="container" style="background-color: #2874f0; padding-top: 10px;">
        <span class="sidenav-heading">Home</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    </div>
    <a href="/test">Link</a>
    <a href="http://clashhacks.in/">Link</a>
    <a href="http://clashhacks.in/">Link</a>
    <a href="http://clashhacks.in/">Link</a>
</div>

<script type="text/javascript">
    function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}
</script>
