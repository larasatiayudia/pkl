@extends('layout.user')

@section('title', 'Deskripsi Test')

@include('user.navbar')

@section('content')

<div class="container">
    @if($status)
      @include('user.stepuser')
    @else
      @include('user.steptespendek')
    @endif

    <div class="panel panel-default">
      <div class="panel-body" style=" border:1px solid #01573C">
       <div class="container-fluid" style="background:#669a8a">
              
              <!-- Welcome title -->
              <div class="row" style="margin-bottom:10px;margin-top:10px;">
                <div class="col-md-12" style="text-align: center">
                  <h2 style="color: white">{{$materi->nama_test}}</h2>
                </div>
              </div>
              <!-- welcome content -->
              <div class="row">
                <div class="col-md-12"> <!-- left panel -->
                  <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                    <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                      <p style="margin-bottom:10px;margin-top:10px">{!!$materi->deskripsi!!}</p>
                      @if($status)
                      <a href="{{url('/klikmodul/'.Hashids::encode($modul->id_modul,$status))}}" class="btn btn-success center-block" style="width: 120px">Baca Modul</a>
                      @else
                      <a href="{{url('/deskripsitest/'.Hashids::encode($materi->id_mat,$status))}}" class="btn btn-success center-block" style="width: 120px">Menuju tes</a>
                      @endif
                    </div>
                  </div>
                </div>


              </div>
           
        </div> <!-- End:Container-fluid -->
      </div>
    </div>
</div>
@endsection