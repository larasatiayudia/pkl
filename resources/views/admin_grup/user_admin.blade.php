@extends('layout.superadmin')
@section('title', 'Tambah Admin')

@include('admin_grup.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container-fluid">
  <div class="col-md-offset-1 col-md-11">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title">
          <ol class="breadcrumb judulmenu">
              <br><br>
              <li class="active" style="color:#01573C">
                  <h3><i class="fa fa-user-secret"></i> Admin</h3>
              </li> 
          </ol>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-md-offset 1 col-md-12">
          <!--SEARCH BOX-->
          <form class="form-inline" method="GET" role="search" action="{{route('admingrup.addAdmin.search')}}">
             <div class="row">
                  <div class="col-md-6"> 
                  <div class="input-group"> 
                    <input type="text" id="keywords" name="q" placeholder="Search..." class="form-control">
                    <span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                  </div>
                  </div> 
                  </div>    
          </form>
          <!--SEARCH BOX END-->

        <!--DATA TABLE-->
        <h1>Daftar User</h1>
        <div class="table-responsive">
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
              <th>NIP</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Unit Kerja</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$user->NIP}}</td>
                <td>{{$user->Nama}}</td>
                <td>{{$user->jabatan->nama_jabatan}}</td>
                <td>{{$user->kantor->nama_kantor}}</td>

                <td><p data-placement="top" data-toggle="tooltip" title="Add">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addAdmin" data-value="{{$user->id_user}}" data-title="Edit"><span class="glyphicon glyphicon-plus"></span></button></p></td>
              </tr>
              @endforeach
            </tbody>
				  </table>     
        </div>
      </div>
  	</div>
  </div>
</div>


<!--MODAL ADD ADMIN-->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pilih jabatan</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="submitadmin" method="POST" action="{{route('admingrup.addAdmin.submit')}}" enctype="multipart/form-data">
      <input name="id_user" type="text" id="id_user" hidden>
      <div class="row" id="popup" >
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default"> Save change </a>
      </div>
      {{csrf_field()}}
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--MODAL ADD END-->

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>

<!-- <script type="text/javascript">
// 	$(document).ready(function(){
// 	$("#mytable #checkall").click(function () {
//         if ($("#mytable #checkall").is(':checked')) {
//             $("#mytable input[type=checkbox]").each(function () {
//                 $(this).prop("checked", true);
//             });

//         } else {
//             $("#mytable input[type=checkbox]").each(function () {
//                 $(this).prop("checked", false);
//             });
//         }
//     });
    
//     $("[data-toggle=tooltip]").tooltip();
// });
</script>-->
@endsection