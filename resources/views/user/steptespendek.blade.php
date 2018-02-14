@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/stepshort.css')}}">
@endsection
		<!-- navigasi step untuk PC -->
		<div class="process">
            <div class="process-row hidden-xs">
                <div class="process-step col-md-4 col-sm-3">
                    @if(\Request::is('deskripsimateri/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-user fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-user fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Deskripsi Materi</b></p>
                </div>
                <div class="process-step col-md-4 col-sm-3">
                    @if(\Request::is('deskripsitest/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-thumbs-up fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-thumbs-up fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Pelaksanaan Tes</b></p>
                </div>
                <div class="process-step col-md-4 col-sm-3">
                    @if(\Request::is('hasiltest/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-eur fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-eur fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Hasil Tes</b></p>
                </div> 
            </div>
        </div><br>
          <!-- navigasi step untuk mobile -->
          <div class="process visible-xs">
            <div class="process-row2">
                <div class="process-step col-xs-4">
                    @if(\Request::is('deskripsimateri/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-user fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-user fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Deskripsi Materi</b></p>
                </div>
                <div class="process-step col-xs-4">
                    @if(\Request::is('deskripsitest/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-thumbs-up fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-thumbs-up fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Tes Dimulai</b></p>
                </div> 
                 <div class="process-step col-xs-4">
                    @if(\Request::is('hasiltest/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-eur fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-eur fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Hasil Tes</b></p>
                </div> 
            </div>
        </div><br>