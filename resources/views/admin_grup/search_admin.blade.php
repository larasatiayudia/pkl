@extends('layout.superadmin')
@section('title', 'Super Admin')

@include('admin_grup.sidebar')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/user2.css')}}">
@endsection

@section('content')
<div class="container"> 
	<div class="col-md-offset-1 col-md-11">
	    <div class="row">
        <div class="col-md-12">
          <div class="page-title">
            <ol class="breadcrumb judulmenu">
                <br><br>
                <li class="active" style="color:#E5FFCA">
                    <h3><i class="fa fa-user-secret"></i> Admin</h3>
                </li> 
            </ol>
          </div>
        </div>
      </div>

      <!--SEARCH BOX-->
		<form class="form-inline" method="GET" role="search" action="{{route('admingrup.searchAdmin')}}">
		<div class="form-group">
		<div class="input-group">
		  	<div class="row">
			  	<div class="col-md-10">                 
					<input type="text" id="keywords" name="q" placeholder="Search..." class="form-control" style="width: 300px">
					<button type="submit" role="button" ><span class="glyphicon glyphicon-search"></span></button>
			  	</div>
					  
		  	</div>
		</div>
		</div>      
	  	</form>
	  	<!--SEARCH BOX END-->

	<!--FORM ADD ADMIN-->
      <form class="form-inline">         
        <div class="form-group">
          <div class="input-group">
            <div class="row">
              <div class="col-md-12">                 
                <a class="btn btn-primary" href="{{route('admingrup.addAdmin')}}" role="button">Add Admin</a>
              </div>
            </div>
          </div>
        </div>              
      </form>
      <!--END FORM ADD-->
      		<!--DATA TABLE ADMIN-->
			<div class="table-responsive">
				<table id="mytable" class="table table-bordred table-striped">    
				  	<thead>
						<th style="text-align: center;">NIP</th>
					  	<th style="text-align: center;">Nama</th>
					 	<th style="text-align: center;">Kantor</th>
					  	<th style="text-align: center;">Jabatan</th>
					  	<th style="text-align: center;"></th>     
				  	</thead>
					@if(count($users))
				  	<tbody>
				  		@foreach($users as $user)
				  		<tr>
						<td>{{$user->NIP}}</td>
						<td>{{$user->Nama}}</td>
		                <td>
		                @foreach($user->admin as $admin)
                      @if($user->admin->last()!=$admin)
                        {{$admin->jabatan->nama_jabatan}}<br> 
                      @else
                        {{$admin->jabatan->nama_jabatan}}
                      @endif
                    @endforeach </td>
		                
	 				<td><p data-placement="top" data-toggle="tooltip" title="Edit">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editAdmin" data-value="{{$user->id_user}}" data-title="Edit"><span class="glyphicon glyphicon-plus"></span></button></p></td>
                    <td>
                <form id="deleteform" class="delete" role="form" method="POST" action="{{route('admingrup.editAdmin')}}" enctype="multipart/form-data">
                  <p data-placement="top" data-toggle="tooltip" title="Delete">
                    <input name="id_user" type="text" id="id_user" value="{{$user->id_user}}" hidden/> 
                    <button class="btn btn-danger btn-xs" type="button" id="delete" data-name="{{$user->Nama}}" data-table="admin">
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
				{{$users->links()}}
			</div>
			</div>
			</div>

	                  <!-- Modal Edit -->
<div class="modal fade" id="editAdmin" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pilih jabatan</h4>
      </div>
      <div class="modal-body">
      <form role= "form" id="submitadmin" method="POST" action="{{route('admingrup.editAdmin')}}" enctype="multipart/form-data">
      <input name="id_user" type="text" id="id_user" hidden>
      <div class="[form-group]">
      <input type="checkbox" name="fancy-checkbox-default" id="fancy-checkbox-default" autocomplete="off" />
      <div class="[btn-group]">
      <input name="id_user" type="text" id="id_user" hidden>
      <div class="row" id="popup" >
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default"> Save change </button>
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
@endsection