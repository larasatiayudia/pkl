@extends('layout.superadmin')
@section('title', 'Admin Grup')

@include('operator.sidebar')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select-edit.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
<div class="col-md-offset-1 col-md-11">
   <div class="row">
     <div class="col-md-12">
      <div class="page-title">
        <ol class="breadcrumb judulmenu"><br><br>
         <li class="active" style="color:#E5FFCA"><h3><i class="fa fa-users"></i><b> Admin Grup</b></h3></li>
        </ol>
       </div>
      </div>
     </div>

<div class="panel panel-default">
  <div class="panel-body" style="background-color: white">

    <h2>Daftar Akun Grup</h2>
 
  <div class="form-group">
    <div class="row">
      <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">  <!--Button Add-->  
                <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addSuperadmin"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Admin Grup</button>                
                </div>
                <!--Search Box -->
               
                <form class="form-inline" method="GET" role="search" action="{{route('operator.searchAdmin')}}">
                <div class="input-group col-md-7">
                  <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan kode grup,nama grup,username..." class="form-control" /><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                  
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
              <th>Username</th>
              <th>Email</th>
              <th></th>
              <th></th>
                           
            </thead>
            <tbody>
            @if(count($admingroups))
            @foreach($admingroups as $ag)
              <tr>
                <td>{{$ag->grup->kode_grup}}</td>
                <td>{{$ag->grup->nama_grup}}</td>
                <td>{{$ag->username}}</td>
                <td>{{$ag->email}}</td>
                           
                <td>
                  <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <button class="btn btn-primary open_modal" data-title="Edit" data-toggle="modal" data-target="#editSuperadmin" data-value="{{$ag->username}}" data-id="{{$ag->id_sa}}" data-email="{{$ag->email}}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                  </p>
                </td>
                <td>
                  <form id="deleteform" class="delete" role="form" method="POST" action="{{route('operator.editSuperadmin')}}" enctype="multipart/form-data">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                      <input name="id_sa" type="text" id="id_grup" value="{{$ag->id_sa}}" hidden/> 
                      <button class="btn btn-danger" type="button" id="delete" data-name="{{$ag->username}}" data-table="Admin Grup">
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
                <td colspan="6">Belum ada data admin grup</td>
              </tr>
            @endif      
            </tbody>
          </table>    
          {{$admingroups->links()}}
        </div>
      </div>
      </div>
  </div>
  </div>
    
  


<!--Modal Add-->
<div class="modal fade" id="addSuperadmin" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Admin Grup</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="submitsuperadmin" method="POST" action="{{route('operator.addAdmin.submit')}}" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label">Username</label>
            <input onchange="valusername()" onkeyup="valusername2()" id="username" name="username" type="text" required="required" class="form-control" placeholder="Max 25 karakter"  />
            <span id="alert1" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input  id="password" name="password" type="text" onchange="valpass()" onkeyup="valpass2()" required="required" class="form-control" placeholder="Min 6 karakter"  />
            <span id="needmore" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" name="email" type="email" required="required" class="form-control" placeholder="Masukkan email yang dapat dihubungi"  />
          </div>
          <div class="form-group">
            <label class="control-label">Grup</label><br>
            <select id="selectgroups" name="id_grup" class="selectpicker" data-live-search="true" data-width="565px"></select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary"> Save</a>
      </div>
          {{csrf_field()}} 
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal Edit -->
<div class="modal fade" id="editSuperadmin" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Akun Grup</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="submitsuperadmin2" method="POST" action="{{route('operator.editSuperadmin')}}" enctype="multipart/form-data">
          <input name="id_sa" type="text" id="id_sa" hidden/>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input onchange="valunameedit()" onkeyup="valunameedit2()" id="username2" name="username" type="text" required="required" class="form-control" placeholder="Max 25 karakter"  />
            <span id="alert2" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input onchange="valpassedit()" onkeyup="valpassedit2()" id="password2" name="password" type="text" class="form-control" placeholder="Min 6 karakter (kosongkan apabila tidak ingin mengganti password"  />
            <span id="needmore2" style="color: red"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" name="email" type="email" required="required" class="form-control" placeholder="Masukkan email baru yang dapat dihubungi"  />
          </div>
          <div class="form-group">
            <label class="control-label">Grup</label><br>
            <select id="selectgroup" name="id_grup" class="selectpicker" data-live-search="true" data-width="565px">
            </select>
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

<meta name="_token" content="{!! csrf_token() !!}" />


<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>

<script>
  @if(Session::has('message'))
      swal("Berhasil!","{{ Session::get('message')}}","success");
  @endif
  
</script>

<script type="text/javascript">
      function valpass(){
          var pass = document.getElementById("password");
          console.log(pass.value);
          if(pass.value != "" && pass.value.length<6){
              document.getElementById("needmore").innerHTML = "Minimal password 6 karakter";
              document.getElementById("save").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("needmore").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }
      function valpass2(){
          var pass = document.getElementById("password");
          if(pass.value=="" || pass.value.length>=6){
              document.getElementById("needmore").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }

      function valpassedit(){
          var pass = document.getElementById("password2");
          console.log(pass.value);
          if(pass.value != "" && pass.value.length<6){
              document.getElementById("needmore2").innerHTML = "Minimal password 6 karakter";
              document.getElementById("save2").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("needmor2e").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }
      function valpassedit2(){
          var pass = document.getElementById("password2");
          if(pass.value=="" || pass.value.length>=6){
              document.getElementById("needmore2").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }


      function valusername(){
          var uname = document.getElementById("username");
          if(uname.value != "" && uname.value.length>25){
              document.getElementById("alert1").innerHTML = "Karakter melebihi batas";
              document.getElementById("save").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("alert1").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }
      function valusername2(){
          var uname = document.getElementById("username");
          if(uname.value=="" || uname.value.length<=25){
              document.getElementById("alert1").innerHTML = "";
              document.getElementById("save").removeAttribute("disabled");
          }
      }

      function valunameedit(){
          var uname = document.getElementById("username2");
          if(uname.value != "" && uname.value.length>25){
              document.getElementById("alert2").innerHTML = "Karakter melebihi batas";
              document.getElementById("save2").setAttribute("disabled","disabled");
          }
          else{
              document.getElementById("alert2").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }
      function valunameedit2(){
          var uname = document.getElementById("username2");
          if(uname.value=="" || uname.value.length<=25){
              document.getElementById("alert2").innerHTML = "";
              document.getElementById("save2").removeAttribute("disabled");
          }
      }

  </script>

@endsection

@section('script')
<script src="{{ URL::asset('/js/bootstrap-select.min.js') }}"></script>
@endsection
