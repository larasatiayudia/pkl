@extends('layout.superadmin')

@include('admin_grup.sidebar')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/grades.css')}}">
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

	@include('admin_grup.stepbonus')

	<div class="row">
    <div class="col-md-12">	
			   	<div class="panel panel-form">
                    <div class="panel-heading">Pengaturan Tipe Tes</div>
                    	<div class="panel-body" style="background-color:white">
                        @if($easy==null)
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										 Soal Level Mudah
									</h3>

									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">Belum ada soal untuk Level Mudah</h4>

									<br><br>

									<a href="{{url('admin/formtestbonus/'.Hashids::encode($materi->id_mat,$materi->status,2))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
									<br>
												
								</div>
							</div>
							@else
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h2 class="lead">
										 <b>Soal Level Mudah<b>
									</h2>


									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">{{$easy->nama}}</h4>
									<br><br>
									<form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('admin/hapustest/'.$easy->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus</button>
                                    </form>
									<a href="{{url('admin/formtestbonus/'.Hashids::encode($easy->materi->id_mat,$status,$easy->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
									<br>				
								</div>
							</div>
							@endif
							@if($medium==null)
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										 Soal Level Sedang
									</h3>

									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">Belum ada soal Level Sedang</h4>

									<br><br>

									<a href="{{url('admin/formtestbonus/'.Hashids::encode($materi->id_mat,$materi->status,3))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
									<br>
												
								</div>
							</div>
							@else
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h2 class="lead">
										 <b>Soal Level Sedang<b>
									</h2>


									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">{{$medium->nama}}</h4>
									<br><br>
									<form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('admin/hapustest/'.$medium->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus </button>
                                    </form>
									<a href="{{url('admin/formtestbonus/'.Hashids::encode($medium->materi->id_mat,$status,$medium->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
									<br>				
								</div>
							</div>
							@endif
                            @if($hard==null)
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										 Soal Level Susah
									</h3>

									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">Belum ada soal Level Susah</h4>

									<br><br>

									<a href="{{url('admin/formtestbonus/'.Hashids::encode($materi->id_mat,$materi->status,4))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
									<br>
												
								</div>
							</div>

							@else
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h2 class="lead">
										 <b>Soal Level Susah<b>
									</h2>


									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">{{$hard->nama}}</h4>
									<br><br>
									<form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('admin/hapustest/'.$hard->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus </button>
                                    </form>
									<a href="{{url('admin/formtestbonus/'.Hashids::encode($hard->materi->id_mat,$status,$hard->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
									<br>				
								</div>
							</div>
							@endif
							<a href="{{url('admin/finishcreate/'.$materi->id_mat)}}" type="button" class="btn btn-success pull-right btn-lg">Finish</a>
			        	</div>			        			
               </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('button#delete').on('click', function(){
        swal({   
        title: "Apa anda yakin?",
        text: "Anda tidak dapat mengembalikan test yang sudah dihapus!", 
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus ini!", 
        closeOnConfirm: false 
        },
        function(){   
            $("#deleteform").submit();
        });
    })

    @if(Session::has('msg'))
        swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
    @endif
</script>

@endsection