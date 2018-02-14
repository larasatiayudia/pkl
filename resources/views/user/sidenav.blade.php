			<div class="hidden-xs hidden-sm">
		    <div class="list-group">
		        <span href="#" class="list-group-item active" style="background-color:#01573C">
		            Submenu
		        </span>

		        @if(\Request::is('hasiltest/*'))
		        <a href="{{url('/home')}}" class="list-group-item" style="color:#01573C">
		            <i class="fa fa-home" aria-hidden="true"></i> Home
		        </a>
		       
		        @endif

		        @if(\Request::is('bonussoal'))
		        <a href="{{url('/bonussoal')}}" class="list-group-item" style="color:white;background-color:#3BCA89">
		            <i class="fa fa-rocket" aria-hidden="true"></i> Bonus Tes
		        </a>
		        @else
		        <a href="{{url('/bonussoal')}}" class="list-group-item" style="color:#01573C">
		            <i class="fa fa-rocket" aria-hidden="true"></i> Bonus Tes
		        </a>
		        @endif

		        @if(\Request::is('statistik')||\Request::is('charts/*')||\Request::is('detailstatistik/*'))
		        <a href="{{url('/statistik')}}" class="list-group-item" style="color:white;background-color:#3BCA89">
		            <i class="fa fa-line-chart" aria-hidden="true"></i> Statistik
		        </a>
		        @else
		        <a href="{{url('/statistik')}}" class="list-group-item" style="color:#01573C">
		            <i class="fa fa-line-chart" aria-hidden="true"></i> Statistik
		        </a>
		        @endif

		        @if(\Request::is('profil'))
		        <a href="{{url('/profil')}}" class="list-group-item" style="color:white;background-color:#3BCA89">
		            <i class="fa fa-user" aria-hidden="true"></i> Profil
		        </a>
		        @else
		        <a href="{{url('/profil')}}" class="list-group-item" style="color:#01573C">
		            <i class="fa fa-user" aria-hidden="true"></i> Profil
		        </a>
		        @endif

		        @if(\Request::is('nilai')||\Request::is('daftarnilai/*')||\Request::is('review/*'))
		        <a href="{{url('/nilai')}}" class="list-group-item" style="color:white;background-color: #3BCA89">
		            <i class="fa fa-trophy" aria-hidden="true"></i> Nilai 
		        </a>
		        @else
		        <a href="{{url('/nilai')}}" class="list-group-item" style="color:#01573C">
		            <i class="fa fa-trophy" aria-hidden="true"></i> Nilai 
		        </a>
		        @endif

		        @if(Auth::user()->Status == 1)
			        @if(\Request::is('pilihjabatan')||\Request::is('materisoal/*')||\Request::is('formmateri/*')||\Request::is('formmodul/*')||\Request::is('formtest/*')||\Request::is('formsoal/*'))
			        <a href="{{url('/pilihjabatan')}}" class="list-group-item" style="color:white;background-color:#3BCA89">
			            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Buat Soal
			        </a>
			        @else
			        <a href="{{url('/pilihjabatan')}}" class="list-group-item" style="color:#01573C">
			            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Buat Soal
			        </a>
			        @endif
		        @endif

		    </div>
		    </div>        