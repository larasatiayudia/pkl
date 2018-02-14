@extends('layout.user')

@section('title', 'Baca Modul')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bacamateri.css')}}">
@endsection

@include('user.navbar')

@section('content')
<input type="text" id="modul" value="{{$id}}" hidden>
<input type="text" id="materi" value="{{$id_mat}}" hidden>
<div class="container">
    @if($status)
      @include('user.stepuser')
    @else
      @include('user.steptespendek')
    @endif

       

	<div class="panel panel-default" style="background-color: #ddd">
    <div class="panel-body" style="text-align: center">
       <div class="row">
            <div class="col-md-4 col-xs-9">             
                    <div class="panel panel-default" style="border: 10px solid #01573C;border-radius: 3px">
                      <div id="countdown" class="panel-body">
                      </div>
                    </div>
                    <span>Minimal waktu baca : {{$modul->durasi}} menit</span>
            </div>
            <div class="col-md-8 col-xs-3">
              <a id="skip" href="{{url('/deskripsitest/'.$id_mat)}}" class="btn btn-success disabled pull-right" style=" margin-top: 5px"><font size="6">Skip</font></a>
            </div>
        </div>

      <div class="embed-responsive embed-responsive-16by9 hidden-xs">
        <iframe class="embed-responsive-item" id="iframe" src ="{{URL::asset('modul/'.$modul->materi->id_mat.'/'.$modul->file)}}#toolbar=0&#navpanes=0&scrollbar=0" width="800" height="500" allowfullscreen webkitallowfullscreen></iframe>
      </div>

      <div class="embed-responsive embed-responsive-4by3 visible-xs">
       <iframe class="embed-responsive-item" id="iframe" src ="{{URL::asset('modul/'.$modul->materi->id_mat.'/'.$modul->file)}}#toolbar=0&#navpanes=0&scrollbar=0" width="800" height="500" allowfullscreen webkitallowfullscreen></iframe>
      </div>

    </div>
  </div>

  
</div>
	
</div>
@endsection

@section('script')
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
        <script type="text/javascript">
            setInterval(function(){ 
                 var id =  document.getElementById("modul").value;
                 var id_mat =  document.getElementById("materi").value;
                 $.ajax({
                    url: '/countdownmodul/'+id,
                    success: function(data){
                        $('#countdown').html("Waktu baca: " + Math.floor(data.countdown / 3600) + " jam " + Math.floor(data.countdown % 3600 / 60) + " menit " + data.countdown % 60 + " detik");
                        if(data.countdown>data.batas){
                          $("#skip").removeClass().addClass('btn btn-success pull-right');
                        }else{
                          $("#skip").removeClass().addClass('btn btn-success disabled pull-right');
                        }
                    }
                });
            }, 1000);
        </script>
@endsection