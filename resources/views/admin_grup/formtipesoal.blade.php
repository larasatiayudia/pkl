@extends('layout.superadmin')
@section('title', 'Tipe Soal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/grades.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@include('admin_grup.sidebar') 


@section('content')
<div class="container-fluid">
    <div class="form-group">
            <div class="col-md-offset-1 col-md-11">
            <div class="row">
			<div class="col-md-12">
				<div class="page-title">
		   			<ol class="breadcrumb judulmenu"><br><br>
			  			<li class="active" style="color:#E5FFCA">
				 		<h3><b><i class="fa fa-alt-list"></i> Test</b></h3>
			  			</li> 
		   			</ol>
				</div>
			</div>
    		</div>
            @include('admin_grup.stepsoal')
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

									<a href="{{url('admin/formtest/'.Hashids::encode($materi->id_mat,$materi->status,0))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
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
									<form id="predeleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('admin/hapustest/'.$pretest->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="predelete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus</button>
                                    </form>
									<a href="{{url('admin/formtest/'.Hashids::encode($pretest->materi->id_mat,$status,$pretest->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
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

									<a href="{{url('admin/formtest/'.Hashids::encode($materi->id_mat,$materi->status,1))}}" class="btn btn-success btn-lg pull-right" style="margin-top: -45px">Buat Soal</a>
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
									<form id="postdeleteform" role="form" method="POST" enctype="multipart/form-data" action="{{url('admin/hapustest/'.$posttest->id_test)}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="postdelete" class="btn btn-danger btn-lg pull-right" style="margin-top: -45px;"><i class="fa fa-trash-o"></i> Hapus </button>
                                    </form>
									<a href="{{url('admin/formtest/'.Hashids::encode($posttest->materi->id_mat,$status,$posttest->tipe_test))}}" class="btn btn-warning btn-lg pull-right" style="margin-top: -45px; margin-right: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
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
	$('button#predelete').on('click', function(){
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
            $("#predeleteform").submit();
        });
    })

    $('button#postdelete').on('click', function(){
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
            $("#postdeleteform").submit();
        });
    })


    @if(Session::has('msg'))
        swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
    @endif
</script>

@endsection