@extends('layout.user')

@section('title', 'Refreshment Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/home.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container"> 

		<!-- PC -->
    <div class="hidden-xs hidden-sm">
      <div class="row" style="padding-right: 50px">
	      <div class="col-md-offset-3 col-md-4">
	        <div class="circle">
	          <a href="#" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/test.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
	        </div>
            <h1 style="margin-left: 90px;margin-top: -30px">Quiz</h1>
	      </div>
	      <div class="col-md-4">
	        <div class="circle">
	           <img src="{{asset('img/statistic.svg')}}" style="margin-top: 15px; width: 100px;height: 100px">
	        </div>
            <h1 style="margin-left: 60px;margin-top: -30px">Statistik</h1>
	      </div>
      </div>
      <div class="garismerah center-block" style="width: 60%;margin-top: 10px"></div>

      <div class="row" style="padding-right: 50px">
	      <div class="col-md-offset-3 col-md-4">
	        <div class="circle">
	           <img src="{{asset('img/user.svg')}}" style="margin-top: 15px; width: 100px;height: 100px">
	        </div>
            <h1 style="margin-left: 85px;margin-top: -30px">Profil</h1>
	      </div>
	      <div class="col-md-4">
	        <div class="circle">
	           <img src="{{asset('img/grades.svg')}}" style="margin-top: 15px; width: 100px;height: 100px">
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
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-offset-2 col-md-4">
        		<a href="/materi/jangkapendek" type="button" class="btn btn-success btn-circle btn-xl" style="margin-bottom: 20px;margin-right: 10px"></a><br>
        		<font face="roboto" size="4">In Class</font>
        	</div>
        	<div class="col-md-4">
        		<a href="/materi/jangkapanjang" type="button" class="btn btn-success btn-circle btn-xl" style="margin-bottom: 20px;margin-left: 20px"></a>
        		<font face="roboto" size="4" style="text-align: center; margin-left: 30px">Periode</font>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


      <!-- mobile -->
      <div class="row">
	      <div class="col-xs-6 visible-xs">
	        <div class="circlexs">
	          <a href="#"><h4>4<small>th</small><p>Title</p></h4></a>
	        </div>
	      </div>
      </div>



      <div class="container" style="margin-top:70px;">
    <div class="row">
        <form class="form-horizontal col-sm-7 col-sm-offset-2" action="" method="post">
            <div class="form-group registration-date">
                <label class="control-label col-sm-3" for="registration-date">Date:</label>
                <div class="input-group registration-date-time">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                    <input class="form-control" name="registration_date" id="tanggal" type="date">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></span>
                    <input id="pukul" class="form-control" name="registration_date"  type="time">

                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $("#pukul").inputmask("h:s",{ "placeholder": "hh/mm" });
});​
</script>

    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
    <script src="http://momentjs.com/downloads/moment-timezone-with-data.js"></script>

<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
}
</script>

<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#tanggal').datepicker();
    })
}
</script>

@endsection
     