@extends('layout.superadmin')
@section('title', 'Pilih Jabatan')

@include('admin_grup.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/pilihjabatan.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="col-md-offset-1 col-md-11">
   
      <div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><b><i class="fa fa-list"></i> Test</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>
    
    <div class="panel panel-default">
    <div class="panel-body" style="background-color: white">
    <div class="col-md-11">
      <h3>Pilih Jabatan</h3><br>
      @foreach($jabatans as $jabatan)
      <div class="col-md-6" style="margin-top: -15px">
      
        
            <div class="thumbnail">
                  <div class="caption">
                    <div class='col-lg-12 col-md-4'>
                        <br>
                    </div>
                    <div class='col-lg-12  well-add-card' style="background-color: #4d8976">
                        <h4 style="color: white">{{$jabatan->nama_jabatan}}</h4>
                    </div>
                    <div class='col-lg-12'>
                        <!-- <p>4111xxxxxxxx3265</p>
                        <p class"text-muted">Exp: 12-08</p> -->
                        <br><br>
                    </div>
                    <div class="container-fluid">
                    <a href="{{url('/admin/materisoal/'.Hashids::encode($jabatan->id_jabatan,1))}}" class="btn btn-primary" style="border-radius: 5px">Periode </a>
                    <a href="{{url('/admin/materisoal/'.Hashids::encode($jabatan->id_jabatan,0))}}"  class="btn btn-primary" style="border-radius: 5px">In Class</a> 
                    </div>
                </div>
              </div>
           
      </div>
       @endforeach

    </div>


</div>
</div>
</div>
</div>


<script type="text/javascript">
  @if(Session::has('msg'))
  swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
  @endif
</script>
@endsection