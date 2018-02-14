@extends('layout.user')

@section('tittle', 'nilai')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/hasiltes.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/stepshort.css')}}">
@endsection

@include('user.navbar')
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-3">
			@include('user.sidenav')
		</div>
	
	<div class="col-md-9">
		
			<div class="panels panel-default">
			  <div class="panel-body" style="background-color: #ccddd8;border: 4px solid #01573C;border-radius: 10px">			  
		  	      <div class="col-md-12">
				          <div class="box1">
				          <h4>Nama tes</h4>
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
				                        <font size="6">90</font>
				                    </div>
				                    <a href="#" class="circle-tile-footer" data-toggle="modal" data-target="#infotes">Informasi Tes <i class="fa fa-chevron-circle-right"></i></a>
				                </div>
				            </div>				      
				          	<a href="" class="btn btn-success col-md-12 col-xs-12"> Kembali ke tes ini</a>

				          
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
	        <li><p>Tes akan ditutup pada <b> WIB</b></p></li>
			<li><p>Nilai nilai anda dinyatakan lulus jika telah mencapai <b>70</b></p></li>
			<li><p>Sisa attempt ada sebanyak <b>1</b> kali</p></li>
		</ul>
		<ul><h3 style="margin-left: -30px"> Informasi Penilaian</h3>
      		<li><h4>Anda dinyatakan 
      		
      		<b>LULUS</b>

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