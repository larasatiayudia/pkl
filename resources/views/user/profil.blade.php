@extends('layout.user')

@section('tittle', 'Profil')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/profil.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@section('content')
@include('user.navbar')
<div class="container">
    <ul class="breadcrumbs hidden-xs">
        <li class="completed"><a href="{{url('/home')}}">Home</a></li>
        <li class="active"><a href="javascript:void(0);">Profil</a></li>
    </ul>
    <div class="row">
        <div class="col-md-3">
                @include('user.sidenav')
        </div>
        <div class="col-md-9">
            <div class="card kl-card kl-xl kl-reveal kl-fade kl-overlay kl-show kl-slide-in kl-shine kl-reveal kl-hide kl-spin">
                
                <div class="kl-card-block kl-lg bg-success kl-shadow-br kl-overlay">
                    <div class="kl-background">
                        <img src="{{URL::asset('img/board.jpg')}}">
                    </div>
                    <div class="kl-card-overlay kl-card-overlay-split-v-4 kl-dark kl-inverse kl-bottom-in">
                        <div class="kl-card-overlay-item"></div>
                        <div class="kl-card-overlay-item"></div>
                        <div class="kl-card-overlay-item"></div>
                        <div class="kl-card-overlay-item"></div>
                    </div>
                    <div class="kl-card-item kl-pbl kl-show text-white kl-txt-shadow">
                        <div class="kl-figure-block" style="margin-left: 10px; margin-bottom: 5px">
                            <span class="kl-figure" style="color: white">{{$user->point}}</span>
                            <span class="kl-title text-white" style="color: white">Points</span>
                        </div>
                    </div>
                    <div class="kl-card-item kl-pbr kl-show text-muted kl-txt-shadow">
                        <div class="kl-figure-block"  style="margin-right: 10px; margin-bottom: 5px">
                            <span class="kl-figure" style="color: white">{{$current->nama_level}}</span>
                            <span class="kl-title text-muted" style="color: white">Level</span>
                        </div>
                    </div>
                    <div class="kl-card-item kl-pm kl-show text-white kl-txt-shadow text-center">
                        <font face="roboto" size="6" class="mb-0" style="color: white">{{$user->Nama}}</font>
                        <div class="text-white small" style="color: white; font-size: 17px">{{$user->username}}</div>
                    </div>
                    
                    <div class="kl-card-item kl-ptl kl-v kl-card-social kl-slide-in">
                        
                    </div>

                    
                    <a href="#" class="kl-card-avatar kl-md kl-pm kl-slow kl-hide"><img class="kl-b-success kl-b-circle kl-b-4 kl-slow kl-shadow-br kl-spin" src="{{URL::asset('img/user2.svg')}}" style="width: 100px; height: 100px"></a> 
                    
                </div>
                <div class="panel panel-default">
                  <div class="panel-body">
                      <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#profil" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> <span>Profil</span></a></li>
                          <li role="presentation"><a href="#edit" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  <span>Edit Profil</span></a></li>
                          <li role="presentation"><a href="#mylevel" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-star" aria-hidden="true"></i>  <span>Level Saya</span></a></li>
                          <li role="presentation"><a href="#infolevel" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i>  <span>Info Level</span></a></li>
        
                            <!-- Tab panes -->
                           
                            <div class="tab-content">
                               <!-- panel biodata (1)-->
                              <div role="tabpanel" class="tab-pane active" id="profil"><br>
                                <div class="row">
                                    <div class="col-md-1 col-xs-2"> Nama</div> 
                                    <div class="col-md-1 col-xs-1"> :</div> 
                                    <div class="col-md-8 col-xs-8"> {{$user->Nama}}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1 col-xs-2">NIP</div> 
                                    <div class="col-md-1 col-xs-1">:</div> 
                                    <div class="col-md-8 col-xs-1">{{$user->NIP}}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1 col-xs-2">Unit Kerja</div> 
                                    <div class="col-md-1 col-xs-1">:</div> 
                                    <div class="col-md-8 col-xs-8">{{$user->kantor->nama_kantor}}</div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-1 col-xs-2">Jabatan</div> 
                                    <div class="col-md-1 col-xs-1">:</div> 
                                    <div class="col-md-8 col-xs-8">{{$user->jabatan->nama_jabatan}}</div>
                                </div>
                                
                              </div>

                              <!-- panel edit (2) -->
                              <div role="tabpanel" class="tab-pane" id="edit">
                              <br><br>
                              <div class="row" style="text-align: center">
                                <div class="col-md-offset-2 col-md-4 col-xs-12" style="margin-bottom: 20px">
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#username"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Username</button>

                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#password"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Password</button>
                                </div>
                              </div>
                              </div>
                              <!-- panel level (3) -->
                              <div role="tabpanel" class="tab-pane" id="mylevel"><br>
                                  <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-8">
                                            <h1 class="rating-num text-center">
                                                {{$current->nama_level}}</h1>
                                            <div class="col-md-12 col-xs-12">
                                                <hr style="margin-top: -10px; border:2px solid black">
                                            </div>
                                            <div class="col-md-offset-2 col-xs-offset-4">
                                                <span class="glyphicon glyphicon-user" ></span> Poin Anda
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3 col-md-2 text-right" style="margin-right: -20px">
                                                    <span> {{$current->point_minimum}} </span>
                                                </div>
                                                <div class="col-xs-7 col-md-9">
                                                    <div class="progress progress-striped">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{($user->point - $current->point_minimum)/($next_level->point_minimum - $current->point_minimum) * 100}}%;">
                                                            <span class="sr-only" style="color: black">{{$user->point}}/{{$next_level->point_minimum}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="margin-left: -20px">
                                                    <span>{{$next_level->point_minimum}}</span>
                                                </div><br>
                                            </div> 
                                        </div>
                                        <center>
                                        <div class="col-xs-12 col-md-4">
                                            <img src="{{URL::asset('level/'.$current->id_level.'/'.$current->icon)}}" style="width: 150px">
                                        </div>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="infolevel"><br>
                                
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 text-center">
                                                <h1 class="rating-num">Informasi Level</h1>
                                                <hr style="margin-top: -10px; border:2px solid black">
                                            </div>
                                            <div class="col-xs-12 col-md-12 text-center">
                                                <div class="row rating-desc" style="margin-left: -10px">
                                                   
                                                    @foreach($levels as $index => $level)
                                                    <div class="col-md-1 col-xs-1 text-right">
                                                        <img src="{{URL::asset('level/'.$level->id_level.'/'.$level->icon)}}" style="width: 20px">
                                                    </div>
                                                    <div class="col-xs-2 col-md-1" style="margin-right: -20px">
                                                        <span> {{$level->point_minimum}} </span>
                                                    </div>
                                                    <div class="col-xs-8 col-md-9">
                                                        <div class="progress progress-striped">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                                <center><span class="sr-only hidden-xs">{{$level->nama_level}}</span></center>
                                                                <span class="sr-only visible-xs" style="margin-left: 70px">{{$level->nama_level}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($index+1 != $levels->count())
                                                    <div class="col-md-1 col-xs-1" style="margin-left: -20px">
                                                        <span>{{$levels[$index+1]->point_minimum}}</span>
                                                    </div>
                                                    @endif
 
                                                    <br><br>
                                                    @endforeach
                                                    
                                                    
                                                   
                                                </div>
                                                <!-- end row -->
                                            </div>
                                        </div>
                                    </div>
                         
                            </div>

                        </div>
                      </div>

                    </div>
            
                </div>
            </div>
                
        </div> <!-- card end -->
    </div>
    </div>
</div>

<!-- Modal username -->
<div class="modal fade" id="username" tabindex="-1" role="dialog" aria-labelledby="username">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Username</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" method="POST" enctype="multipart/form-data" action="{{ url('/editusername') }}">
            {{csrf_field()}}
          <div class="form-group">
          <input type="hidden" name="_method" value="PUT">
            <label for="exampleInputName2">Username</label>
            <input id="uname"  type="text" name="username" class="form-control" id="exampleInputName2" value="{{$user->username}}" onkeyup="kirimusername()" required><br>
            <b id="alert" style="color: red"></b>
          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button id="simpan" type="submit" class="btn btn-primary" disabled>Simpan</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal password-->
<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="username">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('/editpassword')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="hidden" name="_method" value="PUT">
                <label for="inputEmail3" class="col-sm-3 control-label">Password Lama</label>
                <div class="col-sm-9">
                    <input name="password" type="password" class="form-control" id="passlama" placeholder="Password Lama" onchange="kirimpass()" onkeyup="kirimpass2()" required>
                    <b id="wrongpass" style="color: red"></b>
                </div>
            </div>
            

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Password Baru</label>
                <div class="col-sm-9">
                    <input name="passbaru" type="password" class="form-control" id="passbaru" placeholder="Minimal 6 karakter" onchange="validasipassword()" onkeyup="validasipassword2()" required>
                    <b id="needmore" style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="confirmpass" placeholder="konfirmasi password baru " onchange="passmatch()" onkeyup="passmatch2()" required>
                    <b id="notmatch" style="color: red"></b>
             
                </div>
                
            </div>
            <div class="checkbox">
                <label>
                  <input type="checkbox" required> Setuju dan lanjutkan
                </label>
            </div>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="submit" type="submit" class="btn btn-primary" disabled>Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    @if(Session::has('msg'))
        swal("{{ Session::get('tittle') }}", "{{ Session::get('msg') }}", "{{ Session::get('alert-type') }}");
    @endif
</script>
<script type="text/javascript">
function validasipassword(){
        var pass = document.getElementById("passbaru");
        if(pass.value != "" && pass.value.length<6){
            document.getElementById("needmore").innerHTML = "Minimal password 6 karakter";
            document.getElementById("submit").setAttribute("disabled","disabled");
        }
        else{
            document.getElementById("needmore").innerHTML = "";

        }
    }
    function validasipassword2(){
        var pass = document.getElementById("passbaru");
        if(pass.value.length>=6 || pass.value==""){
            document.getElementById("needmore").innerHTML = "";

        }
    }
    function passmatch(){
        var pass1 = document.getElementById("passbaru");
        var pass2 = document.getElementById("confirmpass");
        if(pass1.value != pass2.value && pass2.value != ""){
            document.getElementById("notmatch").innerHTML = "Password tidak sama";
            document.getElementById("submit").setAttribute("disabled","disabled");
        }
        else{
            document.getElementById("notmatch").innerHTML = "";
  
        }
    }
    function passmatch2(){
        var pass1 = document.getElementById("passbaru");
        var pass2 = document.getElementById("confirmpass");
        if(pass1.value == pass2.value){
            document.getElementById("notmatch").innerHTML = "";
      
        }

    }

    setInterval(function(){
      if(document.getElementById("needmore").innerHTML == "" && document.getElementById("notmatch").innerHTML == "" && document.getElementById("alert").innerHTML == "" && document.getElementById("wrongpass").innerHTML == ""){
        document.getElementById("submit").removeAttribute("disabled");
      }
    }, 1000); 

</script>
        <script type="text/javascript">
            function kirimpass(){
                var password = document.getElementById("passlama").value;

                var CSRF_TOKEN = '{{csrf_token()}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN':CSRF_TOKEN
                    }
                });
                $.ajax({
                    url:'/comparepass',
                    type:'POST',
                    data:{password:password,_token:CSRF_TOKEN},
                    success : function(data){
                        if(data=="salah" && password!=""){
                            document.getElementById("wrongpass").innerHTML = "Password tidak sama";
                            document.getElementById("submit").setAttribute("disabled","disabled");
                        }

                    }
                });
            }
            function kirimpass2(){
                var password = document.getElementById("passlama").value;

                var CSRF_TOKEN = '{{csrf_token()}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN':CSRF_TOKEN
                    }
                });
                $.ajax({
                    url:'/comparepass',
                    type:'POST',
                    data:{password:password,_token:CSRF_TOKEN},
                    success : function(data){
                        if(data=="bener" || password==""){
                            document.getElementById("wrongpass").innerHTML = "";
                            
                        }
                    }
                });
            }

            function kirimusername(){
                var username = $('#uname').val();
                var CSRF_TOKEN = '{{csrf_token()}}';

                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN':CSRF_TOKEN
                    }
                });
                $.ajax({
                    url:'/compareusername',
                    type:'POST',
                    data:{username:username,_token:CSRF_TOKEN},
                    success : function(data){
                        if(data=="ada" && username!=""){
                            document.getElementById("alert").innerHTML = "Username sudah ada";
                            document.getElementById("simpan").setAttribute("disabled","disabled");
                        }
                        else{
                            document.getElementById("alert").innerHTML = "";
                         
                        }

                        if(username!="" && username.search(/[ ]/g) !== -1){
                            document.getElementById("alert").innerHTML = "Jangan menggunakan spasi";
                            document.getElementById("simpan").setAttribute("disabled","disabled");
                        }
                    }
                });



            }
        </script>
@endsection