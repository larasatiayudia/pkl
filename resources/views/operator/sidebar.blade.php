@extends('layout.superadmin')
@section('title', 'Operator')


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
        <a href="{{route('operator.myProfile')}}" style="text-align:center;color:white">{{Auth::guard('superadmin')->user()->username}}</a>
      </div>
      <!--END USERNAME-->
    </div>
    <ul class="sidebar-nav" id="sidebar">    
      <li>
        @if(\Request::is('operator'))
        <a href="{{route('operator.dashboard')}}" class="button" style="background-color: rgba(255,255,255,0.2);color:white;">
        @else
        <a href="{{route('operator.dashboard')}}" class="button">
        @endif
        <i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('operator/admingroup') || \Request::is('operator/admingroup/*'))
        <a href="{{route('operator.daftarSuperadmin')}}" style="background-color: rgba(255,255,255,0.2);color:white;">
        @else
        <a href="{{route('operator.daftarSuperadmin')}}">
        @endif
        <i class="fa fa-users" aria-hidden="true" ></i> Admin Grup</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('operator/group') || \Request::is('operator/group/*'))
        <a href="{{route('operator.daftarGroup')}}" style="background-color: rgba(255,255,255,0.2);color:white;">
        @else
        <a href="{{route('operator.daftarGroup')}}">
        @endif
        <i class="fa fa-briefcase" aria-hidden="true"></i> Grup</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('operator/kantor') || \Request::is('operator/kantor/*'))
        <a href="{{route('operator.daftarKantor')}}" style="background-color: rgba(255,255,255,0.2);color:white;">
        @else
        <a href="{{route('operator.daftarKantor')}}">
        @endif
        <i class="fa fa-university" aria-hidden="true"></i> Kantor</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li>
        @if(\Request::is('operator/profile') || \Request::is('operator/profile/*'))
        <a href="{{route('operator.myProfile')}}" style="background-color: rgba(255,255,255,0.2);color:white;">
        @else
        <a href="{{route('operator.myProfile')}}">
        @endif
        <i class="fa fa-user" aria-hidden="true"></i> Profil Saya</a>
      </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">     
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> 
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form></li>
    </ul>
  </div>