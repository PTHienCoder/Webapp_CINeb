@extends('shopping_layout')
@section('content')


         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">

        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/vendor.css')}}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/utility.css')}}css/utility.css">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/app.css')}}">

<div class="row">
     <input type="hidden" id="key_search" value="{{$key_search}}">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
                 <div class="shop-p">
                                <div class="shop-p__toolbar u-s-m-b-30">
                                    <div class="shop-p__meta-wrap u-s-m-b-60">

                                        {{-- <span class="shop-p__meta-text-1">FOUND 18 RESULTS</span> --}}
                                <div class="shop-p__meta-text-2">
                                   <a  href="{{URL::to('/PageShopping')}}" class="shop-w-master__heading u-s-m-b-30"  style="cursor:default;"><i class="dripicons-arrow-left u-s-m-r-8"></i>
                                    <span>BACK</span></a>
                                    <div class="empty">
                                    <div class="empty__wrap">

                                
                                        <span class="empty__text-2 qty_resutl"></span>

                                           
                                        <div class="empty__search-form">
                                            <input class="input-text input-text--primary-style input_search" type="text" id="search-label" placeholder="Search Keywords">
                                               <span class="icon_seacrh"><button class="btn btn--icon fas fa-search" type="button"></button></span>  </div>
                                    </div>
                                </div>

                                    </div>
                                    <div class="shop-p__tool-style"  style="margin-top:30px">
                                        <div class="tool-style__group u-s-m-b-8">

                                            <span class="js-shop-grid-target is-active">Grid</span>

                                            <span class="js-shop-list-target ">List</span></div>
                                  

                                     
                                         
                                    </div>
                                        
                                    </div>
                                </div>
                                <div class="shop-p__collection" style="margin-top:30px">

                                   <div class="row is-grid-active" id="load_more_product_search" style="margin-top: 20px;">
                                      
                                     {{--  @foreach($product as $key => $product) 

                                       @endforeach  --}}

                                  </div>
          

                                </div>
                            
                   </div>
                 

	    </div>

</div>

<script type="text/javascript">
 $(document).ready(function(){
 var key_search = $("#key_search").val();
  load_product_key_search(key_search);
  $('.input_search').val(key_search);

    $(".input_search").keyup(function(){
         if( $('.input_search').val() != ""){
         $('.icon_seacrh').html('<button class="btn btn--icon mdi mdi-close btn_removekeys" type="button"></button>') 
           load_product_key_search($('.input_search').val());
         }else{
         $('.icon_seacrh').html('<button class="btn btn--icon fas fa-search" type="button"></button>') 
           load_product_key_search($('.input_search').val());
         }          
                 
     });

    $(document).on('click', '.btn_removekeys', function(){  
        $('.input_search').val("")
        load_product_key_search($('.input_search').val());
    });

      function load_product_key_search(key_search){   
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('/load_product_key_search')}}",
            method:"POST",
            dataType:'JSON', 
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },data:{key_search:key_search,
             _token:_token},
              success:function(data){
              $('#load_more_product_search').html(data.data_result);
              $('.qty_resutl').html(data.Qty_result);
              
             }
       });
     }
     
      $(document).on('click', '.item_productxx', function(e) {
                e.preventDefault();          
                var id_productss = $(this).closest(".item_productxx").find(".id_productss").val();
                var key_active = "Search_Product";
                var content_key = $('.input_search').val();

                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                    url:"{{url('add_product_active_shopping')}}",
                    method:"POST",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{id_productss:id_productss,
                     content_key:content_key,
                     key_active:key_active,
                     _token:_token},
                      success:function(data){
                      window.location.href = "{{url('/detail_products')}}" + "/" + id_productss;
                     }
                   });

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