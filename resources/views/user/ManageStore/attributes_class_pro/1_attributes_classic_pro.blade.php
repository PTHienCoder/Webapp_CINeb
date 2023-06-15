@extends('MangerStore_Layout')
@section('content')

    @foreach($load_pro as $key => $product)
                <div class="row">
                      <div class="page-title-box">
                        <h4 class="page-title">Enter Quality and price for attributes products</h4>
                      </div>

                         <div class="col-lg-5">
               
                            <!--====== End - Product Breadcrumb ======-->
                            <img class="u-img-fluid" src="{{asset('/uploadproduct/'.$product->image_product)}}" " alt="">
    
                           </div>
                         <div class="col-lg-7">
                              <h4><span class="pd-detail__name">Name Products: {{$product->name_product}}</span></h4> 
                             <!--====== Product Right Side Details ======-->
                        <div class="row">

                             <div class="mb-3">
                                 <input type="text" class="form-control title_type_pro"  value="{{$product->title_type}}" placeholder="Please Enter title type products" >
                              </div>
                             
                        	<div class="col-lg-6">

                        	   <div class="mb-3">
                               <label for="project-overview" class="form-label">Name type</label>
                               <input type="text" class="form-control name_type" placeholder="Please enter title type product" >
                              </div>
                                <div class="mb-3">
                               <label for="project-overview" class="form-label">Price product</label>
                               <input type="number" value="0" min=0 class="form-control price_type">
                              </div>
                              <div class="mb-3">
                               <label for="project-overview" class="form-label">Quality product</label>
                               <input type="number" value="0" min=0 class="form-control qty_type">
                              </div>
                            

                              <div class="mb-3 d-grid">

                             <input type="hidden" value="{{$product->id_product}}"  class="form-control id_product" >
                             <input type="hidden" value=""  class="form-control id_type_pro" >
                             
                             <button type="button" class="btn btn-info btn-sm btn_add_save_type">+ Add</button>
                              <button type="button" class="btn btn-success btn-sm btn_edit_save_type">Save</button>
                              </div>

                        		
                        	</div>
                        	<div class="col-lg-6">
                        	   <div class="mb-3">
                               <label for="project-overview" class="form-label">Image type</label>
                               <input type="file" accept="image/*" name="image_post" id="uploadImage"  onchange="PreviewImage();" class="form-control">

                              </div>
                             <div class="mb-3 ">
                               <img src="" style="height: 150px;" alt="" id="uploadPreview" class="img-fluid">
                                                 
                             </div>
                                      <script type="text/javascript">
                                              	 function PreviewImage() {
				                                    var oFReader = new FileReader();
				                                    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				                                    oFReader.onload = function (oFREvent) {
				                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
				                                    };
				                                  };
                                       </script>
                        		
                        	</div>
                        	
                        </div>
                         <div class="row">
                        	<div >
                        		  <table class="table table-centered mb-0">
                                      <thead class="table-dark">
                                                    <tr>
                                                       <th></th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Quanlity</th>              
                                                        
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="load_type_pro">
                        		             </tbody>
                                   </table>

                        	</div>

                        </div>
                       
                      

                 
                            <!--====== End - Product Right Side Details ======-->
                     
                    </div>
                      <button style="margin-top: 30px;" type="button" class="btn btn-danger save_page">Save</button>

             </div>

      @endforeach


<script type="text/javascript">
  $(document).ready(function(){
      $('.btn_edit_save_type').hide();
  	  $('.btn_add_save_type').show();


              $('.save_page').on( "click", function() {

           if($('.title_type_pro').val() == ""){

                  // alert("Pleasse enter title type pro");
                  $.NotificationApp.send("","Pleasse enter title type pro","top-right","rgba(0,0,0,0.2)","error")  

            }else{
               var title_type_pro = $('.title_type_pro').val(); 
               var id_product = $('.id_product').val(); 

                $.ajax({
                    url:'{{url('save_page_attributes_class')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_product:id_product,title_type_pro:title_type_pro},
                    success:function(data){
                  
                   window.location.href = "{{url('/manage_product')}}";     
                    }

              }); 
            }
        });


    $(document).on('click','.btn_edit_type',function(e){
	 	     $('.btn_edit_save_type').show();
	         $('.btn_add_save_type').hide();

	         $('.name_type').val($(this).closest("tr").find(".a").text());
             $('.price_type').val($(this).closest("tr").find(".b").text()); 
             $('.qty_type').val($(this).closest("tr").find(".c").text());
             

              $('.id_type_pro').val($(this).data("id_type_pro"));
             
     
        });

    	$('.btn_add_save_type').on( "click", function() {

        if($('.name_type').val() == ""){

              // alert("Pleasse enter name type");
          $.NotificationApp.send("","Pleasse enter name type","top-right","rgba(0,0,0,0.2)","error")  


        }else if($('.qty_type').val() == 0 || $('.price_type').val() == 0){
             // alert("Pleasse enter quality and price type");
              $.NotificationApp.send("","Pleasse enter quality and price type","top-right","rgba(0,0,0,0.2)","error")  

        }else{
           save_type_products_classic();
        }
     
       });


  	     function save_type_products_classic(){
                var name_type = $('.name_type').val(); 
                var qty_type = $('.qty_type').val();
                var price_type = $('.price_type').val();

           
                var id_product = $('.id_product').val(); 



                var form_data = new FormData();
                form_data.append("name_type",name_type);
                form_data.append("qty_type",qty_type);
                form_data.append("price_type",price_type);

                form_data.append("file", document.getElementById("uploadImage").files[0]);
                form_data.append("id_product",id_product);
              
       
                
                $.ajax({
                    url:"{{url('/save_type_products_classic')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                       $('.name_type').val('');
                       $('#uploadImage').val('');
                       $('#uploadPreview').attr('src', "");
                       load_type_products_classic();
                         $.NotificationApp.send("","add type product success","top-right","rgba(0,0,0,0.2)","success")
                    }
              });
       
    
     }


         load_type_products_classic();
         function load_type_products_classic(){
         	   var id_product = $('.id_product').val(); 
                $.ajax({
                    url:'{{url('/load_type_products_classic')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_product:id_product},
                    success:function(data){

                        $('.load_type_pro').html(data);
                      
                              
                    }

              }); 
        }


     $(document).on('click', '.btn_edit_save_type', function() {
               var name_type = $('.name_type').val(); 
                var qty_type = $('.qty_type').val();
                var price_type = $('.price_type').val();

           
                var id_type_pro = $('.id_type_pro').val();

                var id_product = $('.id_product').val(); 

                var form_data = new FormData();
                form_data.append("name_type",name_type);
                form_data.append("qty_type",qty_type);
                form_data.append("price_type",price_type);

                form_data.append("file", document.getElementById("uploadImage").files[0]);
                form_data.append("id_type_pro",id_type_pro);
                form_data.append("id_product",id_product);
              
       
                 if($('.name_type').val() == ""){

		              // alert("Pleasse enter name type");
                       $.NotificationApp.send("","Pleasse enter name type","top-right","rgba(0,0,0,0.2)","error")

		        }else if($('.qty_type').val() == 0 || $('.price_type').val() == 0){
		            // alert("Pleasse enter quality and price type");
                     $.NotificationApp.send("","Pleasse enter quality and price type","top-right","rgba(0,0,0,0.2)","error") 


		        }else{
		    
       
                $.ajax({
                    url:"{{url('/edit_type_products_classic')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                       $('.name_type').val('');
                       $('#uploadImage').val('');
                       $('#uploadPreview').attr('src', "");
                       $('.btn_edit_save_type').hide();
  	                   $('.btn_add_save_type').show();
                       load_type_products_classic();
                     $.NotificationApp.send("","update type product success","top-right","rgba(0,0,0,0.2)","success")
                    }
              });
          }
     
       });




       $(document).on('click', '.btn_delete_type', function() {
         var id_type_pro = $(this).data("id_type_pro");
                $.ajax({
                    url:'{{url('/delete_type_products_classic')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_type_pro:id_type_pro},
                    success:function(data){
                     load_type_products_classic();
                     $.NotificationApp.send("","remove type product success","top-right","rgba(0,0,0,0.2)","success")
                      
           
                    }

              }); 
     
       });


 });
</script>





 @endsection