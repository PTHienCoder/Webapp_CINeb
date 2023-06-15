@extends('User_layout')
@section('content')


<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="card">
			
			<ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                   <li class="nav-item">
                    <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                        <span class="d-none d-md-block">Add project</span>
                    </a>
                </li>

			    <li class="nav-item">
			        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
			            <i class="mdi mdi-home-variant d-md-none d-block"></i>
			            <span class="d-none d-md-block">Add video </span>
			        </a>
			    </li>
			 
			   
			</ul>

			<div class="tab-content">
			   
			    <div class="tab-pane show active" id="profile-b2">
			            <div class="card-body">

                          
                     {{--            <form action="{{url('/savepost ')}}" method="post" enctype='multipart/form-data'>
                                            @csrf --}}
                          
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="projectname" class="form-label">Title</label>
                                                    <input  type="text" name="title" id="projectname" class="form-control title_post" placeholder="Enter project name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="project-overview" class="form-label">Overview</label>
                                                    <textarea class="form-control overview_post" name="mota" id="project-overview" rows="4" placeholder="Enter some brief about project.."></textarea>
                                                </div>

                                             
                                              


                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                <div class="mb-3 mt-3 mt-xl-0">
                                                   <label for="project-budget"class="form-label">field</label>
                                                    <!-- Single Select -->
                                                     <select  name="linhvuc" class="form-select mb-3 field_post">
                                                        @foreach($load_field as $key => $load_field)
                                                           <option value="{{$load_field->id_field}}">                  
                                                             {{$load_field->name_field}}
                                                         </option>

                                                         @endforeach
                                                         
                                                        </select>

                                               
                                                </div>

                                                <div class="row">
                
                                               
                                                    <div class="col-xl-10">
                                                        <label for="projectname" class="form-label">Hasgtag Post</label>
                                                        <div class="mb-3">  
                                                            <input type="hidden" class="form-control Input_Hastag_product">
                                                            <input type="text" class="form-control Hastag_product" name="Hastag_product" placeholder="# Enter Hastag product">
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-2">
                                                        <label for="projectname" class="form-label">.</label>
                                                        <div class="mb-3">
                                                             <button type="button" class="btn btn-primary btn-md btn_add_hastag">+</button>
                                                        </div>
                                                    </div>

                                                      <div class="mb-3">
                                                          <h3><span class="badge badge-outline-warning sp_hastag"></span>
                                                          <button type="button" class="btn btn-danger btn-sm btn_delete_hastag">X</button></h3>
                                                     </div>
                                                  
                                                <!-- end row -->
                                               </div>

                                            </div> <!-- end col-->
                                        </div>
                           
                                              <div class="row">
                                                 <div class="col-sm-3"></div>
                                                  <div class="col-sm-6">     
                                                   <label for="example-fileinput" class="form-label">Image post</label>
                                                      <span class="text-muted">
                                                        (size image 850 x 800 )
                                                    </span>
                                                   
                                                   <input  type="file" accept="image/*" name="image_post" id="uploadImage"  onchange="PreviewImage();" class="form-control">
                                                   </div>
                                                 </div>
                                               <div class="row" style="margin-top: 10px;">
                                                <div class="col-sm-3"></div>       
                                                 <div class="col-sm-6">
                                                     <div class="card rowsss" id="asdjsahd">                                               
                                                      <img src="" alt="" id="uploadPreview" class="img-fluid">
                                                     </div>
                                                 </div>
                                                 <div class="col-sm-3"></div>  

                                          
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
                                        <!-- end row -->
                                         

                                           <div class="row">

                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Detail project</label>
                                                     <textarea style="resize: none" rows="8" class="form-control" name="chitiet"  id="ckeditor000" placeholder="Nội dung sản phẩm"></textarea>
                                               
                                                        
                                                </div>

                                                      
                                         

                                         <button type="button" class="btn btn-primary btn-lg btn_add_save_post">Post</button>

                                        
                                       </div>
                              {{-- </form> --}}
                           </div>

			          </div>



                       <div class="tab-pane " id="home-b2">
                                   <div class="row">
                                            <div class="col-xl-12" style="padding: 20px;">
                                                <div class="mb-3 mt-3 mt-xl-0">
                                                    <label for="projectname" class="mb-0">Video</label>
                                                    <p class="text-muted font-14">video size does not exceed 25MB.</p>

                                                    <form action="/" method="post" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                                        

                                                        <div class="dz-message needsclick">
                                                            <i class="h3 text-muted dripicons-cloud-upload"></i>
                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>
                                                    </form>

                                                    <!-- Preview -->
                                                    <div class="dropzone-previews mt-3" id="file-previews"></div>

                                                    <!-- file preview template -->
                                                    <div class="d-none" id="uploadPreviewTemplate">
                                                        <div class="card mt-1 mb-0 shadow-none border">
                                                            <div class="p-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <img data-dz-thumbnail="" src="#" class="avatar-sm rounded bg-light" alt="">
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name=""></a>
                                                                        <p class="mb-0" data-dz-size=""></p>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <!-- Button -->
                                                                        <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                                                            <i class="dripicons-cross"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end file preview template -->
                                                </div>

                                                <!-- Date View -->
                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Title video</label>
                                                    <input type="text" class="form-control" placeholder="Enter the title of the video.">
                                                </div>
                                            </div> <!-- end col-->
                         </div>

                   

                </div>
			    
			</div>


		</div>


	</div>

</div>

<script type="text/javascript">


     $('.btn_add_save_post').on( "click", function() {


        var image =  document.getElementById("uploadImage").files[0];
        // var optionSelected = $('.field_post').val();
        if($('.title_post').val() == ""){

         $.NotificationApp.send("","Pleasse enter title post","top-right","rgba(0,0,0,0.2)","error")


        }else if(image == null){

              $.NotificationApp.send("","Pleasse choose image product","top-right","rgba(0,0,0,0.2)","error")


        }else if($('.overview_post').val() == ""){

              $.NotificationApp.send("","Pleasse enter overview post","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.Input_Hastag_product').val() == ""){

              $.NotificationApp.send("","Pleasse enter hastag","top-right","rgba(0,0,0,0.2)","error") 

        }else{
          save_post();
        }
     
       });


       function save_post(){

                var title_post = $('.title_post').val(); 
                var field_post = $('.field_post').val();
                var overview_post = $('.overview_post').val();

                var Input_Hastag_post = $('.Input_Hastag_product').val();
                var details_post = CKEDITOR.instances.ckeditor000.getData();


                var form_data = new FormData();
                form_data.append("title_post",title_post);
                form_data.append("field_post",field_post);
                form_data.append("overview_post",overview_post);

                form_data.append("file", document.getElementById("uploadImage").files[0]);

                form_data.append("Input_Hastag_post",Input_Hastag_post);
                form_data.append("details_post",details_post);

                Swal.fire({
                  icon: 'warning',
                  title: 'Do you want to add related products ?',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: 'Yes, I want',
                  denyButtonText: `No, for later`,
                   showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                   
                        $.ajax({
                        url:"{{url('/savepost')}}",
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
                            Swal.fire({
                                  icon: 'success',
                                  title: "<h3 style='color:#00FF00'>Post success !</h3>",
                                  width: 300,
                                  showConfirmButton: false,
                                  timer: 700
                                });
                            window.location.href ="{{url('/add_product_for_post')}}"+"/"+data.id_post;
                        }
                       });
                  } else if (result.isDenied) {

                        $.ajax({
                        url:"{{url('/savepost')}}",
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

                             Swal.fire({
                                  icon: 'success',
                                  title: "<h3 style='color:#00FF00'>Post success !</h3>",
                                  width: 300,
                                  showConfirmButton: false,
                                  timer: 700
                                });
                            window.location.href ="{{url('/')}}";
                        }
                       });

                        
                  }
                })
    
       
    
     }

    

    $('.btn_add_hastag').on('click', function (e) {
         var abc = $('.Hastag_product').val();
        if(abc == ""){
        alert("Pleasse enter hastag");
        }else{
           $('.sp_hastag').append("#"+$('.Hastag_product').val());
           $('.Hastag_product').val(""); 
           $('.Input_Hastag_product').val($('.sp_hastag').text()); 
           

        }
        
   });

    $('.btn_delete_hastag').on('click', function (e) {
         var abc = $('.sp_hastag').text();
        if(abc == ""){
        alert("Pleasse enter hastag");
        }else{
           $('.sp_hastag').text(""); 
           $('.Input_Hastag_product').val($('.sp_hastag').text()); 
        }
        
   });
</script>
     <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">

        CKEDITOR.replace('ckeditor000',{


        filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
        // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form',


        });

       </script>


@endsection