        @section('styles')
        <link rel="stylesheet" type="text/css" href="{{url::asset('css/step.css')}}">
        @endsection
        <!-- PC -->
        <div class="process">
            <div class="process-row hidden-xs">
                <div class="process-step col-md-3 col-sm-3">
                    @if(\Request::is('deskripsimateri/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-list-alt fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-list-alt fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Deskripsi Materi</b></p>
                </div>
                <div class="process-step col-md-3 col-sm-3">
                    @if(\Request::is('bacamateri/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-book fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-book fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Baca Materi</b></p>
                </div>
                <div class="process-step col-md-3 col-sm-3">
                    @if(\Request::is('deskripsitest/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Pelaksanaan Tes</b></p>
                </div> 
                 <div class="process-step col-md-3 col-sm-3">
                    @if(\Request::is('hasiltest/*'))
                    <button type="button" class="btn btn-warning btn-circle" disabled="disabled"><i class="fa fa-graduation-cap fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-graduation-cap fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09; font-size: 20"><b>Hasil Tes</b></p>
                </div> 
            </div>
        </div><br>

        <!-- mobile -->
        <div class="process visible-xs">
            <div class="process-row2">
                <div class="process-step col-xs-3">
                    @if(\Request::is('deskripsimateri/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-list-alt fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-list-alt fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Deskripsi Materi</b></p>
                </div>
                <div class="process-step col-xs-3">
                    @if(\Request::is('bacamateri/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-book fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-book fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Baca Materi</b></p>
                </div>
                <div class="process-step col-xs-3">
                    @if(\Request::is('deskripsitest/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-pencil fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Tes Dimulai</b></p>
                </div> 
                 <div class="process-step col-xs-3">
                    @if(\Request::is('hasiltest/*'))
                    <button type="button" class="btn btn-warning btn-circles" disabled="disabled"><i class="fa fa-graduation-cap fa-3x"></i></button>
                    @else
                    <button type="button" class="btn btn-default btn-circles" disabled="disabled"><i class="fa fa-graduation-cap fa-3x"></i></button>
                    @endif
                    <p style="color: #c15c09"><b>Hasil Tes</b></p>
                </div> 
            </div>
        </div><br>