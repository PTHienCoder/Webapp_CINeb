@extends('MangerStore_Layout')
@section('content')

      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                 {{--    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                                            <li class="breadcrumb-item active">Orders</li>
                                        </ol>
                                    </div> --}}
                                    <h4 class="page-title">Orders</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-xl-8">
                                                <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                                                    <div class="col-auto">
                                                        <label for="inputPassword2" class="visually-hidden">Search</label>
                                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="d-flex align-items-center">
                                                            <label for="status-select" class="me-2">Status</label>
                                                            <select class="form-select" id="status-select">
                                                                <option selected="">Choose...</option>
                                                                <option value="0">Processing</option>
                                                                <option value="1">Packed</option>
                                                                <option value="2">Shipped</option>
                                                                <option value="3">Delivered</option>
                                                                <option value="4">Cancelled</option>
                                                                <option value="5">Paid</option>
                                                         
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>                            
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="text-xl-end mt-xl-0 mt-2">
                                                    {{-- <button type="button" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Order</button> --}}
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Order ID</th>
                                                        <th>Date</th>
                                                        <th>Quality Item</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Order Status</th>
                                                        <th style="width: 125px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="load_order_manager">
                                                 
                                                    
                                               
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
<script type="text/javascript">
  $(document).ready(function(){

      $(document).on('click','.delete_order_store',function(e){
          var id_order_store =$(this).closest("td").find(".id_order_store").val();
          var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/delete_order_store')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_order_store:id_order_store,_token:_token},
                    success:function(data){
                      load_order_manager();
      
                    }

            }); 
    
     });



     load_order_manager();
        function load_order_manager(){
             var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_order_manager')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('.load_order_manager').html(data);
      
                    }

            }); 
          }

  }); 

</script>


@endsection