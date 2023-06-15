@extends('User_layout')
@section('content')

         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">

        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/vendor.css')}}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/utility.css')}}css/utility.css">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/app.css')}}">

<div class="row" >
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
      <div class="bp-detail">
      @foreach($load_project as $key => $vid)
      <input type="hidden" class="id_post" value="{{$vid->id_post}}">
      <input type="hidden" class="check_pro" value="{{$count_pro}}">
      <input type="hidden" class="id_user" value="{{$vid->id}}">
                        <div class="bp-detail__thumbnail">
                            <!--====== Image Code ======-->
                        <div class="aspect aspect--bg-grey aspect--1366-768">

                           <img class="aspect__img" src="{{asset('/uploadproject/'.$vid->image_post)}}" alt=""></div>
                            <!--====== End - Image Code ======-->
                        </div>
                        <div class="bp-detail__info-wrap">
                            <div class="bp-detail__stat">
                                <span class="bp-detail__stat-wrap">
                                    <span class="bp-detail__publish-date">
                                        <a>
                                        <span>Time: {{$vid->time_create}}</span></a></span></span>

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__author">

                                        <a>Field: {{$vid->name_field}}</a></span></span>

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__category">

                                        <a>Hastag: {{$vid->hastag_post}}</a></span></span>


                                 
                                    @if(Auth::user())
                                        @if(Auth::user()->id == $vid->id)
                                        <span class="bp-detail__stat-wrap add_product_post" style="margin-left: 250px;">
                                        <span class="bp-detail__category"><i class="uil-focus-add"></i><a> Add Product </a></span></span>

                                        <span class="bp-detail__stat-wrap">
                                        <span class="bp-detail__category edit_post"><i class="uil-file-edit-alt"></i><a> Edit </a></span></span>

                                        <span class="bp-detail__stat-wrap remove_post">
                                        <span class="bp-detail__category"><i class=" uil-archive-alt"></i><a> Remove</a></span></span>
                                         @endif 
                                    @endif 


                                    </div>

                                    <br>
                                <span class="bp-detail__h1">

                                     @if ($vid->image_user == 0)
                                     <img  src="{{asset('/uploads/profile/avt_user.png')}}" alt="user-image" 
                                     class="img-fluid avatar-sm rounded-circle">
                                    @else
                                     <img  src="{{asset('/uploads/profile/'.$vid->id.'/'.$vid->image_user)}}" alt="user-image" 
                                     class="img-fluid avatar-sm rounded-circle">
                                    @endif

                                      &nbsp;  {{$vid->name}}  &nbsp;

                                     
                                      <span class="div_follow"> 
                                   
                                    
                                     </span>
                                     
                                      
                                  </span>

                            <span class="bp-detail__h1">
                                <a>{{$vid->title_post}}</a></span>
                            <div class="blog-t-w">
                                        @if($count_pro > 0)
                                           <button class=" gl-tag btn--e-transparent-hover-brand-b-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                                            aria-controls="offcanvasRight">
                                                         <span class="bp__read-more load_qty_product_of_Post">0</span> </button>
                                                        
                                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                                            <div class="offcanvas-header">
                                                                <h5 id="offcanvasRightLabel">List Products Related To The Post</h5>
                                                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                            </div>
                                                            <div class="offcanvas-body">
                                                             <table class="table table-borderless table-centered mb-0">
                                                                  
                                                                    <tbody id="load_Product_of_Post_Right">
                                                                       
                                                                    
                                                                    </tbody>
                                                                </table>
                                                             
                                                            </div>
                                                        </div>

                                        @endif                
                          
                            </div>
                            <p class="bp-detail__p">{{$vid->desc_post}}</p>

                            <p class="bp-detail__p">{!!$vid->detail_post!!}</p>
                            <div class="post-center-wrap">
                                <ul class="bp-detail__social-list">
                                    <li>

                                        <a class="s-fb--color" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li>

                                        <a class="s-tw--color" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li>

                                        <a class="s-insta--color" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li>

                                        <a class="s-wa--color" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li>

                                        <a class="s-gplus--color" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                         
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top:80px; margin-bottom:150px">

                            <div class="row">
                             <span class="d-meta__text u-s-m-b-36" id="Load_qty_comment_post"></span>
                            <span class="d-meta__text-3 u-s-m-b-16">Please let me know what you think about the Post *</span>
                            <br>
                             <br>
                             @if(Auth::user())      
                            <div class="col-sm-1">

                                     @if (Auth::user()->image_user == 0)
                                     <img  src="{{asset('/uploads/profile/avt_user.png')}}" alt="user-image" 
                                     class="img-fluid avatar-sm rounded-circle">
                                    @else
                                     <img  src="{{asset('/uploads/profile/'.Auth::user()->id.'/'.Auth::user()->image_user)}}" alt="user-image" 
                                    class="img-fluid avatar-sm rounded-circle">
                                    @endif

                             

                            </div>
                            <div class="col-sm-6">
                                <textarea class="text-area text-area--primary-style conetnt_rv" rows="1" style="width: 100%;"></textarea>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn--e-brand-shadow btn_comment_post">SUBMIT</button>
                            </div>
                           @endif
                          </div>
                           <div class="row">
                            <div class="col-lg-12">
                                <div class="d-meta__comment-arena">

                                
                                    <div class="d-meta__comments u-s-m-b-30" style="margin-left: 60px;" id="load_comment">
                                       
                                    </div>                             
                                  
                                </div>
                            </div>
                        </div>
        </div>

              
 @endforeach
	</div>
 
</div>

<script type="text/javascript">
 $(document).ready(function(){
   const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 1500,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })


    if($('.check_pro').val() > 0){
        load_qty_product_of_Post();
        load_Product_of_Post_Right();
    }


            function load_qty_product_of_Post(){
                    var id_post = $('.id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_qty_product_of_Post')}}',
                        method:"GET",
                        dataType:'JSON',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,_token:_token},
                        success:function(data){
                            $('.load_qty_product_of_Post').html("Products Of Post ("+data.Qty_pro+")");
                            
                            
                        }

                    }); 
                }

             function load_Product_of_Post_Right(){
                    var id_post = $('.id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_Product_of_Post_Right__Details')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,_token:_token},
                        success:function(data){
                            $('#load_Product_of_Post_Right').html(data);
                      
                        }

                    }); 
                }


   //////////////////////////////  load comment post ////////////////////


                   $('.btn_comment_post').click(function(){
                 
                             var id_post  = $('.id_post').val();
                             var content_review  = $('.conetnt_rv').val();
                             var _token = $('input[name="_token"]').val();
                             if(content_review == ""){

                                  Toast.fire({
                                  icon: 'warning',
                                  title: "<h5 style='color:#FF8C00'>Please enter content comment</h5>"
                                     
                                 });

                             }else{
                                     $.ajax({
                                    url:'{{url('post_commen_post')}}',
                                    method:"POST",
                                    dataType:"JSON", 
                                       headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },               
                                     data:{id_post:id_post,
                                     content_review:content_review,
                                      _token:_token},
                                    success:function(data){
                                        if(data.id_usersxx == "null"){

                                          window.location.href = "{{url('/LoginUser')}}";

                                         }else {
                                     
                                          load_comment_post();
                                          Load_qty_comment_post();
                                          $('.conetnt_rv').val("");
                                       }
                                       
                                    }

                                 }); 

                             }
                          
                           
                 });
      
       load_comment_post();
       Load_qty_comment_post();
               function load_comment_post(){
                    var id_post  = $('.id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_comment_post')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id_post:id_post,_token:_token},
                        success:function(data){
                            $('#load_comment').html(data);
                        }

                    }); 
                }

                function Load_qty_comment_post(){
                    var id_post  = $('.id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/Load_qty_comment_post')}}',
                        method:"GET",
                        dataType:'JSON',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id_post:id_post,_token:_token},
                        success:function(data){
                            $('#Load_qty_comment_post').html(data.Qty_comment + " Comment");
                        }

                    }); 
                }


           Load_btn_follow();
             function Load_btn_follow(){
                    var id_user  = $('.id_user').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/Load_btn_follow')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id_user:id_user,_token:_token},
                        success:function(data){
                            $('.div_follow').html(data);
                        }

                    }); 
                }

        $(document).on('click', '.btn_followed', function(e) {
            e.preventDefault();
       
               var id_user  = $('.id_user').val();
                var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('btn_Nofollow_user')}}',
                        method:"POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_user:id_user,_token:_token},
                        success:function(data){
                        Load_btn_follow();
                        }

                    }); 

        }); 

        $(document).on('click', '.btn_Follow', function(e) {
            e.preventDefault();
       
               var id_user  = $('.id_user').val();
                var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('btn_follow_user')}}',
                        method:"POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_user:id_user,_token:_token},
                        success:function(data){
                         Load_btn_follow();
                        }

                    }); 

        }); 




        $(document).on('click', '.add_product_post', function(e) {
            e.preventDefault();
             var id_post  = $('.id_post').val();
               window.location.href = "{{url('/add_product_for_post')}}" + "/" +id_post;
    

        });
       $(document).on('click', '.edit_post', function(e) {
            e.preventDefault();
             var id_post  = $('.id_post').val();
           window.location.href = "{{url('edit_post')}}" + "/" +id_post;
        });
       $(document).on('click', '.remove_post', function(e) {
            e.preventDefault();

              var id_post  = $('.id_post').val();
                Swal.fire({
                  icon: 'warning',
                  text: 'Do you want to Remove this Project ?',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, I want'
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                     window.location.href = "{{url('/remove_post')}}" + "/" +id_post;
                      
                  } 
                })
             

        });



});
</script>


    <!--====== Vendor Js ======-->
       <script src="{{asset('/Frontend/assets/js/vendor.js')}}"></script>

       <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('/Frontend/assets/js/jquery.shopnav.js')}}"></script>

        <!--====== App ======-->
        <script src="{{asset('/Frontend/assets/js/app.js')}}"></script>
@endsection