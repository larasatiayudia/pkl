@extends('layout.user')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/pilihjabatan.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@section('tittle', 'Pilih Jabatan')

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="active"><a href="javascript:void(0);">Pilih Jabatan</a></li>
	</ul>

	<div class="row">
		<div class="col-sm-4 col-md-3 sidebar">
		    @include('user.sidenav')
		</div>
		<div class="col-md-9">
			<h3>Pilih Jabatan</h3><br>
			@foreach($user->admin as $admin)
			<div class="col-md-6" style="margin-top: -15px">
			
				
				    <div class="thumbnail">
		              <div class="caption">
		                <div class='col-lg-12'>
		                    <br>
		                </div>
		                <div class='col-lg-12  well-add-card' style="background-color: #4d8976">
		                    <h4 style="color: white">{{$admin->jabatan->nama_jabatan}}</h4>
		                </div>
		                <div class='col-lg-12'>
		                    <!-- <p>4111xxxxxxxx3265</p>
		                    <p class"text-muted">Exp: 12-08</p> -->
		                    <br><br>
		                </div>
		                <div class="container-fluid">
		                <a href="{{url('/materisoal/'.Hashids::encode($admin->jabatan->id_jabatan,0))}}" class="btn btn-primary" style="border-radius: 5px">In Class</a>
		                <a href="{{url('/materisoal/'.Hashids::encode($admin->jabatan->id_jabatan,1))}}" class="btn btn-primary" style="border-radius: 5px">Periode</a>
		                </div>
		            </div>
		          </div>
		       
			</div>
			 @endforeach

		</div>
	</div>
</div>
@endsection