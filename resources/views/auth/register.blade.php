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
                        </div>
                        <div class="form-group{{ $errors->has('Jabatan') ? ' has-error' : '' }}">
                            <label for="Jabatan" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                <input id="Jabatan" type="text" class="form-control" name="Jabatan" value="{{ old('Jabatan') }}" required>

                                @if ($errors->has('Jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group{{ $errors->has('Divisi') ? ' has-error' : '' }}">
                            <label for="Divisi" class="col-md-4 control-label">Divisi</label>

                            <div class="col-md-6">
                                <input id="Divisi" type="text" class="form-control" name="Divisi" value="{{ old('Divisi') }}" required>

                                @if ($errors->has('Divisi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Divisi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                        <!-- <div class="form-group{{ $errors->has('Divisi') ? ' has-error' : '' }}">
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

                        <div class="form-group">
                            <label for="id_grup" class="col-md-4 control-label">Grup</label>
                            <select name="id_grup" class="form-control" style="width:350px">
                              <option value="">--- Pilih grup ---</option>
                            @foreach ($grups as $grup)
                              <option value="{{ $grup -> id_grup }}">{{ $grup -> Nama_grup }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="id_divisi" class="col-md-4 control-label">Divisi</label>
                          <select name="id_divisi" class="form-control" style="width:350px"> </select>
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
                                      $('select[name="id_divisi"]').empty();
                                      i=0;
                                      $.each(data, function() {
                                        $('select[name="id_divisi"]').append('<option value="'+ data[i].id_divisi +'">'+ data[i].nama_divisi +'</option>');
                                        i+=1;
                                      });
                                  }
                                });
                              }else{
                                $('select[name="id_divisi"]').empty();
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
</div>
@endsection
