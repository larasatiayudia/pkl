@extends('layout.user')

@section('tittle', 'Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/materi.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="completed"><a href="{{url('/pilihjabatan')}}">Pilih Jabatan</a></li>
		@if($status)
	  	<li class="active"><a href="javascript:void(0);">Materi Periode</a></li>
	  	@else
	  	<li class="active"><a href="javascript:void(0);">Materi In Class</a></li>
	  	@endif
	</ul>

	<div class="row">
		<div class="col-md-3">
		    @include('user.sidenav')
		</div>
	
		<div class="col-md-9">
			<div class="panel panel-form">
		      <div class="panel-heading">
		      		<h4>List Materi Test</h4>
		      </div>
		        <div class="panel-body">
		        	<a href="{{url('/formmateri/'.Hashids::encode($status,$jabatan))}}" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Test</a><br><br>
		        	<!-- Ngefor buat semua materi -->
					@foreach($materis as $index => $materi)
					<!-- Klo waktu tutupnya masih lama -->
		        	@if($array[$index]>0)
		        	<div class="panel panel-success" style="border: 2px solid #01573C;border-radius: 5px ">
		        		<div class="panel-heading">
		        		<div class="row">
			              	 <div class="col-md-1 col-sm-1 col-xs-2">
			              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
			              	 </div>
			                <div class="col-md-8 col-sm-8 col-xs-8 padding-left-0">
			                  <h4 class="media-heading" style="margin-top: 15px;color: #01573C">{{$materi->nama_test}}</h4>
			                </div>
					<!-- Klo waktu tutupnya udh abis -->
			        @else
			       	<div class="panel panel-danger" style="border: 2px solid #b40202;border-radius: 5px ">
		        			<div class="panel-heading" >
		        			<div class="row">
			              	 <div class="col-md-1">
			              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
			              	 </div>
			                <div class="col-md-8 padding-left-0">
			                  <h4 class="media-heading" style="margin-top: 15px;color: #b40202" >{{$materi->nama_test}}</h4>
			                </div>
			        @endif
			                <div class="col-md-3 col-sm-3 col col-xs-12" style="margin-top: 10px">
			                	<div class="col-md-6 col-sm-6 col-xs-4 pull-right">
			                		@if($buka[$index] > 0 || $buka[$index] == null)
			                		<a href="{{url('/formmateri/'.Hashids::encode($materi->id_mat))}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
			                		@endif
			                	</div>
			                	
			                </div>
			             </div>
			             
			        	</div>
		        	</div>
    				@endforeach
			             
			        	</div>
		        	</div>

		        </div>
		       </div>
		   
		</div>
	</div>
</div>
@endsection