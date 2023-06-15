<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Social CINeb</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">

        <!-- App favicon -->     
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

             <!-- third party css -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/vendor/jquery-jvectormap-1.2.2.css')}}">

        <script src="{{asset('/Frontend/js/jquery.js')}}"></script>

        <!-- App css -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
  

         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">



        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/vendor.css')}}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/utility.css')}}css/utility.css">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/app.css')}}">

        <link rel="stylesheet" href="{{asset('/backend/sweetalert2.min.css')}}">
             
    
        <meta name="csrf-token" content="{{ csrf_token() }}"> 

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


    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
      
        <div class="wrapper">
                    <!-- Topbar Start navbar-custom topnav-navbar navv1 -->
           <div class="navbar-custom topnav-navbar navv1">
                        <div class="container">
                            <!-- LOGO -->
                            <a href="{{URL::to('/')}}" class="topnav-logo">
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
                                 {{-- addd to cart  --}}
                                  <input class="id_Auth" type="hidden" value="{{Auth::user()->id}}" >

                                 <li class="notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                       
                                        <i class="dripicons-cart noti-icon"> </i>
                              
                                          <span id="load_qty_pro_cart" class="total-item-round" style="margin-top: 8px;">0</span>
                                                                     
                                    </a>



                                 <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            Products in your cart      
                                        </h5>
                                    </div>

                                    <div style="max-height: 300px;" data-simplebar="" >
                                        <!-- item-->

                                        {{-- ................... --}}

                                       <table class="table table-hover table-centered mb-0">
                                          <tbody id="load_pro_cart_layout">
                                         </tbody>
                                      </table>


                                    </div>

                                    <!-- All-->
                                    <a href="{{URL::to('/go_to_cart')}}" class="dropdown-item text-center text-primary notify-item notify-all">
                                        Go to my cart
                                    </a>

                                  </div>

                                 </li>

                           
                                   <li class="notification-list">
                                    <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                        <i class="dripicons-message noti-icon"></i>
                                    </a>
                                   </li>

                                     <li class="dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="dripicons-bell noti-icon"></i>
                                        <span class="noti-icon-badge"></span>
                                    </a>
         {{--                         <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

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

                                  </div> --}}
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
                                    <a href="{{URL::to('/MyProfile')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>
                                    <!-- item-->
                                    <a href="{{URL::to('/go_to_cart')}}" class="dropdown-item notify-item">
                                     <i class="mdi mdi-cart me-1"> </i>
                                        <span>My Cart</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                              
                                    <!-- item-->
                                    <a href="{{URL::to('/go_to_cart')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lock-outline me-1"></i>
                                        <span>Lock Screen</span>
                                    </a>
                                  
                                    <!-- item-->
                                    <a href="{{URL::to('logoutuser')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>

                                </div>
                            </li>
                       
                  @else

                     <input class="id_Auth" type="hidden" value="0" >
                             <li class="notification-list">
                                <a class="nav-link end-bar-toggle"  href="{{URL::to('/LoginUser')}}">
                                  <i class=" noti-icon">
                                   <button type="button"  class="btn btn-outline-danger">
                                   <i class="mdi mdi-account-circle-outline"></i> Login</button>
                                  </i>

                                </a>
                            </li>

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="{{URL::to('/SignupUser')}}">
                                  <i class=" noti-icon">
                               <button type="button" class="btn btn-secondary"> 
                                <i class="mdi mdi-account-plus"></i> Signup</button>
                                  </i>

                                </a>
                            </li>

                           @endif

                          </ul>


                           <a class="navbar-toggle" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                <div class="lines" >
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>

                                @include('user.include.sidebar_mobile')


                            <div class="app-search dropdown">
                                <form action="{{url('/Search_Product')}}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="key_search" class="form-control input_searchxx" placeholder="Search..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button class="input-group-text  btn-primary" type="submit">Search</button>
                                    </div>
                                </form>

                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown"  >
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found <span class="text-danger Qty_result">17</span> results</h5>
                                    </div>
                                    <div  style="max-height: 500px;" data-simplebar="">
                                    <div class="load_product_search_ajax">
                                      
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
                    <div class="row content_shopping" style="margin-top: 80px;  margin-bottom: 100px;">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                               @yield('content')
                        </div>
                         
                        <div class="col-lg-1"></div>

                    </div> 

 
                 </div>
        <!-- Model login -->

    {{-- ////// style sweetalert 2 /////////                   --}}


    <script type="text/javascript">
      $(document).ready(function(){

           //////////////////   // update so luong iteam
        if($('.id_Auth').val() != 0){       
          load_pro_cart_layout();
          load_qty_pro_cart();
        }

         function load_qty_pro_cart(){
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_qty_pro_cart')}}',
                    method:"GET",    
                    dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('#load_qty_pro_cart').text(data.qty_pro);

               
                    }

                }); 
            }

       
           function load_pro_cart_layout(){
             var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_pro_cart_layout')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('#load_pro_cart_layout').html(data);
      
                    }

            }); 
          }

   /////////////////////search ////////////////////////////

      load_product_search_ajax($('.input_searchxx').val());

        $(".input_searchxx").keyup(function(){
             if( $('.input_searchxx').val() != ""){
               load_product_search_ajax($('.input_searchxx').val());
             }else{
               load_product_search_ajax($('.input_searchxx').val());
             }          
                     
         });


      function load_product_search_ajax(key_search){   
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('/load_product_search_ajax')}}",
            method:"POST",
            dataType:'JSON', 
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },data:{key_search:key_search,
             _token:_token},
              success:function(data){
              $('.load_product_search_ajax').html(data.data_result);
              $('.Qty_result').html(data.Qty_result);
              
             }
           });

     }

          $(document).on('click', '#item_searchxxx', function(e) {
                e.preventDefault();          
                var id_productss = $(this).closest("#item_searchxxx").find(".id_productss").val();
                var id_post = "";
                var key_active = "Search_Product";
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
                      window.location.href = "{{url('/detail_products')}}" + "/" + id_productss;
                     }
                   });

               });
          
            $(document).on('click', '.remove_active', function(e) {
                e.preventDefault();  
  
                   // var id = $(this).closest("#item_searchxxx").find(".id_active").val();
                   var id = $(this).closest(".id_remove").find(".id_productss").val();
                   var type = "product";
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
                        load_product_search_ajax($('.input_searchxx').val());
                     }
                   });

               });

        //         $(document).on('click', '.add_to_cart', function(e) {
        //           // function add_to_cart(id){
        //               e.preventDefault();

                  
        //                var id_product = $(this).closest(".product-m__add-cart").find(".id_productss").val();
        //                var type_product = $('.type_product').val();

        //                if($('.id_Auth').val() == 0){
        //                 window.location.href = "{{url('/LoginUser')}}";

        //                }else if( $('.load_qty_product_details').val() == 0){

        //                 alert("The product is out of stock")

        //                }else{

        //                     if(type_product == 0 ){

        //                     var id_size_product = 0
        //                     var id_type_product = 0   
        //                     save_add_product_cart(id_product, id_type_product, id_size_product);

        //                     }else if(type_product == 1 ){
        //                             if($("input[name='radio1']:checked").length >0){

        //                                var id_size_product = 0
        //                                var id_type_product = $("input[name='radio1']:checked").val();    
        //                                save_add_product_cart(id_product, id_type_product, id_size_product);
        //                             }else{    
        //                                var asas = $('.title_typexx').text();   
                                
        //                                alert("Please choose" + asas)
        //                             }

                        

        //                     }else if(type_product == 2 ){

        //                             if($("input[name='radio2']:checked").length >0){

        //                                var id_size_product = $("input[name='radio2']:checked").val();
        //                                var id_type_product = $("input[name='radio1']:checked").val();  

        //                               save_add_product_cart(id_product, id_type_product, id_size_product);
        //                             }else{    
        //                                var asas = $('.title_typexx').text();   
        //                                alert("Please choose" + asas + "and size")
        //                             }
            
        //                     }



                        
        //             }
                   
        //        });
        // function save_add_product_cart(id_product, id_type_product, id_size_product){
        //                  var qty_pro = $(".input-counter__text").val();
        //                  var _token = $('input[name="_token"]').val();

        //                  $.ajax({
        //                  url:"{{url('/add_to_cart')}}",
        //                  method:"POST", 
        //                   headers: {
        //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                     },data:{id_product:id_product,
        //                             id_type_product:id_type_product,
        //                             id_size_product:id_size_product,
        //                             qty_pro:qty_pro, _token:_token},
        //                       success:function(data){
                      
        //                       load_qty_pro_cart();
        //                       load_pro_cart_layout();
        //                       alert("add to cart success")      
        //                   }
        //                });
        //     }



      

          ///////////// click item cart layout

               //  $(document).on('click', '.click_itemcart_layout', function(e) {
               //  e.preventDefault();          
               //  var iditem = $(this).closest("tr").find(".id_proxx").val();
               //   // window.location.href = "{{url('/detail_products')}}" +"/"+iditem

               //    window.location.href = "{{url('/go_to_cart')}}"
  

               // });
     


     
          
  });

    </script>




           <!-- bundle -->
        <script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>
        <script src="{{asset('/backend/assets/js/pages/demo.materialdesignicons.js')}}"></script>

         {{-- <script src="{{asset('/backend/assets/js/pages/demo.toastr.js')}}"></script> --}}

             <!--====== Vendor Js ======-->
       <script src="{{asset('/Frontend/assets/js/vendor.js')}}"></script>

       <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('/Frontend/assets/js/jquery.shopnav.js')}}"></script>

        <!--====== App ======-->
        <script src="{{asset('/Frontend/assets/js/app.js')}}"></script>


        <script src="{{asset('/backend/sweetalert2.all.min.js')}}"></script>

    </body>

</html>
