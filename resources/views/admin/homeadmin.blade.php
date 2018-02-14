@extends('layout.user')

@section('title', 'Refreshment Test')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/home.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container"> 

		<!-- PC -->
    <div class="hidden-xs hidden-sm">
      <div class="row" style="padding-left: 100px">
	      <div class="col-md-4 visible-lg">
	        <div class="circle">
	          <a href="#" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/test.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
	        </div>
          <h1 style="margin-left: 95px;margin-top: -30px">Tes</h1>
	      </div>
	      <div class="col-md-4 visible-lg">
	        <div class="circle">
	          <a href="{{url('/pilihjabatan')}}" ><img src="{{asset('img/create.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
	        </div>
          <h1 style="margin-left: 50px;margin-top: -30px">Buat Soal</h1>
	      </div>
          <div class="col-md-4 visible-lg">
            <div class="circle">
               <a href="{{url('/profil')}}"><img src="{{asset('img/user.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
            </div>
            <h1 style="margin-left: 90px;margin-top: -30px">Profil</h1>
          </div>
      </div>
      
      <div class="garismerah center-block visible-lg" style="width: 80%"></div>

      <div class="row" style="padding-right: 50px">
	      <div class="col-md-offset-3 col-lg-4 visible-lg">
	        <div class="circle">
	           <a href="{{url('/nilai')}}"><img src="{{asset('img/trophy.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"></a>
	        </div>
          <h1 style="margin-left: 90px;margin-top: -30px">Nilai</h1>
	      </div>
	      <div class="col-md-4 visible-lg">
	        <div class="circle">
	           <a href="{{url('/statistik')}}"> <img src="{{asset('img/statistic.svg')}}" style="margin-top: 15px; width: 100px;height: 100px"> </a>
	        </div>
          <h1 style="margin-left: 65px;margin-top: -30px">Statistik</h1>
	      </div>
      </div>
    </div>

      <!-- mobile -->
     <div class="row visible-xs">
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="#" data-toggle="modal" data-target="#myModal"><img src="{{asset('img/test.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h1 style="margin-left: 60px;margin-top: -30px">Tes</h1>
        </div>
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/statistik')}}"><img src="{{asset('img/statistic.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h1 style="margin-left: 30px;margin-top: -30px">Statistik</h1>
        </div>
      </div>
      <div class="garismerah center-block visible-xs" style="width: 80%;margin-top: 10px"></div>
       <div class="row visible-xs">
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/profil')}}"><img src="{{asset('img/user.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"></a>
          </div>
          <h1 style="margin-left: 60px;margin-top: -30px">Profil</h1>
        </div>
        <div class="col-xs-5">
          <div class="circlexs">
            <a href="{{url('/nilai')}}"> <img src="{{asset('img/trophy.svg')}}" style="margin-top: 10px; width: 60px;height: 60px"> </a>
          </div>
          <h1 style="margin-left: 60px;margin-top: -30px">Nilai</h1>
        </div>
      </div>

</div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Tipe Tes</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-offset-2 col-md-5 col-xs-offset-1 col-xs-5">
                    <a href="{{('/materi/jangkapendek')}}" class="btn btn-default orange-circle-button" href=""></a><br>  
                    <font face="roboto" size="4">In Class</font>
                  </div>
                  <div class="col-md-5 col-xs-5">
                    <a href="{{('/materi/jangkapanjang')}}" class="btn btn-default orange-circle-button" href=""></a><br>   
                    <font face="roboto" size="4">Periode</font>
                  </div>

              </div><br>
              <div class="modal-footer">
                
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

