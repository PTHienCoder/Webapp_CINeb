@extends('MangerStore_Layout')
@section('content')
<div class="card">
	  <div class="card-body">

			 	<button type="button" data-bs-toggle="modal" data-bs-target="#fill-info-modal"
					  	 class="btn btn-outline-info"><i class="uil-focus-add"></i> Add category</button>

                 <div id="load_category_product">
               
                      	

                 </div> 

		</div>
	
</div>



{{-- model add areas --}}
<div class="modal fade" id="fill-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add category</h4>
                <button type="button" id="btn-closess" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
             <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                   <ul class="list-group list-group-flush">

                      <li class="list-group-item" >            
                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name category:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_category_product" id="name_category_product"
                                    placeholder="Enter your name field...">
                                    </div>
                              </div>


                                 <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">category describe</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_category_product" id="desc_category_product"
                                    placeholder="Enter describe your category..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                   <button type="button" class="btn btn-outline-info add_category_product">add</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

                    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- model add areas --}}
<div class="modal fade" id="update_category_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Update category</h4>
                <button type="button" id="btn-closes55" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
             <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >            
                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name category:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_category_product" id="name_category_product1"
                                    placeholder="Enter your name category...">
                                    </div>
                              </div>


                                 <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">category describe</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_category_product" id="desc_category_product1"
                                    placeholder="Enter describe your category..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                    <input type="hidden" class="id_cate_product"  name="name" id="id_cate_product1">
                                   <button type="button" class="btn btn-outline-info save_update_category_product">Update</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

                    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
      load_category_product();
          $('.add_category_product').click(function(){
                var name_category_product = $('.name_category_product').val();
                var desc_category_product = $('.desc_category_product').val();
           
                // var myPhoto_store_rq = $('.myPhoto_store_rq').val();
                // var _token = $('input[name="_token"]').val();

                var form_data = new FormData();

                form_data.append("name_category_product",name_category_product);
                form_data.append("desc_category_product",desc_category_product);

              if(name_category_product == "" || desc_category_product == "" ){

                    alert("Please enter full information");
              }else{
     
                
                $.ajax({
                    url:"{{url('/add_category_product')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_category_product").value ="";
                     document.getElementById("desc_category_product").value ="";
         
                     document.getElementById("btn-closess").click();
                      $.NotificationApp.send("","add category product success","top-right","rgba(0,0,0,0.2)","success")
              
                     // alert("add success !");
                     load_category_product();
                    }
              });
       
              }
           
        });


         function load_category_product(){
                $.ajax({
                    url:'{{url('/load_category_product')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){

                        $('#load_category_product').html(data);
                        // document.getElementById("hreapsds").href = "{{URL::to('/StoreManager')}}";
                              
                    }

                }); 
        }

           function view_category_product(id){

            var id_cate_product = id;
            var _token = $('input[name="_token"]').val();
           $.ajax({
                url:"{{url('view_category_product')}}",
                method:"GET",
                dataType:"JSON",
                 headers:{
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data:{id_cate_product:id_cate_product, _token:_token},
                  success:function(data){

                    $('#name_category_product1').val(data.name_cate_product);
                    $('#desc_category_product1').val(data.desc_cate_product);
                    $('#id_cate_product1').val(data.id_cate_product);
              

                  }
                });
            }

        $('.save_update_category_product').click(function(){
                var id_cate_product = $('.id_cate_product').val(); 
                var name_category_product = $('#name_category_product1').val();
                var desc_category_product = $('#desc_category_product1').val();
           
                // var myPhoto_store_rq = $('.myPhoto_store_rq').val();
                // var _token = $('input[name="_token"]').val();

                var form_data = new FormData();
                form_data.append("id_cate_product",id_cate_product);
                form_data.append("name_category_product",name_category_product);
                form_data.append("desc_category_product",desc_category_product);

              if(name_category_product == "" || desc_category_product == "" ){

                    alert("Please enter full information");
              }else{
     
                
                $.ajax({
                    url:"{{url('/save_update_category_product')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_category_product").value ="";
                     document.getElementById("desc_category_product").value ="";
         
                     document.getElementById("btn-closes55").click();
                      $.NotificationApp.send("","update category product success","top-right","rgba(0,0,0,0.2)","success")
         
                     // alert("add success !");
                     load_category_product();
                    }
              });
       
              }
        });

        $(document).on('click','.btn_delete_cate',function(){
            var id_cate = $(this).data('id_cate');
            if(confirm('Bạn muốn xóa không?')){
                $.ajax({
                    url:"{{url('/delete_cate_product')}}",
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_cate:id_cate},
                    success:function(data){
                       load_category_product();
                        // $('#noty1').html('<span class="text text-success">delete success</span>');
                        $.NotificationApp.send("","Remove category product success","top-right","rgba(0,0,0,0.2)","success")
                    
                    }
                });
            }


        });




</script>





@endsection