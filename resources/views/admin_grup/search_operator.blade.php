@extends('layout.superadmin')
@section('title', 'Jabatan')

@include('admin_grup.sidebar')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
<div class="container">

      <div class="col-md-offset-1 col-md-11">

      <!-- search box -->
      <form class="form-inline" method="GET" role="search" action="{{route('admingrup.searchOK')}}">
      <div class="input-group col-md-10">
              <div class="row">
                <div class="col-md-10">                 
                  <input type="text" id="keywords" name="q" placeholder="Search..." class="form-control"/><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                
                </div>           
              </div>
            </div>
            </form>    
         
         <!-- button tambah operator --> 
        <form class="form-inline">         
          <div class="form-group">
            <div class="input-group">
              <div class="row">
                <div class="col-md-12">                 
                  <button class="btn btn-primary open_modal" data-title="add" data-toggle="modal" data-target="#addOK"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Operator</button>
                </div>
              </div>
            </div>
          </div>              
        </form>

        <!-- table operator -->
        <h1>Hasil Pencarian : {{$q}}</h1><br>
        <h3>{{$grup->nama_grup}}</h3>
        <div class="table-responsive">
          <table id="mytable" class="table table-bordred table-striped">
            <thead>
              <th>Username</th>
              <th>Kantor</th>
              <th></th>
              <th></th>
              
            </thead>
            @if(count($operators))
            <tbody>
                @foreach($operators as $operator)
              <tr>
                <td>{{$operator-> username}}</td>
                <td>{{$operator->operator_kantor->kantor->nama_kantor}}</td>
                <td> 
                  <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <button class="btn btn-primary btn-xs open_modal" data-title="Edit" data-toggle="modal" data-target="#editOK" data-value="{{$operator->id_sa}}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                  </p>
                </td>
                <td>
                  <form id="deleteform" class="delete" role="form" method="POST" action="{{route('admingrup.deleteOperator',['id' => $operator->id_sa]))}}" enctype="multipart/form-data">
                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                      <input name="" type="text" id="" value="" hidden/> 
                      <button class="btn btn-danger btn-xs" type="button" id="delete">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    </p>
                      
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
            @else
            <div class="panel-default">Tidak ditemukan</div>
            @endif
          </table>    
        </div>
      </div>
    </div>
  

<!--Modal Add Operator-->
<div class="modal fade" id="addOK" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Operator</h4>
      </div>
      <div class="modal-body">
       <form role= "form" id="addOK" method="POST" action="{{route('admingrup.addOperator')}}" enctype="multipart/form-data">
      <div class="form-group">
            <label class="control-label">Username</label>
            <input id="username" name="username" type="text" required="required" class="form-control" placeholder="Masukkan Username"  />
          </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input id="password" name="password" type="password" required="required" class="form-control" placeholder="Masukkan Password"  />
          </div>
          <div class="form-group">
            <label class="control-label">Kantor</label>
            <select id="listkantors" name="kantor" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-control" ></select>
          </div>
      <div class="row" id="listKantor" >
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

<!--Modal Edit -->
<div class="modal fade" id="editOK" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Operator Kantor</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="addOK" method="POST" action="{{route('admingrup.editOperator')}}" enctype="multipart/form-data">
      <div class="form-group">
            <input name="_method" type="hidden" value="PUT"/>
            <input id="id_sa" name="id_sa" type="hidden" class="form-control"/>
      </div>
      <div class="form-group">
            <label class="control-label">Nama Jabatan</label>
            <input id="" name="" type="text" required="required" class="form-control" placeholder="Masukkan Nama Jabatan"  />
          </div>
          <div class="form-group">
            <label class="control-label">Grup</label>
            <input id="" name="" type="" required="required" class="form-control" placeholder="Masukkan Grup"  />
          </div>
           <div class="form-group">
            <label class="control-label">Kantor</label>
            <select id="listkantor" name="kantor" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-control" ></select>
          </div>
      <div class="row" id="popup" >
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save change </a>
      </div>
      {{csrf_field()}}
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  $('button#delete').on('click',function(){
  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false
},
function () {
  $("#deleteform").submit();
});
  })

  @if(Session::has('message'))
      swal("Hapus!","{{ Session::get('message')}}","success");
  @endif
  
</script>
@endsection