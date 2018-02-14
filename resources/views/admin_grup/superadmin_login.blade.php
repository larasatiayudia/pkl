@extends('layout.superadmin')
@section('title', 'Admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-container">
            <img class="center-block" id="profile-img" src="{{asset('img/logobsm3.png')}}" style="width: 60%;height: 60%" />
            <h4>Login Admin</h4>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="{{ route('admingrup.login.submit') }}"> 
                {{ csrf_field() }}
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
        </div><!-- /card-container -->
    </div><!-- /container -->
@endsection