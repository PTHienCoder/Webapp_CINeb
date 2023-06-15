@extends('User_layout')
@section('content')

@foreach($load_post as $key => $load_post)

 <input  type="hidden" value="{{$load_post->id_post}}" class="form-control id_post" >
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
                                                    <input  type="text" name="title" id="projectname" value="{{$load_post->title_post}}" class="form-control title_post" placeholder="Enter project name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="project-overview" class="form-label">Overview</label>
                                                    <textarea class="form-control overview_post" name="mota" id="project-overview" value="" rows="4" placeholder="Enter some brief about project..">{{$load_post->desc_post}}</textarea>
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
                                                            <input type="hidden" value="{{$load_post->hastag_post}}" class="form-control Input_Hastag_product">
                                                            <input type="text" value="{{$load_post->hastag_post}}" class="form-control Hastag_product" name="Hastag_product" placeholder="# Enter Hastag product">
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-2">
                                                        <label for="projectname" class="form-label">.</label>
                                                        <div class="mb-3">
                                                             <button type="button" class="btn btn-primary btn-md btn_add_hastag">+</button>
                                                        </div>
                                                    </div>

                                                      <div class="mb-3">
                                                          <h3><span class="badge badge-outline-warning sp_hastag">{{$load_post->hastag_post}}</span>
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
                                                      <img src="{{asset('/uploadproject/'.$load_post->image_post)}}" alt="" id="uploadPreview" class="" >                                            
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
                                                     <textarea style="resize: none" rows="8" value="" class="form-control" name="chitiet"  id="ckeditor000" placeholder="Nội dung sản phẩm">{{$load_post->detail_post}}</textarea>
                                               
                                                        
                                                </div>

                                                      
                                         

                                         <button type="button" class="btn btn-primary btn-lg btn_add_save_post">Save Update</button>

                                        
                                       </div>
                              {{-- </form> --}}
                           </div>

                      </div>



                
            </div>


        </div>


    </div>

</div>
@endforeach
<script type="text/javascript">


     $('.btn_add_save_post').on( "click", function() {


        var image =  document.getElementById("uploadImage").files[0];
        // var optionSelected = $('.field_post').val();
        if($('.title_post').val() == ""){

         $.NotificationApp.send("","Pleasse enter title post","top-right","rgba(0,0,0,0.2)","error")


        }else if($('.overview_post').val() == ""){

              $.NotificationApp.send("","Pleasse enter overview post","top-right","rgba(0,0,0,0.2)","error") 

        }else if($('.Input_Hastag_product').val() == ""){

              $.NotificationApp.send("","Pleasse enter hastag","top-right","rgba(0,0,0,0.2)","error") 

        }else{
          save_post();
        }
     
       });


       function save_post(){
                var id_post = $('.id_post').val(); 
                var title_post = $('.title_post').val(); 
                var field_post = $('.field_post').val();
                var overview_post = $('.overview_post').val();

                var Input_Hastag_post = $('.Input_Hastag_product').val();
                var details_post = CKEDITOR.instances.ckeditor000.getData();


                var form_data = new FormData();
                 form_data.append("id_post",id_post);
                form_data.append("title_post",title_post);
                form_data.append("field_post",field_post);
                form_data.append("overview_post",overview_post);

                form_data.append("file", document.getElementById("uploadImage").files[0]);

                form_data.append("Input_Hastag_post",Input_Hastag_post);
                form_data.append("details_post",details_post);
                 $.ajax({
                        url:"{{url('/Save_edit')}}",
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
                                  title: "<h3 style='color:#00FF00'>Upadate success !</h3>",
                                  width: 300,
                                  showConfirmButton: false,
                                  timer: 700
                                });
                            window.location.href ="{{url('/user_detail_post')}}"+"/"+data.id_post;
                        }
                       });
    
       
    
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