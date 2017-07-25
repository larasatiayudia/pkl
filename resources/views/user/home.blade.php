@extends('layout.user')

@section('title', 'Refreshment Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/home.css">
@endsection

@include('user.navbar')

@section('content')
<div class="container"> 

		<!-- PC -->
      <div class="row" style="padding-right: 50px">
	      <div class="col-lg-offset-3 col-lg-4 visible-lg">
	        <div class="circle">
	          <a href="#" data-toggle="modal" data-target="#myModal"><h2 style="margin-top: 40px">QUIZ</h2></a>
	        </div>
	      </div>
	     


	      <div class="col-lg-4 visible-lg">
	        <div class="circle">
	          <a href="#"><h4>4<small>th</small><p>Title</p></h4></a>
	        </div>
	      </div>
      </div>
      <div class="row" style="padding-right: 50px">
	      <div class="col-lg-offset-3 col-lg-4 visible-lg">
	        <div class="circle">
	          <a href="#"><h4>4<small>th</small><p>Title</p></h4></a>
	        </div>
	      </div>
	      <div class="col-lg-4 visible-lg">
	        <div class="circle">
	          <a href="#"><h4>4<small>th</small><p>Title</p></h4></a>
	        </div>
	      </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-offset-2 col-md-4">
        		<a href="/jangkapendek" type="button" class="btn btn-primary btn-circle btn-xl" style="margin-bottom: 20px;margin-right: 10px"><i class="glyphicon glyphicon-heart"></i></a><br>
        		<font face="roboto" size="4">Jangka Pendek</font>
        	</div>
        	<div class="col-md-4">
        		<button type="button" class="btn btn-primary btn-circle btn-xl" style="margin-bottom: 20px;margin-left: 20px"><i class="glyphicon glyphicon-heart"></i></button>
        		<font face="roboto" size="4" style="text-align: center; margin-left: 30px">Jangka Panjang</font>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

      <!-- mobile -->
      <div class="row">
	      <div class="col-xs-6 visible-xs">
	        <div class="circlexs">
	          <a href="#"><h4>4<small>th</small><p>Title</p></h4></a>
	        </div>
	      </div>
      </div>
</div>
@endsection
