@extends('layout.superadmin')
@section('title', 'User')

@include('admin_grup.sidebar')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select-edit.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
@endsection

@section('content')

<div class="container-fluid">
   <div class="col-md-offset-1 col-md-11">
      <div class="row">
        <div class="col-md-12">
            <div class="page-title">
               <ol class="breadcrumb judulmenu"><br><br>
                  <li class="active" style="color:#E5FFCA">
                     <h3><b><i class="fa fa-users"></i> User</b></h3>
                  </li> 
               </ol>
            </div>
         </div>
      </div>

  <ul class="breadcrumbs ">
    <li class="active"><a href="javasript:void(0)"> User</a></li>
  </ul> 

      <div class="panel panel-default">
      <div class="panel-body" style="background-color: white">
        <h2>Daftar User</h2>
       <br>
        <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-2">  
                      <!--Button Add-->  
                      <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus" aria-hidden="true"></i> Tambah User</button>       
                      </div>
                      <div class="col-md-3">                
                      <a class="btn btn-primary" href="{{route('admingrup.dataUser')}}" role="button"><i class="fa fa-user" aria-hidden="true"></i> Hasil Tambah User</a>
                  </div>
            <!--SEARCH BOX-->
          <form class="form-inline" method="GET" role="search" action="{{route('admingrup.searchUser')}}">
              <div class="input-group col-md-7">                
              <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan nama, NIP, atau unit kerja..." class="form-control" /><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                </div> 
                </form>         
                </div>
              </div>
            </div>      
          </div>
      <!--SEARCH BOX END-->


      <!--DATA TABLE-->
      <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Unit Kerja</th>
            <th>username</th>
            <th></th>
            <th></th>
          </thead>
          <tbody>
            @if(count($users))
            @foreach($users as $user)
            <tr>
              <td>{{$user->NIP}}</td>
              <td>{{$user->Nama}}</td>
              @if(count($user->jabatan))
              <td>{{$user->jabatan->nama_jabatan}}</td>
              @else
              <td> <i> NULL </i></td>
              @endif
              @if(count($user->kantor))
              <td>{{$user->kantor->nama_kantor}}</td>
              @else
              <td> <i> NULL </i></td>
              @endif
              <td>{{$user->username}}</td>
              <td> 
                <p data-placement="top" data-toggle="tooltip" title="Edit">
                  <button  style="height: 35px" class="btn btn-primary open_modal" data-title="Edit" data-toggle="modal" data-target="#editUser" data-nip="{{$user->NIP}}" data-id="{{$user->id_user}}" data-nama="{{$user->Nama}}" data-tipekantor="{{$user->kantor->tipe}}" data-kantor="{{$user->id_kantor}}" data-jabatan="{{$user->id_jabatan}}" data-username="{{$user->username}}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>
                </p>
              </td>
              <td>
                <form id="deleteform" class="delete" role="form" method="POST" action="{{route('admingrup.deleteUser',['id'=>$user->id_user])}}" enctype="multipart/form-data">
                  <p data-placement="top" data-toggle="tooltip" title="Delete"> 
                    <input type="hidden" name="_method" value="DELETE"/>
                    <button style="height: 35px" class="btn btn-danger" type="button" id="delete" data-name="{{$user->Nama}}" data-table="User">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </p>
                  {{csrf_field()}}
                </form>
              </td>
            </tr>
           @endforeach
           @else
            <tr><td colspan="7">Belum ada data user</td></tr>
          @endif
          </tbody>
          
        </table>
        {{$users->links()}}
            
      </div>
      <!--END DATA TABLE-->
    
  </div>
</div>
</div>
</div>

<!--MODAL ADD USER-->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          <!--NIP-->
          <div class="form-group">
            <label class="control-label">NIP</label>
            <input id="NIP2" name="NIP" type="text" class="form-control"  placeholder="Masukkan NIP" required autofocus onkeyup="valNIP(this)"/>
            <span id="alert1" style="color: red" ></span>
            <h6>ex:123 456 789</h6>
          </div>
          <!--Nama-->
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input id="nama" name="nama" type="text" required class="form-control" placeholder="Masukkan Nama"/>
            <h6>ex:Agus Budi</h6>
          </div>
          <!--Jabatan -->
          <div class="form-group">
            <label class="control-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" id="pilihjabatan" required>
              <!--ajaxscript-->
            </select>
          </div>
          <!--KANTOR-->
          <label class="control-label">Kantor</label>
          <div class="row">
            <!--TIPE-->
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label" style="font-size:12">Tipe Kantor</label>
                <select id="tipe" name="tipe" class="form-control">
                  <!--ajaxscript-->
                </select> 
              </div> 
            </div>
            <!--NAMA-->
            <div class="col-md-8">
              <div class="form-group">
                <label class="control-label" style="font-size:12">Nama Kantor</label><br>
                <select id="pilihkantor" name="id_kantor" class="selectpicker" data-show-subtext="true" data-live-search="true">
                  <option value="" disabled selected>--Pilih Kantor--</option>
                  <!--ajaxscript-->
                </select>
               </div>
              </div>
            </div>
          
          <!--username-->
          <div class="form-group">
            <label class="control-label">Username</label>
            <input id="username2" name="username" type="text" required class="form-control" placeholder="Masukkan username(default: NIP)" onkeyup="validasiusername(this)"/>
            <span style="color: red" id="alert3"></span>
            <h6>ex: user_123</h6>
          </div>
          <!-- password -->
          <div class="form-group">
            <label class="control-label">Password</label>
            <input id="password2" name="password" type="text" required class="form-control" placeholder="Masukkan password" value="{{str_random(6)}}" onchange="validasipassword(this)" onkeyup="validasipassword2(this)" />
            <span id="needmore" style="color: red"></span>
            <h6>min 6 karakter</h6>
          </div>
          <!--Grup-->
          <div class="form-group">
            <input id="id_grup" name="id_grup" value="{{Session::get('id_grup')}}" type="text" hidden>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="submit" type="submit" class="btn btn-primary" disabled> Save</a>
      </div>
          {{csrf_field()}} 
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal Edit -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Akun User</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="editUser" method="POST" action="{{route('admingrup.editUser')}}" enctype="multipart/form-data">
        <!--NIP-->
          <div class="form-group">
            <input name="_method" type="hidden" value="PUT">
            <label class="control-label">NIP</label>
            <input id="NIP" name="NIP" type="text" class="form-control"  placeholder="Masukkan NIP" required autofocus onkeyup="valNIP(this)"/>
            <span id="alert2" style="color: red" ></span>
            <h6>ex:123 456 789</h6>
          </div>
          <!--Nama-->
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input id="nama" name="nama" type="text" required class="form-control" placeholder="Masukkan Nama"/>
            <h6>ex:Agus Budi</h6>
          </div>
          <!--Jabatan -->
          <div class="form-group">
            <label class="control-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" id="pilihjabatan" required>
              <!--ajaxscript-->
            </select>
          </div>
          <!--KANTOR-->
          <label class="control-label">Kantor</label>
          <div class="row">
            <!--TIPE-->
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label" style="font-size:12">Tipe Kantor</label>
                <select id="tipe" name="tipe" class="form-control">
                  <option value="" disabled selected>--Pilih tipe kantor--</option>
                  <option value="1">RO</option>
                  <option value="2">KA</option>
                  <option value="3">KC/KCP</option>
                </select> 
              </div> 
            </div>
            <!--NAMA-->
            <div class="col-md-8">
              <div class="form-group">
                <label class="control-label" style="font-size:12">Nama Kantor</label><br>
                <select id="pilihkantor" name="id_kantor" class="selectpicker" data-show-subtext="true" data-live-search="true">
                  <option value="" disabled selected>--Pilih Kantor--</option>
                  <!--ajaxscript-->
                </select>
               </div>
              </div>
            </div>
          
          <!--username-->
          <div class="form-group">
            <label class="control-label">Username</label>
            <input id="username" name="username" type="text" required class="form-control" placeholder="Masukkan username(default: NIP)" onkeyup="validasiusername(this)"/>
            <span style="color: red" id="alert4"></span>
            <h6>ex: user_123</h6>
          </div>
          <!-- password -->
          <div class="form-group">
            <label class="control-label">Password</label>
            <input id="password" name="password" type="text" class="form-control" placeholder="Masukkan password baru(kosongkan bila tidak ingin mengubah)" value="" onchange="validasipassword(this)" onkeyup="validasipassword2(this)" />
            <span id="needmore2" style="color: red"></span>
            <h6>min 6 karakter</h6>
          </div>
          <div class="checkbox">
                <label>
                  <input type="checkbox" required> Setuju dan lanjutkan
                </label>
              </div>
          <!--User-->
          <div class="form-group">
            <input id="id_user" name="id_user" value="" type="text" hidden>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary" disabled> Save Change</a>
      </div>
          {{csrf_field()}} 
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<meta name="_token" content="{!! csrf_token() !!}" />


<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>

<!-- swal delete -->
<script>
  @if(Session::has('message'))
      swal("Berhasil!","{{ Session::get('message')}}","success");
  @endif 
</script>


<script type="text/javascript">
      function valNIP(obj){
      if(obj.value!="" && obj.value.search(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert1").innerHTML = "Isi dengan angka";
        document.getElementById("alert2").innerHTML = "Isi dengan angka";
        document.getElementById("submit").setAttribute("disabled","disabled");
        document.getElementById("save").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("alert1").innerHTML = "";
        document.getElementById("alert2").innerHTML = "";
        document.getElementById("username").setAttribute("value", "");
        document.getElementById("username").setAttribute("value", obj.value);
        document.getElementById("username2").setAttribute("value", "");
        document.getElementById("username2").setAttribute("value", obj.value);
      }
    }

    function validasiusername(obj){
      if(obj.value!="" && obj.value.search(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1 || obj.value!="" && obj.value == ""){
        document.getElementById("alert3").innerHTML = "Isi dengan angka";
        document.getElementById("alert4").innerHTML = "Isi dengan angka";
        document.getElementById("submit").setAttribute("disabled","disabled");
        document.getElementById("save").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("alert3").innerHTML = "";
         document.getElementById("alert4").innerHTML = "";
      }
    }


    function validasipassword(obj){
        if(obj.value != "" && obj.value.length<6){
            document.getElementById("needmore").innerHTML = "Minimal password 6 karakter";
            document.getElementById("needmore2").innerHTML = "Minimal password 6 karakter";
            document.getElementById("submit").setAttribute("disabled","disabled");
            document.getElementById("save").setAttribute("disabled","disabled");
        }
        else{
            document.getElementById("needmore").innerHTML = "";
            document.getElementById("needmore2").innerHTML = "";
            
        }
    }
    function validasipassword2(obj){
        if(obj.value.length>=6 || obj.value==""){
            document.getElementById("needmore").innerHTML = "";
            document.getElementById("needmore2").innerHTML = "";
        }
    }

    setInterval(function(){
      if(document.getElementById("alert1").innerHTML == "" && document.getElementById("alert3").innerHTML == "" && document.getElementById("needmore").innerHTML == ""){
        document.getElementById("submit").removeAttribute("disabled");
      }
    }, 1000); 

    setInterval(function(){
      if(document.getElementById("alert2").innerHTML == "" && document.getElementById("alert4").innerHTML == "" && document.getElementById("needmore2").innerHTML == ""){
        document.getElementById("save").removeAttribute("disabled");
      }
    }, 1000); 
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="id_grup"]').on('change', function() {
      var grupID = $(this).val();
      if(grupID) {
        $.ajax({
          url: '/formajax/'+grupID,
          type: "GET",
          dataType: "json",
          success:function(data) {
              $('select[name="id_jabatan"]').empty();
              i=0;
              $.each(data, function() {
                $('select[name="id_jabatan"]').append('<option value="'+ data[i].id_jabatan +'">'+ data[i].nama_jabatan +'</option>');
                i+=1;
              });
          }
        });
      }else{
        $('select[name="id_jabatan"]').empty();
      }
    });
  });
</script>

@endsection
@section('script')
  <script src="{{URL::asset('js/bootstrap-select.min.js')}}"></script>
@endsection