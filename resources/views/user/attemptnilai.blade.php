@extends('layout.user')

@section('title', 'Nilai')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/attempt.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
		<li class="completed"><a href="{{url('/home')}}">Home</a></li>
		<li class="completed"><a href="{{url('/nilai')}}">Daftar Nilai</a></li>
		<li class="active"><a href="javascript:void(0);">{{$attempts[0]->peserta->test->nama}}</a></li>
	</ul>

	<div class="row">
		<div class="col-md-3">
			@include('user.sidenav')
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="panel panel-success">
		      <div class="panel-heading">
		        <div class="row">
		        	<div class="col-md-1 col-xs-1 text-right">
		        		<h2><span class="glyphicon glyphicon-list-alt"> </span></h2>
		        	</div>
		          <div class="col-xs-11 col-sm-11 col-md-11">
		            <h2 class=" pull-left">  {{$attempts[0]->peserta->test->nama}}</h2>
		          </div>

		        </div>
		      </div>

		      <div class="panel-body table-responsive">
		        <table class="table table-hover">
		          <thead>
		            <tr>
		              <th class="text-center"> Attempt ke </th>
		              <th class="text-center"> Nilai </th>
									@if($selisih <= 0)
		              <th class="text-center"> Review </th>
		             	@endif
		            </tr>
		          </thead>

		          <tbody>
		          	@foreach($attempts as $index => $attempt)
		            <tr class="edit" id="detail">
		              <td class="text-center"> {{$index+1}} </td>
		              <td class="text-center"> {{$attempt->nilai}} </td>
									@if($selisih <= 0)
		              <td id="mobile" class="text-center"><a href="{{url('/review/'.Hashids::encode($attempt->id_attempt))}}"> Review </a></td>
		            	@endif
								</tr>
		           @endforeach

		          </tbody>
		        </table>
		      </div>

		      <div class="panel-footer">
		        <div class="row">
		          <div class="col-lg-12">
		            <div class="col-md-8">
		              </div>
		              <div class="col-md-4">
		              @if(\Request::is('daftarnilai/*'))
		              <p class="muted pull-right"><strong> © 2017 All rights reserved </strong></p>
		              @endif
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		</div>
	</div>
</div>
@endsection