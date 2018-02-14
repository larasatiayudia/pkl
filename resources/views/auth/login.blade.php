@extends('layouts.app')

@section('title', 'Login')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
@endsection

@section('content')

<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img class="center-block" id="profile-img" src="{{asset('img/logobsm3.png')}}" style="width: 60%;height: 60%" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="{{ route('login') }}"> {{ csrf_field() }}
                <span id="reauth-email" class="reauth-email"></span>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                        <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                
                </div>
                <button class="btn btn-lg btn-block btn-signin" type="submit" style="color: white">Sign in</button>
            </form><!-- /form -->
            <a href="/register" class="forgot-password">
                Belum punya akun? Register sekarang
            </a><br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forgotpw">
              Lupa Password
            </button>

        </div><!-- /card-container -->

    </div><!-- /container -->

<!-- Modal Add -->
<div class="modal fade" id="forgotpw" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Lupa Kata Sandi</h4>
      </div>
      <div class="modal-body">
       
          <div class="form-group">
            <label class="control-label">Grup Penyelenggara</label>
            <select id="milihgrup" name="grup" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <option value="" disabled selected>--Pilih Grup--</option>
              @foreach($grups as $grup)
              <option value="{{$grup->id_grup}}">{{$grup->nama_grup}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-grup" id="kontak" hidden>
            <label class="control-label">Hubungi e-mail :</label>
            <input class="form-control" id="email" type="text" disabled>
          </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="btnkontak" type="submit" class="btn btn-primary">Cari</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript">
    $(".panel-collapse").on("hide.bs.collapse", function () {
        $(".panel-collapse-clickable").find('i').removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
    });

    $(".panel-collapse").on("show.bs.collapse", function () {
        $(".panel-collapse-clickable").find('i').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
    });
</script>
<script type="text/javascript">
    $('#btnkontak').click(function(){
      var grup=$('#milihgrup').val();
      if(!$.isEmptyObject(grup)){
        $.ajax({
          url:'/kontakAdmin/'+grup,
          type:"GET",
          dataType:"json",
          success:function(data){
            $('#kontak').removeAttr("hidden");
            $("#email").empty;
            $('#email').val(data[0].email);
          }
        });
      }
    });
</script>

@endsection

