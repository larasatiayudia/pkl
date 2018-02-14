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
      <div class="panel-body">
       <div class="container-fluid" style="background:#669a8a">
              
              <!-- Welcome title -->
              <div class="row" style="margin-bottom:10px;margin-top:10px;">
                <div class="col-md-12" style="text-align: center">
                  @if($status)
                  <h2 style="color: white">Peraturan {{$test->nama}}</h2>
                  @else
                  <h2 style="color: white">Pilihan Test</h2>
                  @endif
                </div>
              </div>
              <!-- welcome content -->


                  <div class="panel panel-default" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 3px 10px 0 rgba(0, 0, 0, 0.1);">
                    <div class="panel-body" style="margin-left: 10px;margin-right: 10px;">
                      <!-- Periode -->
                      <div class="row"> 
                          @if($status)
                            <p style="margin-bottom:10px;margin-top:10px">{!!$test->peraturan_test!!}</p>
                            @if($peserta->isEmpty())
                              <a href="{{url('/kliksoal/'.Hashids::encode($test->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$test->attempt}})</a>
                            @elseif($peserta[0]->sisa_attempt>0)
                              <a href="{{url('/kliksoal/'.Hashids::encode($test->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$peserta[0]->sisa_attempt}})</a>
                            @else
                              <a href="#" class="btn btn-success center-block disabled" style="width:120px" >Attempts (0)</a>
                            @endif
                        </div>
                  
                      <!-- In Class -->
                      @else
                        <br>
                      <div class="panel panel-success">
                          <div class="panel-heading clearfix">Pre Test
                            <div class="pull-right">
                              <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapse1"
                                aria-expanded="false" aria-controls="collapse03"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                            </div>
                          </div>
                          <div class="panel-body collapse" id="collapse1">
                              @if($pretest != null)
                                <p style="margin-bottom:10px;margin-top:10px">{{$pretest->peraturan_test}}</p>
                                @if($pesertapre==null)
                                  <a href="{{url('/kliksoal/'.Hashids::encode($pretest->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$pretest->attempt}})</a>
                                @else
                                  <a href="{{url('/kliksoal/'.Hashids::encode($pretest->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$pesertapre->sisa_attempt}})</a>
                                @endif
                              @else
                                <h4>Tidak ada pretest untuk materi ini</h4>
                              @endif
                          </div>
                      </div>

                      <div class="panel panel-success">
                          <div class="panel-heading clearfix">Post Test
                            <div class="pull-right">
                              <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapse2"
                                aria-expanded="false" aria-controls="collapse03"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                            </div>
                          </div>
                          <div class="panel-body collapse" id="collapse2">
                              @if($posttest != null)
                                <p style="margin-bottom:10px;margin-top:10px">{{$posttest->peraturan_test}}</p>
                                @if($pesertapost==null)
                                  <a href="{{url('/kliksoal/'.Hashids::encode($posttest->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$posttest->attempt}})</a>
                                @else
                                  <a href="{{url('/kliksoal/'.Hashids::encode($posttest->id_test))}}" class="btn btn-success center-block" style="width:120px">Attempts ({{$pesertapost->sisa_attempt}})</a>
                                @endif
                              @else
                                <h4>Tidak posttest untuk materi ini</h4>
                              @endif
                          </div>
                      </div>
                      @endif



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