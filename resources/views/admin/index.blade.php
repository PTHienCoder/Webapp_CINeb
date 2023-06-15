@extends('Admin_layout')

@section('sidebar-left')
  @include('admin.include_admin.sidebar_left')
@endsection

@section('navbar-top')
  @include('admin.include_admin.navbar_top')
@endsection
@section('contents')
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                                <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Analytics</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-users-alt float-end'></i>
                                        <h6 class="text-uppercase mt-0">Active Users</h6>
                                        <h2 class="my-2" id="active-users-count">121</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span> 5.27%</span>
                                            <span class="text-nowrap">Since last month</span>  
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->

                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-window-restore float-end'></i>
                                        <h6 class="text-uppercase mt-0">Views per minute</h6>
                                        <h2 class="my-2" id="active-views-count">560</h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger me-2"><span class="mdi mdi-arrow-down-bold"></span> 1.08%</span>
                                            <span class="text-nowrap">Since previous week</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->

                                <div class="card cta-box overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h3 class="m-0 fw-normal cta-box-title">Enhance your <b>Campaign</b> for better outreach <i class="mdi mdi-arrow-right"></i></h3>
                                            </div>
                                            <img class="ms-3" src="{{asset('/backend/assets/images/email-campaign.svg')}}" width="92" alt="Generic placeholder image">
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                            </div> <!-- end col -->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                     
                                        <ul class="nav float-end d-none d-lg-flex">
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">7d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">15d</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1m</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-muted" href="#">1y</a>
                                            </li>
                                        </ul>
                                        <h4 class="header-title mb-3">Sessions Overview</h4>

                                        <div dir="ltr">
                                            <div id="sessions-overview" class="apex-charts mt-3" data-colors="#0acf97"></div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                        </div>

@endsection