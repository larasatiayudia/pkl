@extends('layout.user')
@section('title', 'Refreshment Test')

@section('styles')
<<<<<<< HEAD
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/navbar.css')}}">
=======
<link rel="stylesheet" type="text/css" href="css/navbar.css">
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad



@section('navbar')
<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">
            <div class="col-sm-2">
<<<<<<< HEAD
                <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()" style="padding-bottom: 15px; ">☰ Learntera</span></h2>
               <a href="/"><h3 style="margin:0px;"><span class="largenav"><img src="{{ asset('img/logobsm.jpg') }}" style="width: 120px; padding-top: 10px;padding-bottom: 10px"/></span></h3></a> 
            </div>
            <ul class="largenav pull-right" style="margin-top: 30px">

                <li class="upper-links dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font face="roboto" size="4" style="color: white">{{auth::user()->Nama}}<span class="caret"></span></font></a>               
                  <ul class="dropdown-menu" role="menu">
                    <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </form>
                    </li>

                  </ul>                
                </li>

=======
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

                

>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
            </ul>
        </div>
  
    </div>
</div>
<div id="mySidenav" class="sidenav">
<<<<<<< HEAD
    <div class="container" style="background-color:#4d8976; padding-top: 10px;">
        <span class="sidenav-heading">Learntera</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    </div>
            <div class="list-group" style="text-indent: -5px">
                <a href="{{url('/home')}}" class="list-group-item" style="border-right: none; border-left: none"><i class="fa fa-home" aria-hidden="true"></i> Home
                </a>
                @if(Auth::user()->Status == 1)
                <a href="{{url('/pilihjabatan')}}" class="list-group-item" style="border-right: none; border-left: none">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Buat Soal
                </a>
                @endif
                <a href="{{url('/bonussoal')}}" class="list-group-item" style="border-right: none; border-left: none">
                    <i class="fa fa-rocket" aria-hidden="true"></i> Bonus
                </a>
                <a href="{{url('/statistik')}}" class="list-group-item" style="border-right: none; border-left: none">
                    <i class="fa fa-line-chart" aria-hidden="true"></i> Statistik
                </a>
                <a href="{{url('/nilai')}}" class="list-group-item" style="border-right: none; border-left: none">
                    <i class="fa fa-star" aria-hidden="true"></i> Nilai 
                </a>
                <a href="{{url('/profil')}}" class="list-group-item" style="border-right: none; border-left: none">
                    <i class="fa fa-user" aria-hidden="true"></i> Profil
                </a>
                

                <a href="{{ route('logout') }}" class="list-group-item" style="border-right: none; border-left: none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form>


            </div>
</div>
<br>
=======
    <div class="container" style="background-color: #2874f0; padding-top: 10px;">
        <span class="sidenav-heading">Home</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    </div>
    <a href="/test">Link</a>
    <a href="http://clashhacks.in/">Link</a>
    <a href="http://clashhacks.in/">Link</a>
    <a href="http://clashhacks.in/">Link</a>
</div>

>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
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
