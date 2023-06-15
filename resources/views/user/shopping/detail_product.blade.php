@extends('Shopping_layout')
@section('content')

{{--         <link href="{{asset('/backend/assets/css/vendor/quill.core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/backend/assets/css/vendor/quill.snow.css')}}" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset('/Frontend/style_details.css')}}" rel="stylesheet" type="text/css" />
  <div class="card" style="padding: 15px;">



  	   @foreach($product as $key => $product)
          <input type="hidden" class="type_product" value="{{$product->type_product}}">
                <div class="row">
                        <div class="col-lg-5">
                            <!--====== Product Breadcrumb ======-->
                            <div class="pd-breadcrumb u-s-m-b-30">
                                <ul class="pd-breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="{{url('/PageShopping')}}">Shopping Home</a></li>
                                    <li class="has-separator">

                                        <a href="{{url('/category_product_pages/'.$product->id_areas)}}">{{$product->name_areas}}</a></li>
                                    <li class="has-separator">

                                        <a href="">{{$product->name_cate_product}}</a></li>
                                    <li class="is-marked">

                                        <a href="">{{$product->name_product}}</a></li>
                                </ul>
                            </div>
                            <!--====== End - Product Breadcrumb ======-->
                            <img class="u-img-fluid" src="{{url('/uploadproduct/'.$product->image_product)}}" data-zoom-image="{{url('/uploadproduct/'.$product->image_product)}}" alt="">
    
                           </div>
                        <div class="col-lg-7">

                            <!--====== Product Right Side Details ======-->
                            <div class="pd-detail">
                                <div>

                                    <span class="pd-detail__name">{{$product->name_product}}</span></div>
                                <div>
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__price" id="load_price_product_details"></span>

                                        {{-- <span class="pd-detail__discount">(76% OFF)</span><del class="pd-detail__del">$28.97</del></div> --}}
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__rating gl-rating-style" id="load_sao_detais_pro">
                                        

                                    </div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <ul class="pd-social-list">
                                        <li>

                                            <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li>

                                            <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li>

                                            <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li>

                                            <a class="s-wa--color-hover" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        <li>

                                            <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>

                                 <div class="u-s-m-b-15">
                                    <form class="form cf" id="load_type_pro_detals">
                                        
                                        
                                      
                                    </form>
                                    
                                  </div>
                                    <div class="u-s-m-b-15">
                                     <form class="form cf" id="load_size_pro_detals">
                                        
                                     </form>
                                    
                                     </div>
                              

                              
                            
                                  <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">
                                     The remaining amount: <span class="pd-detail__stock" id="load_qty_product_details">0</span>
                                     <input class="load_qty_product_details" type="hidden" value="" >
                                    </div>
                                </div>
                                <div class="u-s-m-b-15" style="margin-top: 15px;">
                                    <form class="pd-detail__form">
                                        <div class="pd-detail-inline-2">
                                         <div class="u-s-m-b-15">

                                                <!--====== Input Counter ======-->
                                                <div class="input-counter">

                                                    <span class="input-counter__minus fas fa-minus dow_qty_details"></span>

                                                    <input class="input-counter__text input-counter--text-primary-style" type="text" value="1" data-min="1">

                                                    <span class="input-counter__plus fas fa-plus up_qty_details"></span>
                                                </div>
                                                <!--====== End - Input Counter ======-->
                                            </div>

                                            <div class="u-s-m-b-15">
                                                <div class="product-m__add-cart">
                                                  <input class="id_productss" type="hidden" value="{{$product->id_product}}" >
                                                 <a class="btn btn--e-brand-b-2 add_to_cart">Add to Cart</a>
                                                </div>

                                                {{-- <a class="btn btn--e-brand-b-2"  onclick="add_to_cart(this.id);" id="{{$product->id_product}}">Add to Cart</a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                    <ul class="pd-detail__policy-list">
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Buyer Protection.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Full Refund if you don't receive your order.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Returns accepted if product not as described.</span></li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="u-s-m-b-15">

                                    <div class="row">
                                       <h4 class="font-13 text-uppercase">About store information :</h4>
                                        <div class="col-lg-4">
                                            <span id="image_store">
                                            <img alt="image" src="{{url('/uploads/store/'.$product->avt_store)}}" s 
                                            class="rounded-circle avatar-md img-thumbnail" />
                                           
                                            </span>
                                                   
                                             <h4 class="mb-0 mt-2" id="name_store">{{$product->name_store}}</h4>
                                              <p class="text-muted font-14" id="phone_store">{{$product->phone_store}}</p>
                                                   
     
                                        </div>
                                        <div class="col-lg-8">

                                              
                                               <p class="text-muted mb-2 font-13"><strong>Join date :</strong> <span class="ms-2" id="time_add">{{$product->time_add}}</span></p>

                                                <p class="text-muted mb-2 font-13"><strong>The number of products :</strong><span class="ms-2" id="qty_pro_sto">{{$count_pro_store}}</span></p>

                                                 <p  class="text-muted mb-2 font-13"><strong>Address store :</strong> <span class="ms-2" id="address_store">{{$product->address_store}}</span></p>

                                                 <a href="{{url('/Pages_store_product/'.$product->id_store)}}" class="btn btn-danger btn-sm mt-1"><i class="uil uil-shop me-1"></i>View store</a>
                                                     <a href="{{url('/Chat_Page/'.$product->id_store)}}" class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Chat</a>
                                            

                                        </div>
                                     </div>
                                </div>
                            </div>
                            <!--====== End - Product Right Side Details ======-->
                        </div>
                    </div>

             </div>


            <div class="row">
                        <div class="col-lg-12">
                            <div class="pd-tab">
                                <div class="u-s-m-b-30">
                                    <ul class="nav pd-tab__list">
                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="tab" href="#pd-desc">DESCRIPTION</a></li>
                                        
                                        <li class="nav-item">

                                            <a class="nav-link" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS

                                                (<span class="load_qty_rv_tab"></span>)</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">

                                    <!--====== Tab 1 ======-->
                                    <div class="tab-pane fade show active" id="pd-desc">
                         
                                        <div class="pd-tab__desc">
                                         
                                            <div class="u-s-m-b-15" style=" margin-top: 15px;">
                                                 {!!$product->desc_product!!}
                                            </div>
                                          
                                            <div class="u-s-m-b-15">
                                                <h4>PRODUCT INFORMATION</h4>
                                                <hr>
                                            </div>
                                            <div class="u-s-m-b-15">
                                                 <div class="pd-table gl-scroll">
                                                      {!!$product->details_product!!}
                                                </div>
                                            </div>
                                        </div>
                               
                                    </div>
                                    <!--====== End - Tab 1 ======-->


                                    <!--====== Tab 3 ======-->
                                    <div class="tab-pane" id="pd-rev">
                                        <div class="pd-tab__rev">
                                            <div class="u-s-m-b-30">              
                                              <div class="pd-tab__rev-score">
                                                 <div class="row">
                                                    <div class="u-s-m-b-8">
                                                        <h2><span class="qty_review"></span> 
                                                        Reviews - <span class="tbc_review"></span> / 5</h2>
                                                    </div>
                                                    <div class="gl-rating-style-2 u-s-m-b-8" id="load_saoxx">
                                                       
                                                    </div>
                                                   
                                                  </div>
                                                  <div class="row">
                                                   <div class="button-list">
                                                    <button type="button" onclick="load_rv_sao(0)" class="btn btn-outline-warning all_rview">All</button>

                                                    <button type="button" onclick="load_rv_sao(5)" class="btn btn-outline-warning namsao">5 
                                                        <i class="fas fa-star"></i>  (<span class="5sao"> </span>)
                                                    </button>

                                                    <button type="button" onclick="load_rv_sao(4)" class="btn btn-outline-warning bonsao">4 
                                                        <i class="fas fa-star"></i> (<span class="4sao"> </span>)
                                                    </button>

                                                    <button type="button" onclick="load_rv_sao(3)" class="btn btn-outline-warning basao">3 
                                                        <i class="fas fa-star"></i> (<span class="3sao"> </span>)
                                                    </button>

                                                    <button type="button" onclick="load_rv_sao(2)" class="btn btn-outline-warning haisao">2 
                                                        <i class="fas fa-star"></i> (<span class="2sao"> </span>)
                                                    </button>

                                                    <button type="button" onclick="load_rv_sao(1)" class="btn btn-outline-warning motsao">1 
                                                        <i class="fas fa-star"></i> (<span class="1sao"> </span>)
                                                    </button>
                                                  
                                            
                                                   </div>


                                                  </div>

                                            </div>
                                                
                                            </div>

                                        
                                            <div class="u-s-m-b-30" >
                                                <div class="rev-f1__group">
                                                     <div class="u-s-m-b-15">
                                                         <h2><span class="qty_review"></span> review </h2>
                                                              </div>
                                                                            
                                                </div>
                                                <div class="rev-f1__review " id="load_revwew">
                                                  

                                                       {{-- ...................... --}}
                                                </div> 
                                          
                                             
                                            </div>

                                            <div class="u-s-m-b-30" id="div_rv_pro">
                                                  
                                              
                                                 <h2 class="u-s-m-b-15">Add a Review</h2>
                                                    <div class="u-s-m-b-30">
                                                        <div class="rev-f2__table-wrap gl-scroll">
                                                            <table class="rev-f2__table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i>

                                                                                <span>(1)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(1.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(2)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(2.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(3)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(3.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(4)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(4.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(5)</span></div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-1" name="rating"value="1" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-1.5" name="rating"value="1.5" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-2" name="rating"value="2" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-2.5" name="rating"value="2.5" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-3" name="rating"value="3" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-3.5" name="rating" value="3.5" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-4" name="rating"value="4" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" value="4.5" id="star-4.5" name="rating"class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-5" name="rating" value="5" class="checkbox_rate">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" value=" {{$product->id_product}}" class="id_productssx">
                                                    <input type="hidden" value=" {{$product->id_store}}" class="id_store">
                                                    
                                                    <div class="rev-f2__group">


                                                       
                                                        <div class="u-s-m-b-15">
                                                            <label class="gl-label" for="reviewer-text">YOUR REVIEW *</label>
                                                           
                                                             <textarea class="text-area text-area--primary-style conetnt_rv" rows="4" style="width: 100%;"></textarea>
                                                        </div>

                                                       
                                                    </div>
                                                    <div>


                                                     <button type="button" style="margin-top: 45px;" class="btn btn--e-brand-shadow btn_reviewxx" >SUBMIT</button>
                                                    </div>

                                            </div>



                                        </div>
                                    </div>
                                    <!--====== End - Tab 3 ======-->
                                </div>
                            </div>
                        </div>
                    </div>


      @endforeach



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


          $(document).on('click', '.add_to_cart', function(e) {
                  // function add_to_cart(id){
                      e.preventDefault();

                  
                       var id_product = $(this).closest(".product-m__add-cart").find(".id_productss").val();
                       var type_product = $('.type_product').val();

                       if($('.id_Auth').val() == 0){
                        window.location.href = "{{url('/LoginUser')}}";

                       }else if( $('.load_qty_product_details').val() == 0){

                        // alert("The product is out of stock")
                        Toast.fire({
                                 icon: 'warning',
                                title: "<h5 style='color:#FF8C00'>The product is out of stock</h5>"
                                     
                         });

                       }else{

                            if(type_product == 0 ){

                            var id_size_product = 0
                            var id_type_product = 0   
                            save_add_product_cart(id_product, id_type_product, id_size_product);

                            }else if(type_product == 1 ){
                                    if($("input[name='radio1']:checked").length >0){

                                       var id_size_product = 0
                                       var id_type_product = $("input[name='radio1']:checked").val();    
                                       save_add_product_cart(id_product, id_type_product, id_size_product);
                                    }else{    
                                       var asas = $('.title_typexx').text();

                              
                                        Toast.fire({
                                          icon: 'warning',
                                          title: "<h5 style='color:#FF8C00'>Please choose " + asas + "</h5>"
                                     
                                        });   
                                
                                       
                                    }

                        

                            }else if(type_product == 2 ){

                                    if($("input[name='radio2']:checked").length >0){

                                       var id_size_product = $("input[name='radio2']:checked").val();
                                       var id_type_product = $("input[name='radio1']:checked").val();  

                                      save_add_product_cart(id_product, id_type_product, id_size_product);
                                    }else{    
                                       var asas = $('.title_typexx').text(); 

                                       Toast.fire({
                                          icon: 'warning',
                                          title: "<h5 style='color:#FF8C00'>Please choose " + asas + " and size</h5>"
                                     
                                        });   
                                       
                                    }
            
                            }



                        
                    }
                   
               });
        function save_add_product_cart(id_product, id_type_product, id_size_product){
                         var qty_pro = $(".input-counter__text").val();
                         var _token = $('input[name="_token"]').val();

                         $.ajax({
                         url:"{{url('/add_to_cart')}}",
                         method:"POST", 
                          headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },data:{id_product:id_product,
                                    id_type_product:id_type_product,
                                    id_size_product:id_size_product,
                                    qty_pro:qty_pro, _token:_token},
                              success:function(data){
                      
                              load_qty_pro_cart();
                              load_pro_cart_layout();
                              var id_type_pro = 0;
                              var id_size_pro = 0;
                              load_qty_and_price_product_details(id_type_pro, id_size_pro);

                               if($('.type_product').val() == 1){

                                load_type_pro_detals();        

                                }else if($('.type_product').val() == 2){

                                load_type_pro_detals();
                                load_size_pro_detals(id_size_pro);

                                }
                                Swal.fire({
                                  icon: 'success',
                                  title: "<h3 style='color:#00FF00'>add to cart success</h3>",
                                  width: 300,
                                  showConfirmButton: false,
                                  timer: 1200
                                });

                              // alert("add to cart success")      
                          }
                       });
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
     







   ////////////////////// load type, qty price pro ///////////

           var id_type_pro = 0;
           var id_size_pro = 0;
            load_qty_and_price_product_details(id_type_pro, id_size_pro);

            if($('.type_product').val() == 1){

            load_type_pro_detals();        

            }else if($('.type_product').val() == 2){

            load_type_pro_detals();
            load_size_pro_detals(id_size_pro);

            }

            /////////// event radio

              $(document).on('click', 'input[name=radio1]', function() {
                var id_type_pro = $(this).val();
                var id_size_pro = 0;
                load_qty_and_price_product_details(id_type_pro, id_size_pro);
                load_size_pro_detals(id_type_pro);  

               });



              $(document).on('click', 'input[name=radio2]', function() {

                if($("input[name='radio1']:checked").length >0){

                 var id_size_pro = $(this).val();          
                 var id_type_pro = $("input[name='radio1']:checked").val();
                 load_qty_and_price_product_details(id_type_pro, id_size_pro); 
                 // alert("Please asdad " );

                }else{

                    $('input[name=radio2]').prop('checked', false);
                    var asas = $('.title_typexx').text();

                               Swal.fire({
                                  position: 'top-end',
                                  icon: 'warning',
                                  text: 'Please choose '+ asas,
                                  showConfirmButton: false,
                                  timer: 1200
                                });     
                    // alert("Please choose " + asas);

                }

               
               });




           

              function load_qty_and_price_product_details(id_type_pro = '', id_size_pro = ''){
                    var id_product  = $('.id_productssx').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_qty_and_price_product_details')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'JSON',
                           data:{id_product:id_product,
                                id_type_pro:id_type_pro,
                                id_size_pro:id_size_pro,
                                _token:_token},
                        success:function(data){
                            $('#load_price_product_details').html(data.price_product);
                            $('#load_qty_product_details').text(data.qty_product);
                            $('.load_qty_product_details').val(data.qty_product);
                            $(".input-counter__text").data('max', data.qty_product);
                         }

                    }); 
                }

             function load_type_pro_detals(id_type_pro = ''){
                    var id_product  = $('.id_productssx').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_type_pro_detals')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id_product:id_product,_token:_token},
                        success:function(data){
                            $('#load_type_pro_detals').html(data);
                         }

                    }); 
             }

               function load_size_pro_detals(id_type_pro = ''){
                    var id_product  = $('.id_productssx').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_size_pro_detals')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id_product:id_product,id_type_pro:id_type_pro,_token:_token},
                        success:function(data){
                            $('#load_size_pro_detals').html(data);
                         }

                }); 
             } 


           
         });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
           
          var rating = 0;
           var content_review="..."
                   $(document).on('click', '.checkbox_rate', function() {
                    rating = $(this).closest(".radio-box").find(".checkbox_rate").val();  
                                             
                   });
         
                   $('.btn_reviewxx').click(function(){
                 
                             var id_product  = $('.id_productssx').val();
                             content_review  = $('.conetnt_rv').val();
                             var _token = $('input[name="_token"]').val();
                          
                            $.ajax({
                                url:'{{url('post_review_product')}}',
                                method:"POST",
                                dataType:"JSON", 
                                   headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },               
                                 data:{id_product:id_product,
                                 content_review:content_review,
                                 rating:rating,
                                  _token:_token},
                                success:function(data){
                                    if(data.id_usersxx == "null"){

                                      window.location.href = "{{url('/LoginUser')}}";

                                     }else {
                                     load_sao_review_product()
                                     load_qty_review_product() 
                                     load_all_start_review()
                                      $('.rev-f2__group').remove();
                                      // $.NotificationApp.send("","add to cart success","top-right","rgba(0,0,0,0.2)","success")
                                   }
                                   
                                }

                           }); 
                 });
      

 

        load_sao_review_product();
           
           function load_sao_review_product(){
                 var id_product  = $('.id_productssx').val();
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url:'{{url('/load_sao_review_product')}}',
                    method:"GET",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },data:{id_product:id_product,_token:_token},
                    success:function(data){
                         $('#load_sao_detais_pro').html(data);
                        $('#load_saoxx').html(data);
                       
                    }

                }); 
               
            }


         load_qty_review_product();

             function load_qty_review_product(){
                 var id_product  = $('.id_productssx').val();
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url:'{{url('/load_qty_review_product')}}',
                      method:"GET",
                     dataType:"JSON",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },data:{id_product:id_product,_token:_token},
                    success:function(data){
                        $('.5sao').text(data.nam_sao);
                        $('.4sao').text(data.bon_sao);
                        $('.3sao').text(data.ba_sao);
                        $('.2sao').text(data.hai_sao);
                        $('.1sao').text(data.mot_sao);

                        $('.tbc_review').text(data.avg_rv);

                        $('.qty_review').text(data.qty_rv);
                        $('.load_qty_rv_tab').text(data.qty_rv);

                      
                    }

                }); 
               
            }

              
             
 ////////////////////////// load review ////////////////

         load_more_review();
             
               function load_more_review(id = ''){
                    var id_product  = $('.id_productssx').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_review')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id:id,id_product:id_product,_token:_token},
                        success:function(data){
                            $('#load_more_button').remove();
                            $('#load_revwew').append(data);
                        }

                    }); 
                }
                $(document).on('click','#load_more_button',function(){
                    var id = $(this).data('id');
                    $('#load_more_button').html('<b>Loading...</b>');
                    load_more_review(id);
                   
                      
             })
  
        

   });


</script>
<script type="text/javascript">
        if($('.id_Auth').val() == 0){
        $('#div_rv_pro').hide();
        }else{
        $('#div_rv_pro').show();
        }
       

          function load_rv_sao(sao){
               
                  if(sao==0){
                   load_all_start_review()
                  }else{
                    load_review_of_start(sao)
                  }

                 }

                function load_review_of_start(sao){
                     var id_product  = $('.id_productssx').val();
                     var _token = $('input[name="_token"]').val();
                     $.ajax({
                        url:'{{url('/load_review_of_start')}}',
                        method:"GET",
                           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{sao:sao,id_product:id_product,_token:_token},
                        success:function(data){
                            $('#load_revwew').html(data);
                        }

                    }); 
                   
                }


         
                 
            function load_all_start_review(id = ''){
                     var id_product  = $('.id_productssx').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_review')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{id:id,id_product:id_product,_token:_token},
                        success:function(data){
                            $('#load_more_button').remove();
                            $('#load_revwew').html(data);
                            
                            
                        }

                    }); 
         }
</script>


{{-- 
  <!-- quill js -->
<script src="{{asset('/backend/assets/js/vendor/quill.min.js')}}"></script>
<!-- quill Init js-->
<script src="{{asset('/backend/assets/js/pages/demo.quilljs.js')}}"></script>
 --}}




                
@endsection