@extends('Admin_layout')

@section('sidebar-left')
  @include('admin.include_admin.sidebar_left')
@endsection

@section('navbar-top')
  @include('admin.include_admin.navbar_top')
@endsection
@section('contents')
      <div class="row">
       <div class="page-title-box">
        <h4 class="page-title-box">Manager Products</h4>
         </div>
      
                <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                             
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">
                                                    <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div>
                                        </div>
                
                                           <div class="table-responsive">
                                           <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                               <thead class="table-light">
                                                    <tr>
                                                   
                                                        <th class="all">Product</th>
                                                        <th>Category</th>
                                                        <th>Added Date</th>
                                                        <th>Type</th>
                                                        <th>Price</th>
                                                        <th>Quality</th>
                                        
                                                    </tr>
                                                </thead>
                                                 <tbody class="load_producust_mana">
                                             
                                             
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                </div> <!-- end col -->
      </div>


<script type="text/javascript">
    $(document).ready(function(){


     load_products_manager();
        function load_products_manager(){
             var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_products_manager_admin')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('.load_producust_mana').html(data);
      
                    }

            }); 
          }

  }); 

</script>
@endsection