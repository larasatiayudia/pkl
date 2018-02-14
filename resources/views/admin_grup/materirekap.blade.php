@extends('layout.superadmin')
@section('title', 'Rekap')

@include('admin_grup.sidebar')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/tabel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
@endsection

@section('content')
<div class="container-fluid">
 	<div class="col-md-offset-1 col-md-11 content">
 	<div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><b><i class="fa fa-bar-chart"></i> Rekap</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>

  <ul class="breadcrumbs ">  
    <li class="active"><a href="javasript:void(0)"> Pilih Jabatan dan Materi Test</a></li>
  </ul> 

  <div class="panel panel-default">
  <div class="panel-body" style="background-color: white">  
  <div class="panel panel-success">
    <div class="panel-heading">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6">
            <h2 class="text-center pull-left" style="padding-left: 30px;"> <span class="glyphicon glyphicon-list-alt"> </span> Pilih Jabatan dan Tipe Tes </h2>
          </div>
        </div>
    </div>
    </div>
    <br>

              <div class="col-md-2" style="margin-top:10px;margin-bottom:20px">
                  <img src="{{URL::asset('img/clipboard.png')}}" style="width:150px"/>
              </div>
              <div class="col-md-3" style="border-right: 1px solid black; padding-bottom: 90px">
                    <h3> Rekap Hasil Test</h3> 
                    <h5> Lihat tabel data hasil nilai test di tiap jabatan dari semua user.</h5>
              </div> 



              <div class="col-md-7">
                        <label class="col-md-offset-1"> <h4>Pilih Test</h4></label><br>
                       
                            <div class="form-grup">

                              <label class="col-md-3 control-label">Jabatan</label>
                              <div class="col-md-9">
                                <select id="jabatan" name="jabatan" class="selectpicker" data-show-subtext="true" data-live-search="true">
                                  <!--ajaxscript-->
                                </select>
                              </div>
                            </div><br><br>
                            <div class="form-grup">
                              <label class="col-md-3 control-label">Tipe Test </label>
                              <div class="col-md-3">
                                <input id="panjang" type="radio" name="Radio" value="1"> Periode
                              </div>
                              <div class="col-md-5">
                                <input id="pendek" type="radio" name="Radio" value="0"> In Class
                              </div><br><br>
                            
                            <div class="form-grup">
                              <label class="col-md-3 control-label"> Pilih Materi</label>
                              <!--SELECT MATERI TESTNYA CUKUP SATU AJA ME, INI YANG DIBAWAH YANG AKU PAKE-->
                              <div class="col-md-9">
                                <select id="materitest" name="materitest" class="selectpicker" data-show-subtext="true" data-live-search="true">
                                <option value="" disabled selected>-- Pilih Materi --</option>
                                  <!--ajaxscript-->
                                </select>
                              </div>
                              
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" id="filterbtn">Go</button>
                             
                      </div>
                    </div>

<!--     <div class="row">
      <div class="col-md-3">
        <select id="jabatan" name="jabatan" class="selectpicker" data-show-subtext="true" data-live-search="true">
          
        </select>
      </div>
      <br><br>
      <div>
        <label><input id="panjang" type="radio" name="Radio" value="1"> Periode</label>
      </div>
      <div>
        <label><input id="pendek" type="radio" name="Radio" value="0"> In Class</label>
      </div>
    </div> -->
    
  
<!--     <div class="row">
    <div class=" box col-md-3" >
      
      <select id="materitest" name="materitest" class="selectpicker" data-show-subtext="true" data-live-search="true">
       
      </select>
    </div>

    <div class=" box col-md-8">

    </div>
    <br><br><br>
    <div class="col-md-3"><button type="submit" class="btn btn-primary" id="filterbtn">Go</button></div>
    </div> -->
  </div>

</div>
</div>
</div>



<!-- <script type="text/javascript">
  $(document).ready(function(){
    $('input[type="radio"]').click(function(){
    var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
  });
</script> -->

@endsection
@section('script')
<script src="{{ URL::asset('/dist/hashids.min.js') }}"></script>
<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>
<script src="{{ URL::asset('/js/bootstrap-select.min.js') }}"></script>
@endsection