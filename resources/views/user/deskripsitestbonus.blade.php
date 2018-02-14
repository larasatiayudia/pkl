@extends('layout.user')

@section('title', 'Deskripsi Test')

@include('user.navbar')

@section('content')

<div class="container">

    <div class="panel panel-default">
      <div class="panel-body">
       <div class="container-fluid" style="background:#669a8a">
              
              <!-- Welcome title -->
              <div class="row" style="margin-bottom:10px;margin-top:10px;">
                <div class="col-md-12" style="text-align: center">             
                  <h2 style="color: white">{{$test->nama}}</h2>
                </div>
              </div>
              <!-- welcome content -->


                  <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                    <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                      <!-- Periode -->
                      <div class="row">                
                            <p style="margin-bottom:10px;margin-top:10px">{{$test->peraturan_test}}</p>
                            @if($peserta->isEmpty())
                              <a href="{{url('/kliksoal/'.Hashids::encode($test->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$test->attempt}})</a>
                            @elseif($peserta[0]->sisa_attempt>0)
                              <a href="{{url('/kliksoal/'.Hashids::encode($test->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$peserta[0]->sisa_attempt}})</a>
                            @else
                              <a href="#" class="btn btn-success center-block disabled" style="width:120px" >Attempts (0)</a>
                            @endif
                        </div>
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