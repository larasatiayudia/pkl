@extends('layout.superadmin')
@section('title', 'User')

@include('admin_grup.sidebar')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-select.min.css')}}" />
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
    <li class="completed"><a href="{{route('admingrup.daftarUser')}}"> User</a></li>  
    <li class="active"><a href="javasript:void(0)"> Hasil Tambah User</a></li>
  </ul> 


        <div class="panel panel-default">
        <div class="panel-body" style="background-color: white">

        <div class="form-group">
        <div class="row">
        <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">  
                <!--Button Add-->  
                <button class="btn btn-primary" id="btndownload"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</button>                
                </div>
                <!--Search Box -->
                <form class="form-inline" method="GET" role="search" action="{{route('admingrup.dataUser.search')}}">
                  <div class="input-group col-md-7">
                  <input type="text" id="keywords" name="q" placeholder="Cari berdasarkan Nama, NIP..." class="form-control" /><span class="input-group-btn"><button type="submit" class="btn btn-default" style="height: 34px"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                  </div>
                  </form>      
              </div>
            </div>              
            </div>
          </div>

      <!--DATA TABLE-->
      <h1>Daftar User</h1>
      <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <th>No. </th>
            <th>NIP</th>
            <th>Nama</th>
            <th>username</th>
            <th>Password</th>
            <th>Tanggal Register</th>

          </thead>
          <tbody>
            @if(count($users))
            @foreach($users as $index => $user)
            <tr>
              @php($c=$users->perPage()*($users->currentPage()-1)+1)
              <td>{{$index+$c}} .</td>
              <td>{{$user->NIP}}</td>
              <td>{{$user->Nama}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->registered_pw}}</td>
              <td>{{$user->created_at}}</td>
            </tr>
           @endforeach
           @else
           <tr><td colspan="6">Belum ada data user</td></tr>
          </tbody>
        </table>
        {{$users->links()}}    
      </div>
      <!--END DATA TABLE-->


      <!--DATA TABLE-->
      <div class="table-responsive" id="tableuser" hidden>
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <th>No. </th>
            <th>NIP</th>
            <th>Nama</th>
            <th>username</th>
            <th>Password</th>
            <th>Tanggal Register</th>

          </thead>
          <tbody>
            @foreach($printusr as $index => $usr)
            <tr>
              <td>{{$index+1}} .</td>
              <td>{{$usr->NIP}}</td>
              <td>{{$usr->Nama}}</td>
              <td>{{$usr->username}}</td>
              <td>{{$usr->registered_pw}}</td>
              <td>{{$usr->created_at}}</td>
            </tr>
           @endforeach
          </tbody>
        </table>   
      </div>
      <!--END DATA TABLE-->
    </div>
  </div>
  </div>
  </div>

<script type="text/javascript">
  $(document).ready(function() {
  $("#btndownload").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('tableuser');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      } 

      if(mm<10) {
          mm = '0'+mm
      } 

      today = dd + '-' + mm + '-' + yyyy;

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'DataUserBaru(update '+today+').xls';
    a.click();
  });
});
</script>


<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>


@endsection
@section('script')
<!-- script export excel -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection