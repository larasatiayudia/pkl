@extends('layout.user')

@section('title', 'Detail Statistik')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/attempt.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/breadcrumb.css')}}">
@endsection

@include('user.navbar')

@section('content')
<div class="container">
	<ul class="breadcrumbs hidden-xs">
	    <li class="completed"><a href="{{url('/home')}}">Home</a></li>    
	    <li class="completed"><a href="{{url('/statistik')}}">Statistik</a></li>
	    <li class="completed"><a href="{{url('/charts/'.Hashids::encode($test->id_test))}}">Diagram {{$test->nama}}</a></li>
	    <li class="active"><a href="javascript:void(0)">Peringkat Peserta Tes</a></li>
  	</ul>
  	<ul class="breadcrumb visible-xs">
	    <li><a href="{{url('/home')}}">Home</a></li>    
	    <li><a href="{{url('/statistik')}}">Statistik</a></li>
	    <li><a href="{{redirect()->back()->getTargetUrl()}}">Diagram {{$test->nama}}</a></li>
	    <li class="active">Peringkat Peserta Tes</li>
  	</ul>		
	<div class="row">
		<div class="col-md-3">
			@include('user.sidenav')
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-success">
			      <div class="panel-heading">
			        <div class="row">
			          	<div class="col-xs-5 col-sm-5 col-md-5">
			            	<h2 class="text-center pull-left" style="padding-left: 30px;"> <span class="glyphicon glyphicon-list-alt"> </span> Peringkat Peserta</h2>
			         	</div>
			          	<div class="col-md-2 col-xs-2" style="margin-top: 15px">
							<form method="GET" action="">
								
								<select name="filter" style="height: 33px">
									@if(Request::get('filter')==null || Request::get('filter')=="all" )
				                	<option selected="true" value="all">Tanpa Filter</option>
				                	@else
				                	<option value="all">Tanpa Filter</option>
				                	@endif
				                	@if(Request::get('filter')=="lulus")
				                	<option selected="true" value="lulus"> Lulus</option>
				                	@else
				                	<option value="lulus"> Lulus</option>
				                	@endif
				                	@if(Request::get('filter')=="tidak_lulus")
				                	<option selected="true" value="tidak_lulus">Tidak Lulus</option>
				                	@else
				                	<option value="tidak_lulus">Tidak Lulus</option>
				                	@endif
				                	@if(Request::get('filter')=="belum_ikut")
				                	<option selected="true" value="belum_ikut">Belum Mengkuti</option>
				                	@else
				                	<option value="belum_ikut">Belum Mengkuti</option>
				                	@endif				          
				                </select>
							
					  	</div>
					  	<div class="col-md-3 col-xs-4" style="margin-top: 15px">
							
				                <input type="text" class="form-control" placeholder="Pencarian nama" name="keywords" />            
				          
							
						</div>
						<div class="col-md-1 col-xs-1">
                            <button type="submit" class="btn btn-default" style="margin-top: 15px;height: 34px; color:white; background-color: #01573C">Cari</button>
						</div>
							</form>
					</div>
			      </div>
			    </div>

			      <div class="panel-body" style="margin-top: -20px">
			        <table class="table table-hover">
			          <thead>
			            <tr>
			              <th class="text-center"> Peringkat</th>
			              <th class="text-center"> Nama </th>
			              <th class="text-center"> Jabatan </th>
			              <th class="text-center"> Status </th>
			              <th class="text-center"> Selesai Mengerjakan</th>
			              <th class="text-center"> Nilai </th>
			              
			            </tr>
			          </thead>

			          <tbody>
			          	@if(Request::only('keywords')!=null && $semua->isEmpty())
				          	<h4 class="alert alert-danger">Pencarian tidak ditemukan</h4>
			          	@elseif(Request::only('keywords')==null && $semua->isEmpty())
				          	<h4 class="alert alert-danger">Belum ada yang mengikuti test</h4>
			          	@else
				          	@foreach($semua as $index => $satu)   	
					            <tr class="edit" id="detail">
					              <td class="text-center"> {{$index+1}} </td>
					              @if($satu->getTable() == 'peserta')
						              <td class="text-center"> {{$satu->user->Nama}} </td>
						              <td class="text-center"> {{$satu->user->jabatan->nama_jabatan}} </td>
							              @if($satu->nilai >= $satu->test->passing_grade)
							              <td class="text-center"> Lulus </td>
							              @else
							              <td class="text-center"> Tidak Lulus </td>
							              @endif
						              <td class="text-center">{{Date::parse($satu->waktu_submit)->format('l,d F Y H:i')}} </td>
						              <td class="text-center">{{$satu->nilai}}</td>
					              @else
						              <td class="text-center"> {{$satu->Nama}} </td>
						              <td class="text-center"> {{$satu->jabatan->nama_jabatan}} </td>
						              <td class="text-center"> Belum Mengikuti </td>
						              <td class="text-center"> - </td>
						              <td class="text-center"> -</td>
					              @endif
					            </tr>
				          	@endforeach
				        @endif
			          </tbody>
			        </table>
			     	{{ $semua->appends(Request::all())->links() }}
			      </div>

			      <div class="panel-footer">
			        <div class="row">
			          <div class="col-lg-12">
			            <div class="col-md-8">
			              </div>
			              <div class="col-md-4">
			              
			              <p class="muted pull-right"><strong> © 2017 All rights reserved </strong></p>
			             
			            </div>
			          </div>
			        </div>
			      </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection