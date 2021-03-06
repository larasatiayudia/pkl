@extends('layout.superadmin')

@include('admin_grup.sidebar')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container-fluid">
<div class="col-md-offset-1 col-md-11">
    <div class="row">
			<div class="col-md-12">
				<div class="page-title">
		   			<ol class="breadcrumb judulmenu"><br><br>
			  			<li class="active" style="color:#E5FFCA">
				 		<h3><b><i class="fa fa-rocket"></i> Bonus Soal</b></h3>
			  			</li> 
		   			</ol>
				</div>
			</div>
    </div>
	@include('admin_grup.stepbonus')
    <div class="row">
		<div class="col-md-12">
                <div class="panel panel-form">
                    <div class="panel-heading">Pengaturan Soal</div>
	                    <div class="panel-body" style="background-color:white">
							<!-- Kalo tambah test baru -->
		                    @if(empty($test))
		                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/tambahtest') }}">
		                    {{csrf_field()}}
		                        <div class="row" id="step-2">                     
			                        <div class="col-md-12 col-xs-12">

			                        <h4>Pengaturan Umum</h4>
			                        <div class="row">
				                        <div class="col-md-9">
					                        <div class="form-group">
					                            <label class="control-label">Nama Test</label>
					                            <input  name="nama" type="text" required="required" class="form-control" placeholder=""/>
					                        </div>
				                        </div>
			                        </div>

			                        <div class="row">
				                        <div class="col-md-10 col-xs-12">
					                        <div class="form-group">
					                            <label class="control-label">Deskripsi</label>
					                             <textarea name="deskripsi" style="height: 20%; width: 100%" id="area1"></textarea>
					                        </div>
				                        </div>
			                        </div>

			                        <div class="row">
			                        	<div class="col-md-12 col-xs-8">
					                        <div class="form-group">
					                            <label class="control-label">Attempt</label>
					                            <div class="form-inline">
						                            <input  name="attempt" type="text" required="required" class="form-control" placeholder="Max 3" onkeyup="valattempt(this)" />
						                            <label class="control-label">kali</label>
						                            <b id="alert1" style="color: red"></b>
					                            </div>
					                            

					                        </div>
					                    </div>
					                </div>

					                <div class="row">
			                        	<div class="col-md-12 col-xs-8">
					                        <div class="form-group">
					                            <label class="control-label">Jumlah Soal</label>
					                            <div class="form-inline">
						                            <input  name="jumlah" type="text" required="required" class="form-control" placeholder="yang ingin ditampilkan" onkeyup="valjmlsoal(this)" />
						                            <label class="control-label">soal</label>
						                            
					                            </div>
					                            <b id="alert4" style="color: red"></b>

					                        </div>
					                    </div>
					                </div>

			         				<hr style="border-color: #ddd">


			         				<h4>Pengaturan Waktu</h4>
			                        <div class="row">
			                        	<div class="col-md-9 col-xs-12">
					                        <div class="form-group">
					                            <label class="control-label">Durasi Tes</label>
					                            <div class="form-inline">
						                            <input name="durasi" type="text" required="required" class="form-control" placeholder="Max 60" onkeyup="valdurasi(this)" />
						                            <label class="control-label">menit</label>
					                            </div>
					                            <b id="alert2" style="color: red"></b>
					                        </div>
					                        
					                    </div>
			                        </div>
			                        <hr style="border-color: #ddd">

			                        <h4>Pengaturan Nilai</h4>
			                        <div class="row">
			                        	<div class="col-md-4 col-xs-12">
					                        <div class="form-group">
					                            <label class="control-label">Passing Grade</label>
					                            <input  name="passing" type="text" required="required" class="form-control" placeholder="Max 100" onkeyup="valgrade(this)"/>
					                            <b id="alert3" style="color: red"></b>
					                        </div>
					                        
					                    </div>
					                </div>
					                <hr style="border-color: #ddd">
					               	<input type="text" name="id_mat" value="{{$materi->id_mat}}" hidden>
									<!-- Klo test In Class -->
					               	@if(isset($tipe))
					               	<input type="text" name="tipe" value="{{$tipe}}" hidden>
					               	@endif
				                     <button id="next" class="btn btn-success nextBtn btn-lg pull-right" type="submit"  style="margin-right: 20px" disabled>Next</button>
			                        </div>
			                      
			                        </div>
			                </form>
							<!-- Edit test -->
			                @else
			                <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/edittest') }}">
		                    {{csrf_field()}}
		                    <input type="hidden" name="_method" value="PUT">
		                        <div class="row" id="step-2">                     
			                        <div class="col-md-12 col-xs-12">
				                        <h4>Pengaturan Umum</h4>
				                        <div class="row">
					                        <div class="col-md-9">
						                        <div class="form-group">
						                            <label class="control-label">Nama Test</label>
						                            @if($status==1)
						                            <input  name="nama" type="text" required="required" class="form-control" placeholder="" value="{{$test[0]->nama}}" />
						                            @else
						                            <input  name="nama" type="text" required="required" class="form-control" placeholder="" value="{{$test->nama}}" />
						                            @endif
						                        </div>
					                        </div>
				                        </div>

				                        <div class="row">
					                        <div class="col-md-10 col-xs-12">
						                        <div class="form-group">
						                            <label class="control-label">Deskripsi</label>
						                            @if($status==1)
						                             <textarea name="deskripsi" style="height: 20%; width: 100%" id="area1">{{$test[0]->peraturan_test}}</textarea>
						                        	@else
						                        	<textarea name="deskripsi" style="height: 20%; width: 100%" id="area1">{{$test->peraturan_test}}</textarea>
						                        	@endif
						                        </div>
					                        </div>
				                        </div>

				                         <div class="row">
				                        	<div class="col-md-12 col-xs-12">
						                        <div class="form-group">
						                            <label class="control-label">Attempt</label>
						                            <div class="form-inline">
							                            @if($status==1)
									                    <div class="form-inline">
								                            <input onkeyup="valattempt(this)" name="attempt" type="text" required="required" class="form-control" placeholder="" value="{{$test[0]->attempt}}" />
								                            <label class="control-label">kali</label>
							                            </div>
							                            
							                            @else
							                            <div class="form-inline">
							                            	<input onkeyup="valattempt(this)" name="attempt" type="text" required="required" class="form-control" placeholder="" value="{{$test->attempt}}" />
							                            	<label class="control-label">kali</label>
							                            </div>
							                            @endif
						                            </div>
						                            <b id="alert1" style="color: red"></b>
						                        </div>
						                        
						                    </div>
						                </div>

						                <div class="row">
				                        	<div class="col-md-12 col-xs-8">
						                        <div class="form-group">
						                            <label class="control-label">Jumlah Soal</label>
						                            <div class="form-inline">
														@if($status==1)
							                            <input  name="jumlah" type="text" required="required" class="form-control" placeholder="yang ingin ditampilkan" onkeyup="valjmlsoal(this)" value="{{$test[0]->jumlah_soal}}"/>
							                            @else
														<input  name="jumlah" type="text" required="required" class="form-control" placeholder="yang ingin ditampilkan" onkeyup="valjmlsoal(this)" value="{{$test->jumlah_soal}}"/>													
														@endif
														<label class="control-label">soal</label>
														
						                            </div>
						                            <b id="alert4" style="color: red"></b>
						                        </div>
						                    </div>
					               		 </div>

				         				<hr style="border-color: #ddd">


				         				<h4>Pengaturan Waktu</h4>
				                        <div class="row">
				                        	<div class="col-md-9 col-xs-12">
						                        <div class="form-group">
						                            <label class="control-label">Durasi</label>
						                            <div class="form-inline">
						                            	@if($status==1)
							                            <input onkeyup="valdurasi(this)" id="durasi" name="durasi" type="text" required="required" class="form-control" placeholder=""/ value="{{$test[0]->durasi}}">
							                            @else
							                            <input onkeyup="valdurasi(this)" id="durasi" name="durasi" type="text" required="required" class="form-control" placeholder=""/ value="{{$test->durasi}}">
							                            @endif
							                            <label class="control-label">menit</label>
						                            </div>
						                             <b id="alert2" style="color: red"></b>
						                        </div>
						                       
						                    </div>
				                        </div>
				                        <hr style="border-color: #ddd">

				                        <h4>Pengaturan Nilai</h4>
				                        <div class="row">
				                        	<div class="col-md-3 col-xs-12">
						                        <div class="form-group">
						                            <label class="control-label">Passing Grade</label>
						                            @if($status==1)
						                            <input  onkeyup="valgrade(this)" name="passing" type="text" required="required" class="form-control" value="{{$test[0]->passing_grade}}" placeholder=""/>
						                            @else
						                            <input  onkeyup="valgrade(this)" name="passing" type="text" required="required" class="form-control" value="{{$test->passing_grade}}" placeholder=""/>
						                            @endif
						                             <b id="alert3" style="color: red"></b>
						                        </div>
						                       
							                    
						                    </div>
						                </div>
						               	<hr style="border-color: #ddd">
						                @if($status==1)
						               	<input type="text" name="id_test" value="{{$test[0]->id_test}}" hidden>
						               	@else
						               	<input type="text" name="id_test" value="{{$test->id_test}}" hidden>
						               	@endif
					                    <button id="next" class="btn btn-success nextBtn btn-lg pull-right" type="submit" disabled >Next</button>
					                </div>         
			                </div>	                      
		                </div>
	                </form>
	                @endif
                    </div>
                </div>
		</div>
	</div>
</div>


<script type="text/javascript" src="{{URL::asset('js/nicEdit-latest.js')}}"></script> 
<!-- <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="http://momentjs.com/downloads/moment-timezone-with-data.js"></script>
 -->


<script type="text/javascript">
    function valattempt(obj){
      if(obj.value!="" && obj.value.search(/[a-z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert1").innerHTML = "Isi dengan angka";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else if(obj.value!="" && obj.value > 3){
        document.getElementById("alert1").innerHTML = "Attempt melebihi batas maksimum";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else{
      	document.getElementById("alert1").innerHTML = "";
      }
    } 

    function valdurasi(obj){
      
      if(obj.value!="" && obj.value.search(/[a-z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert2").innerHTML = "Isi dengan angka";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else if(obj.value!="" && obj.value > 180){
        document.getElementById("alert2").innerHTML = "Durasi melebihi batas maksimum";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else{
      	document.getElementById("alert2").innerHTML = "";
      }

    }

    function valgrade(obj){
      if(obj.value!="" && obj.value.search(/[a-z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert3").innerHTML = "Isi dengan angka";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else if(obj.value!="" && obj.value > 100){
        document.getElementById("alert3").innerHTML = "Passing grade melebihi batas";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else{
      	document.getElementById("alert3").innerHTML = "";
      }
    }

    function valjmlsoal(obj){
      if(obj.value!="" && obj.value.search(/[a-z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert4").innerHTML = "Isi dengan angka";
        document.getElementById("next").setAttribute("disabled","disabled");
      }
      else{
      	document.getElementById("alert4").innerHTML = "";
      }

    } 

    setInterval(function(){
	    if(document.getElementById("alert1").innerHTML == "" && document.getElementById("alert2").innerHTML == "" && document.getElementById("alert3").innerHTML == "" && document.getElementById("alert4").innerHTML == ""){
	    	document.getElementById("next").removeAttribute("disabled");
	    }
	}, 1000); 
	  
</script>

<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="{{URL::asset('css/jquery-ui.css')}}" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="{{URL::asset('js/jquery1.4.min.js')}}"><\/script>\n')
        document.write('<script src="{{URL::asset('js/jquery-ui.min.js')}}"><\/script>\n') 
    }
</script>
 
<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#tanggal').datepicker({
        	dateFormat: "dd/mm/yyyy",
        	minDate: 0, 
            onSelect: function (date) {
                var dt2 = $('#tanggals');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('option', 'minDate', minDate);
            }
        });
        $('#tanggals').datepicker({
        	dateFormat: "dd/mm/yyyy",
        	minDate: 0,
        	onSelect: function (date) {
                var dt1 = $('#tanggal');
                var maxDate = $(this).datepicker('getDate');
                dt1.datepicker('option','maxDate', maxDate);
            }
        });
    })
}
</script>

<script type="text/javascript">
	$('#tanggal').on('change',function(){
		var buka = new Date(Date.parse($(this).val()+"T23:59:59+07:00"));
		var sekarang = new Date();
		var tutup = Date(Date.parse($('#tanggals').val()+"T23:59:59+07:00")); 

		if(buka<sekarang || buka>tutup && tutup!=null){
			swal("Tanggal salah!", "Harap masukan tanggal yang benar");
			$(this).val('');
		}
	});

	$('#tanggals').on('change',function(){
		var tutup = Date.parse($(this).val()+"T23:59:59+07:00");
		var sekarang = new Date();
		var buka = Date(Date.parse($('#tanggal').val()+"T23:59:59+07:00")) ;

		if(tutup<sekarang || tutup<buka && buka!=null){
			swal("Tanggal salah!", "Harap masukan tanggal yang benar");
			$(this).val('');
		}
	});
</script>



<script>
    $(document).ready(function(){
        $("#opentime").inputmask({ mask: "h:s", greedy: false});
        $("#closetime").inputmask({ mask: "h:s", greedy: false}); });
</script>

 <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area1');
  });
  //]]>
  </script>
@endsection

@section('script')
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.inputmask.bundle.min.js')}}"></script>
@endsection