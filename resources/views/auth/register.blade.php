@extends('layouts.app')

@section('content')
<div class="container">
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
                                <input id="Nama" type="text" class="form-control" name="Nama" required>

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
                                <input id="Kantor" type="text" class="form-control" name="Kantor" required>

                                @if ($errors->has('Kantor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Kantor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('Jabatan') ? ' has-error' : '' }}">
                            <label for="Jabatan" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                <input id="Jabatan" type="text" class="form-control" name="Jabatan" required>

                                @if ($errors->has('Jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Divisi') ? ' has-error' : '' }}">
                            <label for="Divisi" class="col-md-4 control-label">Divisi</label>

                            <div class="col-md-6">
                                <input id="Divisi" type="text" class="form-control" name="Divisi" required>

                                @if ($errors->has('Divisi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Divisi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
</div>
@endsection
