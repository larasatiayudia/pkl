            
            <ul class="nav nav-pills nav-justified thumbnail hidden-xs">
                @if(\Request::is('formmateri/*'))
                <li class="active"><a href="#">
                @else
                <li class="disabled"><a href="#">
                @endif
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Form Materi</p>
                </a></li>
                @if(\Request::is('formmodul/*')&& $status == 1)
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Form Modul</p>
                </a></li>
                @elseif($status == 1)
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Form Modul</p>
                </a></li>
                @elseif(\Request::is('tipetes/*')&& $status == 0)
                <li class="active"><a href="#">
                <h4 class="list-group-item-heading">Step 2</h4>
                <p class="list-group-item-text">Pilih tipe test</p>
                </a></li>
                @else
                <li class="disabled"><a href="#">
                <h4 class="list-group-item-heading">Step 2</h4>
                <p class="list-group-item-text">Pilih tipe test</p>
                </a></li>
                @endif
                @if(\Request::is('formtest/*'))
                <li class="active"><a href="#">
                @else
                <li class="disabled"><a href="#">
                @endif
                <h4 class="list-group-item-heading">Step 3</h4>
                <p class="list-group-item-text">Form Test</p>
                </a></li>
                @if(\Request::is('formsoal/*'))
                <li class="active"><a href="#">
                @else
                <li class="disabled"><a href="#">
                @endif
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Form Soal</p>
                </a></li>
            </ul>