@extends('layout.superadmin')

@section('title', 'Soal Bonus')

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
				 		<h3><b><i class="fa fa-rocket"></i> Bonus Soal</b></h3>
			  			</li> 
		   			</ol>
				</div>
			</div>
  		</div>
		
		<div class="col-md-12">
			<div class="panel panel-form">
				<div class="panel-heading">
					<h4>List Materi Bonus Soal</h4>
				</div>
				<div class="panel-body" style="background-color:white">
					<a href="{{url('admin/formmateribonus/'.Hashids::encode(2,$id_jabatan))}}" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Test</a><br><br>
						<!-- Ngefor buat semua materi -->
					@if($materis != null)
					@foreach($materis as $index => $materi)
					<div class="panel panel-success" style="border: 2px solid #01573C;border-radius: 5px ">
						<div class="panel-heading" >
							<div class="row">
								<div class="col-md-1">
									<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
								</div>
								<div class="col-md-8 padding-left-0">
									<h4 class="media-heading" style="margin-top: 15px;color: #01573" >{{$materi->nama_test}}</h4>
								</div>
								<div class="col-md-3 col-sm-3 col col-xs-12" style="margin-top: 10px">
									<div class="col-md-6 col-sm-6 col-xs-4 pull-right">
										<a href="{{url('admin/formmateribonus/'.Hashids::encode($materi->id_mat))}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
									</div>	                	
								</div>
							</div>
						</div>
					</div>
					<br>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

	<script type="text/javascript">
        @if(Session::has('msg'))
          swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
        @endif
    </script>


@endsection