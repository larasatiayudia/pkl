@extends('layout.user')

@section('tittle', 'Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/jangkapendek">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
<br>
	<div class="row">
		<div class="col-sm-4 col-md-3 sidebar">
		    <div class="mini-submenu">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		    </div>
		    <div class="list-group">
		        <span href="#" class="list-group-item active">
		            Submenu
		        </span>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-comment-o"></i> Lorem ipsum
		        </a>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-search"></i> Lorem ipsum
		        </a>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-user"></i> Lorem ipsum
		        </a>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
		        </a>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-bar-chart-o"></i> Lorem ipsumr <span class="badge">14</span>
		        </a>
		        <a href="#" class="list-group-item">
		            <i class="fa fa-envelope"></i> Lorem ipsum
		        </a>
		    </div>        
		</div>
	
		<div class="col-md-9">
			<div class="panel panel-primary">
		      <div class="panel-heading">
		        List User
		      </div>
		        <div class="panel-body">
		        	<div class="panel panel-success" style="border: 2px solid #01573C;border-radius: 5px ">
		        		<div class="panel-heading" >
		        		<div class="row">
			              	 <div class="col-md-1">
			              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
			              	 </div>
			                <div class="col-xs-8 padding-left-0">
			                  <h4 class="media-heading" style="margin-top: 10px" data-toggle="modal" data-target="#myModal">ARIP</h4>
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
							<form class="form-horizontal">
					    		<div class="form-group">
						      		<label for="inputEmail3" class="col-sm-2 control-label">Password</label>
								    <div class="col-sm-10">
								      <input type="email" class="form-control" id="inputEmail3" placeholder="Password">
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
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary">Save changes</button>
					      </div>
					    </div>
					  </div>
					</div>



		        	<div class="panel panel-danger" style="border: 2px solid #b40202;border-radius: 5px ">
		        		<div class="panel-heading" >
		        		<div class="row">
			              	 <div class="col-md-1">
			              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
			              	 </div>
			                <div class="col-xs-8 padding-left-0">
			                  <h4 class="media-heading" style="margin-top: 10px">ARIP</h4>
			                </div>
			             </div>
			             
			        	</div>
		        	</div>

		          <!-- <div class="well shadow-z-1">
		            <div class="media">
		              <a href="#" class="pull-left">
		                <img src="" style="max-width: 100px; max-height: 100px; font-size: 4em">
		              </a>
		              <div class="media-body">
		              	 <div class="col-md-1">
		              	 	<img src="{{asset('img/exam.png')}}" style="width: 50px; height: 50px">
		              	 </div>
		                <div class="col-xs-8 padding-left-0">
		                  <h4 class="media-heading" style="margin-top: 10px">ARIP</h4>
		                </div>

		              </div>
		            </div>
		          </div> -->
		        </div>
		       </div>
		   
		</div>
	</div>
</div>

@endsection