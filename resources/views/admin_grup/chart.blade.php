@extends('layout.superadmin')
@section('title', 'Dashboard')


@include('admin_grup.sidebar')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/statistik.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/hasiltes.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
@endsection

<!-- dashboard operator admin -->
@section('content')
<div class="container-fluid">
   <div class="col-md-offset-1 col-md-11">
   		<div class="row">
	        <div class="col-md-12">
	            <div class="page-title">
	               <ol class="breadcrumb judulmenu"><br><br>
	                  <li class="active" style="color:#E5FFCA">
	                     <h3><b><i class="fa fa-dashboard"></i> Statistik</b></h3>
	                  </li> 
	               </ol>
	            </div>
	         </div>
	      </div>

	<ul class="breadcrumbs ">
    <li class="completed"><a href="{{route('admingrup.dashboard')}}"> Dashboard</a></li>  
    <li class="active"><a href="javasript:void(0)"> Statistik</a></li>
   </ul> 
	   		<div class="col-sm-6 col-md-12">
	            <div class="panel panel-default shadow-depth-2">
	               <div class="panel-body">
	               		@if($chart2 != null)
	               			<center>
	               				<div class="col-md-6">
	               				{!! $chart->render() !!}<br>
	               				</div>
	               				<div class="col-md-6">
	               				{!! $chart2->render() !!}<br>
	               				</div>
	               			</center>	               		
	               		@else
	               		 <center>
	               			{!! $chart->render() !!}<br>
	               		</center>
	               		@endif

		                <div class="row">
	                      <div class="col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10">
	                        <div class="circle-tile">
	                              <a href="#">
	                                  <div class="circle-tile-heading blue">
	                                      <i class="fa fa-line-chart fa-3x"></i>
	                                  </div>
	                              </a>
	                              <div class="circle-tile-content blue">
	                                  <div class="circle-tile-description text-faded">
	                                      <h2>Detail Statistik</h2>
	                                  </div>
	                                  <hr style="border:2px solid rgba(255,255,255,0.3);">
	                                  <div class="circle-tile-number text-faded">
	                                      <h4>Nilai rata-rata : {{$rataan}}</h4>
	                                      <h4>Nilai terbesar : {{$max}}</h4>
	                                      <h4>Nilai terkecil : {{$min}}</h4> 
	                                      <span id="sparklineB"></span>
	                                  </div>
	                                  
	                              </div>
	                          </div>
	                        </div>
	                    </div>
			       		
	              </div>
	            </div>
	      	</div>
   </div>
</div>
{!! Charts::assets() !!}
@endsection