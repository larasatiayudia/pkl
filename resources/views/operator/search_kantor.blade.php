@extends('layout.superadmin')
@section('title', 'Search | Kantor')

@include('operator.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/option.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/tabpanel.css')}}">
@endsection

@section('content')
@php($tabName=\Session::get('tab'))
<div class="container-fluid">
  <div class="col-md-offset-1 col-md-11">
    <div class="row">
      <div class="col-md-12">
        <div class="page-title">
           <ol class="breadcrumb judulmenu"><br><br>
              <li class="active" style="color:#E5FFCA">
                <h3><i class="fa fa-university"></i><b> Kantor</b></h3>
              </li> 
           </ol>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-body" style="background-color: white">
    <!--TAB-->
    <div class="row">
      <div class="col-md-12">
        <div class="tabbable-panel">
          <div class="tabbable-line">
            <ul class="nav nav-tabs">
              <li class="{{ empty($tabName) ? 'active' : '' }}"><a href="#kantor" data-toggle="tab"><b>Kantor</b></a></li>
              <li class="{{ !empty($tabName) || $tabName == 'tipe' ? 'active' : '' }}"><a href="#tipe" data-toggle="tab"><b>Tipe Kantor</b></a></li>       
            </ul>
          </div>
          <div class="tab-content">
            <!--TAB KANTOR-->
            <div class="tab-pane {{ empty($tabName) ? 'active' : '' }}" id="kantor">
              <h2>Hasil pencarian kantor untuk : {{$q}}</h2><br>
                 <div class="form-group">
      <div class="row">
      <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">  <!--Button Add-->  
                <button class="btn btn-primary open_modal" data-title="addKantor" data-toggle="modal" data-target="#addKantor"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Kantor</button>                
                </div> 
                <!--Search Box -->
                <form class="form-inline" method="GET" role="search" action="{{route('operator.searchKantor')}}">
                <div class="input-group col-md-7">
                  <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan nama kantor,tipe kantor..." class="form-control"/><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                  </div>
                  </form>      
              </div>
            </div>              
            </div>
          </div>
              <!--DATA TABLE-->
              <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                  <thead>
                    <th>No.</th>
                    <th>Tipe/Status</th>
                    <th>Kantor</th>
                    <th>Koordinasi</th>
                    <th></th>
                    <th></th>
                    
                  </thead>
                  @if(count($kantors))
                  <tbody>
                    @foreach($kantors as $index => $kantor)
                    <tr>
                      @php($c=$kantors->perPage()*($kantors->currentPage()-1)+1)
                      <td>{{$index+$c}} .</td>
                      <td>{{$kantor->tipekantor->tipe_kantor}}</td>
                      <td>{{$kantor->nama_kantor}}</td>
                      @if(count($kantor->superkantor))
                      <td>
                        @php($k=$kantor)
                        @while($k->superkantor)
                        {{$k->superkantor->nama_kantor}}<br>
                            @php($k=$k->superkantor)
                        @endwhile
                      </td>
                      @else
                      <td>-</td>
                      @endif
                      <td> 
                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                          <button class="btn btn-primary  open_modal" data-title="Edit" data-toggle="modal" data-target="#editKantor" 
                          data-value="{{$kantor->nama_kantor}}" data-tipe="{{$kantor->tipe}}" data-id="{{$kantor->id_kantor}}" data-level="{{$kantor->level}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </button>
                        </p>
                      </td>
                      <td>
                        <form id="deleteform" class="delete" role="form" method="POST" action="{{route('operator.deleteKantor',['id'=>$kantor->id_kantor])}}" enctype="multipart/form-data">
                          <p data-placement="top" data-toggle="tooltip" title="Delete"> 
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button class="btn btn-danger " type="button" id="delete" data-name="{{$kantor->nama_kantor}}" data-table="Kantor">
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
                    <div class="panel-heading"></div>
                    <div class="panel-body">Tidak ditemukan</div>
                  @endif
                </table>
                {{$kantors->links()}}    
              </div>
              <!--END DATA TABLE-->
            </div>
            <!--TAB KANTOR END-->

            <!--TAB TIPE KANTOR-->
            <div class="tab-pane {{ !empty($tabName) || $tabName == 'tipe' ? 'active' : '' }}" id="tipe">
              <h2>Daftar Tipe Kantor</h2><br>
                <!--FORM ADD TIPE-->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-5"> 
                          <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addTipe"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Tipe Kantor</button>                
                        </div>       
                      </div>
                    </div>              
                  </div>
                </div>
                <!--END FORM ADD-->
                <!--DATA TABLE-->
                <div class="table-responsive">
                  <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                      <th>Tipe</th>
                      <th>Level</th>
                      <th>Grup</th>
                      <th></th>
                      <th></th>
                      
                    </thead>
                    <tbody>
                      @foreach($tipekantor as $tipe)
                      <tr>
                        <td>{{$tipe->tipe_kantor}}</td>
                        <td>{{$tipe->level}}</td>
                        <td>{{$tipe->grup->kode_grup}}</td>
                        <td> 
                          <p data-placement="top" data-toggle="tooltip" title="Edit">
                            <button class="btn btn-primary btn-xs open_modal" data-title="Edit" data-toggle="modal" data-target="#editTipe" 
                            data-grup="{{$tipe->id_grup}}" data-tipe="{{$tipe->tipe_kantor}}" data-id="{{$tipe->id_tipe}}" data-level="{{$tipe->level}}">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                          </p>
                        </td>
                        <td>
                          <form id="deleteform" class="delete" role="form" method="POST" action="{{route('operator.deleteTipe',['id'=>$tipe->id_tipe])}}" enctype="multipart/form-data">
                            <p data-placement="top" data-toggle="tooltip" title="Delete"> 
                              <input type="hidden" name="_method" value="DELETE"/>
                              <button class="btn btn-danger btn-xs" type="button" id="delete" data-name="{{$tipe->tipe_kantor}}" data-table="Tipe Kantor">
                                <span class="glyphicon glyphicon-trash"></span>
                              </button>
                            </p>
                            {{csrf_field()}}
                          </form>
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                <!--END DATA TABLE-->
              </div>
              <!--END TAB TIPE-->
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
</div>


<!--Modal Add Kantor-->
<div class="modal fade" id="addKantor" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Kantor</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="addKantor" method="POST" action="{{route('operator.addKantor')}}" enctype="multipart/form-data">
          <div class="form-group">
          <div class="row">
          <div class="col-md-4">
            <label class="control-label">Tipe/Status Kantor : </label>
            <select id="tipe" name="tipe" class="form-control" style="width:170px;">
              <!--ajaxscript-->
            </select> 
          </div>
          <div class="col-md-8">
             <label class="control-label">Di Bawah Koordinasi Kantor : </label>
            <select id="superkantor" name="superkantor"class="form-control">
            </select>
            </div>
          </div>
          </div>

          <div class="form-group">
            <label class="control-label">Nama Kantor : </label>
            <input id="kantor" name="kantor" type="text" required="required" class="form-control" placeholder="Masukkan Nama Kantor"/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save </a>
      </div>
        {{csrf_field()}}
        </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   

<!--Modal Edit Kantor-->
<div class="modal fade" id="editKantor" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Kantor</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="edit" method="POST" action="{{route('operator.editKantor')}}" enctype="multipart/form-data">
        <div class="form-group">
          <input name="_method" type="hidden" value="PUT"/>
          <input name="id_kantor" id="id_kantor" type="hidden" value=""/>
        </div>
        <div class="form-group">
          <div class="row">
          <div class="col-md-4">
            <label class="control-label">Tipe Kantor</label>
            <select id="tipe" name="tipe" class="form-control" style="width:170px;">
              <!--ajaxscript-->
            </select> 
          </div>
          <div class="col-md-8">
            <label class="control-label">Koordinasi Kantor</label>
            <select id="superkantor" name="superkantor"class="form-control"></select>
          </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Nama Kantor</label>
          <input id="kantor" name="kantor" type="text" required="required" class="form-control" placeholder="Masukkan Nama Kantor"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save </a>
      </div>
      {{csrf_field()}}
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal Add Tipe Kantor-->
<div class="modal fade" id="addTipe" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Tipe Kantor</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="addTipe" method="POST" action="{{route('operator.addTipe')}}" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label">Tipe : </label>
            <input id="tipe" name="tipe" type="text" required="required" class="form-control" placeholder="Masukkan Tipe/Status Kantor"/>
          </div>
          <div class="form-group">
          <div class="row">
          <div class="col-md-4">
            <label class="control-label">Level : </label>
            <select id="level" name="level" class="form-control">
              <option value"" disabled selected> -- Pilih Level -- </option>
            @php($i=0)
            @while($i<10)
              <option value="{{$i}}"> {{$i}}</option>
              @php($i+=1)
            @endwhile
            </select>
          </div>
          <div class="col-md-8">
            <label class="control-label">Unit Kerja untuk Grup : </label>
            <select class="form-control" id="listgrup" name="grup">
              <!--ajaxscript-->
            </select>
          </div>
          </div>
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

<!--Modal Edit Tipe Kantor-->
<div class="modal fade" id="editTipe" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Tipe Kantor</h4>
      </div>
      <div class="modal-body">
        <form role= "form" id="editTipe" method="POST" action="{{route('operator.editTipe')}}" enctype="multipart/form-data">
          <div class="form-group">
            <input name="_method" type="hidden" value="PUT"/>
            <input name="id_tipe" id="id_tipe" type="hidden" value=""/>
          </div>
          <div class="form-group">
            <label class="control-label">Tipe : </label>
            <input id="tipe" name="tipe" type="text" required="required" class="form-control" placeholder="Masukkan Tipe/Status Kantor"/>
          </div>
          <div class="form-group">
          <div class="row">
          <div class="col-md-4">
            <label class="control-label">Level : </label>
            <select id="level" name="level" class="form-control">
            <!--ajaxscript-->
            </select>
          </div>
          <div class="col-md-8">
            <label class="control-label">Unit Kerja untuk Grup : </label>
            <select class="form-control" id="listgrup" name="grup">
              <!--ajaxscript-->
            </select>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save </a>
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
