@extends('layout.superadmin')
@section('title', 'Search | Jabatan')

@include('admin_grup.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
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
                   <h3><b><i class="fa fa-briefcase"></i> Jabatan</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>

  <ul class="breadcrumbs ">
    <li class="completed"><a href="{{route('admingrup.daftarJabatan')}}"> Jabatan</a></li>    
    <li class="active"><a href="javasript:void(0)"> Pencarian Jabatan</a></li>
  </ul> 


    <div class="panel panel-default">
      <div class="panel-body" style="background-color: white">
      <h2>Daftar Jabatan</h2>
     <br>
      <div class="form-group">
        <div class="row">
          <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-5">  <!--Button Add-->  
                    <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addJabatan"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Jabatan</button>                
                    </div>
                    <!--Search Box -->
                    <form class="form-inline" method="GET" role="search" action="{{route('admingrup.searchJabatan')}}">
                      <div class="input-group col-md-7">
                      <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan nama jabatan..." class="form-control"/><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                      </div>
                      </form>      
                  </div>
                </div>              
                </div>
              </div>
            

        <!-- table -->
        <h1>Hasil Pencarian : {{$q}} </h1>
        <h3>{{$grup->nama_grup}}</h3>
        <div class="table-responsive">
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
              <th>No.</th>
              <th>Jabatan</th>
              <th></th>
              <th></th>
              
            </thead>
            @if(count($jabatans))
            <tbody>
                @foreach($jabatans as $index => $jabatan)
              <tr>
              @php($c=$jabatans->perPage()*($jabatans->currentPage()-1)+1)
                <td>{{$index+$c}} .</td>
                <td>{{$jabatan->nama_jabatan}}</td>
                <td> 
                  <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <button class="btn btn-primary open_modal" data-title="Edit" data-toggle="modal" data-target="#editJabatan" data-value="{{$jabatan->nama_jabatan}}" 
                    >
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                  </p>
                </td>
                <td>
                  <form id="deleteform" class="delete" role="form" method="POST" action="{{route('admingrup.deleteJabatan',['id'=>$jabatan->id_jabatan])}}" enctype="multipart/form-data">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                      <input name=_method"" type="hidden" id="" value="DELETE" /> 
                      <button class="btn btn-danger" type="button" id="delete" data-name="{{$jabatan->nama_jabatan}}" data-table="Jabatan" data-id="{{$jabatan->id_jabatan}}">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    </p>
                    {{csrf_field()}}  
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
            @else
            <h3><b>Tidak ditemukan</b></h3>
            @endif
          </table>    
          {{$jabatans->links()}}
        </div>
      </div>
    </div>
    </div>
    </div>


<!--Modal Add Jabatan-->
<div class="modal fade" id="addJabatan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Jabatan</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="addJabatan" method="POST" action="{{route('admingrup.addJabatan')}}" enctype="multipart/form-data">
      <div class="form-group">
            <label class="control-label">Nama Jabatan</label>
            <input id="jabatan" name="jabatan" type="text" required="required" class="form-control" placeholder="Masukkan Nama Jabatan"  />
          </div>
          <div class="form-group">
            <label class="control-label">Grup</label>
            <input id="id_grup" name="id_grup" type="hidden" required="required" class="form-control" value="{{$grup->id_grup}}" placeholder="Masukkan Grup"  />
          </div>
      <div class="row" id="popup" >
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save </button>
      </div>
      {{csrf_field()}}
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   

<!--Modal Edit Jabatan-->
<div class="modal fade" id="editJabatan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Jabatan</h4>
      </div>
      <div class="modal-body">
       <form role= "form" id="edit" method="POST" action="{{route('admingrup.editJabatan')}}" enctype="multipart/form-data">
      <div class="form-group">
          <input name="_method" type="hidden" value="PUT">
            <label class="control-label">Nama Jabatan</label>
            <input id="jabatan" name="jabatan" type="text" required="required" class="form-control" placeholder="Masukkan Nama Jabatan"  />
          </div>
          <div class="form-group">
            <label class="control-label">Grup</label>
            <input id="id_jabatan" name="id_jabatan" type="hidden" required="required" class="form-control" placeholder="Masukkan Grup"  />
          </div>
      <div class="row" id="popup" >
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save change </button>
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
@endsection