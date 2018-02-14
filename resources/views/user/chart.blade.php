@extends('layout.user')

@section('title', 'statistik')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/statistik.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/hasiltes.css')}}">
@endsection

@section('content')

@include('user.navbar')
<div class="container">
  <ul class="breadcrumbs hidden-xs">
    <li class="completed"><a href="{{url('/home')}}">Home</a></li>    
    <li class="completed"><a href="{{url('/statistik')}}">Statistik</a></li>
    <li class="active"><a href="javasript:void(0)">Diagram {{$test->nama}}</a></li>
  </ul>	
	<div class="row">
		<div class="col-md-3">
		@include('user.sidenav')	
		</div>
      	<div class="col-sm-6 col-md-9">
            <div class="panel panel-default shadow-depth-2">
               <div class="panel-body">
                  <center><a class="btn" href="{{url('/detailstatistik/'.Hashids::encode($id))}}">Lihat Peringkat</a></center><br><br>
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

                    
              </div>
                    
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
{!! Charts::assets() !!}
@endsection