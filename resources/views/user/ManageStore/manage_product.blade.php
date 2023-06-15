@extends('MangerStore_Layout')
@section('content')


      <div class="row">
       <div class="page-title-box">
        <h4 class="page-title-box">Manager Products</h4>
         </div>
         <?php
         $message = Session::get('message');
         if($message){
            ?>
        <div class="alert alert-success" role="alert"> <i class="dripicons-checkmark me-2"></i> 
        <?php  echo $message?>
        </div>
         <?php
         Session::put('message',null);
        }
        ?>
                <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="{{url('/add_product_store')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Products</a>
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
                                                     
                                                        <th style="width: 150px;">Action</th>
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
     <!-- end row -->    

<script type="text/javascript">
  $(document).ready(function(){

     $(document).on('click','.btn_enter_qty_pro',function(e){
          var id_product = $(this).data("id_product");
          var ty_pro =$(this).closest("td").find(".type_product").val()
           if(ty_pro==1){
             window.location.href = "{{url('/attributes_1_classic_pro')}}"+"/"+id_product;

          }else if(ty_pro==2){
             window.location.href = "{{url('/attributes_2_classic_pro')}}"+"/"+id_product;
          }
             
     
        });

     $(document).on('click','.btn_delete_pro',function(e){
        var id_product =$(this).closest("td").find(".id_product").val();
    
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/delete_product_store')}}',
                    method:"GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_product:id_product,_token:_token},
                    success:function(data){
                      load_products_manager();
      
                    }

            }); 
     });


      $(document).on('click','.btn_edit_pro',function(e){
          var id_product =$(this).closest("td").find(".id_product").val();
           window.location.href = "{{url('/edit_product_store')}}"+"/"+id_product;
    
     });



     load_products_manager();
        function load_products_manager(){
             var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_products_manager')}}',
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