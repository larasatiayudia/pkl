@extends('layout.superadmin')
@section('title', 'Operator')
@include('operator.sidebar')


@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/profil_admin.css')}}">
@endsection

@section('content')
  <div class="container-fluid">
  <div class="col-md-offset-1 col-md-11">
    <div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><i class="fa fa-user"></i><b> Profil Saya</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>
<div class="full-width">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="custom-form">
                <div class="text-center bg-form">
                    <div class="img-section">
                        <img src="{{URL::asset('img/user.png')}}" class="imgCircle" alt="Profile picture">
                    <div class="col-lg-12">
                        <a href="javascript:void(0)" id="button" onclick="clickbutton(this)"><h4 class="text-right col-lg-12"><span class="glyphicon glyphicon-edit"></span> Edit Profile</h4></a>
                        <a href="javascript:void(0)" id="buttonback" onclick="clickbuttoninverse(this)" hidden><h4 class="text-right col-lg-12"><span class="glyphicon glyphicon-user"></span> Back to My Profile</h4></a>
                    </div>
                    </div>
                  
                </div>
                <form role="form" method="POST" action="{{route('operator.editProfile')}}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <div class="col-lg-12 col-md-12">
                    <input type="text" name="username" class="form-control form-input" value="{{$myprofile->username}}" placeholder="Name" disabled id="name">
                    <span class="glyphicon glyphicon-user input-place"></span>
                </div>
                <div class="col-lg-12 col-md-12">
                    <input type="text" class="form-control form-input" value="{{$myprofile->email}}" placeholder="Email ID" name="email" id="email" disabled>
                    <span class="glyphicon glyphicon-envelope input-place"></span>
                </div>
                <div class="col-lg-12 col-md-12" id="btnpw" hidden>
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel">Edit Password</a>
                          <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel">
                          <i class="glyphicon glyphicon-chevron-down"></i>
                          </span>
                      </h4>
                    </div>
                    <div id="filterPanel" class="panel-collapse panel-collapse collapse">
                    <div class="panel-body">
                      <div class="col-lg-12 col-md-12" id="pw">
                      <input type="password" class="form-control form-input" placeholder="Masukkan password lama" id="old_password" name="old_password">
                      <i class="fa fa-unlock-alt input-place" aria-hidden="true"></i>
                    </div>
                    <div class="col-lg-12 col-md-12" id="passhide" >
                      <input type="password" class="form-control form-input" value="" placeholder=" Masukkan password baru" id="password" name="password">
                      <i class="fa fa-unlock-alt input-place" aria-hidden="true"></i>
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
               
                <div class="col-lg-12 col-md-12 text-center" id="hidden" hidden>
                    <button class="btn btn-info btn-lg custom-btn" id="submit" type="submit" disabled><span class="glyphicon glyphicon-save"></span> Save</button>
                </div>
                {{csrf_field()}}
                </form>
                </div>

            </div>
        </div>
    </div>
  </div>

<script>
  @if(Session::has('message'))
      swal("Error!","{{ Session::get('message')}}","warning");
  @endif
  
</script>

<script type="text/javascript">
  function clickbutton(obj){
      document.getElementById("name").removeAttribute("disabled");
      document.getElementById("email").removeAttribute("disabled");
      /*document.getElementById("password").removeAttribute("disabled");*/
      document.getElementById("submit").removeAttribute("disabled");
      document.getElementById("hidden").removeAttribute("hidden");
      /*document.getElementById("passhide").removeAttribute("hidden");
      document.getElementById("pw").removeAttribute("hidden");*/
      document.getElementById("btnpw").removeAttribute("hidden");
      document.getElementById("button").setAttribute("hidden","hidden");
      document.getElementById("buttonback").removeAttribute("hidden");
  };
  function clickbuttoninverse(obj){
      document.getElementById("name").setAttribute("disabled","disabled");
      document.getElementById("email").setAttribute("disabled","disabled");
      /*document.getElementById("password").removeAttribute("disabled");*/
      document.getElementById("submit").setAttribute("disabled","disabled");
      document.getElementById("hidden").setAttribute("hidden","hidden");
      /*document.getElementById("passhide").removeAttribute("hidden");
      document.getElementById("pw").removeAttribute("hidden");*/
      document.getElementById("btnpw").setAttribute("hidden","hidden");
      document.getElementById("button").removeAttribute("hidden");
      document.getElementById("buttonback").setAttribute("hidden","hidden");
  };
</script>
<script type="text/javascript">
    $(".panel-collapse").on("hide.bs.collapse", function () {
        $(".panel-collapse-clickable").find('i').removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
    });

    $(".panel-collapse").on("show.bs.collapse", function () {
        $(".panel-collapse-clickable").find('i').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    });
</script>


@endsection
