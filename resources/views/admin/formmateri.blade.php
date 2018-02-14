@extends('layout.user')

@section('title', 'Form Materi')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/panel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')
@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="completed"><a href="{{url('/pilihjabatan')}}">Pilih Jabatan</a></li>
		@if($status)
	  	<li class="completed"><a href="{{redirect()->back()->getTargetUrl()}}">Materi Periode</a></li>
	  	@else
	  	<li class="completed"><a href="{{redirect()->back()->getTargetUrl()}}">Materi In Class</a></li>
	  	@endif
		<li class="active"><a href="javascript:void(0);">Form Materi</a></li>	
	</ul>

	<div class="row">
		<div class="col-md-3 hidden-xs">
			@include('user.sidenav')
		</div>
		<div class="col-md-9">
			@include('admin.stepadmin')
			   	<div class="panel panel-form">
                    <div class="panel-heading">Pengaturan Materi Tes</div>
                    <div class="panel-body">
					<!-- Tambah materi baru -->
                    @if(isset($jabatan))
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/tambahmateri') }}">
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
	                        	<div class="col-md-9 col-xs-12">
			                        <div class="form-group">
			                            <label class="control-label">Password</label>
			                            <input name="pass_materi" type="password" required="required" class="form-control" placeholder="Password untuk Materi"/>
			                        </div>
			                    </div>
			                </div>
		                        <button class="btn btn-success nextBtn btn-lg pull-right" type="submit" >Next</button>
                      		</div>
                        </div>
                    </form>
					<!-- Edit materi -->
                    @else
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/editmateri') }}">
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
	                        	<div class="col-md-9 col-xs-12">
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
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
 <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript','strikeThrough']}).panelInstance('area1');
  });
  //]]>
  </script>
@endsection