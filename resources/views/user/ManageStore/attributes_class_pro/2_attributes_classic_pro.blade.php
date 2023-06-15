@extends('MangerStore_Layout')
@section('content')

    @foreach($load_pro as $key => $product)
                <div class="row">
                      <div class="page-title-box">
                        <h4 class="page-title">Enter Quality and price for attributes products</h4>
                      </div>
                          <div class="col-lg-5">
                                 <div class="row">
                   
                                <!--====== End - Product Breadcrumb ======-->
                                <img class="u-img-fluid" src="{{asset('/uploadproduct/'.$product->image_product)}}" " alt="">
                                  </div>
                                   <div class="row" style="margin-top: 20px;">
                                         <div class="mb-3">
                                 
                                       <input type="text" class="form-control title_type_pro"  value="{{$product->title_type}}" placeholder="Please Enter title type products" >
                                      </div>
                                      <table class="table table-centered mb-0">
                                                      <thead class="table-dark">
                                                                    <tr>
                                                                       <th></th>
                                                                        <th>Name</th>
                                                                 
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="load_type_pro">
                                                             </tbody>
                                                   </table>
                                    
                                </div>
    
                           </div>
                         <div class="col-lg-7">
   
                         <div class="row">

                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">   
                                    <h4><span class="pd-detail__name">Name Products: {{$product->name_product}}</span></h4> 
                                    <br>
                                     
                                   <label for="project-budget"class="form-label">Select type to enter price and quantity</label>
                                   <div class="row">
                                     <div class="col-lg-9">
                                                      <select name="choose_attributexx" class="form-select mb-3 choose_attributecsx">
                                                      
                                                      </select>
                                       </div>
                                       <div class="col-lg-3">
                                            <div class="mb-3">
                                            <button class="btn btn-primary btn-md" type="button" data-bs-toggle="modal" data-bs-target="#add_type_product">+ Add</button>
                                           </div>
                                       
                                   </div>
                                                    <!-- Single Select -->
                                                       
                                  <hr>
                                  <div class="load_div_price_qty">
                                  <div class="mb-3">
                                   <label for="project-overview" class="form-label">Name Size</label>
                                   <input type="text"  class="form-control name_size" placeholder="Please Enter name size products" >
                                  </div>
                            
                                  <div class="mb-3">
                                   <label for="project-overview" class="form-label">Price Size</label>
                                   <input type="number" min=0 value="0" class="form-control price_size">
                                  </div>
                                        <div class="mb-3">
                                   <label for="project-overview" class="form-label">Quality Size</label>
                                   <input type="number" min=0 value="0" class="form-control qty_size" >
                                  </div>
                                
                                  <div class="mb-3 d-grid">
                                  <input type="hidden" value="{{$product->id_product}}"  class="form-control id_product" >
                                  <input type="hidden" value=""  class="form-control id_size_pro" >
                                  <button type="button" class="btn btn-info btn-sm btn_add_save_size">+ Add</button>
                                  <button type="button" class="btn btn-success btn-sm btn_edit_save_size">Save</button>
                                  </div> 
                            

                                     <table class="table table-centered mb-0">
                                          <thead class="table-dark">
                                                        <tr>
                                                     
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Quanlity</th>  
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="load_size_pro">
                                                 </tbody>
                                       </table>

                                        </div>
                                    </div>
                      

                 
                            <!--====== End - Product Right Side Details ======-->
                        </div>
                

                     </div>

    </div>
         <button type="button" class="btn btn-danger save_page">Save</button>
 </div>
      @endforeach




 <script type="text/javascript">
  $(document).ready(function(){
      $('.btn_edit_save_size').hide();
      $('.btn_add_save_size').show();

      $('.load_div_price_qty').hide();


    $(document).on('change','.choose_attributecsx',function(e){
      if($('.choose_attributecsx').val() == 0){
         $('.load_div_price_qty').hide();
      }else{
         $('.load_div_price_qty').show();
         load_size_products_classic();
      }

    });

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





 

        $('.btn_add_save_type').on( "click", function() {

        if($('.name_type').val() == ""){

              // alert("Pleasse enter name type");
            $.NotificationApp.send("","Pleasse enter name type","top-right","rgba(0,0,0,0.2)","error") 


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
                form_data.append("file", document.getElementById("uploadImage").files[0]);
                form_data.append("id_product",id_product);
              
       
                
                $.ajax({
                    url:"{{url('/save_type_products_2_classic')}}",
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
                        load_option_type();
                        $('#btn-closes55').click();
                         $.NotificationApp.send("","add type product success","top-right","rgba(0,0,0,0.2)","success")
                    }
              });
       
    
     }


         load_type_products_classic();
         function load_type_products_classic(){
               var id_product = $('.id_product').val(); 

                $.ajax({
                    url:'{{url('/load_type_products_2_classic')}}',
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
             load_option_type();
         function load_option_type(){
               var id_product = $('.id_product').val(); 
                $.ajax({
                    url:'{{url('/load_option_type')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_product:id_product},
                    success:function(data){

                        $('.choose_attributecsx').html(data);
                      
                              
                    }

              }); 
        }

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
                      load_option_type();
                     $('.load_div_price_qty').hide();
                     $.NotificationApp.send("","remove type product success","top-right","rgba(0,0,0,0.2)","success")
                      
           
                    }

              }); 
     
       });





       //////////////////////// size ////////////////////////

        $(document).on('click','.btn_edit_size',function(e){
                 $('.btn_edit_save_size').show();
                 $('.btn_add_save_size').hide();

             $('.name_size').val($(this).closest("tr").find(".a").text()); 
             $('.price_size').val($(this).closest("tr").find(".b").text());
             $('.qty_size').val($(this).closest("tr").find(".c").text());
           

              $('.id_size_pro').val($(this).data("id_size_pro"));
             
     
        });

        $('.btn_add_save_size').on( "click", function() {

        if($('.name_size').val() == ""){

              // alert("Pleasse enter name type");
               $.NotificationApp.send("","Pleasse enter name type","top-right","rgba(0,0,0,0.2)","error")


        }else if($('.qty_size').val() == 0 || $('.price_size').val() == 0){

              // alert("Pleasse enter quality and price type");
              $.NotificationApp.send("","Pleasse enter quality and price type","top-right","rgba(0,0,0,0.2)","error")

        }else{
              save_size_products_classic();
        }
     
       });


         function save_size_products_classic(){
              var name_size = $('.name_size').val(); 
                var qty_size = $('.qty_size').val();
                var price_size = $('.price_size').val();


                var id_product = $('.id_product').val(); 
                var id_type_pro = $('.choose_attributecsx').val(); 

                var form_data = new FormData();
                form_data.append("name_size",name_size);
                form_data.append("qty_size",qty_size);
                form_data.append("price_size",price_size);

                form_data.append("id_product",id_product);
                form_data.append("id_type_pro",id_type_pro);
              
       
                
                $.ajax({
                    url:"{{url('/save_size_products_classic')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                      
                       if(data == 0){

                       $.NotificationApp.send("","This size name already exists","top-right","rgba(0,0,0,0.2)","error")

                       }else if(data == 1){
                         $('.name_size').val('');
                       $('#uploadImage').val('');
                       $('#uploadPreview').attr('src', "");
                        load_size_products_classic();
                         $.NotificationApp.send("","add size product success","top-right","rgba(0,0,0,0.2)","success")

                       }
                    
                    }
              });
       
    
     }


         load_size_products_classic();
         function load_size_products_classic(){
              var id_type_pro = $('.choose_attributecsx').val(); 
                $.ajax({
                    url:'{{url('/load_size_products_classic')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_type_pro:id_type_pro},
                    success:function(data){

                        $('.load_size_pro').html(data);
                      
                              
                    }

              }); 
        }


     $(document).on('click', '.btn_edit_save_size', function() {
               var name_size = $('.name_size').val(); 
                var qty_size = $('.qty_size').val();
                var price_size = $('.price_size').val();

           
                var id_size_pro = $('.id_size_pro').val();
                var id_product = $('.id_product').val(); 
                var id_type_pro = $('.choose_attributecsx').val(); 

                var form_data = new FormData();
                form_data.append("name_size",name_size);
                form_data.append("qty_size",qty_size);
                form_data.append("price_size",price_size);

                form_data.append("file", document.getElementById("uploadImage").files[0]);
                form_data.append("id_size_pro",id_size_pro);
                form_data.append("id_product",id_product);
                form_data.append("id_type_pro",id_type_pro);
              
       
                 if($('.name_size').val() == ""){

                      // alert("Pleasse enter name type"); 
                      $.NotificationApp.send("","Pleasse enter name type","top-right","rgba(0,0,0,0.2)","error")

                }else if($('.qty_size').val() == 0 || $('.price_size').val() == 0){
                    // alert("Pleasse enter quality and price type");
                     $.NotificationApp.send("","Pleasse enter quality and price type","top-right","rgba(0,0,0,0.2)","error")

                }else{
            
       
                $.ajax({
                    url:"{{url('/edit_size_products_classic')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){

                         if(data == 0){

                       $.NotificationApp.send("","This size name already exists","top-right","rgba(0,0,0,0.2)","error")

                       }else if(data == 1){
                       $('.name_size').val('');
                       $('#uploadImage').val('');
                       $('.btn_edit_save_size').hide();
                       $('.btn_add_save_size').show();
                       load_size_products_classic();

                    
                       $.NotificationApp.send("","update size product success","top-right","rgba(0,0,0,0.2)","success")

                       }
                     
                    }
              });
          }
     
       });



          $(document).on('click', '.btn_delete_size', function() {
           var id_size_pro = $(this).data("id_size_pro");
                $.ajax({
                    url:'{{url('/delete_size_products_classic')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_size_pro:id_size_pro},
                    success:function(data){
                     load_size_products_classic();
                     $.NotificationApp.send("","remove size product success","top-right","rgba(0,0,0,0.2)","success")
                      
           
                    }

              }); 
     
       });



 });
</script>

{{-- model add areas --}}
<div class="modal fade" id="add_type_product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add Type Product</h4>
                <button type="button" id="btn-closes55" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
             <div class="modal-body">
            <form>
                 @csrf
                <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="mb-3">
                               <label for="project-overview" class="form-label">Title type</label>
                               <input type="text" class="form-control name_type" placeholder="Please enter title type product" >
                              </div>
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
                                
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                   <button type="button" class="btn btn-outline-info  btn_add_save_type">Add</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

                    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

     

 @endsection