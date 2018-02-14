@extends('layout.user')

@section('title', 'Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/soal.css')}}">
@endsection


@include('user.navbar')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h3 class="text-success">Nama Test</h3><br>
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-success btn-lg pull-right" id="finish"><i class="fa fa-check-circle" aria-hidden="true"></i> Finish</a>
		</div>
	</div>
	<!-- panel navigasi -->
	<div class="row">
		<div class="col-md-2 visible-lg" style="position: fixed;">
			<div class="panels panel-default">
			  <div class="panel-body" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 10px; margin-right: -20px" >
			    <h4 class="text-success">Test Navigation</h4>
			    <div class="row" >
			    	
			    	<div class="col-md-1" style="margin-left: 5px">
					
			    			<a href="" id="" type="button" class="btn btn-warning" style="margin-bottom: 10px; height: 30px; width: 30px"><span style="text-align: center; margin-left: -3px">1</span></a>

			    
			    </div>
			    <span id="countdown"></span><br>
			    
			  </div>
			  <a href="#finish" class="text-success"> Finish </a>
			</div>
		</div>

	</div>

	<!-- panel nomor soal -->
	<div class="row">
		<div class="col-md-offset-2 col-md-1 visible-lg">
			<div class="panel panel-warning" style="margin-left: 40px;">
			  <div class="panel-heading" style="margin-right: -60px; border: 2px solid #eeaa00;border-radius: 5px; ">
			    <h4 class="text-warning" style="margin-left: 10px">1</h4>
			  </div>
			</div>
		</div>
		<!-- panel soal -->
		<div class="col-md-9 col-xs-12">
			<div class="panels panel-default">
			  <div class="panel-body" id="" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 40px;"><br>
			  	<div class="row">
				<!-- kondisi kalo dalem soal ada gambar
 			  	<div class="col-md-3">
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
						  <div class="panel-heading" style="background-color: #eeaa00;border: 2px solid #eeaa00;border-radius: 5px">
						    <h4 class="text-warning">Question 1</h4>
						  </div>
						</div>
					</div>

					<!-- soal dan PG buat PC dan mobile -->
				    <div class="col-md-12 col-xs-12">
						Soalnya
				    </div>			   
			    </div> <br>
			    <input type="text" value="" id="soal" hidden>
			    <div data-toggle="buttons">
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    
				    		<button class="btn btn-warning" style="height: 33px" value="a" data-id="" data-nomor="" onclick="submit(this);">

				    			<input type="radio" id="optiona" autocomplete="off" hidden> A
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</button>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">isi pilihan a</font>
							  </div>
							</div>
				    	</div>
				    </div>
				   
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		
				    		<button class="btn btn-warning" style="height: 33px" value="b" data-id="" data-nomor="" onclick="submit(this);">

				    			<input type="radio" id="option2" autocomplete="off" hidden> B
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</button>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">Isi pilihan b</font>
							  </div>
							</div>
				    	</div>
				    </div>

				    <div class="row">
				    	<div class="col-md-1 col-xs-2">

				    		<button class="btn btn-warning" style="height: 33px" value="c" data-id="" data-nomor="" onclick="submit(this);">

				    			<input type="radio" id="option2" autocomplete="off" hidden> C
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</button>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">isi pilihan c</font>
							  </div>
							</div>
				    	</div>
				    </div>

				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<button class="btn btn-warning" style="height: 33px" value="d" data-id="" data-nomor="" onclick="submit(this);">

				    			<input type="radio" id="option2" autocomplete="off" hidden> D
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</button>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">isi jawaban d</font>
							  </div>
							</div>
				    	</div>
				    </div>
				  </div>
				</div>
			</div>	
		</div>
	</div>


</div>

<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
    <i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>

<input type="text" id="test" value="" hidden>
<input type="text" id="attempt" value="" hidden>

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

<script>
	window.onbeforeunload = function(e) {
		e.preventDefault();
		var dialogText = 'Jika anda keluar maka anda dinyatakan selesai mengerjakan tes. Apa anda yakin?';
		return dialogText;
	};
</script>

@endsection