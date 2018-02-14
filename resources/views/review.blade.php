@extends('layout.user')

@section('title', 'Review')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/soal.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<h3 class="text-success">REVIEW - NAMA TEST</h3><br>
	<div class="row">
		<div class="col-md-2 col-xs-12">
			<div class="panels panel-default">
			  <div class="panel-body" style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 10px;">
			    Basic panel example
			  </div>
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="col-md-offset-2 col-md-1 visible-lg">
			<div class="panel panel-warning" style="margin-left: 40px;">
			  <div class="panel-heading" style="background-color: #eeaa00;margin-right: -60px; border: 2px solid #eeaa00;border-radius: 5px">
			    <h4 class="text-warning" style="margin-left: 10px">1</h4>
			  </div>
			</div>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="panels panel-default">
			  <div class="panel-body"  style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 40px;"><br>
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
						  <div class="panel-heading" style="background-color: #eeaa00;border: 2px solid #eeaa00;border-radius: 5px">
						    <h4 class="text-warning">Question 1</h4>
						  </div>
						</div>
					</div>
				    <div class="col-md-12 col-xs-12">
				    	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    </div>			   
			    </div> <br>

			    <div data-toggle="buttons">
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-danger" style="height: 33px">
				    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> A
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-danger">
							  <div class="panel-heading" style=" border: 2px solid #b40202;border-radius: 3px;padding: 5px">
							    <font size="2">Basic panel example</font>
							  </div>
							</div>
				    	</div>
				    	<div class="col-md-1">
				    		<img src="{{asset('img/cross.png')}}" style="width: 30px; height: 30px;margin-left: -20px; margin-top: 2px">
				    	</div>
				    </div>
				   
				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning" style="height: 33px">
				    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> B
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">Basic panel example</font>
							  </div>
							</div>
				    	</div>
				    </div>

				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning" style="height: 33px">
				    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> C
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">Basic panel example</font>
							  </div>
							</div>
				    	</div>
				    </div>

				    <div class="row">
				    	<div class="col-md-1 col-xs-2">
				    		<div class="btn btn-warning" style="height: 33px">
				    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> D
								<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
				    		</div>
				    	</div>
				    	<div class="col-md-8 col-xs-10">
				    		<div class="panel panel-warning">
							  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
							    <font size="2">Basic panel example</font>
							  </div>
							</div>
				    	</div>
				    </div>			   
				  </div>
				</div>
			</div>	
		</div>
		</div>
		<div class="row">
			<div class="col-md-offset-3 col-md-9">
				<div class="panels panel-default">
				  <div class="panel-body" style="background-color: #eff68e; border: 2px solid#bfc471;border-radius: 20px;padding-bottom: 100px">
				    Basic panel example
				  </div>
				</div>
			</div>
		</div>

		<div class="row">	
			<div class="col-md-offset-2 col-md-1 visible-lg">
				<div class="panel panel-warning" style="margin-left: 40px;">
				  <div class="panel-heading" style="background-color: #eeaa00;margin-right: -60px; border: 2px solid #eeaa00;border-radius: 5px">
				    <h4 class="text-warning" style="margin-left: 10px">1</h4>
				  </div>
				</div>
			</div>
			<div class="col-md-9 col-xs-12">
				<div class="panels panel-default">
				  <div class="panel-body"  style="background-color: #BBF68E; border: 2px solid #01573C;border-radius: 40px;"><br>
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
							  <div class="panel-heading" style="background-color: #eeaa00;border: 2px solid #eeaa00;border-radius: 5px">
							    <h4 class="text-warning">Question 1</h4>
							  </div>
							</div>
						</div>
					    <div class="col-md-12 col-xs-12">
					    	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					    </div>			   
				    </div> <br>

				    <div data-toggle="buttons">
					    <div class="row">
					    	<div class="col-md-1 col-xs-2">
					    		<div class="btn btn-warning" style="height: 33px">
					    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> A
									<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
					    		</div>
					    	</div>
					    	<div class="col-md-8 col-xs-10">
					    		<div class="panel panel-warning">
								  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
								    <font size="2">Basic panel example</font>
								  </div>
								</div>
					    	</div>
					    </div>
					   
					    <div class="row">
					    	<div class="col-md-1 col-xs-2">
					    		<div class="btn btn-success" style="height: 33px">
					    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> B
									<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
					    		</div>
					    	</div>
					    	<div class="col-md-8 col-xs-10">
					    		<div class="panel panel-success">
								  <div class="panel-heading" style=" border: 2px solid #01573C;border-radius: 3px;padding: 5px">
								    <font size="2">Basic panel example</font>
								  </div>
								</div>
					    	</div>
					    	<div class="col-md-1">
					    		<img src="{{asset('img/check.png')}}" style="width: 30px; height: 30px; margin-left: -20px; margin-top: 2px">
					    	</div>
					    </div>

					    <div class="row">
					    	<div class="col-md-1 col-xs-2">
					    		<div class="btn btn-warning" style="height: 33px">
					    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> C
									<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
					    		</div>
					    	</div>
					    	<div class="col-md-8 col-xs-10">
					    		<div class="panel panel-warning">
								  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
								    <font size="2">Basic panel example</font>
								  </div>
								</div>
					    	</div>
					    </div>

					    <div class="row">
					    	<div class="col-md-1 col-xs-2">
					    		<div class="btn btn-warning" style="height: 33px">
					    			<input type="radio" name="opsi_a" id="option2" autocomplete="off" hidden> D
									<span class="glyphicon glyphicon-ok" style="margin-top: 2px"></span>
					    		</div>
					    	</div>
					    	<div class="col-md-8 col-xs-10">
					    		<div class="panel panel-warning">
								  <div class="panel-heading" style=" border: 2px solid#F3921D;border-radius: 3px;padding: 5px">
								    <font size="2">Basic panel example</font>
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
@endsection