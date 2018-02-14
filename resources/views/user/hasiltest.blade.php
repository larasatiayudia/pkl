@extends('layout.user')

@section('tittle', 'nilai')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/hasiltes.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/stepshort.css')}}">
@endsection

@include('user.navbar')
@section('content')
<div class="container">

    @if($status==1)
      @include('user.stepuser')
    @elseif($status==0)
      @include('user.steptespendek')
    @endif

	<div class="row">
		<div class="col-md-3">
			@include('user.sidenav')
		</div>
	
	<div class="col-md-9">
		
			<div class="panels panel-default">
			  <div class="panel-body" style="background-color: #ccddd8;border: 4px solid #01573C;border-radius: 10px">			  
		  	      <div class="col-md-12">
				          <div class="box1">
				          <h4>{{$attempt->peserta->test->nama}}</h4>
				    	</div>
				  	</div>			  	
				  	<div class="row">	
						  <div class="col-md-offset-3 col-md-6">	
				            <div class="circle-tile">
				                <a href="#">
				                    <div class="circle-tile-heading green">
				                        <i class="fa fa-graduation-cap fa-fw fa-3x"></i>
				                    </div>
				                </a>
				                <div class="circle-tile-content green">
				                    <div class="circle-tile-description text-faded">
				                        <font size="5">Nilai Anda</font>
				                    </div>
				                    <div class="circle-tile-number text-faded">
				                        <font size="6">{{$attempt->nilai}}</font>
				                    </div>
				                    <a href="#" class="circle-tile-footer" data-toggle="modal" data-target="#infotes">Informasi Tes <i class="fa fa-chevron-circle-right"></i></a>
				                </div>
				            </div>
				            @if($selisih <= 0 && $status!=2)
				            <a href="{{url('/review/'.Hashids::encode($attempt->id_attempt))}}" class="btn btn-success col-md-12 col-xs-12"> Pratinjau</a>
				          	@elseif($sisa>0&&$status==1)
				          	<a href="{{url('/deskripsimateri/'.Hashids::encode($attempt->peserta->test->materi->id_mat,$status))}}" class="btn btn-success col-md-12 col-xs-12"> Kembali ke tes ini</a>
				          	@elseif($sisa>0&&$status==0)
				          	<a href="{{url('/deskripsitest/'.Hashids::encode($attempt->peserta->test->materi->id_mat,$status))}}" class="btn btn-success col-md-12 col-xs-12"> Kembali ke tes ini</a>
				          	@elseif($sisa>0&&$status==2)
										<a href="{{url('/deskripsitesbonus/'.Hashids::encode($attempt->peserta->test->id_test))}}" class="btn btn-success col-md-12 col-xs-12"> Kembali ke tes ini</a>
										@endif
				          </div>
			         </div>
			  </div>
			</div>

		

	</div>
	</div>
</div>

<div class="modal fade" id="infotes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #01573C">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: white">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: white">Informasi Tes</h4>
      </div>
      <div class="modal-body">
      	<ul><h3 style="margin-left: -30px"> Informasi Tes</h3>
	        <li><p>Tes akan ditutup pada <b>{{Date::parse($attempt->peserta->test->waktu_tutup)->format('l,d F Y H:i')}} WIB</b></p></li>
			<li><p>Nilai nilai anda dinyatakan lulus jika telah mencapai <b>{{$attempt->peserta->test->passing_grade}}</b></p></li>
			<li><p>Sisa attempt ada sebanyak <b>{{$attempt->peserta->sisa_attempt}}</b> kali</p></li>
		</ul>
		<ul><h3 style="margin-left: -30px"> Informasi Penilaian</h3>
      		<li><h4>Anda dinyatakan 
      		@if($attempt->nilai >= $attempt->peserta->test->passing_grade)
      		<b>LULUS</b>
      		@else
      		<b>TIDAK LULUS</b>
      		@endif
      		</h4></li>
      	</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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