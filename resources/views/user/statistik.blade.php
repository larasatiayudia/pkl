@extends('layout.user')

@section('title', 'Statistik')

@section('styles')
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/statistik.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@section('content')
@include('user.navbar')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>		
	  	<li class="active"><a href="javascript:void(0);">Statistik</a></li>
	</ul>
	<ul class="breadcrumb visible-xs">
		<li><a href="{{url('/home')}}">Home</a></li>		
	  	<li class="active">Statistik</li>
	</ul>
	<div class="row">
		<div class="col-sm-4 col-md-3">	
			@include('user.sidenav')
		</div>		
			<div class="col-md-9">
				<div class="panels text-center">
				  	<h1 class="title">STATISTIK</h1>
				</div><br>
				<div class="row">
					<div class="col-md-9" style="margin-top: -15px">
						{{ $tests->appends(Request::all())->links() }}
					</div>
					
					<div class="col-md-3">
						<form method="GET" action="" id="filterform">
							<select name="filter" id="selectfilter" class="form-control" style="border: 2px solid #eea236">
								@if(Request::get('filter')==null || Request::get('filter')=="all")
								<option selected="true" value="all">Tanpa Filter</option>
								@else
								<option value="all">Tanpa Filter</option>
								@endif
								@if(Request::get('filter')=="pendek")
								<option selected="true" value="pendek">In Class</option>
								@else
								<option value="pendek">In Class</option>
								@endif
								@if(Request::get('filter')=="panjang")
								<option selected="true" value="panjang">Periode</option>
								@else
								<option value="panjang">Periode</option>
								@endif
							</select>
						</form>
					</div>
				</div>
				<br>
					@foreach($tests as $test)
						<div class="col-md-6">
							<div class="panel text-center">
								<h3>{{$test->nama}}</h3><br>
								<h5>Buka : {{Date::parse($test->waktu_buka)->format('l,d F Y H:i')}} WIB</h5>
								<h5>Waktu Tutup : {{$test->waktu_tutup}}</h5><br>
								<img src="{{URL::asset('img/statistik.png')}}" class="center-block img-responsive">
								<a href="{{url('/charts/'.Hashids::encode($test->id_test))}}" class="btn center-block" style="margin-bottom: 20px">Lihat Statistik</a>
							</div>
						</div>

				@endforeach
			</div>
		</div>
	</div>
</div>

<script>
	$('#selectfilter').on('change',function(){
		$('#filterform').submit();
	});
</script>
@endsection