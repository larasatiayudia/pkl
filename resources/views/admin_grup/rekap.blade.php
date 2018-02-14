@extends('layout.superadmin')
@section('title', 'Rekap')

@include('admin_grup.sidebar')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/tabel.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/breadcrumb.css')}}" />
@endsection

@section('content')
<div class="container-fluid">
 	<div class="col-md-offset-1 col-md-11 content">
 	<div class="row">
      <div class="col-md-12">
          <div class="page-title">
             <ol class="breadcrumb judulmenu"><br><br>
                <li class="active" style="color:#E5FFCA">
                   <h3><b><i class="fa fa-bar-chart"></i> Rekap</b></h3>
                </li> 
             </ol>
          </div>
       </div>
    </div>

  <ul class="breadcrumbs ">
    <li class="completed"><a href="{{route('admingrup.rekap')}}"> Pilih Jabatan dan Materi Test</a></li>  
    <li class="active"><a href="javasript:void(0)"> Rekap</a></li>
  </ul> 

    <div class="panel panel-default">
    <div class="panel-body" style="background-color: white">
    <h3>Filter:</h3>
    
    <div class="row">
    <div class="col-md-6">
    <label class="control-label">Pilih Area Kantor</label>
    </div>
    <div class="col-md-3">
      <label class="control-label"> Pilih Status</label>
    </div>
    </div>
    <form method="GET" action="">
		<div class="row">
        <div class="col-md-6" id="radiogrup">
          <!-- ajax -->
        </div>
			<div class="col-md-3">
				<select name="filter" class="form-control">
          @if(Request::get('filter')==null || Request::get('filter')=="all" )
				  <option selected="true" value="all">Tanpa Filter</option>
          @else
          <option value="all">Tanpa Filter</option> 
          @endif
          @if(Request::get('filter')=="lulus")
				  <option selected="true" value="lulus">Lulus</option>
          @else
          <option value="lulus">Lulus</option>
          @endif
          @if(Request::get('filter')=="tidak_lulus")
				  <option selected="true" value="tidak_lulus">Tidak Lulus</option>
          @else
          <option value="tidak_lulus">Tidak Lulus</option>
          @endif
          @if(Request::get('filter')=="belum_ikut")
				  <option selected="true" value="belum_ikut">Belum Mengikuti</option>
          @else
          <option value="belum_ikut">Belum Mengikuti</option>
          @endif
				</select>
			</div>
        <div class="col-md-3">
        <button class="btn btn-primary" type="submit">Go</button>
      </div>
		</div>
    
		<div class="row">
			<div class=" box col-md-3" id="box" hidden>
				<select class="selectpicker" id="kantor" name="kantor" data-show-subtext="true" data-live-search="true">
      <!--ajax region-->    
        </select>
			</div>
		</div>
		</form>
		<br>
		<div class="grid">
		
		</div>
		<br>		


    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3">
            <h2 class="text-center pull-left" style="padding-left: 30px;"> <span class="glyphicon glyphicon-list-alt"> </span> Details </h2>
          </div>
          <div class="col-md-9">
            <h2 style="padding-right: 30px;"><button id="btnxls" class="btn btn-primary pull-right text-center"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</button></h2>
          </div>
        </div>
      </div>

      <div class="panel-body table-responsive">
        <table class="table table-hover" >
          <thead>
            <tr style="background-color: #f0ad4e">
              <th class="text-center"> No. </th>
              <th class="text-center"> NIP </th>
              <th class="text-center"> Nama </th>
              <th class="text-center"> Kantor/Unit Kerja </th>
              <th class="text-center"> Nilai </th>
              <th class="text-center"> Status </th>
            </tr>
                  </thead>                            
                  <tbody>
                  @foreach($semua as $index => $satu)     
                    <tr class="edit" id="detail">
                      <td class="text-center"> {{$index+1}} </td>
                    @if($satu->getTable() == 'peserta')
                      <td class="text-center"> {{$satu->user->NIP}} </td>
                      <td class="text-center"> {{$satu->user->Nama}} </td>
                      <td class="text-center"> {{$satu->user->kantor->nama_kantor}} </td>
                      <td class="text-center">{{$satu->nilai}}</td>
                      @if($satu->nilai >= $satu->test->passing_grade)
                      <td class="text-center"> Lulus </td>
                      @else
                      <td class="text-center"> Tidak Lulus</td>
                      @endif
                    @else
                      <td class="text-center"> {{$satu->NIP}} </td>
                      <td class="text-center"> {{$satu->Nama}} </td>
                      <td class="text-center"> {{$satu->kantor->nama_kantor}} </td>
                      <td class="text-center"> - </td>
                      <td class="text-center"> Belum Mengikuti </td>
                      
                    @endif
                    </tr>
                  @endforeach
                  </tbody>
                  </table>
                  {{ $semua->appends(Request::all())->links() }}
      </div>

        <div class="panel-body table-responsive" hidden>
        <table class="table table-hover" id="tablerekap">
          <thead>
            <tr style="background-color: #f0ad4e">
              <th class="text-center"> No. </th>
              <th class="text-center"> NIP </th>
              <th class="text-center"> Nama </th>
              <th class="text-center"> Kantor/Unit Kerja </th>
              <th class="text-center"> Nilai </th>
              <th class="text-center"> Status </th>
            </tr>
                  </thead>                            
                  <tbody>
                  @foreach($semuas as $index => $satu)     
                    <tr class="edit" id="detail">
                      <td class="text-center"> {{$index+1}} </td>
                    @if($satu->getTable() == 'peserta')
                      <td class="text-center"> {{$satu->user->NIP}} </td>
                      <td class="text-center"> {{$satu->user->Nama}} </td>
                      <td class="text-center"> {{$satu->user->kantor->nama_kantor}} </td>
                      <td class="text-center">{{$satu->nilai}}</td>
                      @if($satu->nilai >= $satu->test->passing_grade)
                      <td class="text-center"> Lulus </td>
                      @else
                      <td class="text-center"> Tidak Lulus</td>
                      @endif
                    @else
                      <td class="text-center"> {{$satu->NIP}} </td>
                      <td class="text-center"> {{$satu->Nama}} </td>
                      <td class="text-center"> {{$satu->kantor->nama_kantor}} </td>
                      <td class="text-center"> - </td>
                      <td class="text-center"> Belum Mengikuti </td>
                      
                    @endif
                    </tr>
                  @endforeach
                  </tbody>
                  </table>
          </div>
    </div>

  		</div>
  	</div>
    </div>
    </div>

<script type="text/javascript">
  $(document).ready(function() {
  $("#btnxls").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('tablerekap');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    //set today
    var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      } 

      if(mm<10) {
          mm = '0'+mm
      } 

      today = dd + '-' + mm + '-' + yyyy;

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'DataRekap(update '+today+').xls';
    a.click();

  });
});
</script>

@endsection

@section('script')

<!-- script export excel -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script src="{{ URL::asset('/js/ajaxscript.js') }}"></script>
<script src="{{ URL::asset('/js/bootstrap-select.min.js') }}"></script>
@endsection