@extends('layout.user')

@section('tittle', 'Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/grades.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="active"><a href="javascript:void(0)">Bonus Tes</a></li>
	</ul>


	<div class="row">
		<div class="col-sm-4 col-md-3">
		    @include('user.sidenav')
		</div>
	
		
			<div class="col-md-9">
			   	<div class="thumbnail">
             			<div class="container-fluid">
    						@foreach($materis as $index=>$materi)         				
							<div class="offer offer-success">
								<div class="offer-content">
									<div class="row">
										<div class="col-md-10 col-xs-12">
											<h3 class="lead"><img src="{{URL::asset('img/exam.svg')}}" style="width: 30px"> {{$materi->nama_test}}</h3>
											<hr  style="border: 2px solid #01573C; margin-top: -5px">
											<div class="panel panel-form">
											    <div class="panel-heading">
											        <h4 class="panel-title" >
											            <a data-toggle="collapse" data-parent="#accordion" href="#deskripsiPanel-{{$index}}">Deskripsi Materi</a>
											            <span id="tomboldeskripsi-{{$index}}" class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#deskripsiPanel-{{$index}}">
											                <i class="glyphicon glyphicon-chevron-down"></i>
											            </span>
											        </h4>
												</div>
											    <div id="deskripsiPanel-{{$index}}" class="panel-collapse panel-collapse collapse">
											        <div class="panel-body">
											            {{$materi->deskripsi}}
											        </div>
												</div>
											</div>
											<div class="panel panel-form">
												<div class="panel-heading">
											        <h4 class="panel-title" >
											            <a data-toggle="collapse" data-parent="#accordion" href="#modulPanel-{{$index}}">Bahan bacaan Materi</a>
											            <span id="tombolmodul-{{$index}}" class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#modulPanel-{{$index}}">
											                <i class="glyphicon glyphicon-chevron-down"></i>
											            </span>
											        </h4>
											    </div>

												<div id="modulPanel-{{$index}}" class="panel-collapse panel-collapse collapse">
											        <div class="panel-body">
											          	<ul>
														  	@foreach($materi->modul as $modul)
											          		<li><a href="{{URL::asset('/modul/'.$modul->id_mat.'/'.$modul->file)}}" target="_blank">{{$modul->file}}</a>
															@if($modul->status==2)
															(Easy)
															@elseif($modul->status==3)
															(Medium)
															@else
															(Hard)
															@endif
															</li>
															@endforeach
											          	</ul>
											        </div>
												</div>
											</div>
										</div>
										<div class="col-md-2 hidden-xs">
										@foreach($materi->test->sortBy('tipe_test') as $test)
											@if($test->tipe_test == 2)
											<a href="{{url('/deskripsitesbonus/'.Hashids::encode($test->id_test))}}">
											<button type="button" class="btn btn-success btn-circle" style="margin-top: 20px;margin-bottom: 10px; margin-left: -10px"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></button></a>
											<b class="text-success" style="margin-left: 10px">Easy</b>
											@elseif($test->tipe_test == 3)
											<a href="{{url('/deskripsitesbonus/'.Hashids::encode($test->id_test))}}">
												<button type="button" class="btn btn-warning btn-circle" style="margin-bottom: 10px; margin-left: -10px"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></button>
											</a>
											<b class="text-warning" style="margin-left: 5px">Medium</b>
											@elseif($test->tipe_test == 4)
											<a href="{{url('/deskripsitesbonus/'.Hashids::encode($test->id_test))}}">
											<button type="button" class="btn btn-danger btn-circle" style="margin-bottom: 5px; margin-left: -10px"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></button></a>
											<b class="text-danger" style="margin-left: 10px">Hard</b>
											@endif
										@endforeach
										</div>
											<!-- level di mobile -->
											<center>
											<div class="row visible-xs container-fluid">
											@foreach($materi->test as $test)
												<div class=" col-xs-4">
													@if($test->tipe_test == 2)
													<button type="button" class="btn btn-success btn-circle"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></i></button><br>
													<b class="text-success">Easy</b>
													@elseif($test->tipe_test == 3)
													<button type="button" class="btn btn-warning btn-circle"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></button><br>
													<b class="text-warning">Medium</b>
													@else
													<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-pencil fa-3x" aria-hidden="true"></i></button><br>
													<b class="text-danger">Hard</b>
													@endif
												</div>
											@endforeach
											</div>
											</center>
										
										

									</div>			
								</div>
							</div>
							@endforeach
							{{$materis->links()}}
						</div>

			        </div>			        			
         
		     </div>
		   
	
	</div>
</div>

<script type="text/javascript">
    @foreach($materis as $index=>$materi)
    $("#deskripsiPanel-{{$index}}").on("hide.bs.collapse", function () {
        $("#tomboldeskripsi-{{$index}}").find('i').removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
    });

    $("#deskripsiPanel-{{$index}}").on("show.bs.collapse", function () {
        $("#tomboldeskripsi-{{$index}}").find('i').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    });

	$("#modulPanel-{{$index}}").on("hide.bs.collapse", function () {
        $("#tombolmodul-{{$index}}").find('i').removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
    });

    $("#modulPanel-{{$index}}").on("show.bs.collapse", function () {
        $("#tombolmodul-{{$index}}").find('i').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    });
    @endforeach
</script>



@endsection