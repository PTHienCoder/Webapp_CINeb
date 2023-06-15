@extends('MangerStore_Layout')
@section('content')

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                          <div class="row">

                                             <div class="col-sm-8">
                                                 <label for="example-select" class="form-label">Status Select</label>
                                                      <select class="form-select select_status" id="example-select">
                                                               <option class="a" value="0">Processing</option>
                                                                <option class="c" value="1">Packed</option>
                                                                <option class="d" value="2">Shipped</option>
                                                                <option class="e" value="3">Delivered</option>
                                                                <option class="f" value="4">Cancelled</option>
                                                                <option class="g" value="5">Paid</option>  
                                                        
                                                     </select>
                                               </div>

                                             <div class="col-sm-4">
                                                 <label for="example-select" class="form-label">.</label>
                                                   <button class="btn btn-outline-primary btn_ok_select_status">OK</button>
                                               </div>

                                         </div>
                                    </div>
                                    <h4 class="page-title">  <a  href="{{url('manage_order_store')}}" class="shop-w-master__heading u-s-m-b-30"  style="cursor:default;"><i class="dripicons-arrow-left u-s-m-r-8"></i> </a>
                                      <span> Order Details</span></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-11">

                                <h3 class="st_4" style="text-align: center;"><span class="badge badge-danger-lighten">
                                <i class="mdi mdi-exclamation-thick"></i>Cancelled</span></h3>

                                <h3 class="st_5" style="text-align: center;"><span class="badge badge-success-lighten">
                                <i class="mdi mdi-cancel"></i>Paid</span></h3>

                                <h3 class="st_3" style="text-align: center;"><span class="badge badge-success-lighten">
                                <i class="mdi mdi-check-underline"></i>Delivered Succecss</span></h3>
        
                               <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                    <div class="horizontal-steps-content">
                                        <div class="step-item st1" >
                                            <span class="time_ordersx" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                        </div>
                                        <div class="step-item st2">
                                            <span>Packed</span>
                                        </div>
                                        <div class="step-item st3">
                                            <span data-bs-container="#tooltip-container">Shipped</span>
                                        </div>
                                        <div class="step-item st4">
                                            <span>Delivered</span>
                                        </div>
                                    </div>
        
                                    <div class="process-line" style="width: 33%;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->    
                        
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Items from Order {{$de_orderxs_us->order_code}}</h4>
            
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr> 
                                                    <th>Item</th>
                                                    <th>type product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                 @foreach($itemd_order as $key => $itemd_order)
                                                    <tr>
                                                        <td>
                                                        <img src="{{asset('/uploadproduct/'.$itemd_order->image_product)}}" class="img-thumbnail" width="40px" height="40px">
                                                         <p class="m-0 d-inline-block align-middle font-15" 
                                                         style="overflow-wrap: break-word; width: 150px;>
                                                           <a class="text-body">  
                                                           {{$itemd_order->name_product}}</a>
                                                              <br>
                                                           </p>
                                                       </td>
                                                       @if($itemd_order->type_pro ==0)
                                                            <td></td>

                                                       @elseif($itemd_order->type_pro ==1)
                                                         <td><span class="badge badge-outline-warning">
                                                            {{$itemd_order->name_type}}</span></td>

                                                       @elseif($itemd_order->type_pro ==2)

                                                          <td><span class="badge badge-outline-warning">
                                                            {{$itemd_order->name_type}}, {{$itemd_order->name_size}}</span></td>
                                                       @endif

                                                        

                                                        <td>{{$itemd_order->qty_product}}</td>
                                                        <td>{{$itemd_order->price_product}}</td>
                                                        <td>{{$itemd_order->price_items}}</td>
                                                    </tr>
                                                 @endforeach
                                        
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Order Summary</h4>
            
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Grand Total :</td>
                                                    <td>${{$de_order_st->total_order}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount 
                                                    <span class="badge badge-success-lighten pt_dis">{{$pt_dis}}%</span>
                                                    </td>
                                                     <td><span class="badge badge-danger-lighten Discount">-${{$pri_dis}}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Total :</th>
                                                    <th>${{$price_total_dis}}</th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
        
         
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Shipping Information</h4>

                                        <h5>{{$de_orderxs_ship->name_shipping}}</h5>
                                        
                                        <address class="mb-0 font-14 address-lg">
                                            {{$de_orderxs_ship->desc_address_ship}},<br>
                                            {{$de_orderxs_ship->address_ship}}<br>
                                            <abbr title="Phone">P: </abbr> {{$de_orderxs_ship->phone_order}}<br>
                                            <abbr title="Mobile">M: </abbr> {{$de_orderxs_ship->email_user}}
                                        </address>

            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Billing Information</h4>

                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span>{{$de_orderxs_us->method_payment  }}</p>
                                                <p class="mb-2"><span class="fw-bold me-2">Provider:</span>{{$name_store->name_store}}</p>
                                                <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span> {{$de_orderxs_us->time_order}}</p>
                                                <p class="mb-0"><span class="fw-bold me-2">CVV:</span>xxx</p>
                                            </li>
                                        </ul>
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Delivery Info</h4>
            
                                        <div class="text-center">
                                            <i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b>UPS Delivery</b></h5>
                                            <p class="mb-1"><b>Order ID :</b> {{$de_orderxs_us->order_code}}</p>
                                            <p class="mb-0"><b>Payment Mode :</b>{{$de_orderxs_us->method_payment  }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
    <input type="hidden" class="id_order_store" value="{{$de_order_st->id_order_store}}">
     <input type="hidden" class="order_status" value="{{$de_order_st->order_status}}">
<script type="text/javascript">
  $(document).ready(function(){

 
           $(document).on('click', '.btn_ok_select_status', function() {
                var id_order_store = $('.id_order_store').val();
                var status_order =  $('.select_status').val();
                 var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/update_status_order')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_order_store:id_order_store,status_order:status_order,_token:_token},
                    success:function(data){
                
                    load_status_order_store(status_order);
                    }
            
           });
          }); 

         var status_order =  $('.order_status').val();
         load_status_order_store(status_order);

        function load_status_order_store(status_order){
         
                      if(status_order == 0){

                         $('.st1').addClass("current");
                         $('.st2').removeClass("current");
                         $('.st3').removeClass("current");
                         $('.st4').removeClass("current");

                         $('.process-line').width(0 + '%');
                         $('.select_status').val("0").change();

                         $('.st_4').hide();
                         $('.st_5').hide();
                         $('.st_3').hide();

                      }else if(status_order == 1){

                          $('.st2').addClass("current");
                          $('.st1').removeClass("current");
                          $('.st3').removeClass("current");
                          $('.st4').removeClass("current");

                          $('.process-line').width(33 + '%');
                          $('.select_status').val("1").change();

                         $('.st_4').hide();
                         $('.st_5').hide();
                         $('.st_3').hide();

                      }else if(status_order == 2){
                          $('.st3').addClass("current");
                          $('.st1').removeClass("current");
                          $('.st2').removeClass("current");
                          $('.st4').removeClass("current");

                         $('.process-line').width(66 + '%');
                         $('.select_status').val("2").change();

                         $('.st_4').hide();
                         $('.st_5').hide();
                         $('.st_3').hide();

                      }else if(status_order == 3){
                          $('.st4').addClass("current");
                          $('.st1').removeClass("current");
                          $('.st2').removeClass("current");
                          $('.st3').removeClass("current");

                          $('.process-line').width(100 + '%');
                          $('.select_status').val("3").change();

                         $('.st_4').hide();
                         $('.st_5').hide();
                         $('.st_3').show();

                      }else if(status_order == 4){
                          $('.st_4').show();
                          $('.st_5').hide();
                          $('.st_3').hide();
                           $('.select_status').val("4").change();

                      }else if(status_order == 5){
                         $('.st_4').hide();
                         $('.st_5').show();
                         $('.st_3').hide();
                         $('.select_status').val("5").change();
                      }
          }
         

  }); 

</script>


@endsection