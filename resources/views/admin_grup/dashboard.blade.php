@extends('layout.superadmin')
@section('title', 'Dashboard')


@include('admin_grup.sidebar')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
@endsection

<!-- dashboard operator admin -->
@section('content')
<div class="container-fluid">
   <div class="col-md-offset-1 col-md-11">
      <div class="row">
        <div class="col-md-12">
            <div class="page-title">
               <ol class="breadcrumb judulmenu"><br><br>
                  <li class="active" style="color:#E5FFCA">
                     <h3><b><i class="fa fa-dashboard"></i> Dashboard</b></h3>
                  </li> 
               </ol>
            </div>
         </div>
      </div>

  <ul class="breadcrumbs "> 
    <li class="active"><a href="javasript:void(0)"> Dashboard</a></li>
  </ul> 

      <div class="row" ><br>
         <!--KOTAK MENU USER-->
         <div class="col-md-4 col-md-6">
            <div class="circle-tile">
                <a href="#">
                    <div class="circle-tile-heading red">
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content red">
                    <div class="circle-tile-description text-faded">User</div>
                    <div class="circle-tile-number text-faded">
                        {{count($users)}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{route('admingrup.daftarUser')}}" class="circle-tile-footer"> More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
         </div>
         <!--KOTAK MENU JABATAN--> 
         <div class="col-md-4 col-md-6">
            <div class="circle-tile">
                <a href="#">
                    <div class="circle-tile-heading green">
                        <i class="fa fa-briefcase fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">Jabatan</div>
                    <div class="circle-tile-number text-faded">{{count($jabatan)}}</div>
                    <a href="{{route('admingrup.daftarJabatan')}}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
         </div>
         <!--KOTAK MENU LEVEL-->
         <div class="col-md-4 col-md-6">
             <div class="circle-tile">
                 <a href="#">
                     <div class="circle-tile-heading orange">
                         <i class="fa fa-star fa-fw fa-3x"></i>
                     </div>
                 </a>
                 <div class="circle-tile-content orange">
                     <div class="circle-tile-description text-faded">
                         Level
                     </div>
                     <div class="circle-tile-number text-faded">
                         {{count($levels)}}
                     </div>
                     <a href="{{route('admingrup.daftarLevel')}}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                 </div>
             </div>
         </div>
         <!--KOTAK END-->
      </div>
            
 
                    <br>
                    
                    <div class="panel-body" style="background-color: white">
                      <div class="col-md-2" style="margin-top:10px;margin-bottom:20px">
                        <img src="{{URL::asset('img/statistik_admin.png')}}" style="width:150px"/>
                      </div>
                      <div class="col-md-3" style="border-right: 1px solid black; padding-bottom: 90px">
                        <h3> Statistik Test</h3> 
                        <h5> Lihat data statistik dari setiap materi test di tiap jabatan.</h5>
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
                              <input id="status" value="chart" hidden>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" id="filterbtn">Go</button>
                             
                      </div>
                    </div>
  
</div>
</div>

<script type="text/javascript">
    function showselect(obj){
       document.getElementById("materitest").removeAttribute("hidden");
    }
</script>



@endsection

@section('script')

<script src="{{ URL::asset('/dist/hashids.min.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('js/ajaxscript.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection