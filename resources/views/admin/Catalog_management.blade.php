@extends('Admin_layout')

@section('sidebar-left')
  @include('admin.include_admin.sidebar_left')
@endsection

@section('navbar-top')
  @include('admin.include_admin.navbar_top')
@endsection
@section('contents')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			
		<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
		    <li class="nav-item">
		        <a href="#Project" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
		            <i class="mdi mdi-home-variant d-md-none d-block"></i>
		            <span class="d-none d-md-block">Project field</span>
		        </a>
		    </li>
		    <li class="nav-item">
		        <a href="#Business" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
		            <i class="mdi mdi-account-circle d-md-none d-block"></i>
		            <span class="d-none d-md-block">Business areas</span>
		        </a>
		    </li>
		  
		</ul>

		  <div class="tab-content">
			  <div class="tab-pane show active" id="Project">
					  <div class="card-body">

					  	<button type="button" data-bs-toggle="modal" data-bs-target="#fill-info-modal"
					  	 class="btn btn-outline-info"><i class="uil-focus-add"></i> Add category</button>

                       <div id="load_field_project">
                      	<div id="#noty1"></div>
                      	

                      </div> 

               {{--    <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>  
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Describe</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody id="load_field_project">

                         </tbody>
                       </table>
				 	  --}}

					</div>
			</div>



	

		    <div class="tab-pane " id="Business">



                 <div class="card-body">
					  	<button type="button" data-bs-toggle="modal" data-bs-target="#centermodal"
					  	 class="btn btn-outline-info"><i class="uil-focus-add"></i> Add category</button>
                      <div id="load_business_areas">
                      	  	<div id="#noty2"></div>
                      	
                     	
                    </div>
					      
             {{-- 
                        <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>  
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Describe</th>
                                    <th>image</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody id="load_business_areas">

                          </tbody>
                       </table> --}}


				 </div>


		   
		    </div>
        </div>

		</div>
	</div>
</div>


</div>








{{-- model add areas --}}
<div class="modal fade" id="fill-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add field project</h4>
                <button type="button" id="btn-closess" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
             <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >
                     <h5 class="modal-title" id="myCenterModalLabel">Image field:</h5>
                     <div style="margin-top: 5px; display: flex; justify-content: center">
                        <div for="images" class="row">       
                         <span class="drop-title col-sm-3">
                             <img id="uploadPreview11" src="{{asset('/uploads/fieldpng.png')}}" alt="image" 
                       class="img-fluid img-thumbnail" width="60" height="60" /> 
                             </span>
                            <div class="col-sm-9">
                          <input type="file" accept="image/*" id="uploadImage22"  name="file" class="myPhoto_store_rq" onchange="PreviewImage2();" style="margin-top: 8px;">

                          </div>
                        </div>

                        <script type="text/javascript">

                                function PreviewImage2() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("uploadImage22").files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview11").src = oFREvent.target.result;
                                    };
                                  };

                                </script>
                              </div>
                            

                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name field:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_field_pro" id="name_field_pro"
                                    placeholder="Enter your name field...">
                                    </div>
                              </div>


                                 <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Field describe</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_field_pro" id="desc_field_pro"
                                    placeholder="Enter describe your field..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                   <button type="button" class="btn btn-outline-info add_field_pro">add</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

                    </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





{{-- model add areas --}}
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add Business areas</h4>
                <button type="button" id="btn-closessss" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
           <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >
                     <h5 class="modal-title" id="myCenterModalLabel">Image field:</h5>
                     <div style="margin-top: 5px; display: flex; justify-content: center">
                        <div for="images" class="row">       
                         <span class="drop-title col-sm-3">
                             <img id="uploadPreviews" src="{{asset('/uploads/fieldpng.png')}}" alt="image" 
                           class="img-fluid img-thumbnail" width="60" height="60" /> 
                             </span>
                            <div class="col-sm-9">
                          <input type="file" accept="image/*" id="uploadImages"  name="file" class="myPhoto_store_rq" onchange="PreviewImage();" style="margin-top: 8px;">

                          </div>
                        </div>

                        <script type="text/javascript">

                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("uploadImages").files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreviews").src = oFREvent.target.result;
                                    };
                                  };

                                </script>
                              </div>
                            

                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name field:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_business_areas" id="name_business_areas"
                                    placeholder="Enter your name field...">
                                    </div>
                              </div>


                                <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Field describe</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" name="desc" rows="3" class="form-control form-control-sm desc_business_areas" id="desc_business_areas"
                                    placeholder="Enter describe your field..."></textarea>
                                    </div>
                                </div>
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                   <button type="button" class="btn btn-outline-info add_business_areas">add</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





{{-- <script src="{{asset('/Frontend/jsss/jquery.min.js')}}"></script> --}}

    <script type="text/javascript">
         $(document).ready(function(){
            load_field_project();
            load_business_areas();
  
            });


          $('.add_field_pro').click(function(){
                var name_field_pro = $('.name_field_pro').val();
                var desc_field_pro = $('.desc_field_pro').val();
           
                // var myPhoto_store_rq = $('.myPhoto_store_rq').val();
                // var _token = $('input[name="_token"]').val();

                var form_data = new FormData();

                form_data.append("file", document.getElementById("uploadImage22").files[0]);
                form_data.append("name_field_pro",name_field_pro);
                form_data.append("desc_field_pro",desc_field_pro);

              if(name_field_pro == "" || desc_field_pro == "" ){

                    alert("Please enter full information");
              }else{
     
                
                $.ajax({
                    url:"{{url('/add_field_project')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_field_pro").value ="";
                     document.getElementById("desc_field_pro").value ="";
         
                     document.getElementById("btn-closess").click();
                      $.NotificationApp.send("","add field project success","top-right","rgba(0,0,0,0.2)","success")
              
                     // alert("add success !");
                     load_field_project();
                    }
              });
       
              }
           
        });


         function load_field_project(){
                $.ajax({
                    url:'{{url('/load_field_project')}}',
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){

                        $('#load_field_project').html(data);
                        // document.getElementById("hreapsds").href = "{{URL::to('/StoreManager')}}";
                              
                    }

                }); 
        }

        $(document).on('click','.btn-delete-field',function(){
            var id_field = $(this).data('id_field');
            if(confirm('Bạn muốn xóa không?')){
                $.ajax({
                    url:"{{url('/delete_field')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_field:id_field},
                    success:function(data){
                        load_field_project();
                        // $('#noty1').html('<span class="text text-success">delete success</span>');
                        $.NotificationApp.send("","Remove field project success","top-right","rgba(0,0,0,0.2)","success")
                    
                    }
                });
            }


        });




          $('.add_business_areas').click(function(){
                var name_business_areas = $('.name_business_areas').val();
                var desc_business_areas = $('.desc_business_areas').val();

                var form_data = new FormData();

                form_data.append("file", document.getElementById("uploadImages").files[0]);
                form_data.append("name_business_areas",name_business_areas);
                form_data.append("desc_business_areas",desc_business_areas);

              if(name_business_areas == "" || desc_business_areas == "" ){

                    alert("Please enter full information");
              }else{
     
                
                $.ajax({
                    url:"{{url('/add_business_areas')}}",
                    method:"POST",
                   headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("name_business_areas").value ="";
                     document.getElementById("desc_business_areas").value ="";
         
                     document.getElementById("btn-closessss").click();
                     $.NotificationApp.send("","add business areas success","top-right","rgba(0,0,0,0.2)","success")
                     // alert("add success !");
                     load_business_areas();

                    }
              });
       
              }
           
        });


         function load_business_areas(){
                $.ajax({
                    url:'{{url('/load_business_areas')}}',
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){

                        $('#load_business_areas').html(data);
                        // document.getElementById("hreapsds").href = "{{URL::to('/StoreManager')}}";
                              
                    }

                }); 
        }


        $(document).on('click','.btn-delete-areas',function(){
            var id_areas = $(this).data('id_areas');
            if(confirm('Bạn muốn xóa không?')){
                $.ajax({
                    url:"{{url('/delete_areas')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_areas:id_areas},
                    success:function(data){
                        load_business_areas();
                        $.NotificationApp.send("","Remove business areas success","top-right","rgba(0,0,0,0.2)","success")
                    }
                });
            }


        });





    </script>

  
@endsection