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
     <input type="hidden" id="id_post" value="{{$id_post}}">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
                 <div class="shop-p">
                                <div class="shop-p__toolbar u-s-m-b-30">
                                    <div class="shop-p__meta-wrap u-s-m-b-60">

                                        {{-- <span class="shop-p__meta-text-1">FOUND 18 RESULTS</span> --}}
                                        <div class="shop-p__meta-text-2">
                            <a  href="{{URL::to('/')}}" class="shop-w-master__heading u-s-m-b-30"  style="cursor:default;"><i class="dripicons-arrow-left u-s-m-r-8"></i>
                                    <span>BACK</span></a>
                                    <div class="section__text-wrap">
                                            <h1 class="section__heading u-c-secondary">ADD PRODUCT RELATIVE PROJECT</h1>
                                        </div>

                                    <br>
                                     <br>
                                            <a id="all_product" class="gl-tag btn--e-brand-shadow" >All Product</a>
                                           
                                           @if(Auth::user()->type_user == 1)

                                            <input type="hidden" id="id_store" value="{{$id_store}}">
                                            <a id="product_my_store" class="gl-tag btn--e-brand-shadow">Product My Store</a>
                                           @endif
                                            

                                    </div>
                                    <div class="shop-p__tool-style"  style="margin-top:30px">
                                        <div class="tool-style__group u-s-m-b-8">

                                            <span class="js-shop-grid-target is-active">Grid</span>

                                            <span class="js-shop-list-target ">List</span></div>
                                  

                                        <form>
                                            <div class="tool-style__form-wrap">
                                                <div class="u-s-m-b-8">
                                                   <input class="input-text input-text--primary-style" type="text" id="post-search" placeholder="Search">
                                                </div>
                                                <div class="u-s-m-b-8">
                                                       <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
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
                                                </div>
                                                <div class="u-s-m-b-8">
                                                        </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="shop-p__collection" style="margin-top:30px">

                                   <div class="row is-grid-active" id="load_more_product_add_post" style="margin-top: 20px;">
                                      
                                     {{--  @foreach($product as $key => $product) 

                                       @endforeach  --}}

                                  </div>
          

                                </div>
                            
                            </div>
                 

	    </div>

</div>

<script type="text/javascript">

     $(document).ready(function(){
        load_more_product_add_post();
        load_qty_product_of_Post();
        load_Product_of_Post_Right();
        var key = "all";

        $(document).on('click', '#all_product', function() {
          load_more_product_add_post();
           key = "all";
        }); 

         $(document).on('click', '#product_my_store', function() {
          load_product_add_post_store()
           key = "store";
        }); 

      /////////////////////////
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


        $(document).on('click', '.add_product_to_post', function(e) {
               e.preventDefault();
              var id_product = $(this).closest(".product-m__add-cart").find(".id_productss").val(); 
              var id_post = $('#id_post').val(); 
              var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/add_product_to_post')}}',
                        method:"POST",
                        dataType:'JSON',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,id_product:id_product,_token:_token},
                        success:function(data){
                            if(data.chek == 1){
                            load_qty_product_of_Post();
                            load_Product_of_Post_Right();
                                    if(key =="all"){
                                        load_more_product_add_post();
                                    }else if(key =="store"){
                                        load_product_add_post_store()
                                    }
                            Toast.fire({
                                  icon: 'success',
                                 title: "<h5 style='color:#7FFF00'>Product already exists</h5>"                            
                                 });
                            }else if(data.chek == 0){
                                Toast.fire({
                                  icon: 'warning',
                                 title: "<h5 style='color:#FF8C00'>Product already exists</h5>"                            
                                 });

                            }
                           

                        }

                    }); 

     
        }); 

        $(document).on('click', '.remove_item', function(e) {
          e.preventDefault();
              var id_item = $(this).closest("td").find("#id_item").val(); 
                var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('Remove_item_Pro_post')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_item:id_item,_token:_token},
                        success:function(data){
                            load_qty_product_of_Post();
                            load_Product_of_Post_Right();
                            if(key =="all"){
                                load_more_product_add_post();
                            }else if(key =="store"){
                                load_product_add_post_store()
                            }

                        }

                    }); 


        }); 





         

            function load_more_product_add_post(){
                   var id_post = $('#id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_product_add_post')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,_token:_token},
                        success:function(data){
                            $('#load_more_product_add_post').html(data);
                            
                            
                        }

                    }); 
                }


             function load_product_add_post_store(){
                   var id_post = $('#id_post').val();
                    var id_store = $('#id_store').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_product_add_post_store')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,id_store:id_store,_token:_token},
                        success:function(data){
                            $('#load_more_product_add_post').html(data);
                            
                            
                        }

                    }); 
                }
            function load_qty_product_of_Post(){
                    var id_post = $('#id_post').val();
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
                    var id_post = $('#id_post').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_Product_of_Post_Right')}}',
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



 });



</script>
            <!--====== Vendor Js ======-->
       <script src="{{asset('/Frontend/assets/js/vendor.js')}}"></script>

       <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('/Frontend/assets/js/jquery.shopnav.js')}}"></script>

        <!--====== App ======-->
        <script src="{{asset('/Frontend/assets/js/app.js')}}"></script>

@endsection