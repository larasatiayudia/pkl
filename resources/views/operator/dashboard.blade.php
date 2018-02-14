@extends('layout.superadmin')
@section('title', 'Dashboard')

@include('operator.sidebar')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/dashboard_ua.css')}}">
@endsection

<!-- dashboard operator admin -->
@section('content')

<div class="container-fluid">
<div class="col-md-offset-1 col-md-11">
      <div class="row">
        <div class="col-md-12">
          <div class="page-title">
          <ol class="breadcrumb judulmenu"><br><br>
            <li class="active" style="color: #E5FFCA"><h3><b><i class="fa fa-dashboard"></i> Dashboard</b></h3></li>
          </ol>
          </div>
        </div>
      </div>

        <div class="row" >
        <!-- KOTAK ADMIN GRUP -->
          <div class="col-md-4 col-sm-6">
              <div class="circle-tile">
                    <a href="#">
                        <div class="circle-tile-heading red">
                            <i class="fa fa-users fa-fw fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content red">
                        <div class="circle-tile-description text-faded">
                            Admin Grup
                        </div>
                        <div class="circle-tile-number text-faded">
                            {{count($superadmins)}}
                            <span id="sparklineA"></span>
                        </div>
                        <a href="{{route('operator.daftarSuperadmin')
                        }}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- KOTAK GRUP -->
                    <div class="col-md-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-briefcase fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Grup
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{count($groups)}}
                                </div>
                                <a href="{{route('operator.daftarGroup')}}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- KOTAK KANTOR -->
                    <div class="col-md-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-university fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Kantor
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{count($kantors)}}
                                </div>
                                <a href="{{route('operator.daftarKantor')}}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>  
        
@endsection