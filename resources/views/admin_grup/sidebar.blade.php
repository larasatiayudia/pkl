@extends('layout.superadmin')
@section('title', 'Admin')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/sidebar_ua.css')}}">


@section('sidebar')
<div id="wrapper">      
  <div id="sidebar-wrapper">
    <div class="row">
      <!--LOGO BSM-->
      <div class="col-md-12" style="text-align:center;margin-top:10px;margin-bottom:20px">
          <img src="{{URL::asset('img/logobsm.jpg')}}" style="width:125px"/>
      </div> 
      <!--END LOGO-->
      <!--LOGO USER-->
      <div class="col-md-12" style="text-align:center;margin-bottom:10px">
            <img src="{{URL::asset('img/user.png')}}" style="width:125px;height:125px;text-align:center;"/>
      </div>
      <!--END LOGO-->
      <!--USERNAME-->
      <div class="col-md-12" style="text-align:center;margin-bottom:10px">
        <span style="text-align:center;color:white">{{Auth::guard('superadmin')->user()->username}}</span>
      </div>
      <!--END USERNAME-->
    </div>
    <ul class="sidebar-nav" id="sidebar">    
      <li>
        @if(\Request::is('/admin'))
        <a href="{{route('admingrup.dashboard')}}" class="button" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{route('admingrup.dashboard')}}" class="button">
        @endif
        <i class="fa fa-dashboard" aria-hidden="true"></i>  Dashboard</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('admin/users') || \Request::is('admin/users/*'))
        <a href="{{route('admingrup.daftarUser')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{route('admingrup.daftarUser')}}">
        @endif
        <i class="fa fa-users" aria-hidden="true" ></i>  User </a>
      </li>
    </ul>
<!--     <ul class="sidebar-nav" id="sidebar">     
      <li style="color:white">
        @if(\Request::is('admin/admins') || \Request::is('admin/admins/*'))
        <a href="{{route('admingrup.daftarAdmin')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{route('admingrup.daftarAdmin')}}">
        @endif
        <i class="fa fa-user-secret" aria-hidden="true"></i>  Admin </a>
      </li>
    </ul> -->
    
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('admin/jabatan') || \Request::is('admin/jabatan/*'))
        <a href="{{route('admingrup.daftarJabatan')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{route('admingrup.daftarJabatan')}}">
        @endif
        <i class="fa fa-briefcase" aria-hidden="true"></i>  Jabatan </a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li style="color:white">
        @if(\Request::is('admin/level'))
        <a href="{{url('admin/level')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{url('admin/level')}}">
        @endif
        <i class="fa fa-star" aria-hidden="true"></i>  Level </a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
         @if(\Request::is('admin/pilihjabatan') || \Request::is('pilihjabatan/*') || \Request::is('admin/materisoal') || \Request::is('admin/formmateri/*'))
        <a href="{{url('admin/pilihjabatan')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{url('admin/pilihjabatan')}}">
        @endif
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Test </a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li style="color:white">
        @if(\Request::is('admin/soalbonus'))
        <a href="{{url('admin/soalbonus')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{url('admin/soalbonus')}}">
        @endif
        <i class="fa fa-rocket" aria-hidden="true"></i>  Soal Bonus </a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
      @if(\Request::is('admin/rekap') || \Request::is('admin/rekap/*'))
        <a href="{{route('admingrup.rekap')}}" style="background-color: rgba(255,255,255,0.2);color:white">
        @else
        <a href="{{route('admingrup.rekap')}}">
        @endif
        <i class="fa fa-bar-chart" aria-hidden="true"></i> Rekap </a>
      </li>
    </ul>
    <!--logout-->
    <ul class="sidebar-nav" id="sidebar">     
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> 
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form></li>
    </ul>
  </div>