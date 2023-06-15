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

        <script src="{{asset('/Frontend/jsss/jquery.min.js')}}"></script>
        <!-- third party css -->
        <link href="{{asset('/backend/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/backend/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/backend/assets/css/vendor/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/backend/assets/css/vendor/select.bootstrap5.css')}}" rel="stylesheet" type="text/css">

        <!-- App css -->
		<link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
		<link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
		<link rel="stylesheet" type="text/css" id="dark-style" href="{{asset('/backend/assets/assets/css/app-dark.min.css')}}">

     
       {{-- <script src="{{asset('/Frontend/js/jquery.js')}}"></script> --}}
      {{-- <script src="{{asset('/Frontend/js/jquery.pjax.js')}}"></script>  --}}

{{--          <script src="{{asset('/Frontend/jsss/jquery.min.js')}}"></script>
         <script src="{{asset('/Frontend/jsss/jquery.pjax.js')}}"></script> --}}
{{--         <script type="text/javascript">
            $(document).ready(function(){

                $.ajaxSetup({
                    headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });

            });
      </script> --}}
      
{{--           <script type="text/javascript">
           $(document).ready(function(){
            $(document).pjax('a', '#pjax-container')
        // does current browser support PJAX
                if ($.support.pjax) {
                   
                    $.pjax.defaults.timeout = 1000; // time in milliseconds
                }
                
            });
        </script> --}}

	
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->

        <section class="wrapper">

              @yield('sidebar-left')

            <div class="content-page">
                <div class="content">
               
                       @yield('navbar-top')

                    <!-- Start Content-->
                    <section>
                     <div class="container-fluid" id="body">
  
                    @yield('contents')
                    </div>
                    </section>
              
                    
         
                 
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


        </section>
        <!-- END wrapper -->





        <!-- bundle -->

		<script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>
     	<script src="{{asset('/backend/assets/js/app.min.js')}}"></script>




        <!-- third party js -->

		<script src="{{asset('/backend/assets/js/vendor/apexcharts.min.js')}}"></script>
		<script src="{{asset('/backend/assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
		<script src="{{asset('/backend/assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
		<script src="{{asset('/backend/assets/js/pages/demo.dashboard.js')}}"></script>

        <!-- end demo js-->

            <!-- third party js -->
        <script src="{{asset('/backend/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/buttons.html5.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/buttons.flash.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/buttons.print.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/vendor/dataTables.select.min.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('/backend/assets/js/pages/demo.datatable-init.js')}}"></script>
        <script type="text/javascript">
       
       </script>
        {{-- <script src="{{asset('/Frontend/js/jquery.js')}}"></script> --}}

        <!-- demo app -->
        <script src="{{asset('/backend/assets/js/pages/demo.dashboard-analytics.js')}}"></script>





    </body>
</html>