@extends('Shopping_layout')
@section('content')

<div class="row" style=" margin-top: 15px;">
      <div class="col-lg-3 col-md-12">
                     <div class="shop-w-master">
                                <a  href="{{URL::to('PageShopping')}}" class="shop-w-master__heading u-s-m-b-30"  style="cursor:default;"><i class="dripicons-arrow-left u-s-m-r-8"></i>

                              <span>BACK SHOPPING</span></a>
                                <div class="shop-w-master__sidebar sidebar--bg-snow">
                                      <div class="u-s-m-b-30" style="margin-top: 35px; padding: 15px;">
                                            <h1 class="shop-w-master__heading u-s-m-b-30"><i class="fas fa-filter u-s-m-r-8"></i>

                                           <span>FILTERS</span></h1>
                                        </div>
                             
                                      <div class="u-s-m-b-30">
                                        <div class="shop-w">
                                            <div class="shop-w__intro-wrap">
                                                <h1 class="shop-w__h">CATEGORY PRODUCT</h1>

                                                <span class="fas fa-minus shop-w__toggle" data-target="#s-manufacturer" data-toggle="collapse"></span>
                                            </div>
                                            <div class="shop-w__wrap collapse show" id="s-manufacturer">

                                                <ul class="shop-w__list-2">

                                                    @foreach($category as $key => $category) 
                                                    <li>
                                                        <div class="list__content">

                                                            <input type="hidden" class="id_cate" value="{{$category->id_areas}}" >

                                                            <span class="name_cate">{{$category->name_areas}}</span>
                                                       </div>
                             
                                                    </li>
                                                 @endforeach 
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="u-s-m-b-30">
                                        <div class="shop-w">
                                            <div class="shop-w__intro-wrap">
                                                <h1 class="shop-w__h">RATING</h1>

                                                <span class="fas fa-minus shop-w__toggle" data-target="#s-rating" data-toggle="collapse"></span>
                                            </div>
                                            <div class="shop-w__wrap collapse show" id="s-rating">
                                                <ul class="shop-w__list gl-scroll">
                                                    <li>
                                                        <div class="rating__check"  onclick="load_product_category()">

                                                            <input type="hidden" class="value_sao" value="5">
                                                            <div class="rating__check-star-wrap"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                                        </div>

                                                        
                                                    </li>
                                                    <li>
                                                        <div class="rating__check">

                                                             <input type="hidden" class="value_sao" value="4">
                                                            <div class="rating__check-star-wrap"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li>
                                                        <div class="rating__check">

                                                            <input type="hidden" class="value_sao" value="3">
                                                            <div class="rating__check-star-wrap"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
 
                                                            </div>
                                                        </div>

                                                        
                                                    </li>
                                                    <li>
                                                        <div class="rating__check">

                                                            <input type="hidden" class="value_sao" value="2">   
                                                            <div class="rating__check-star-wrap"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>

                                                                </div>
                                                        </div>

                                                       
                                                    </li>
                                                    <li>
                                                        <div class="rating__check">

                                                             <input type="hidden" class="value_sao" value="1">
                                                            <div class="rating__check-star-wrap"><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>

                                                               </div>
                                                        </div>

                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
{{--                                     <div class="u-s-m-b-30">
                                        <div class="shop-w">
                                            <div class="shop-w__intro-wrap">
                                                <h1 class="shop-w__h">SHIPPING</h1>

                                                <span class="fas fa-minus shop-w__toggle" data-target="#s-shipping" data-toggle="collapse"></span>
                                            </div>
                                            <div class="shop-w__wrap collapse show" id="s-shipping">
                                                <ul class="shop-w__list gl-scroll">
                                                    <li>

                                                        <!--====== Check Box ======-->
                                                        <div class="check-box">

                                                            <input type="checkbox" id="free-shipping">
                                                            <div class="check-box__state check-box__state--primary">

                                                                <label class="check-box__label" for="free-shipping">Free Shipping</label></div>
                                                        </div>
                                                        <!--====== End - Check Box ======-->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
  {{--                                <div class="u-s-m-b-30">
                                        <div class="shop-w">
                                            <div class="shop-w__intro-wrap">
                                                <h1 class="shop-w__h">PRICE</h1>

                                                <span class="fas fa-minus shop-w__toggle" data-target="#s-price" data-toggle="collapse"></span>
                                            </div>
                                            <div class="shop-w__wrap collapse show" id="s-price">
                                                <form class="shop-w__form-p">
                                                    <div class="shop-w__form-p-wrap">
                                                        <div>

                                                            <label for="price-min"></label>

                                                            <input class="input-text input-text--primary-style price_to" type="text" id="price-min" placeholder="Min"></div>
                                                        <div>

                                                            <label for="price-max"></label>

                                                            <input class="input-text input-text--primary-style price_from" type="text" id="price-max" placeholder="Max"></div>
                                                        <div>

                                                            <button class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2 load_product_of_price" type="button"></button></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                  
                                </div>
                            </div>
                        </div>





       <div class="col-lg-9 col-md-12">
           <div class="shop-p">

                <div class="shop-p__toolbar u-s-m-b-30">
                
                       <div class="tool-style__group u-s-m-b-8">
                           <span class="js-shop-grid-target is-active">Grid</span>
                           <span class="js-shop-list-target">List</span>
                      </div>
                        @foreach($id_areas as $key => $id_areas) 
                        <input type="hidden" class="id_areas" value="{{$id_areas->id_areas}}">
                        <h4 style="display: flex;justify-content: center;"><span class="text_cate">{{$id_areas->name_areas}}</span></h4>
                       @endforeach 
                   

                      <hr>
                    
                 </div>



              <div class="shop-p__collection" style="margin-top: 15px;">
                   <div class="row is-grid-active" id="load_more_product_category">
 



                   </div>
              </div>


            </div>
      </div>



  </div>


  <script type="text/javascript">
         $(document).ready(function(){
          load_more_product_categsxxy();

     
   
                function load_more_product_categsxxy(){ 
                  var id ='';   
                   var id_areas = $(".id_areas").val();
                     load_product_category(id, id_areas)
                }
           

                 $(document).on('click', '.list__content', function(e) {
                     e.preventDefault();
                      var id ='';  
                       var id_areas = $(this).closest(".list__content").find(".id_cate").val();
                       var name_cate = $(this).closest(".list__content").find(".name_cate").text();   
                        $('.text_cate').text(name_cate);
                       load_product_category(id, id_areas)
                      

                 });

                function load_product_category(id='',id_areax){  
                   var id_areas = id_areax;
                         

                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_product_category')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id,id_areas:id_areas,_token:_token},
                        success:function(data){
                            $('#load_more_product_category').html(data);
                            
                            
                        }

                    }); 
                }

       ///////////////// loc theo danh muc ///////////////////////


               function load_more_product_category(id = '', id_areax){  
                   var id_areas = id_areax;
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_product_category')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id:id,id_areas:id_areas,_token:_token},
                        success:function(data){
                             $('#load_more_button').remove();
                            $('#load_more_product_category').append(data);
                            
                            
                        }

                    }); 
                }

                $(document).on('click','#load_more_button',function(){
                    var id = $(this).data('id');
                    var id_cate = $(this).closest(".abcd").find(".id_areas").val();
                    $('#load_more_button').html('<b>Loading...</b>');
                    load_more_product_category(id, id_cate);
                   
                      
                })


    ////////////////////////////// loc theo sao 


                $(document).on('click', '.rating__check', function(e) {
                     e.preventDefault();
                      var id ='';  
                       var so_rating = $(this).closest(".rating__check").find(".value_sao").val();  

                        $('.text_cate').html('Product -  ' + so_rating + ' <i class="fas fa-star"></i>  ');       
                       
                         load_product_of_start(id = '', so_rating)

                        

                 });

              function load_product_of_start(id = '', so_rating){  
                   var so_rating = so_rating;
                      // alert(so_rating)
                    var _token = $('input[name="_token"]').val();
                        $.ajax({
                        url:'{{url('/load_product_of_start')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id:id,so_rating:so_rating,_token:_token},
                        success:function(data){
                          $('#load_more_product_category').html(data);
                       
                       
                         var checkcountxx = $(".checkcountxx").val();
                         
                          if(checkcountxx==0){
                               $('.abcd').remove();
                              
                          }
                         
                     
                            
                            
                        }

                    }); 
                }

              function load_more_product_of_start(id = '', so_rating){  
                   var so_rating = so_rating;
                      // alert(so_rating)
                    var _token = $('input[name="_token"]').val();
                        $.ajax({
                        url:'{{url('/load_product_of_start')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id:id,so_rating:so_rating,_token:_token},
                        success:function(data){
                             $('#load_more_of_start_button').remove();

                             $('#load_more_product_category').append(data);
                            
                            
                        }

                    }); 
                }

                  $(document).on('click','#load_more_of_start_button',function(){
                    var id = $(this).data('id');
                    var so_rating = $(this).closest(".abcd").find(".so_rating").val();
                    $('#load_more_of_start_button').html('<b>Loading...</b>');
                    load_more_product_of_start(id, so_rating);
                   
                      
                })

       ///////////////////////////// load_product_of_price //////////////////////////



         $(document).on('click','.load_product_of_price',function(){
                    var price_to = $(".price_to").val();
                    var price_from = $(".price_from").val();
                   load_product_of_price(price_to, price_from);
                    $('.text_cate').text("Min " +price_to);
                   
                      
                })

              function load_product_of_price(price_to, price_from){  
                  
                    var _token = $('input[name="_token"]').val();
                        $.ajax({
                        url:'{{url('/load_product_of_price')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{price_from:price_from,price_to:price_to,_token:_token},
                        success:function(data){
                          $('#load_more_product_category').html(data);
              
                     
                            
                            
                        }

                    }); 
                }

           });
  </script>



@endsection