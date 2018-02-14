@extends('layout.superadmin')

@include('admin_grup.sidebar')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

@section('content')
    <div class="container-fluid">
    <div class="col-md-offset-1 col-md-11">
    <div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><b><i class="fa fa-list-alt"></i> Test</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>
@include('admin_grup.stepsoal')
<div class="row">
    <div class="col-md-12">
          <div class="panel panel-form">
                    <div class="panel-heading">Pengaturan Materi Tes</div>
                    <div class="panel-body" style="background-color:white">
          <!-- Tambah materi baru -->
                    @if(isset($jabatan))
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/tambahmateri') }}">
                    {{csrf_field()}}
                      <div class="row" id="step-2">                     
                          <div class="col-md-12 col-xs-12">
                            <div class="row">
                            <div class="col-md-10">
                              <input type="text" name="status" value="{{$status}}" hidden>
                              <input type="text" name="jabatan" value="{{$jabatan}}" hidden>
                                <div class="form-group">
                                    <label class="control-label">Nama Materi</label>
                                    <input  name="nama" type="text" required="required" class="form-control" placeholder=""/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                     <textarea name="deskripsi" style="height: 20%; width: 100%" id="area1"></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input name="pass_materi" type="text" required="required" class="form-control" placeholder="Password untuk Materi"/>
                                </div>
                              </div>
                            </div>
                            <button class="btn btn-success nextBtn btn-lg pull-right" type="submit" >Next</button>
                          </div>
                        </div>
                    </form>
          <!-- Edit materi -->
                    @else
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/editmateri') }}">
                    {{csrf_field()}}
                    <input type="text" name="id_mat" value="{{$materi->id_mat}}" hidden>
                     <input type="hidden" name="_method" value="PUT">
                      <div class="row" id="step-2">                     
                          <div class="col-md-12 col-xs-12">
                            <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Nama Materi</label>
                                    <input  name="nama" type="text" required="required" class="form-control" value="{{$materi->nama_test}}" placeholder=""/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                     <textarea name="deskripsi" style="height: 20%; width: 100%" id="area1">{{$materi->deskripsi}}</textarea>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input value="{{$materi->pass_materi}}" name="pass_materi" type="text" required="required" class="form-control" placeholder="Password untuk Materi"/>
                                </div>
                              </div>
                            </div>
                            <button class="btn btn-success nextBtn btn-lg pull-right" type="submit" >Next</button>
                          </div>
                        </div>
                    </form>
                    @endif
                    </div>
                </div>
    </div>
  </div>
    </div>
</div>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
 <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area1');
  });
  //]]>
  </script>
@endsection