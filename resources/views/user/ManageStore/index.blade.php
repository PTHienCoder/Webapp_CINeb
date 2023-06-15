@extends('MangerStore_Layout')
@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
                  <div class="row">
                     <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                         
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                            
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	 <div class="col-lg-4">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers</h5>
                                                <h3 class="mt-3 mb-3">{{$count_customer}}</h3>
                                              {{--   <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                                    <span class="text-nowrap">Since last month</span>  
                                                </p> --}}
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-4">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                                <h3 class="mt-3 mb-3">{{$count_oder}}</h3>
                                               {{--  <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                                    <span class="text-nowrap">Since last month</span>
                                                </p> --}}
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-4">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                                                <h3 class="mt-3 mb-3">{{$profit_to}}.000đ</h3>
                                               {{--  <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                                    <span class="text-nowrap">Since last month</span>
                                                </p> --}}
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div>

                                  {{--  <div class="col-lg-3">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-pulse widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Growth">Growth</h5>
                                                <h3 class="mt-3 mb-3">+ 30.56%</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                                    <span class="text-nowrap">Since last month</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> --}}

                        </div>

                         <div class="row">
                                      	<div class="col-md-4">
	                                      
	                                        <form class="d-flex">
	                                            <div class="input-group">
		                                         <p>Từ ngày: <input type="date" id="datepicker"class="form-control form-control-light"></p>   
	                                            </div>
	                                            <div class="input-group">
	                                             <p>Đến ngày: <input type="date" id="datepicker2" class="form-control"></p>
	                                            </div>
	                                            <p>.
	                                             <a id="btn-dashboard-filter" class="btn btn-primary">
	                                                <i class="mdi mdi-autorenew"></i>
	                                              </a>
	                                            </p>
	                                            
	                                    </form>
                                     </div>
                                      <div class="col-md-3">
	                                      <p>
											Lọc theo: 
											<select class="dashboard-filter form-control" >
												<option>--Chọn--</option>
												<option value="7ngay">7 ngày qua</option>
												<option value="thangtruoc">tháng trước</option>
												<option value="thangnay">tháng này</option>
												<option value="365ngayqua">365 ngày qua</option>
											</select>
										</p>
	                                       
                                     </div>
                         </div>
                        <div class="row">
                        	          <div class="card card-h-100">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title mb-3">Projections Vs Actuals</h4>

                                        <div dir="ltr">
                                            <div id="chart" ></div>
                                        </div>
                                            
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                        </div>


    
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){

        chart60daysorder();

        var chart = new Morris.Bar({
             
              element: 'chart',
              //option chart
              lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
            
            });


       
        function chart60daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/days-order')}}",
                method:"POST",
                dataType:"JSON",  
                headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data:{_token:_token},
                
                success:function(data)
                    {
                        chart.setData(data);
                    }   
            });
        }

    $('.dashboard-filter').change(function(){
        var dashboard_value = $(this).val();
        var _token = $('input[name="_token"]').val();
        // alert(dashboard_value);
        $.ajax({
            url:"{{url('/dashboard-filter')}}",
            method:"POST",
            dataType:"JSON",
            headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
            data:{dashboard_value:dashboard_value,_token:_token},
            
            success:function(data)
                {
                    chart.setData(data);
                }   
            });

    });

    $('#btn-dashboard-filter').click(function(){
       
        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

         $.ajax({
            url:"{{url('/filter-by-date')}}",
            method:"POST",
            dataType:"JSON",
            headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
            data:{from_date:from_date,to_date:to_date,_token:_token},
            
            success:function(data)
                {
                    chart.setData(data);
                }   
        });

    });

});
    
</script>
            


@endsection