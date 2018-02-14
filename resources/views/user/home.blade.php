@extends('layout.user')

@section('title', 'Refreshment Test')

@section('styles')
<<<<<<< HEAD
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/home.css')}}">
=======
<link rel="stylesheet" type="text/css" href="css/home.css">
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
@endsection

@include('user.navbar')

@section('content')
<div class="container"> 

<<<<<<< HEAD
    <!-- PC -->
    <div class="hidden-xs hidden-sm">
      <div class="row" style="padding-left: 100px">
        <div class="col-md-4">
          <div class="circle">
            <a href="#" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/test.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
          </div>
            <h1 style="margin-left: 95px;margin-top: -30px">Tes</h1>
        </div>
        <div class="col-md-4 visible-lg">
          <div class="circle">
            <a href="{{url('/bonussoal')}}" ><img src="{{asset('img/rocket2.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
          </div>
          <h1 style="margin-left: 45px;margin-top: -30px">Bonus Tes</h1>
        </div>
        <div class="col-md-4">
          <div class="circle">
             <a href="{{url('/statistik')}}"><img src="{{asset('img/statistic.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
          </div>
            <h1 style="margin-left: 60px;margin-top: -30px">Statistik</h1>
        </div>
      </div>


      <div class="garismerah center-block" style="width: 80%;margin-top: 10px"></div>

      <div class="row" style="padding-right: 50px">
        <div class="col-md-offset-3 col-md-4">
          <div class="circle">
             <a href="{{url('/profil')}}"><img src="{{asset('img/user.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
          </div>
            <h1 style="margin-left: 85px;margin-top: -30px">Profil</h1>
        </div>
        <div class="col-md-4">
          <div class="circle">
             <a href="{{url('/nilai')}}"> <img src="{{asset('img/trophy.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"> </a>
          </div>
            <h1 style="margin-left: 90px;margin-top: -30px">Nilai</h1>
        </div>
      </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Jenis Materi</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-offset-2 col-md-5 col-xs-offset-1 col-xs-5">
                  <a href="{{('/materi/jangkapendek')}}" class="btn btn-default orange-circle-button"> 
                    <font face="roboto" size="5" class="hidden-xs">In class</font>
                    <font face="roboto" size="3" class="visible-xs">In class</font>
                  </a>
                </div>
                <div class="col-md-5 col-xs-6">
                  <div class="col-md-12 col-xs-12">
                      <a href="{{('/materi/jangkapanjang')}}" class="btn btn-default orange-circle-button">   
                        <font face="roboto" size="5" class="hidden-xs">Periode</font>
                        <font face="roboto" size="3" class="visible-xs">Periode</font>
                      </a><br>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


      <!-- mobile -->
     <div class="row visible-xs">
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="#" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/test.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h2 style="margin-left: 70px;margin-top: -30px">Tes</h2>
        </div>
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/bonussoal')}}"><img src="{{asset('img/rocket2.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h2 style="margin-left: 55px;margin-top: -30px">Bonus</h2>
        </div>
      </div>
      <div class="garismerah center-block visible-xs" style="width: 80%;margin-top: 10px"></div>
       <div class="row visible-xs">
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/statistik')}}"><img src="{{asset('img/statistic.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h2 style="margin-left: 45px;margin-top: -30px">Statistik</h2>
        </div>
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/nilai')}}"> <img src="{{asset('img/trophy.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"> </a>
          </div>
          <h2 style="margin-left: 70px;margin-top: -30px">Nilai</h2>
        </div>
      </div>
</div>


=======
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
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
@endsection
