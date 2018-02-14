@extends('layout.user')

@section('title', 'Nilai')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/grades.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">

@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="active"><a href="javascript:void(0);">Daftar Nilai</a></li>
	</ul>

	<div class="row">
		<div class="col-md-3">
			@include('user.sidenav')
		</div>
		<div class="col-md-9">
		@foreach($pesertas as $peserta)
			<div class="col-md-6">
				<div class="offer offer-success">
					<div class="shape">
						<div class="shape-text">
							<i class="fa fa-star" aria-hidden="true"></i>							
						</div>
					</div>
					<div class="offer-content">
						<h3 class="lead">
							 {{$peserta->test->nama}} 
						</h3>

						<hr style="border-color: green; margin-top: -5px">
						<p style="color: green">Waktu buka : {{Date::parse($peserta->test->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						<p style="color: green">Waktu tutup : {{Date::parse($peserta->test->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>

						Nilai Tertinggi Anda :
						<br><br>
						<div class="row">
							<div class="col-md-8 col-xs-8">
								<div class="circle-badge">
					            	<strong><font size="5">{{$peserta->nilai}}</font></strong>
					          	</div>
					         </div>
							<div class="col-md-4 col-xs-4">	
								<a href="{{url('/daftarnilai/'.Hashids::encode($peserta->id_peserta))}}" class="btn btn-success btn-lg pull-right" style="margin-top: 25px">Lihat Tes</a>
							</div>
						</div>
						<br>
									
					</div>
				</div>
			</div>
				@endforeach
				 
		</div>
	</div>
</div>



@endsection

