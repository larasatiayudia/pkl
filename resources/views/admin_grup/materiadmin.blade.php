@extends('layout.superadmin')

@section('tittle', 'Soal Bonus')

@include('admin_grup.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/materi.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container-fluid">	
	<div class="col-md-offset-1 col-md-11">
	<div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><b><i class="fa fa-list-alt"></i> Test</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>

		<div class="col-md-12">
		<div class="panel panel-form">
		      <div class="panel-heading">
		      		<h4>List Materi Test</h4>
		      </div>
		        <div class="panel-body" style="background-color:white">
		        	<a href="{{url('admin/formmateri/'.Hashids::encode($status,$jabatan))}}" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Test</a><br><br>
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
			                		@if($buka[$index] > 0 || $buka[$index] == null || $array[$index]<0)
			                		<a href="{{url('admin/formmateri/'.Hashids::encode($materi->id_mat))}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
			                		@else
			                		<p>Sedang berlangsung</p>
			                		@endif
			                	</div>	                	
			                </div>
			            	<div class="col-md-5 col-xs-12" style="margin-top: 10px">
			            		@if($materi->waktu_buka != null)
						        <p>Mulai : {{Date::parse($materi->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						        @else
						        <p>Mulai : Waktu mulai belum ditenetukan</p>
						        @endif
						        @if($materi->waktu_tutup != null)
						        <p>Berakhir : {{Date::parse($materi->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>
						        @else
						        <p>Berakhir : Waktu berakhir belum ditentukan</p>
						        @endif
					        </div>
			             </div>
			             
			        	</div>
		        	</div>
		        	<br>
    				@endforeach
			             
			        	</div>
		        	</div>

		        </div>
		       </div>
		   </div>
		</div>
	</div>
</div>
@endsection