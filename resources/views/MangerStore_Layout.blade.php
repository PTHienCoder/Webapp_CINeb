<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Dashboard | CINeb</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
		<link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">
        <!-- third party css -->
		<link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/vendor/jquery-jvectormap-1.2.2.css')}}">

        <!-- third party css end -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{asset('/Frontend/js/jquery.js')}}"></script>
    

        <!-- App css -->
		<link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
		<link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
		<link rel="stylesheet" type="text/css" id="dark-style" href="{{asset('/backend/assets/assets/css/app-dark.min.css')}}">


         <!-- third party css -->
        <link href="{{asset('/backend/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/backend/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">


        <link href="{{asset('/backend/assets/css/vendor/quill.core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/backend/assets/css/vendor/quill.snow.css') }}" rel="stylesheet" type="text/css" />



        <!-- third party css end -->

	
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="{{url('/')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                     <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        {{-- <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50"> --}}
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{url('/')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                          <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                             {{-- <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50"> --}}
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar="">

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                 
					   
                         <li class="side-nav-item">
                            <a href="{{url('/StoreManager')}}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Home </span>
                            </a>
                        </li>
             
                        <li class="side-nav-item">
                            <a href="{{url('/manage_product')}}" class="side-nav-link">
                                <i class="uil-chart-pie-alt"></i>
                                <span>Manage Product </span>
                            </a>
                        </li>

                       <li class="side-nav-item">
                            <a href="{{url('/manage_category')}}" class="side-nav-link">
                                <i class="uil-lightbulb-alt"></i>
                                <span>Manage Category </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{url('/manage_order_store')}}" class="side-nav-link">
                                <i class="uil-lightbulb-alt"></i>
                                <span>Manage Bill </span>
                            </a>
                        </li>


            
                        <li class="side-nav-title side-nav-item mt-1">Support</li>

						<li class="side-nav-item">
                            <a href="{{url('/Chat_Page_store')}}" class="side-nav-link">
                                <i class="uil-comments-alt"></i>
                                <span> Chat </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="widgets.html" class="side-nav-link">
                                <i class="uil-layer-group"></i>
                                <span> FAQ</span>
                            </a>
                        </li>
                         <li class="side-nav-item">
                            <a href="{{url('/logout_store')}}" class="side-nav-link">
                                <i class="uil-arrow-from-right"></i>
                                <span>Logout Store</span>
                            </a>
                        </li>


    
                    </ul>

               

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                      <!-- Topbar Start -->
					  <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>

                             <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                        </h5>
                                    </div>

                                    <div style="max-height: 230px;" data-simplebar="">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">Caleb Flakelar commented on Admin
                                                <small class="text-muted">1 min ago</small>
                                            </p>
                                        </a>

                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                        View All
                                    </a>

                                </div>
                               </li>
                       

                                 
                     
   
                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                   
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                   <?php
                                                      $avt_st = Session::get('avt_st');       
                                                      $name_st = Session::get('name_st'); 
                                                   
                                                     ?>
                                    <span class="account-user-avatar"> 
                                        <img src="{{asset('/uploads/store/'.$avt_st)}}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">
                                                <span class="user-name">    
                                                {{$name_st}}
                                        </span>
                                        <span class="account-position">Store manager</span>
                                    </span>
                                </a>
                           {{--      <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lifebuoy me-1"></i>
                                        <span>Support</span>
                                    </a>

                                     
                                   

                                    <!-- item-->
                                    <a href="{{url('logoutuser')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div> --}}
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn-primary" type="submit">Search</button>
                                </div>
                            </form>

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-notes font-16 me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
					@yield('content')
                    </div>
                    
         
                 
                </div>
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script></script> © Website CINeb
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- bundle -->

		<script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>
     	<script src="{{asset('/backend/assets/js/app.min.js')}}"></script>

{{-- 

        <!-- third party js -->

		<script src="{{asset('/backend/assets/js/vendor/apexcharts.min.js')}}"></script>
		<script src="{{asset('/backend/assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
		<script src="{{asset('/backend/assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
		<script src="{{asset('/backend/assets/js/pages/demo.dashboard.js')}}"></script>


                <!-- third party js -->
        <script src="{{asset('/backend/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.checkboxes.min.js')}}"></script>
 --}}
        <!-- third party js ends -->

   {{--      <!-- demo app -->
        <script src="{{asset('/backend/assets/js/pages/demo.products.js')}}"></script>
                <!-- plugin js -->
        <script src="{{asset('/backend/assets/js/vendor/dropzone.min.js')}}"></script> --}}
            <!-- init js -->
        {{-- <script src="{{asset('/backend/assets/js/ui/component.fileupload.js')}}"></script> --}}

        





    </body>
</html>