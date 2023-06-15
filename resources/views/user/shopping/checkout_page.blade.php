@extends('Shopping_layout')
@section('content')

<div class="row">
                <div class="col-12">
                            <div class="card">          
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mt-2">Delivery Address</h4>
                                                     <?php
                                                     if($ship == 0){  
                                                     ?> 
                                                      <p class="text-muted mb-3">
                                                       Please add your shipping address</p>
                                                       <button type="button" data-bs-toggle="modal" data-bs-target="#centermodal" class="btn btn-info btn-sm btn-rounded add_shippingxx"> <i class="dripicons-plus "></i> Add</button>
                                                                                          
                                                        <?php 
                                                          }
                                                        ?>
                                                       <hr>  

                                                       <div class="row" id="load_info_shipping">

                                                            {{-- ----------------------------------- --}}
                                                    
                                                        </div>
                                                    


                                                <h4 class="mt-2">Saved Address</h4>
                                                <p class="text-muted mb-3">
                                                    Fill the form below in order to
                                                            send you the order's invoice.
                                                        </p>
                                                    <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-check">
                                                                        <input type="radio" checked id="BillingOptRadio2" value="Cash on Delivery" name="type_paymentxx" class="form-check-input">
                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio2">Cash on Delivery</label>
                                                                    </div>
                                                                    <p class="mb-0 ps-3 pt-1">Pay with cash when your order is delivered..</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                                    <img src="{{asset('/backend/assets/images/payments/cod.png')}}" height="25" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-check">
                                                                        <input type="radio" id="BillingOptRadio1" value="Credit / Debit Card" name="type_paymentxx" class="form-check-input" >
                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio1">Credit / Debit Card</label>
                                                                    </div>
                                                                    <p class="mb-0 ps-3 pt-1">Safe money transfer using your bank account. We support Mastercard, Visa, Discover and Stripe.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                                    <img src="{{asset('/backend/assets/images/payments/master.png')}}" height="24" alt="master-card-img">
                                                                    <img src="{{asset('/backend/assets/images/payments/discover.png')}}" height="24" alt="discover-card-img">
                                                                    <img src="{{asset('/backend/assets/images/payments/visa.png')}}" height="24" alt="visa-card-img">
                                                                    <img src="{{asset('/backend/assets/images/payments/stripe.png')}}" height="24" alt="stripe-card-img">
                                                                </div>
                                                            </div> <!-- end row -->
                                                          
                                                        </div>


                                               
                                                   <div id="show_more_method_checkout">

                                                   <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-check">
                                                                        <input type="radio" id="BillingOptRadio2" value="Momo" name="type_paymentxx" class="form-check-input">
                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio2">Momo E-wallets</label>
                                                                    </div>
                                                                    <p class="mb-0 ps-3 pt-1">You will be redirected to MOMO website to complete your purchase securely.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                                    <img src="{{asset('/uploads/MoMo_Logo.png')}}" height="25" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="form-check">
                                                                        <input type="radio" id="BillingOptRadio2" value="Paypal" name="type_paymentxx" class="form-check-input">
                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio2">Pay with Paypal</label>
                                                                    </div>
                                                                    <p class="mb-0 ps-3 pt-1">You will be redirected to PayPal website to complete your purchase securely.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                                                                    <img src="{{asset('/backend/assets/images/payments/paypal.png')}}" height="25" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                   </div>

                                                  </div>
                                                  
                                                   <a id="see_more_btn" class="dropdown-item text-center text-primary notify-item notify-all">
                                                        See more
                                                  </a>
                                                  <a id="see_Collapse_btn" class="dropdown-item text-center text-primary notify-item notify-all">
                                                        Collapse
                                                  </a>

                                              <!-- action buttons-->
                                                <div class="row mt-4">
                                                    <div class="col-sm-6">
                                                        <a href="{{URL::to('/go_to_cart')}}" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                                            <i class="mdi mdi-arrow-left"></i>Back To Cart </a>
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-sm-end">
                                                            <a class="btn btn-danger comfirm_checkoutxx">
                                                                <i class="mdi mdi-cart-plus me-1"></i>Comfirm Checkout </a>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row-->
                                            </div>
                                            <!-- end col -->

                                            <div class="col-lg-4">
                                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                          <div class="table-responsive">
                                                                <table class="table table-borderless table-centered mb-0">
                                                                  
                                                                    <tbody id="load_pro_checkout_page">
                                                                       
                                                                    
                                                                    </tbody>
                                                                </table>
                                                            </div> <!-- end table-responsive-->
                                                    <h4 class="header-title mb-3">Order Summary</h4>

                                                    <div class="table-responsive ">
                                                        <table class="table mb-0 ">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Grand Total :</td>
                                                                    <td><span class="Grand_total"></span>.000đ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discount 
                                                                        <span class="badge badge-success-lighten pt_dis"></span>
                                                                    </td>
                                                                    <td><span class="badge badge-danger-lighten Discount"></span></td>
                                                                    <input type="hidden" class="pt_discx">
                                                                </tr>
                                                              
                                                                <tr>
                                                                    <th>Total :</th>
                                                                    <td><span class="Total"></span>.000đ</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end table-responsive -->
                                                </div>

                                            </div> <!-- end col -->

                       </div> <!-- end row -->
                   </div> <!-- end card-body-->
                  </div> <!-- end card-->
             </div> <!-- end col -->
       </div>






       {{-- ////////////////////////////////// --}}
       <!-- Center modal -->
 
        <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content" >
                {{-- new address --}}
                    <div id="new_addressxx">
                      <div class="modal-header">
                        <h4 class="modal-title title_modalxx" id="myCenterModalLabel">New Address</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body" style="height: 500px;" data-simplebar>
                              <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                  <div class="mb-2 row">
        
                                        <div class="col-sm-6">
                                        <input required type="text"  name="name" class="form-control form-control-sm name_shipping" id="name_shipping"
                                        placeholder="Enter your full name...">
                                        </div>
                                        <div class="col-sm-6">
                                        <input required type="text"  name="name" class="form-control form-control-sm phone_shipping" id="phone_shipping"
                                        placeholder="Enter your number phone...">
                                        </div>

                                       


                                  </div>
                                  <div class="mb-2 row">                 
                                        <div class="col-sm-12">
                                         <select  id="city" class="form-select form-select-sm mb-1 choosexx city">
                                                 <option value="">--Chọn tỉnh thành phố--</option>
                                                    @foreach($city as $key => $ci)
                                                    <option class="optionck" value="{{$ci->matp}}">{{$ci->name}}</option>
                                                    @endforeach                                                   
                                        </select>
                                        <select  id="province"  class="form-select form-select-sm mb-1 choosexx province">
                                            <option  value="">--Chọn quận huyện--</option>                                                   
                                        </select>
                                        <select id="wards" class="form-select form-select-sm mb-1 wards">
                                            <option value="">--Chọn xã phường--</option>                                                      
                                        </select>

                                        </div>
                                   </div>

                                      <div class=" row">                 
                                        <div class="col-sm-12">
                                        <h4 class="address_xx">

                                          <span class="cityxss">
                                          
                                         </span>   
                                          <span class="provincecsssx">
                                           
                                         </span> 
                                          <span class="wardsxxss">
                                            
                                         </span> 

                                          <h4>
                                        
                                        </div>
                                     </div>


                                   <div class="mb-2 row">                 
                                        <div class="col-sm-12">
                                        <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_address" id="desc_address"
                                        placeholder="Enter Street name, House no"></textarea>
                                        </div>
                                   </div>
                                   <div class="row">
                                         <div class="col-md-6">
                                            <div class="border p-3 rounded mb-3 mb-md-0">
                                              <input type="radio" id="customRadio1" name="customRadio" value="Home" class="form-check-input Homexx" checked="">
                                               <label class="form-check-label font-16 fw-bold" v for="customRadio1">Home</label>
                                            </div>
                                         </div>
                                          <div class="col-md-6">
                                            <div class="border p-3 rounded">
                                              <input type="radio" id="customRadio1" name="customRadio" value="Work" class="form-check-input Workxx">
                                                <label class="form-check-label font-16 fw-bold" for="customRadio2">Work</label>
                                            </div>
                                      </div>
                                   </div>
                                    
                                </li>
                                <li class="list-group-item">
                                       <div style="display: flex; justify-content: center;"> 
                                        <input type="hidden" class="id_ship"  name="name" id="id_ship">
                                        <button type="button" style="margin-right: 15px;"  class="btn btn-outline-secondary cancel_btn">Cancel</button>
                                        <button type="button" class="btn btn-outline-info add_shipping_checkout">Saves</button>
                                        <button type="button" class="btn btn-outline-info edit_shipping_checkout">Saves update</button>
                                       </div>
                                </li>
                             
                            </ul>
                         </div>


                       
                       </div>

                     
                       {{-- my address --}}
                    <div id="my_addressxx">
                       <div class="modal-header" >
                        <h4 class="modal-title" id="myCenterModalLabel">My address</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body" style="max-height: 500px; max-width: auto" data-simplebar>
                          
                                <div class="row" > 
                                    <ul class="list-group list-group-flush" id="load_all_info_delivery_checkout">

                                     

                                     {{-- ----------------------------- --}}
                                   
                                    
                                     
                             
                                    </ul>
                                </div>

                              
                                 <div class="row"> 
                                    
                                    <div class="col-sm-3">
                                    <input type="hidden" class="id_cate_product"  name="name" id="id_cate_product1">
                                     <button type="button" class="btn btn-outline-info add_shippingxx"> <i class="dripicons-plus "></i> Add</button>
                                    </div>
                                   
                                </div>
                                
                           
                           </div>
                           <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                             <button type="button" class="btn btn-primary save_change_btn">Save changes</button>
                           </div>
                       
                       </div>



                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
 
       {{-- /////////////////////////////////// --}}


    <script type="text/javascript">

       $(document).ready(function(){
    

         $('#show_more_method_checkout').fadeOut();
         $('#see_Collapse_btn').hide();
        
        $('#see_more_btn').click(function(){
            $('#show_more_method_checkout').fadeIn();
               $('#see_Collapse_btn').show();
               $('#see_more_btn').hide();
         });
        $('#see_Collapse_btn').click(function(){
            $('#show_more_method_checkout').fadeOut();
               $('#see_Collapse_btn').hide();
               $('#see_more_btn').show();
            

         });
  
  
         $('.add_shippingxx').click(function(){

            $('#new_addressxx').show();
            $('#my_addressxx').hide();

            /// edit ///
            $('.add_shipping_checkout').show();
            $('.edit_shipping_checkout').hide();
            $('.title_modalxx').text("New address delivery");
            
            

         });
         $('.cancel_btn').click(function(){
             $('#new_addressxx').hide();
            $('#my_addressxx').show();

         });
         
         $(document).on('click', '.change_shippingxcc', function(e) {
                e.preventDefault();
            $('#new_addressxx').hide();
            $('#my_addressxx').show();
              load_all_info_delivery_checkout();

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

         //////////////////// save ///////////////

         $(document).on('click', '.comfirm_checkoutxx', function(e) {
                e.preventDefault();
                

                if ($('.id_shipping_cf').length ) {
       
                   
                 var id_shipping_cf = $('.id_shipping_cf').val();
                 var type_paymentxx = $("input[name='type_paymentxx']:checked").val();
                 var pt_discx = $(".pt_discx").val();           
                 var total_order = $(".Total").text();

                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url : '{{url('/comfirm_checkout')}}',
                    method: 'POST',
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }, 
                    data:{id_shipping_cf:id_shipping_cf,
                          type_paymentxx,type_paymentxx,
                          pt_discx:pt_discx,
                          total_order:total_order,_token:_token},
                         success:function(data){

                               Swal.fire({
                                  icon: 'success',
                                  title: "<h3 style='color:#00FF00'>Checkout success</h3>",
                                  width: 300,
                                  showConfirmButton: false,
                                  timer: 1200
                                });

                               $(this).delay(1050).queue(function(){
                                  window.location.href = "{{URL::to('/page_checkout_success')}}"
                                });
                                 
                    }
                });

               }else {
                  Toast.fire({
                          icon: 'warning',
                         title: "<h5 style='color:#FF8C00'>Please enter your address delivery</h5>"                            
                         });
                   
                      
                    
             }  

         });



       ////////// /////edit /////////
         $(document).on('click', '.edit_shippingxx', function(e) {
                e.preventDefault();
            $('#new_addressxx').show();
            $('#my_addressxx').hide();

            /// edit ///
            $('.add_shipping_checkout').hide();
            $('.edit_shipping_checkout').show();
            $('.title_modalxx').text("Edit address delivery");

             var id_ship = $(this).closest(".abcdas").find(".check_default").val();
                load_info_update_shipping_checkout(id_ship)

         });

         $(document).on('click', '.edit_shipping_checkout', function(e) {
                e.preventDefault();
                var id_ship = $('.id_ship').val();
                var type_address = $("input[name='customRadio']:checked").val();
                 
                var cityxss = $('.city').val();
                var provincecsssx = $('.province').val();
                var wardsxxss = $('.wards').val();

                var name_shipping = $('.name_shipping').val();
                var phone_shipping = $('.phone_shipping').val();
                var desc_address = $('.desc_address').val() 

                if(name_shipping == "" || phone_shipping == ""){
                        Toast.fire({
                          icon: 'warning',
                         title: "<h5 style='color:#FF8C00'>Please enter your name and phone number</h5>"                            
                         });


                }else if(cityxss == "" || provincecsssx == "" || wardsxxss == "" || desc_address ==""){
                    Toast.fire({
                          icon: 'warning',
                         title: "<h5 style='color:#FF8C00'>Please enter your delivery address information</h5>"                            
                         });

                }else{

                var address_shipping = $('.cityxss').text() + $('.provincecsssx').text() + $('.wardsxxss').text();
                var _token = $('input[name="_token"]').val();
                   
            
                $.ajax({
                    url : '{{url('/save_edit_shipping_checkout')}}',
                    method: 'POST',
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }, 
                    data:{id_ship:id_ship,
                          name_shipping:name_shipping,
                          phone_shipping:phone_shipping,
                          address_shipping,address_shipping,
                          desc_address,desc_address,
                          type_address:type_address,
                          _token:_token},
                         success:function(data){
                          $('#new_addressxx').hide();
                          $('#my_addressxx').show();
                          load_null();
                          load_all_info_delivery_checkout();

                     
                    }
                });  
                 }
        
         });


         function load_info_update_shipping_checkout(id_ship){
             $('.id_ship').val(id_ship);
              var _token = $('input[name="_token"]').val();
               $.ajax({
                url : '{{url('load_info_update_shipping_checkout')}}',
                method: 'GET',
                dataType:"JSON",
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{id_ship:id_ship,  
                      _token:_token},
                     success:function(data){
                        $('.name_shipping').val(data.name_shipping);
                        $('.phone_shipping').val(data.phone_shipping);
                        $('.address_ship').val(data.address_shipping);
                        $('.desc_address').val(data.desc_address);


                        if(data.type_shipping == "Home"){
                          $(".Homexx").attr('checked', 'checked');

                        }else{
                            $(".Workxx").attr('checked', 'checked');

                        }



                }
            }); 

         }



           
         


         //////////////////


         $('.add_shipping_checkout').click(function(){

             var type_address = $("input[name='customRadio']:checked").val();
             
            var cityxss = $('.city').val();
            var provincecsssx = $('.province').val();
            var wardsxxss = $('.wards').val();

            var name_shipping = $('.name_shipping').val();
            var phone_shipping = $('.phone_shipping').val();
            var desc_address = $('.desc_address').val() 
          
            if(cityxss == "" || provincecsssx == "" || wardsxxss == "" || desc_address ==""){
                  Toast.fire({
                          icon: 'warning',
                         title: "<h5 style='color:#FF8C00'>Please enter your delivery address information</h5>"                            
                         });



            }else if(name_shipping == "" || phone_shipping == ""){
                  Toast.fire({
                          icon: 'warning',
                         title: "<h5 style='color:#FF8C00'>Please enter your name and phone number</h5>"                            
                         });
                
            }else{

            var address_shipping =  $('.cityxss').text() + $('.provincecsssx').text() + $('.wardsxxss').text();
            var _token = $('input[name="_token"]').val();
               
        
            $.ajax({
                url : '{{url('/add_shipping_checkout')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{name_shipping:name_shipping,
                      phone_shipping:phone_shipping,
                      address_shipping,address_shipping,
                      desc_address,desc_address,
                      type_address:type_address,
                      _token:_token},
                     success:function(data){
                      $('#new_addressxx').hide();
                      $('#my_addressxx').show();
                      load_null();
                      load_all_info_delivery_checkout();

                 
                }
            });  
             }
          });

         function load_null(){

            $('.name_shipping').val("");
            $('.phone_shipping').val("");
            $('.address_ship').val("");

            $('.cityxss').text("");
            $('.provincecsssx').text("");
            $('.wardsxxss').text("");

            $("#city").val("");   
            $("#province").val("");
            $("#wards").val("");

         }



         $(document).on('click', '.save_change_btn', function(e) {
                e.preventDefault();
                 update_check_shipping_default();
           
          });

         function update_check_shipping_default(){
      
              var id_ship = $("input[name='customRadio_all']:checked").val();
               var _token = $('input[name="_token"]').val();
         
               $.ajax({
                url : '{{url('update_check_shipping_default')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{id_ship:id_ship,  
                      _token:_token},
                     success:function(data){
                      load_info_delivery_checkout();
                  
                     $('.btn-close').click();

                }
            }); 

         }


          


 
      


       //       $.ajax({
       //          url : '{{url('update_check_shipping_default')}}',
       //          method: 'POST',
       //          headers: {
       //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       //             }, 
       //          data:{id_ship:id_ship,  
       //                _token:_token},
       //               success:function(data){
       //                    load_all_info_delivery_checkout();

       //          }
       //      }); 


////////////////////////////////////// function ///////////////////////////

  
          load_info_delivery_checkout();

          function load_info_delivery_checkout(){
             var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_info_delivery_checkout')}}',
                    method:"GET",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },  
                   data:{_token:_token},            
                    success:function(data){
                        $('#load_info_shipping').html(data);
      
                    }

                }); 
             }

            load_all_info_delivery_checkout();

          function load_all_info_delivery_checkout(){
                $.ajax({
                    url:'{{url('/load_all_info_delivery_checkout')}}',
                    method:"GET",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },              
                    success:function(data){
                        $('#load_all_info_delivery_checkout').html(data);
      
                    }

                }); 
             }

             load_pro_checkout_page();

             function load_pro_checkout_page(){
                $.ajax({
                    url:'{{url('/load_pro_checkout_page')}}',
                    method:"GET",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },              
                    success:function(data){
                        $('#load_pro_checkout_page').html(data);
      
                    }

                }); 
               }



          load_info_checkout_cart();
           
          function load_info_checkout_cart(){
               var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_info_checkout_cart')}}',
                    method:"GET",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:"JSON",
                     data:{_token:_token},       
                    success:function(data){  
                      $('.Grand_total').html(data.Grand_total);
                       var disco = data.Discount + data.Shipping_ch + data.Estimated_tax;
                      $('.Discount').html("- " + disco.toFixed(0) +".000đ");
                      // $('.Shipping_ch').html(data.Shipping_ch);
                      // $('.Estimated_tax').html(data.Estimated_tax);

                      $('.Total').text(data.Total);
                      $('.pt_dis').text(data.pt_dis + data.pt_ship + data.pt_tax + "%")

                      var pt_discx = (data.pt_dis + data.pt_ship + data.pt_tax)/100;

                       $('.pt_discx').val(pt_discx);

                 
      
                    }

             }); 
          }


          if($('.Total').text != 0){
              $('.comfirm_checkoutxx').show();    
                  
          }else{
              $('.comfirm_checkoutxx').hide();  

          } 

     


      });
             
    </script>




   <script type="text/javascript">


    $(document).ready(function(){

         $('#city').change(function(){ 
            var action = $(this).attr('id');
            var ma_id = $(this).val();
         
            var _token = $('input[name="_token"]').val();
           
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#province').html(data); 
                 
                }
            });  


            $('.address_xx').addClass('badge badge-info-lighten');
             var city = $('#city').find(":selected").text();
            $('.cityxss').html(`<i class="dripicons-location"></i>`+ city)
        });

         $('#province').change(function(){ 
            

            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
                
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }, 
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#wards').html(data); 


                   
                }
            });


         var province = $('#province').find(":selected").text();
            $('.provincecsssx').text(", " + province)  

         });

         $('#wards').on('change',function(){
            var wards = $('#wards').find(":selected").text();
            $('.wardsxxss').text(", " +wards)  


        });

           
           



   });


    </script>

@endsection