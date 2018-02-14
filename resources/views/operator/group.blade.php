@extends('layout.superadmin')
@section('title', 'Operator')

@include('operator.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container-fluid">
<div class="col-md-offset-1 col-md-11">
   <div class="row">
     <div class="col-md-12">
      <div class="page-title">
        <ol class="breadcrumb judulmenu"><br><br>
         <li class="active" style="color:#E5FFCA"><h3><i class="fa fa-briefcase"></i><b> Grup</b></h3></li>
        </ol>
       </div>
      </div>
     </div>

  <div class="panel panel-default">
  <div class="panel-body" style="background-color: white">
  <div class="form-group">
    <div class="row">
      <div class="col-md-12">
      <h2 style="margin-top: -5px">Daftar Grup</h2>
        <div class="row">
        <div class="col-md-5">
                <!--Button Add-->    
              <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addGroup"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Grup</button>
        </div>
        <!--Search Box -->
        <form class="form-inline" method="GET" role="search" action="{{route('operator.searchGroup')}}">
        <div class="input-group col-md-7">     
                  <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan nama grup,kode grup..." class="form-control"><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                   </div> 
                   </form>
                         
              </div>
            </div>      
          </div>
        </div>
        <!--Table Data-->               
        <div class="table-responsive" style="margin-top: -15px">
          <table id="mytable" class="table table-bordred table-striped">   
            <thead>
              <th>Kode Grup</th>
              <th>Nama Grup</th>
              <th></th>
              <th></th>

            </thead>
            <tbody>
            @if(count($groups))
            @foreach($groups as $group)
              <tr>
                <td>{{$group->kode_grup}}</td>
                <td>{{$group->nama_grup}}</td>           
                <td>
                  <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <button class="btn btn-primary open_modal" data-title="Edit" data-toggle="modal" data-target="#editGroup" data-id="{{$group->id_grup}}" data-name="{{$group->nama_grup}}" data-kode="{{$group->kode_grup}}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                  </p>
                </td>
                <td>
                  <form id="deleteform" class="delete" role="form" method="POST" action="{{route('operator.editGroup')}}" enctype="multipart/form-data">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                      <input name="id_grup" type="text" id="id_grup" value="{{$group->id_grup}}" hidden/> 
                      <button class="btn btn-danger " type="button" id="delete" data-name="{{$group->nama_grup}}" data-table="Grup">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    </p>
                  
                      {{csrf_field()}}
                  </form>        
                </td>          
              </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4">Belm ada data grup</td>
            </tr>
            @endif      
            </tbody>
          </table>   
          {{$groups->links()}} 
        </div>
      </div>
    </div>
    </div>
    </div>
  

 <!--Modal Add-->
<div class="modal fade" id="addGroup" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Grup</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="addGroup" method="POST" action="{{route('operator.addGroup.submit')}}" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label">Kode Grup</label>
            <input onchange="valkode()" onkeyup="valkode2()" id="kode" name="kode_grup" type="text" required="required" class="form-control" placeholder="Max 10 karakter"  />
            <h6 style="padding-left: 1em; margin-top: 2px">ex: MBG</h6>
            <span id="alert1" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Nama Grup</label>
            <input id="nama" name="nama_grup" type="text" required="required" class="form-control" placeholder="Masukkan nama grup"  />
            <h6 style="padding-left: 1em; margin-top: 2px">ex: Micro Banking Group</h6>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary"> Save </a>
      </div>
          {{csrf_field()}} 
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal Edit -->
<div class="modal fade" id="editGroup" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Grup</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="editGroup" method="POST" action="{{route('operator.editGroup')}}" enctype="multipart/form-data">
        <input id="id" name="id_grup" type="text" value="" hidden>
          <div class="form-group">
            <label class="control-label">Kode Grup</label>
            <input onchange="valkodeedit()" onkeyup="valkodeedit2()" id="kode2" name="kode_grup" type="text" required="required" class="form-control" placeholder="Max 10 karakter" data-value="" />
            <h6 style="padding-left: 1em; margin-top: 2px">ex: MBG</h6>
            <span id="alert2" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Nama Grup</label>
            <input id="nama" name="nama_grup" type="text" required="required" class="form-control" placeholder="Masukkan nama grup"  />
            <h6 style="padding-left: 1em; margin-top: 2px">ex: Micro Banking Group</h6>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save2" type="submit" class="btn btn-primary"> Save Change</a>
      </div>
          {{csrf_field()}} 
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>
<script>
  @if(Session::has('message'))
      swal("Berhasil!","{{ Session::get('message')}}","success");
  @endif
  
</script>

<script type="text/javascript">
      function valkode(){
          var kode = document.getElementById("kode");
          if(kode.value != "" && kode.value.length>10){
              document.getElementById("alert1").innerHTML = "Karakter melebihi batas";
              document.getElementById("save").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("alert1").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }
      function valkode2(){
          var kode = document.getElementById("kode");
          if(kode.value=="" || kode.value.length<=10){
              document.getElementById("alert1").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }

      function valkodeedit(){
          var kode = document.getElementById("kode2");
          if(kode.value != "" && kode.value.length>10){
              document.getElementById("alert2").innerHTML = "Karakter melebihi batas";
              document.getElementById("save2").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("alert2").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }
      function valkodeedit2(){
          var kode = document.getElementById("kode2");
          if(kode.value=="" || kode.value.length<=10){
              document.getElementById("alert2").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }
</script>

@endsection
