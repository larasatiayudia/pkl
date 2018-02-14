@extends('layout.user')

@section('tittle', 'Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		@if($status)
	  	<li class="active"><a href="javascript:void(0);">Materi Periode</a></li>
	  	@else
	  	<li class="active"><a href="javascript:void(0);">Materi In Class</a></li>
	  	@endif
	</ul>


	<div class="row">
		<div class="col-sm-4 col-md-3">
		    @include('user.sidenav')
		</div>
	
		<div class="col-md-9">
			<div class="panel panel-form">
		      <div class="panel-heading">
		        @if($status)
		        	Materi Periode
		        @else
		        	Materi In Class
		        @endif
		      </div>
		        <div class="panel-body">
		        	@foreach($materis as $index => $materi)
							<!-- Buat yg blm enroll -->
	        		@if(!$enrollstatus[$index])
								<!-- Buat yg waktu tutup nya masih lama -->
	        			@if($array[$index]>0)
				        	<div class="panel panel-success" style="border: 2px solid #01573C;border-radius: 5px ">
				        		<div class="panel-heading" >
				        		<div class="row">
					              	 <div class="col-md-1 col-xs-2">
					              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
					              	 </div>
					                <div class="col-md-6 col-xs-10">
														<!-- Klo testnya udh dibuka -->
					                  @if($buka[$index]<=0)
					                  <a href="#" data-id="{{$materi->id_mat}}" data-nama="{{$materi->nama_test}}" style="color: #01573C"  data-toggle="modal" data-target="#myModal"><h4 class="media-heading" style="margin-top: 15px" id="2">{{$materi->nama_test}}</h4></a>
					                  @else
					                  <h4 class="media-heading" style="margin-top: 15px" id="2">{{$materi->nama_test}}</h4>
					                  @endif
					                </div>
					                <div class="col-md-5 col-xs-12" style="margin-top: 10px">
						                	<p>Mulai : {{Date::parse($materi->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						                	<p>Berakhir : {{Date::parse($materi->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>
					                </div>
					             </div>
					             
					        	</div>
				        	</div>

				        	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
							      </div>
							      <div class="modal-body">
									<form class="form-horizontal" id="enrollform" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/enroll') }}">
										<div class="form-group">
										    <div class="col-sm-10" hidden>
										      <input name="id_mat" type="text" class="form-control" id="id_mat">
										    </div>
								      	</div>
							    		<div class="form-group">
								      		<label class="col-sm-2 control-label">Password</label>
										    <div class="col-sm-10">
										      	<input name="enroll" type="password" class="form-control" placeholder="Password">
										    </div>
								      	</div>
								      	{{ csrf_field() }}
								      <div class="form-group">
									    <div class="col-sm-offset-2 col-sm-10">
									      <button type="submit" class="btn btn-primary">Submit</button>
									    </div>
									  </div>
							      	</form>
							      </div>
							      <div class="modal-footer">
							        
							      </div>
							    </div>
							  </div>
							</div>
		        		@else		        		
				        	<div class="panel panel-danger" style="border: 2px solid #b40202;border-radius: 5px ">
				        		<div class="panel-heading" >
				        		<div class="row">
					              	 <div class="col-md-1 col-xs-2">
					              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
					              	 </div>
					                <div class="col-md-6 col-xs-10">
														@if($status)
					                  <a href="#" data-id-2="{{$materi->id_mat}}" data-nama-2="{{$materi->nama_test}}" style="color: #b40202" data-toggle="modal" data-target="#myModal2"><h4 class="media-heading" style="margin-top: 15px" >{{$materi->nama_test}}</h4></a>
														@else
														<h4 class="media-heading" style="margin-top: 15px" id="2">{{$materi->nama_test}}</h4>
														@endif
													</div>
					                <div class="col-md-5 col-xs-12" style="margin-top: 10px">
						                <p>Mulai : {{Date::parse($materi->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						                <p>Berakhir : {{Date::parse($materi->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>
					                </div>
					             </div>
					             
					        	</div>
				        	</div>

							<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
							      </div>
							      <div class="modal-body">
									<form class="form-horizontal" id="enrollform" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/enroll') }}">
									{{ csrf_field() }}
										<div class="form-group" hidden>
										    <div class="col-sm-10">
										      <input name="id_mat" type="text" class="form-control" id="id_mat2">
										    </div>
								      	</div>
							    		<div class="form-group">
								      		<label class="col-sm-2 control-label">Password</label>
										    <div class="col-sm-10">
										      	<input name="enroll" type="password" class="form-control" placeholder="Password">
										    </div>
								      	</div>
								      <div class="form-group">
									    <div class="col-sm-offset-2 col-sm-10">
									      <button type="submit" class="btn btn-primary">Submit</button>
									    </div>
									  </div>
							      	</form>
							      </div>
							      <div class="modal-footer">
							        
							      </div>
							    </div>
							  </div>
							</div>
						@endif

					@else
						@if($array[$index]>0)
							<div class="panel panel-success" style="border: 2px solid #01573C;border-radius: 5px ">
					        		<div class="panel-heading" >
					        		<div class="row">
						              	 <div class="col-md-1 col-xs-2">
						              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
						              	 </div>
						                <div class="col-md-6 col-xs-10">
						                  @if($buka[$index]<=0)
							               		<a href="{{url('/deskripsimateri/'.Hashids::encode($materi->id_mat,$status))}}" style="color: #01573C"><h4 class="media-heading" style="margin-top: 15px"> {{$materi->nama_test}} </h4></a>
						                  @else
																<h4 class="media-heading" style="margin-top: 15px"> {{$materi->nama_test}} </h4>
						                  @endif
						                </div>
						                <div class="col-md-5 col-xs-12" style="margin-top: 10px">
						                	<p>Mulai : {{Date::parse($materi->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						                	<p>Berakhir : {{Date::parse($materi->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>
					                	</div>
						             </div>
						             
						        	</div>
					        </div>
					    @else
						    <div class="panel panel-danger" style="border: 2px solid #b40202;border-radius: 5px ">
					        		<div class="panel-heading" >
					        		<div class="row">
						              	 <div class="col-md-1 col-xs-2">
						              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
						              	 </div>
						                <div class="col-md-6 col-xs-10">
														@if($status)
						                  <a href="{{ url('/deskripsimateri/'.Hashids::encode($materi->id_mat,$status)) }}" style="color: #b40202" ><h4 class="media-heading" style="margin-top: 15px" >{{$materi->nama_test}}</h4></a>
						                @else
															<h4 class="media-heading" style="margin-top: 15px" id="2">{{$materi->nama_test}}</h4>
														@endif
														</div>
						                <div class="col-md-5 col-xs-12" style="margin-top: 10px">
						                	<p>Mulai : {{Date::parse($materi->waktu_buka)->format('l,d F Y H:i')}} WIB</p>
						                	<p>Berakhir : {{Date::parse($materi->waktu_tutup)->format('l,d F Y H:i')}} WIB</p>
					                	</div>
						             </div>
						             
						        	</div>
					        	</div>
					    @endif
					@endif
				@endforeach

		        	{{ $materis->links() }}

		        </div>
		       </div>
		   
		</div>
	</div>
</div>

<script>

    $('#myModal').on('show.bs.modal', function(event) {
		    var link = $(event.relatedTarget);
		    var id = link.data('id');
		    var nama = link.data('nama');
		    var status = link.data('status');

		    var modal = $(this);
		    modal.find('#myModalLabel').text('Enroll to ' + nama);
		    modal.find('#id_mat').val(id);
		    modal.find('#status').val(status);
	});

	$('#myModal2').on('show.bs.modal', function(event) {
		    var link = $(event.relatedTarget);
		    var id = link.data('id-2');
		    var nama = link.data('nama-2');
		   	var status = link.data('status-2');

		    var modal = $(this);
		    modal.find('#myModalLabel2').text('Enroll to ' + nama);
		    modal.find('#id_mat2').val(id);
		    modal.find('#status2').val(status);
	});

  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif

</script>
@endsection