@extends('layout.user')

@section('title', 'Register')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/register.css">
@endsection

@section('content')
<div class="container">
    <div class="card card-container">
        <img class="center-block" id="profile-img" src="{{asset('img/logobsm3.png')}}" style="width: 60%;height: 60%" />
        <p id="profile-name" class="profile-name-card"></p>

        <form class="form-signin" method="POST" action="{{ route('register') }}"> {{ csrf_field() }}
            <span id="reauth-email" class="reauth-email"></span>
           <div class="form-group{{ $errors->has('NIP') ? ' has-error' : '' }}">

                    <input id="NIP" type="text" class="form-control" name="NIP" placeholder="NIP" value="{{ old('NIP') }}" required autofocus>
                    @if ($errors->has('NIP'))
                        <span class="help-block">
                            <strong>{{ $errors->first('NIP') }}</strong>
                        </span>
                    @endif
                
            </div>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}"  required>
                    
                   
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
              
            </div>
           

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" onchange="validasipassword()" onkeyup="validasipassword2()" required>
                    <span id="error" style="color: red"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>
             <script type="text/javascript">
                function validasipassword(){
                    var pass = document.getElementById("password");
                    if(pass.value != "" && pass.value.length<=6){
                        document.getElementById("error").innerHTML = "Minimal password 6 karakter";
                    }
                    else{
                        document.getElementById("error").innerHTML = "";
                    }
                }
                function validasipassword2(){
                    var pass = document.getElementById("password");
                    if(pass.value.length>=6){
                        document.getElementById("error").innerHTML = "";
                    }
                }
            </script>

            <div class="form-group">

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
             
            </div>
            <div class="form-group{{ $errors->has('Nama') ? ' has-error' : '' }}">

                    <input id="Nama" type="text" class="form-control" name="Nama" value="{{ old('Nama') }}" placeholder="Nama Lengkap" required>
                    @if ($errors->has('Nama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Nama') }}</strong>
                        </span>
                    @endif
             
            </div>
            <div class="form-group{{ $errors->has('Kantor') ? ' has-error' : '' }}">

                    <input id="Kantor" type="text" class="form-control" name="Kantor" value="{{ old('Kantor') }}" placeholder="Kantor" required>
                    @if ($errors->has('Kantor'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Kantor') }}</strong>
                        </span>
                    @endif
              
            </div>
            <div class="form-group{{ $errors->has('id_grup') ? ' has-error' : '' }}">
                <div class="form-group">
 
                        <select name="id_grup" class="form-control">
                          <option value="">--- Pilih grup ---</option>
                        @foreach ($grups as $grup)
                          <option value="{{ $grup -> id_grup }}">{{ $grup -> Nama_grup }}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('id_grup'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_grup') }}</strong>
                        </span>
                        @endif
                 
                </div>
            </div>
            <div class="form-group{{ $errors->has('id_jabatan') ? ' has-error' : '' }}">
                <div class="form-group">
 
                    <select name="id_jabatan" class="form-control"> 
                    <option value="">--- Pilih Jabatan ---</span></option>
                    </select>
                    @if ($errors->has('id_jabatan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_jabatan') }}</strong>
                        </span>
                    @endif
                  
                </div>
            </div>
            @section('script')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                $('select[name="id_grup"]').on('change', function() {
                  var grupID = $(this).val();
                  if(grupID) {
                    $.ajax({
                      url: '/formajax/'+grupID,
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                          $('select[name="id_jabatan"]').empty();
                          i=0;
                          $.each(data, function() {
                            $('select[name="id_jabatan"]').append('<option value="'+ data[i].id_jabatan +'">'+ data[i].nama_jabatan +'</option>');
                            i+=1;
                          });
                      }
                    });
                  }else{
                    $('select[name="id_jabatan"]').empty();
                  }
                });
              });
              </script>
              @endsection
            <button class="btn btn-lg btn-block btn-signin" type="submit" style="color: white">Register</button>
        </form><!-- /form -->
        
    </div><!-- /card-container -->
</div><!-- /container -->


<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('NIP') ? ' has-error' : '' }}">
                            <label for="NIP" class="col-md-4 control-label">NIP</label>

                            <div class="col-md-6">
                                <input id="NIP" type="text" class="form-control" name="NIP" value="{{ old('NIP') }}" required autofocus>

                                @if ($errors->has('NIP'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('NIP') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Nama') ? ' has-error' : '' }}">
                            <label for="Nama" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Nama" type="text" class="form-control" name="Nama" value="{{ old('Nama') }}" required>

                                @if ($errors->has('Nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Kantor') ? ' has-error' : '' }}">
                            <label for="Kantor" class="col-md-4 control-label">Kantor</label>

                            <div class="col-md-6">
                                <input id="Kantor" type="text" class="form-control" name="Kantor" value="{{ old('Kantor') }}" required>

                                @if ($errors->has('Kantor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Kantor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

<!--                         <div class="form-group{{ $errors->has('Jabatan') ? ' has-error' : '' }}">
                            <label for="Jabatan" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                <input id="Jabatan" type="text" class="form-control" name="Jabatan" value="{{ old('Jabatan') }}" required>

                                @if ($errors->has('Jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

<!--                         <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                            <label for="jabatan" class="col-md-4 control-label">jabatan</label>

                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" required>

                                @if ($errors->has('jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                            <label for="id_grup" class="col-md-4 control-label">Grup</label>

                            <div class="col-md-6">
                                <input id="id_grup" type="text" class="form-control" name="id_grup" value="{{ old('id_grup') }}" required>

                                @if ($errors->has('id_grup'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_grup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('id_grup') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="id_grup" class="col-md-4 control-label">Grup</label>
                                <div class="col-md-6">
                                    <select name="id_grup" class="form-control">
                                      <option value="">--- Pilih grup ---</option>
                                    @foreach ($grups as $grup)
                                      <option value="{{ $grup -> id_grup }}">{{ $grup -> Nama_grup }}</option>
                                    @endforeach
                                    </select>

                                    @if ($errors->has('id_grup'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_grup') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id_jabatan') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <label for="id_jabatan" class="col-md-4 control-label">Jabatan</label>
                              <div class="col-md-6">
                                <select name="id_jabatan" class="form-control"> </select>
                                @if ($errors->has('id_jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_jabatan') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                        </div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                        <script type="text/javascript">
                          $(document).ready(function() {
                            $('select[name="id_grup"]').on('change', function() {
                              var grupID = $(this).val();
                              if(grupID) {
                                $.ajax({
                                  url: '/formajax/'+grupID,
                                  type: "GET",
                                  dataType: "json",
                                  success:function(data) {
                                      $('select[name="id_jabatan"]').empty();
                                      i=0;
                                      $.each(data, function() {
                                        $('select[name="id_jabatan"]').append('<option value="'+ data[i].id_jabatan +'">'+ data[i].nama_jabatan +'</option>');
                                        i+=1;
                                      });
                                  }
                                });
                              }else{
                                $('select[name="id_jabatan"]').empty();
                              }
                            });
                          });
                          </script>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
