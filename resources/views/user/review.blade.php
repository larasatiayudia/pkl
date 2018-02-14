@extends('layout.user')

@section('title', 'Review')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/soal.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="completed"><a href="{{url('/nilai')}}">Daftar Nilai</a></li>
		<li class="completed"><a href="{{redirect()->back()->getTargetUrl()}}">{{$gradings[0]->test->nama}}</a></li>
		<li class="active"><a href="javascript:void(0);">Review</a></li>
	</ul>

	<div class="row">
		<div class="col-md-4" style="text-align: center">
			<div class="panels panel-default">
				<div class="panel-body" style="background-color: #BBF68E; border: 5px solid #01573C;border-radius: 40px;padding: 10px">
					<h3 class="text-success">Review {{$gradings[0]->test->nama}} </h3><br>
				</div>
			</div>
		</div>
	</div>
	<!-- panel navigasi -->
	
	<div class="row">
		<div class="col-md-2 visible-lg" style="position: fixed;">
			<div class="panels panel-default">
			  <div class="panel-body" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 10px; margin-right: -15px" >
			    <h4 class="text-success">Review Navigation</h4>
			    <div class="row" >
			    	@foreach($gradings as $index => $grading)
			    	<div class="col-md-1" style="margin-left: 5px">
			    		<a href="#{{$index+1}}" type="button" class="btn btn-success" style="margin-bottom: 10px; height: 30px; width: 30px"><span style="text-align: center; margin-left: -3px">{{$index+1}}</span></a>
			    	</div>
			    	@endforeach
			    </div>
			  </div>
			</div>
		</div>
	

	</div>
	@foreach($gradings as $index => $grading)
	<!-- panel nomor -->
	<div class="row">	
		<div class="col-md-offset-2 col-md-1 visible-lg">
			<div class="panel panel-warning" style="margin-left: 40px;">
			  <div class="panel-heading" style="margin-right: -60px; border: 2px solid #eeaa00;border-radius: 5px">
			    <h4 class="text-warning" style="margin-left: 10px">{{$index+1}}</h4>
			  </div>
			</div>
		</div>
		<!-- panel soal -->
		<div class="col-md-9 col-xs-12">
			<div class="panels panel-default">
			  <div class="panel-body"  id="{{$index+1}}" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 40px;"><br>
			  	<div class="row">
<!-- 			  	<div class="col-md-3">
			  			<img src="{{ asset('img/barca.jpg') }}" style="height: 180px;width: 240px">
			  		</div>
				    <div class="col-md-9">
				    	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				    </div>
			    </div> -->
			    
			    <!-- nomor untuk mobile -->
			   		<div class=" col-xs-8 visible-xs" style="text-align: center; margin-left: 50px">
						<div class="panel panel-warning">
						  <div class="panel-heading" style="border: 2px solid #eeaa00;border-radius: 5px">
						    <h4 class="text-warning">Question {{$index+1}}</h4>
						  </div>
						</div>
					</div>
				    <div class="col-md-12 col-xs-12">
				    {!!$grading->soal->soal!!}
				    </div>			   
			    </div> <br>

			    <div data-toggle="buttons">
			    @if($grading->status == 1 && $grading->selected_ans == 'a')
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-success active disabled" style="height: 33px"> A
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-success">
							  <div class="panel-heading" style=" border: 2px solid #01573C;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_a!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_a!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>

				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@elseif($grading->status == 0 && $grading->selected_ans == 'a')
				   	 <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-danger active disabled" style="height: 33px"> A
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-danger">
							  <div class="panel-heading" style=" border: 2px solid #b40202;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_a!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_a!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@else
					<div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning disabled" style="height: 33px"> A
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid #F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">{!!$grading->soal->opsi_a!!}</font>
							  </div>
							</div>
				    	</div>
				    </div>
				@endif
				@if($grading->status == 1 && $grading->selected_ans == 'b')
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-success active disabled" style="height: 33px"> B
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-success">
							  <div class="panel-heading" style=" border: 2px solid #01573C;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_b!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_b!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@elseif($grading->status == 0 && $grading->selected_ans == 'b')
				   	 <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-danger active disabled" style="height: 33px"> B
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-danger">
							  <div class="panel-heading" style=" border: 2px solid #b40202;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_b!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_b!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@else
					<div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning disabled" style="height: 33px"> B
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid #F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">{!!$grading->soal->opsi_b!!}</font>
							  </div>
							</div>
				    	</div>
				    </div>
				@endif
				@if($grading->status == 1 && $grading->selected_ans == 'c')
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-success active disabled" style="height: 33px"> C
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-success">
							  <div class="panel-heading" style=" border: 2px solid #01573C;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_c!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_c!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@elseif($grading->status == 0 && $grading->selected_ans == 'c')
				   	 <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-danger active disabled" style="height: 33px"> C
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-danger">
							  <div class="panel-heading" style=" border: 2px solid #b40202;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_c!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_c!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@else
					<div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning disabled" style="height: 33px"> C
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid #F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">{!!$grading->soal->opsi_c!!}</font>
							  </div>
							</div>
				    	</div>
				    </div>
				@endif
				@if($grading->status == 1 && $grading->selected_ans == 'd')
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-success active disabled" style="height: 33px"> D
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-success">
							  <div class="panel-heading" style=" border: 2px solid #01573C;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_d!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_d!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@elseif($grading->status == 0 && $grading->selected_ans == 'd')
				   	 <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-danger active disabled" style="height: 33px"> D
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-danger">
							  <div class="panel-heading" style=" border: 2px solid #b40202;border-radius: 3px;padding: 5px">
							    <font class="hidden-xs" size="2">{!!$grading->soal->opsi_d!!}</font>
							    <div class="row visible-xs">
							    	<div class="col-xs-10">
							    		<font size="2">{!!$grading->soal->opsi_d!!}</font>
							    	</div>
							    	<div class="col-xs-2">
							    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; padding: auto;">
							    	</div>
							    </div>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1 hidden-xs">
				    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				@else
					<div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning disabled" style="height: 33px"> D
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid #F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">{!!$grading->soal->opsi_d!!}</font>
							  </div>
							</div>
				    	</div>
				    </div>
				@endif					   
				  </div>
				</div>
			</div>	
		</div>
		</div>
		<!-- panel jawaban benar -->
		<div class="row">
			<div class="col-md-offset-3 col-md-9">
				<div class="panels panel-default">
				  <div class="panel-body" style="background-color: #eff68e; border: 2px solid#bfc471;border-radius: 20px;">
				    Jawaban yang benar adalah : <br>
				    <b>
				    {{strtoupper($grading->soal->kunci_jawaban)}}.
				    @if($grading->soal->kunci_jawaban == 'a')
				    {!!$grading->soal->opsi_a!!}
				    @elseif($grading->soal->kunci_jawaban == 'b')
				    {!!$grading->soal->opsi_b!!}
				    @elseif($grading->soal->kunci_jawaban == 'c')
				    {!!$grading->soal->opsi_c!!}
				    @elseif($grading->soal->kunci_jawaban == 'd')
				    {!!$grading->soal->opsi_d!!}
				    @endif
				    </b>
				  </div>
				</div>
			</div>
		</div>
		@endforeach
</div>

<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
    <i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>

<script type="text/javascript">
$('a[href^="#"]').click(function() {
$('html,body').animate({ scrollTop: $(this.hash).offset().top}, 500);
return false;
e.preventDefault();
});
</script>
<script type="text/javascript">
	$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});
</script>

@endsection