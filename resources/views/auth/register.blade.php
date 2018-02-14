@extends('layouts.app')

@section('title', 'Register')

@section('styles')
<link rel="stylesheet" type="text/css" href="css/register.css">

@endsection

@section('content')
<div class="container">
    <div class="card card-container">
        <img class="center-block" id="profile-img" src="{{asset('img/logobsm3.png')}}" style="width: 60%;height: 60%" />
        <p id="profile-name" class="profile-name-card"></p>

            <form role= "form" id="" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                {{csrf_field()}} 
              <!--NIP-->
              <div class="form-group">
                <label class="control-label">NIP</label>
                <input id="NIP" name="NIP" type="text" class="form-control"  placeholder="Masukkan NIP" required autofocus onkeyup="valNIP(this)"/>
                <b id="alert1" style="color: red" ></b>
                
              </div>
              <!--Nama-->
              <div class="form-group">
                <label class="control-label">Nama</label>
                <input id="nama" name="nama" type="text" required class="form-control" placeholder="Masukkan Nama"/>
                <h6>ex:Agus Budi</h6>
              </div>
              <div class="form-group{{ $errors->has('id_grup') ? ' has-error' : '' }}">
                <div class="form-group">
                    <label class="control-label">Penyelenggara</label>
                    <select name="id_grup" class="form-control" id="pilihgrup" required>
                      <option value="" disabled selected>--Pilih Penyelenggara--</option>
                    @foreach ($grups as $grup)
                      <option value="{{ $grup -> id_grup }}">{{ $grup -> nama_grup }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('id_grup'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_grup') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
              <!--Jabatan -->
              <div class="form-group">
                <label class="control-label">Jabatan</label>
                <select name="id_jabatan" class="form-control" id="pilihjabatan" required>
                  <option value="">--Pilih Jabatan--</option>
                </select>
              </div>
              <!--KANTOR-->
              <label class="control-label">Kantor</label>
              <div class="row">
                <!--TIPE-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" style="font-size:12">Tipe Kantor</label>
                    <select id="tipe" name="tipe" class="form-control" required>
                      <option value="" disabled selected>Tipe Kantor--</option>
                      @foreach($tipekantors as $tipekantor)
                      <option value="{{$tipekantor->id_tipe}}">{{$tipekantor->tipe_kantor}}</option>
                      @endforeach
                    </select> 
                  </div> 
                </div>

                <!--NAMA-->
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="control-label" style="font-size:12">Nama Kantor</label><br>
                    <select id="pilihkantor" name="id_kantor" class="selectpicker" data-width="330px" data-show-subtext="true" data-live-search="true" required>
                      <option value="" disabled selected>--Pilih Kantor--</option>
                      <!--ajaxscript-->
                    </select>
                   </div>

                   
                  </div>
            </div>
              
              <!--username-->
              <div class="form-group">
                <label class="control-label">Username</label>
                <input id="username" name="username" type="text" required class="form-control" placeholder="Max 20 karakter" onkeyup="valusername(this)"/>
                <b style="color: red" id="alert2"></b>
                <h6>ex: user_123</h6>
              </div>
              <!-- password -->
              <div class="form-group">
                <label class="control-label">Password</label>
                <input id="password" name="password" type="password" required class="form-control" placeholder="Min 6 Karakter" value="" onchange="validasipassword()" onkeyup="validasipassword2()" />
                <b id="needmore" style="color: red"></b>
                <h6>min 6 karakter</h6>
              </div>
              <!-- konfirmasi password -->
              <div class="form-group">
                <label class="control-label">Konfirmasi Password</label>
                <input id="password-confirm" name="password" type="password" required class="form-control" placeholder="Konfirmasi password" value="" onchange="passmatch()" onkeyup="passmatch2()" />
                <b id="notmatch" style="color: red"></b>
                <h6>min 6 karakter</h6>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" required> Setuju dan lanjutkan
                </label>
              </div>
 
              <button id="submit" class="btn btn-lg btn-block btn-signin" type="submit" style="color: white" disabled>Register</button>
            </form><!-- /form -->
           
         </div>
 
      </div>

     
    <script type="text/javascript">
    function valNIP(obj){
      if(obj.value!="" && obj.value.search(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]/g) !== -1){
        document.getElementById("alert1").innerHTML = "Isi dengan angka atau huruf";
        document.getElementById("submit").setAttribute("disabled","disabled");

      }
      else{
        document.getElementById("alert1").innerHTML = "";
      }
    }

    function valusername(obj){
      if(obj.value!="" && obj.value.search(/[ ]/g) !== -1){
        document.getElementById("alert2").innerHTML = "Jangan gunakan spasi";
        document.getElementById("submit").setAttribute("disabled","disabled");
      }
      else if(obj.value!="" && obj.value.length>20){
        document.getElementById("alert2").innerHTML = "Karakter melebihi batas maksimum";
        document.getElementById("submit").setAttribute("disabled","disabled");
      }
      else{
        document.getElementById("alert2").innerHTML = "";
        
      }
    }

    function validasipassword(){
        var pass = document.getElementById("password");
        if(pass.value != "" && pass.value.length<6){
            document.getElementById("needmore").innerHTML = "Minimal password 6 karakter";
            document.getElementById("submit").setAttribute("disabled","disabled");
        }
        else{
            document.getElementById("needmore").innerHTML = "";
           
        }
    }
    function validasipassword2(){
        var pass = document.getElementById("password");
        if(pass.value.length>=6 || pass.value==""){
            document.getElementById("needmore").innerHTML = "";
            
        }
    }

    function passmatch(){
        var pass1 = document.getElementById("password");
        var pass2 = document.getElementById("password-confirm");
        if(pass1.value != pass2.value && pass2.value != ""){
            document.getElementById("notmatch").innerHTML = "Password tidak sama";
            document.getElementById("submit").setAttribute("disabled","disabled");
        }
        else{
            document.getElementById("notmatch").innerHTML = "";
            
        }
    }
    function passmatch2(){
        var pass1 = document.getElementById("password");
        var pass2 = document.getElementById("password-confirm");
        if(pass1.value == pass2.value || pass2.value ==""){
            document.getElementById("notmatch").innerHTML = "";
            
        }

    }

    setInterval(function(){
      if(document.getElementById("alert1").innerHTML == "" && document.getElementById("alert2").innerHTML == "" && document.getElementById("needmore").innerHTML == "" && document.getElementById("notmatch").innerHTML == ""){
        document.getElementById("submit").removeAttribute("disabled");
      }
    }, 1000); 
</script>

@endsection

@section('script')
    
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
     
      <script type="text/javascript">
            $(document).ready(function(){
                $('#tipe').on('change', function() {
                var selectedtipe = $(this).val();
                $.ajax({
                 url: '/kantorAddUserbiasa/'+selectedtipe,
                 type: "GET",
                 dataType: "json",
                 success:function(data) {
                     $('#pilihkantor').empty();
                     i=0;
                     var show;
                     if($.isEmptyObject(data)){
                         $('#pilihkantor').empty();
                         $('#pilihkantor').append(show);
                     }
                     else{
                       $.each(data, function() {
                         $('#pilihkantor').empty();
                         show+='<option value="'+ data[i].id_kantor +'">'+ data[i].nama_kantor +'</option>';
                         $('#pilihkantor').append(show);
                         i+=1;
                       });
                       $('#pilihkantor').selectpicker('render').selectpicker('refresh');
                    }
                  }
                });
              });
                
                
                //$('#kontak').setAttribute("hidden","hidden");
              
      });      
      </script>
@endsection
