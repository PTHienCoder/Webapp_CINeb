<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Social CINeb</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">

          <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->     
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">
        <!-- App css -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
        <link rel="stylesheet" type="text/css" id="dark-style" href="{{asset('/backend/assets/css/app-dark.min.css')}}">
         
             <!-- third party css end -->
          <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">
  
          <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="{{asset('/Frontend/jsss/jquery.min.js')}}"></script>

    
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
              <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- Quill css -->


    </head>
    <style type="text/css">   
        .menuprofile::before{
            content: '';
            position: absolute;
            top: -6px;
            right: 22px;
            width: 13px;
            height: 13px;
            background-color: #fff;   
            transform: rotate(45deg);
            z-index: -1;
        }

    </style>


    <body class="loading">
        <!-- Begin page -->
      
        <div class="wrapper">
                    <!-- Topbar Start navbar-custom topnav-navbar navv1 -->
           <div class="navbar-custom topnav-navbar navv1">
                        <div class="container">
                            <!-- LOGO -->
                            <a href="{{url('/')}}" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                                </span>
                                <!-- <span class="topnav-logo-sm">
                                    <img src="{{asset('/backend/assets/images/logo_sm_dark.png')}}" alt="" height="16">
                                </span> -->
                            </a>

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
                          
                          @if (Auth::user())
  
                             <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="{{url('AddProject')}}">
                                    <i class="noti-icon">
                                    <button type="button" class="btn btn-outline-info">
                                        <i class="dripicons-plus "></i> Add</button>
                                    </i>
                                </a>
                             </li>

                           
                               <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="{{url('/Chat_Page/0')}}">
                                    <i class="dripicons-message noti-icon"></i>
                                </a>
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
                          
                          
                               <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class=" noti-icon">
                                    
                                    @if (Auth::user()->image_user == 0)
                                     <img  src="{{asset('/uploads/profile/avt_user.png')}}" alt="user-image" 
                                     class="img-fluid rounded-circle" width="40">
                                    @else
                                     <img  src="{{asset('/uploads/profile/'.Auth::user()->id.'/'.Auth::user()->image_user)}}" alt="user-image" 
                                     class="img-fluid rounded-circle" width="40">
                                    @endif
                                    
  
                                    </i>
                                
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown menuprofile">
                           
                                    <!-- item-->
                                    <a href="{{url('/MyProfile')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                       <!-- item-->
                                      <!-- item-->
                                    <a href="{{url('/go_to_cart')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-cart me-1"></i>
                                        <span>My Cart</span>
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

                                </div>
                                </li>
                           @else
                                 <li class="notification-list">
                                    <a class="nav-link end-bar-toggle"  href="{{url('/LoginUser')}}">
                                      <i class=" noti-icon">
                                       <button type="button"  class="btn btn-outline-danger">
                                       <i class="mdi mdi-account-circle-outline"></i> Login</button>
                                      </i>

                                    </a>
                                </li>

                                <li class="notification-list">
                                    <a class="nav-link end-bar-toggle" href="{{url('/SignupUser')}}">
                                      <i class=" noti-icon">
                                   <button type="button" class="btn btn-secondary"> 
                                    <i class="mdi mdi-account-plus"></i> Signup</button>
                                      </i>

                                    </a>
                                </li>

                           @endif
                    </ul>


                     

                      <a class="navbar-toggle" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
                      style="margin-right: 0px;margin-left: 0px;">
                                <div class="lines" >
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>

                             @include('user.include.sidebar_mobile')

                            <div class="app-search dropdown">
                                 <form action="{{url('/Search_Post')}}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control input_searchxx" placeholder="Search..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button class="input-group-text btn-primary" type="submit">Search</button>
                                    </div>
                                </form>

                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown"  >
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found <span class="text-danger Qty_result">17</span> results</h5>
                                    </div>
                                    <div  style="max-height: 500px;" data-simplebar="">
                                    <div class="load_post_search_ajax">
                                      
                                    </div>
                                    <!-- item-->
                             
    
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">recommend</h6>
                                    </div>
    
                                     <div class="notification-list load_product_search_ajax_recomend">
                                        <!-- item-->
{{--                                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex">
                                                <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Erwin Brown</h5>
                                                    <span class="font-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a> --}}
    
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid" style="margin-top: 80px;  margin-bottom: 100px;">
                        
                        @yield('content')

                    </div> 
                    <!-- container -->

      
                <!-- content -->
 


 
                 </div>
        <!-- Model login -->

<script type="text/javascript">
       /////////////////////search ////////////////////////////

      load_post_search_ajax($('.input_searchxx').val());

        $(".input_searchxx").keyup(function(){
             if( $('.input_searchxx').val() != ""){
               load_post_search_ajax($('.input_searchxx').val());
             }else{
               load_post_search_ajax($('.input_searchxx').val());
             }          
                     
         });


      function load_post_search_ajax(key_search){   
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('/load_post_search_ajax')}}",
            method:"POST",
            dataType:'JSON', 
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },data:{key_search:key_search,
             _token:_token},
              success:function(data){
              $('.load_post_search_ajax').html(data.data_result);
              $('.Qty_result').html(data.Qty_result);
              
             }
           });

     }

          $(document).on('click', '#item_searchxxx', function(e) {
                e.preventDefault();  
                var id_productss ="";     
                var id_post = $(this).closest("#item_searchxxx").find(".id_post").val();
                var key_active = "Search_Post";
                var content_key = $('.input_searchxx').val();

                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                    url:"{{url('add_product_active_shopping')}}",
                    method:"POST",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{id_productss:id_productss,
                     id_post:id_post,
                     content_key:content_key,
                     key_active:key_active,
                     _token:_token},
                      success:function(data){
                      window.location.href = "{{url('/user_detail_post')}}" + "/" + id_post;
                     }
                   });

               });



          $(document).on('click', '.remove_active', function(e) {
                e.preventDefault();  
  
                   // var id = $(this).closest("#item_searchxxx").find(".id_active").val();
                   var id = $(this).closest(".id_remove").find(".id_post").val();
                   var type = "post";
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                    url:"{{url('remove_active_user')}}",
                    method:"POST",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{id:id,
                     type:type,
                     _token:_token},
                      success:function(data){
                        load_post_search_ajax($('.input_searchxx').val());
                     }
                   });

               });
</script>






        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->


        <!-- bundle -->
        <script src="{{asset('/backend/assets/js/vendor.min.js')}}">
    
        </script>
        <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/pages/demo.materialdesignicons.js')}}"></script>
        <!-- demo app -->
        <script src="{{asset('/backend/assets/js/pages/demo.form-wizard.js')}}"></script>


        <!-- quill js -->
        <script src="{{asset('/backend/assets/js/vendor/quill.min.js')}}"></script>
        <!-- quill Init js-->
        <script src="{{asset('/backend/assets/js/pages/demo.quilljs.js')}}"></script>


        <!-- plugin js -->
        <script src="{{asset('/backend/assets/js/vendor/dropzone.min.js')}}"></script>

    <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script>

            <!-- init js -->
        
    </body>

</html>
