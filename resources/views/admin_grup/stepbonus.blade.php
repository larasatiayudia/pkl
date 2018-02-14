<ul class="nav nav-pills nav-justified thumbnail hidden-xs">
                @if(\Request::is('admin/formmateribonus/*'))
                <li class="active"><a href="#" style="background-color: #ffc107">
                @else
                <li class="disabled"><a href="#">
                @endif
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Form Materi</p>
                </a></li>

                @if(\Request::is('admin/tipetesbonus/*'))
                <li class="active"><a href="#" style="background-color: #ffc107">
                <h4 class="list-group-item-heading">Step 2</h4>
                <p class="list-group-item-text">Pilih tipe test</p>
                </a></li>
                @else
                <li class="disabled"><a href="#">
                <h4 class="list-group-item-heading">Step 2</h4>
                <p class="list-group-item-text">Pilih tipe test</p>
                </a></li>
                @endif

                @if(\Request::is('admin/formtestbonus/*'))
                <li class="active"><a href="#" style="background-color: #ffc107">
                @else
                <li class="disabled"><a href="#">
                @endif
                <h4 class="list-group-item-heading">Step 3</h4>
                <p class="list-group-item-text">Form Test</p>
                </a></li>

                @if(\Request::is('admin/formmodulbonus/*'))
                <li class="active"><a href="#" style="background-color: #ffc107">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Form Modul</p>
                </a></li>
                @else
                <li class="disabled"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Form Modul</p>
                </a></li>
                @endif

                @if(\Request::is('admin/formsoalbonus/*'))
                <li class="active"><a href="#" style="background-color: #ffc107">
                @else
                <li class="disabled"><a href="#">
                @endif
                <h4 class="list-group-item-heading">Step 5</h4>
                <p class="list-group-item-text">Form Soal</p>
                </a></li>
</ul>