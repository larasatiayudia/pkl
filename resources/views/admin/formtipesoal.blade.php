@extends('layout.user')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/grades.css')}}">
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
	  	<li class="completed"><a href="{{url('/materisoal/'.Hashids::encode($materi->id_jabatan,$status))}}">Materi Periode</a></li>
	  	@else
	  	<li class="completed"><a href="{{url('/materisoal/'.Hashids::encode($materi->id_jabatan,$status))}}">Materi In Class</a></li>
	  	@endif
		<li class="active"><a href="javascript:void(0);">Form Tipe Tes</a></li>	
	</ul>

	<div class="row">
		<div class="col-md-3 hidden-xs">
			@include('user.sidenav')
		</div>
		<div class="col-md-9">
			@include('admin.stepadmin')	   	
			   	<div class="panel panel-form">
                    <div class="panel-heading">Pengaturan Tipe Tes</div>
                    	<div class="panel-body">
						<!-- Kalo pretest gaada -->
							@if($pretest==null)
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										 Pre Test
									</h3>

									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">Belum ada pretest</h4>

									<br><br>

									<a href="{{url('/formtest/'.Hashids::encode($materi->id_mat,$materi->status,0))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
									<br>
												
								</div>
							</div>
							<!-- Kalo ada pretest -->
							@else
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h2 class="lead">
										 <b>Pre Test<b>
									</h2>


									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">{{$pretest->nama}}</h4>
									<br><br>
									<form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('/hapustest/'.$pretest->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus</button>
                                    </form>
									<a href="{{url('/formtest/'.Hashids::encode($pretest->materi->id_mat,$status,$pretest->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
									<br>				
								</div>
							</div>
							@endif
							<!-- Kalo posttest gaada -->
							@if($posttest==null)
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										 Post Test
									</h3>

									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">Belum ada posttest</h4>

									<br><br>

									<a href="{{url('/formtest/'.Hashids::encode($materi->id_mat,$materi->status,1))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
									<br>
												
								</div>
							</div>
							<!-- Klo ada posttest -->
							@else
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>							
									</div>
								</div>
								<div class="offer-content">
									<h2 class="lead">
										 <b>Post Test<b>
									</h2>


									<hr style="border-color: green; margin-top: -5px">
									<h4 style="color: green">{{$posttest->nama}}</h4>
									<br><br>
									<form id="deleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('/hapustest/'.$posttest->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus </button>
                                    </form>
									<a href="{{url('/formtest/'.Hashids::encode($posttest->materi->id_mat,$status,$posttest->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
									<br>				
								</div>
							</div>
							@endif
							<a href="{{url('/finishcreate/'.$materi->id_mat)}}" type="button" class="btn btn-success pull-right btn-lg">Finish</a>
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