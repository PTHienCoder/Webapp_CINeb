@extends('MangerStore_Layout')
@section('content')

<div class="row">
	 <div class="page-title-box">
        <h4 class="page-title">Add Products</h4>
      </div>
	<div class="col-sm-12">
		<div class="card">

			<div class="tab-content">
			            <div class="card-body">

                             {{--    <form action="{{url('/save_product_store ')}}" method="post" enctype='multipart/form-data'>
                                         @csrf --}}
                          
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="projectname" class="form-label">Name product</label>
                                                    <input required type="text" name="name_product"  class="form-control name_product" placeholder="Enter project name">
                                                </div>

                                                  <div class="mb-3 mt-3 mt-xl-0">
                                                   <label for="project-budget"class="form-label">Category</label>
                                                    <!-- Single Select -->
                                                     <select  name="cate_product" class="form-select mb-3 cate_product">
                                                        @foreach($load_cate as $key => $load_cate)
                                                           <option value="{{$load_cate->id_cate_product }}">                  
                                                             {{$load_cate->name_cate_product}}
                                                         </option>

                                                         @endforeach
                                                         
                                                        </select>

                                               
                                                </div>

                                                <div class="mb-3 mt-3 mt-xl-0">
                                                   <label for="project-budget"class="form-label">product classification</label>
                                                    <!-- Single Select -->
                                                     <select name="choose_attributexx" class="form-select mb-3 choose_attribute">
                                                           <option value="3" selected> -- Choose attribute product --</option>
                                                           <option value="0"> No attribute  </option>
                                                           <option value="1"> 1 attribute  </option>
                                                           <option value="2"> 2 attribute  </option>
                                                         
                                                        </select>

                                               
                                                </div>
                                                

                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                  
                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Image products</label>
                                                      <span class="text-muted">
                                                        (size image 200 x 300 )
                                                    </span>
                                                   
                                                   <input type="file" accept="image/*" name="image_post" id="uploadImage"  onchange="PreviewImage();" class="form-control">

                                                 
                                                </div>
                                                <div class="mb-3">
                                                     <img src="" style="height: 150px;" alt="" id="uploadPreview" class="img-fluid">
                                                 
                                                </div>


                                            </div> <!-- end col-->
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

                                      <div class="row" id="div_no_attribute">
                                            <div class="col-xl-6">
                                                 <div class="mb-3">
                                                        <label for="project-overview" class="form-label">Quality product</label>
                                                        <input type="number" value="0" class="form-control quality_product" name="quality_product" >
                                                    </div>
                                            </div>
                                            <div class="col-xl-6">
                                                   <div class="mb-3">
                                                        <label for="project-overview" class="form-label">Price product</label>
                                                        <input type="number" value="0" class="form-control price_product" name="price_product" >
                                                    </div>
                                            </div>
                                       </div>
                                       <div class="row">
                                          <h3><span class="badge badge-outline-warning sp_hastag"></span>
                                           <button type="button" class="btn btn-danger btn-sm btn_delete_hastag">X</button></h3>
                                            <div class="col-xl-4">
                                                <div class="mb-3">  
                                                    <input type="hidden" class="form-control Input_Hastag_product">
                                                    <input type="text" class="form-control Hastag_product" name="Hastag_product" placeholder="# Enter Hastag product">
                                                </div>
                                            </div>
                                             <div class="col-xl-3">
                                                <div class="mb-3">
                                                     <button type="button" class="btn btn-primary btn-md btn_add_hastag">+</button>
                                                </div>
                                            </div>
                                       </div>



                                           <div class="row">

                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Decs Products</label>

                                                     <textarea style="resize: none" rows="8" class="form-control desc_product" name="desc_product"  
                                                     id="ckeditor111" placeholder="Nội dung sản phẩm"></textarea>
                                        
                                                    
                                                </div>

                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Detail Products</label>

                                                     <textarea style="resize: none" rows="8" class="form-control details_product" name="details_product" 
                                                     id="ckeditor2222" placeholder="Nội dung sản phẩm"></textarea>
                                                          
                                                </div>
   

                                         <button type="button" class="btn btn-primary btn-lg btn_add_save_pro">Add</button>

                                       </div>
                              {{-- </form> --}}
                           </div>
			    
			</div>
          


		</div>


	</div>

</div>

<script type="text/javascript">
  $(document).ready(function(){



 });
</script>

<script type="text/javascript">
  $(document).ready(function(){
   $('#div_no_attribute').hide();

   $('.choose_attribute').on('change', function (e) {
    var optionSelected = $('.choose_attribute').val();
    if(optionSelected ==0){
        $('#div_no_attribute').show()
    }else{
         $('#div_no_attribute').hide()
    }
 
   });




   
        $('.btn_add_save_pro').on( "click", function() {


        var image =  document.getElementById("uploadImage").files[0];
        var optionSelected = $('.choose_attribute').val();
        if($('.name_product').val() == ""){

              // alert("Pleasse enter name product");
         $.NotificationApp.send("","Pleasse enter name product","top-right","rgba(0,0,0,0.2)","error")


        }else if(image == null){
              // alert("Pleasse choose image product");
              $.NotificationApp.send("","Pleasse choose image product","top-right","rgba(0,0,0,0.2)","error")

        }else if(optionSelected == 0){
            if($('.price_product').val() == 0 || $('.quality_product').val() == 0){
               // alert("Please enter Price and Quality");
               $.NotificationApp.send("","Please enter Price and Quality","top-right","rgba(0,0,0,0.2)","error")
            }else{
              save_product();
            }

        }else if(optionSelected == 3){

              $.NotificationApp.send("","Pleasse choose attribute","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.Input_Hastag_product').val() == ""){
            
              $.NotificationApp.send("","Pleasse enter hastag","top-right","rgba(0,0,0,0.2)","error") 

        }else{
           save_product();
        }
     
       });

         function save_product(){
                var name_product = $('.name_product').val(); 
                var cate_product = $('.cate_product').val();
                var choose_attribute = $('.choose_attribute').val();

           
                var quality_product = $('.quality_product').val(); 
                var price_product = $('.price_product').val(); 
                var Input_Hastag_product = $('.Input_Hastag_product').val();

                var desc_product = CKEDITOR.instances.ckeditor111.getData();
                var details_product = CKEDITOR.instances.ckeditor2222.getData();


                var form_data = new FormData();
                form_data.append("name_product",name_product);
                form_data.append("cate_product",cate_product);
                form_data.append("choose_attribute",choose_attribute);

                form_data.append("file", document.getElementById("uploadImage").files[0]);
                form_data.append("quality_product",quality_product);
                form_data.append("price_product",price_product);
                form_data.append("Input_Hastag_product",Input_Hastag_product);
                
                form_data.append("desc_product",desc_product);
                form_data.append("details_product",details_product);

       
                
                $.ajax({
                    url:"{{url('/save_product_store')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:"JSON",
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                        // alert(data.id_product)
                        if(choose_attribute == 0){
                            window.location.href = "{{url('/manage_product')}}";

                        }else if(choose_attribute == 1){
                            window.location.href = "{{url('/attributes_1_classic_pro')}}"+"/"+data.id_product;

                        }else if(choose_attribute == 2){
                            window.location.href = "{{url('/attributes_2_classic_pro')}}"+"/"+data.id_product;

                        }
                    
                    }
              });
       
    
     }



    $('.btn_add_hastag').on('click', function (e) {
         var abc = $('.Hastag_product').val();
        if(abc == ""){
        // alert("Pleasse enter hastag");
         $.NotificationApp.send("","Pleasse enter hastag","top-right","rgba(0,0,0,0.2)","error") 
        }else{
           $('.sp_hastag').append("#"+$('.Hastag_product').val());
           $('.Hastag_product').val(""); 
           $('.Input_Hastag_product').val($('.sp_hastag').text()); 
           

        }
        
   });

    $('.btn_delete_hastag').on('click', function (e) {
         var abc = $('.sp_hastag').text();
        if(abc == ""){
       $.NotificationApp.send("","Pleasse enter hastag","top-right","rgba(0,0,0,0.2)","error") 
        }else{
           $('.sp_hastag').text(""); 
           $('.Input_Hastag_product').val($('.sp_hastag').text()); 
        }
        
   });
    

 });
</script>

        <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript">

        CKEDITOR.replace('ckeditor2222',{


        filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
        // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form',


        });

        CKEDITOR.replace('ckeditor111',{

        filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
        // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form',


        });
       </script>


@endsection