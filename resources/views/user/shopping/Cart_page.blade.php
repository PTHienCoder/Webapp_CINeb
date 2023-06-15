@extends('Shopping_layout')
@section('content')

<div class="row">
       <div class="card">
                 <div class="card-body">
                            <div class="row">
                                            <div class="col-lg-8">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-centered mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th></th>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                <th style="width: 50px;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="load_pro_cart_page">
                                                           
                                                        
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->

                                             

                                                <!-- action buttons-->
                                                <div class="row mt-4">
                                                    <div class="col-sm-6">
                                                        <a href="{{URL::to('/PageShopping')}}" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                                            <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-sm-end">
                                                            <a class="btn btn-danger checkout_btn">
                                                                <i class="mdi mdi-cart-plus me-1 checkout_btn"></i> Checkout </a>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row-->
                                            </div>
                                            <!-- end col -->

                                            <div class="col-lg-4">
                                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                    <h4 class="header-title mb-3">Order Summary</h4>

                                                    <div class="table-responsive ">
                                                        <table class="table mb-0 ">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Grand Total :</td>
                                                                    <td><span class="Grand_total"></span>.000đ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discount <span class="badge badge-outline-success rounded-pill pt_dis"></span> </td>
                                                                    <td><span class="Discount"></span>.000đ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shipping Charge <span class="badge badge-outline-success rounded-pill pt_ship"></span> </td>
                                                                      <td><span class="Shipping_ch"></span>.000đ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Estimated Tax <span class="badge badge-outline-success rounded-pill pt_tax"></span>  </td>
                                                                     <td><span class="Estimated_tax"></span>.000đ</td>
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

             $(document).on('click', '.checkout_btn', function(e) {
                e.preventDefault();          
                
                   var checkll = $('.Total').text();
                   if(checkll != 0 ){
                    window.location.href = "{{url('/page_checkout')}}"
                   }else{
                     Toast.fire({
                    
                          icon: 'warning',
                          title: "<h5 style='color:#FF8C00'>Please choose product for checkout</h5>"
                                     
                         });

                   }
              

             });



               $(document).on('click', '.cart_quantity_down', function(e) {
                e.preventDefault();
                var price = $(this).closest("tr").find(".price_item").text();
                var qtys = $(this).closest(".input-counter").find(".input-counter__text").val();
                if(qtys > 1){
                
                 $(this).closest(".input-counter").find(".input-counter__text").val(parseInt(qtys)-1);
                
                var qty = parseInt(qtys) - 1
                $(this).closest("tr").find(".qty_cart_page").text(parseInt(qty) * parseInt(price));
                 var id_cart = $(this).closest(".input-counter").find(".id_cartxx").val();  
                  var _token = $('input[name="_token"]').val();
                  
                            $.ajax({
                                url:'{{url('/update_quanty')}}',
                                method:"POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },        
                                 data:{id_cart:id_cart,qty:qty, _token:_token},
                                 success:function(data){ 
                                  load_pro_cart_page();
                                   load_info_checkout_cart();

                                 
                                  
                                }

                  }); 
                }
               
            });


            $(document).on('click', '.cart_quantity_up', function(e) {
                e.preventDefault();
                var price = $(this).closest("tr").find(".price_item").text();
                var qtys = $(this).closest(".input-counter").find(".input-counter__text").val();
                var max_qtypro = $(this).closest(".input-counter").find(".max_qtypro").val();

                   if(qtys<max_qtypro){
                     $(this).closest(".input-counter").find(".input-counter__text").val(parseInt(qtys) +1);
                  
                
                        var id_cart = $(this).closest(".input-counter").find(".id_cartxx").val(); 
                     
                        var qty = parseInt(qtys) + 1

                        $(this).closest("tr").find(".qty_cart_page").text( parseInt(qty) * parseInt(price));
                        

                       var _token = $('input[name="_token"]').val();
                            
                                $.ajax({
                                    url:'{{url('/update_quanty')}}',
                                    method:"POST", 
                                       headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },     
                                     data:{id_cart:id_cart,qty:qty, _token:_token},
                                     success:function(data){
                                          load_pro_cart_page();
                                        load_info_checkout_cart();
                                 }

                        });



                   } 
        
            });



      
        
        load_info_checkout_cart();
           
          function load_info_checkout_cart(){
                $.ajax({
                    url:'{{url('/load_info_checkout_cart')}}',
                    method:"GET",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:"JSON",
                    success:function(data){

                      $('.Grand_total').html(data.Grand_total);
                      $('.Discount').html(data.Discount);
                      $('.Shipping_ch').html(data.Shipping_ch);
                      $('.Estimated_tax').html(data.Estimated_tax);      
                      $('.Total').html(data.Total);

       
                      $('.pt_dis').text(data.pt_dis + "%");
                      $('.pt_ship').text(data.pt_ship + "%");
                      $('.pt_tax').text(data.pt_tax + "%");


                 
      
                    }

             }); 
          }



             $(document).on('change', '.check_item', function(e) {
               e.preventDefault();
                    var id_cart = $(this).closest(".checkbox_iteam").find(".id_cartkk").val();  
                    var _token = $('input[name="_token"]').val();
                
                    if(this.checked) {
                        
                        checkedd = 1;
                             $.ajax({
                                url:'{{url('checked_iteam')}}',
                                method:"GET",
                                   headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },data:{checkedd:checkedd, id_cart:id_cart, _token:_token},
                                success:function(data){              
                                 load_info_checkout_cart();
                                }

                            }); 
                     
                    }else{

                        checkedd = 0;
                        $.ajax({
                        url:'{{url('checked_iteam')}}',
                        method:"GET",
                           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },data:{checkedd:checkedd,id_cart:id_cart, _token:_token},
                        success:function(data){              
                          load_info_checkout_cart();
                        }

                        }); 

                    }

                    
                    
               });
       
   


   

         load_pro_cart_page();


         $(document).on('click', '.delete_item_cart', function(){

                var id_cart = $(this).closest(".id_cartxxssa").find(".id_cartxx").val();
               // alert(id_cart)
                $.ajax({
                    url:'{{url('/delete_item_cart')}}',
                    method:"GET",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },data:{id_cart:id_cart},
                    success:function(data){ 
                     load_qty_pro_cart();            
                     load_pro_cart_page();
                 
                     load_info_checkout_cart();
                    }

                }); 

         }); 

          function load_pro_cart_page(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_pro_cart_page')}}',
                    method:"GET",
                    data:{_token:_token},               
                    success:function(data){
                        $('#load_pro_cart_page').html(data);
    
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


  
  });


    </script>


@endsection