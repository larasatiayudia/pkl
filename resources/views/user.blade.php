@extends('layout.superadmin')
@section('title', 'Super Admin')

@include('superadmin.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="/css/user.css">
@endsection

@section('content')
<div class="container">
<div class="row">
<div class="col-md-10">
		    <form class="form-inline">
               
               	<div class="form-group">
               		<div class="input-group">
               			<div class="row">
               				<div class="col-md-2">
		               			<select class="form-control">
		               				<option>test</option>
		               				<option>test</option>
		               			</select>
		               		</div>
		               		<div class="col-md-10">             		
		               			<input type="text" class="form-control" placeholder="Text input" >
		               			<a class="btn btn-default" href="#" role="button">Search</a>
		               		</div>
	               			
               			</div>
	            	</div>
	            </div>   		
               	
              
            </form>
            </div>
            </div>

</div>

		<div>



  	<footer class="pull-left footer">
  		<p class="col-md-12">
  			<hr class="divider">
  				Copyright &COPY; 2015
  		</p>
  	</footer>

  	

@endsection
