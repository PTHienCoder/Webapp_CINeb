@extends('User_layout')
@section('content')
<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
    <div class="row">
    <input type="hidden" class="id_store" value="{{$id_fr}}">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
	    <div class="row">
          <!-- start chat users-->
                            <div class="col-xxl-3 col-xl-6 order-xl-1">
                                <div class="card">
                                    <div class="card-body p-0">
                                       
                                        <div class="tab-content">
                                            <div class="tab-pane show active p-3" id="newpost">

                                                <!-- start search box -->
                                                <div class="app-search">
                                                    <form>
                                                        <div class="mb-2 position-relative">
                                                            <input type="text" class="form-control" placeholder="People, groups & messages...">
                                                            <span class="mdi mdi-magnify search-icon"></span>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- end search box -->

                                                <!-- users -->
                                                <div class="row">
                                                    <div class="col">
                                                        <div data-simplebar="" style="height: 550px" class="loadstore_Chat_user">
                                                           

                                                        </div> <!-- end slimscroll-->
                                                    </div> <!-- End col -->
                                                </div>
                                                <!-- end users -->
                                            </div> <!-- end Tab Pane-->
                                        </div> <!-- end tab content-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            <!-- end chat users-->

                            <!-- chat area -->
                            <div class="col-xxl-6 col-xl-12 order-xl-2">
                                <div class="card">
                                    <div class="card-body">
                                    	
                                         <ul class="conversation-list">
                                             <div id="data_chat"   style="height: 500px; overflow: auto; display: flex;  flex-direction: column-reverse; padding: 10px;" >
                                      
                                             </div>

                                        
                             
                                        </ul>

                                        <div class="row">
                                            <div class="col">
                                                <div class="mt-2 bg-light p-3 rounded">
                                                    <form class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                                        <div class="row">
                                                            <div class="col mb-2 mb-sm-0">
                                                                <input type="text" class="form-control border-0 content_chat" placeholder="Enter your text" required="">
                                                                <div class="invalid-feedback">
                                                                    Please enter your messsage
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-auto">
                                                                <div class="btn-group">
                                                                    <a href="#" class="btn btn-light"><i class="uil uil-paperclip"></i></a>
                                                                    <a href="#" class="btn btn-light"> <i class='uil uil-smile'></i> </a>
                                                                    <div class="d-grid">
                                                                        <button type="submit" class="btn btn-success chat-send"><i class='uil uil-message'></i></button>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row-->
                                                    </form>
                                                </div> 
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div>
                            <!-- end chat area-->

                            <!-- start user detail -->
                            <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2 div_inf_user">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">View full</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Edit Contact Info</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Remove</a>
                                            </div>
                                        </div>

                                        <div class="mt-3 text-center">
                                        	<span class="image_store">
                                        		
                                        	</span>
                                           
                                            <h4 class="name"></h4>
                                         
                                          
                                        </div>

                                        <div class="mt-3">
                                            <hr class="">

                                            <p class="mt-4 mb-1"><strong><i class='uil uil-at'></i> Email:</strong></p>
                                            <p class="email"></p>

                                            <p class="mt-3 mb-1"><strong><i class='uil uil-phone'></i> Phone Number:</strong></p>
                                            <p class="phone"></p>

                                            <p class="mt-3 mb-1"><strong><i class='uil uil-location'></i> Location:</strong></p>
                                            <p class="address"></p>

                                            <p class="mt-3 mb-1"><strong><i class='uil uil-globe'></i> Languages:</strong></p>
                                            <p>English, German, Spanish</p>

                                            <p class="mt-3 mb-2"><strong><i class='uil uil-users-alt'></i> Groups:</strong></p>
                                            <p>
                                                <span class="badge badge-success-lighten p-1 font-14">Work</span>
                                                <span class="badge badge-primary-lighten p-1 font-14">Friends</span>
                                            </p>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                            <!-- end user detail -->
                        </div> <!-- end row-->


	      </div>
	</div>
<script type="text/javascript">
	 $(document).ready(function(){
	 	var id_store = $('.id_store').val();

         if(id_store !=0){
         
         	  // load_Infor_store_chat(id_store);
               $('.div_inf_user').show();
                $('.div_senchat').show(); 

         }else {
               $('.div_inf_user').hide();
               $('.div_senchat').hide(); 
         }
       loadstore_Chat_user();
           function loadstore_Chat_user(){  
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/loadstore_Chat_user')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{_token:_token},
                        success:function(data){
                 
                            $('.loadstore_Chat_user').html(data);

                            
                        }

                    }); 
                 }
          var id_fr = null;
	 	   $(document).on('click', '.item_user', function(e) {
                e.preventDefault(); 
                  $('.div_inf_user').show();
                  $('.div_senchat').show(); 
                  var id_store = $(this).closest(".item_user").find(".id_store").val();
                  loadstore_Chat_user(id_store);
                     id_store = id_store;
                          setInterval(function() {
                          load_Infor_store_chat(id_store);
                            }, 300)


               });
	      function load_Infor_store_chat(id_store){  
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_Infor_store_chat')}}',
                        method:"GET",
                        dataType:'JSON',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id_store:id_store,_token:_token},
                        success:function(data){
                        	$('.image_store').html(data.image_store);
                        	$('.name').html(data.name_store);
                        	$('.email').html(data.email);
                        	$('.phone').html(data.phone);
                        	$('.address').html(data.location);

                        	$('#data_chat').html(data.data_chat);

                            
                        }

                    }); 
                 }


       $(document).on('click', '.chat-send', function(e) {
                e.preventDefault();  
  
                   // var id = $(this).closest("#item_searchxxx").find(".id_active").val();
                   var content_chat = $(".content_chat").val();
                   var id_fr = $(".id_store").val();
                    var _token = $('input[name="_token"]').val();
                    if(content_chat != ""){
                    	  $.ajax({
		                    url:"{{url('post_chat')}}",
		                    method:"POST",
		                    headers: {
		                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                     },
		                     data:{content_chat:content_chat,
		                     id_fr:id_fr,
		                     _token:_token},
		                      success:function(data){
		                       load_Infor_store_chat(id_store);
		                       $(".content_chat").val("");
		                     }
		                   });
                    	}else{
                    		alert("please enter content chat !")
                    	}
                  

               });

 }); 
</script>


@endsection