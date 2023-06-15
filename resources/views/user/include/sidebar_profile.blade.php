         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">

        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/vendor.css')}}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/utility.css')}}css/utility.css">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/app.css')}}">


       @foreach($idusserssss as $key => $idussers)

                              <div class="card text-center">
                                    <div class="card-body">
                                     

                                            @if (Auth::user()->image_user == 0)
                                             <img  src="{{asset('/uploads/profile/avt_user.png')}}" alt="user-image" 
                                             class="img-fluid rounded-circle" width="80">
                                            @else
                                             <img  src="{{asset('/uploads/profile/'.Auth::user()->id.'/'.Auth::user()->image_user)}}" alt="user-image" 
                                             class="img-fluid rounded-circle" width="80">
                                            @endif
                                    

                                        <h4 class="mb-0 mt-2">{{$idussers->name}}</h4>
                                        <p class="text-muted font-14">{{$idussers->email}}</p>

                                  
                                         <button type="button" data-bs-toggle="modal" data-bs-target="#centermodal"  
                                         class="btn btn-success btn-sm mb-2"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</button>

                                        <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>

                                         <ul class="mb-0 list-inline text-light" style="margin-top: 15px;">
                                                   <li class="list-inline-item me-3">
                                                      <p class="text-muted mb-2 font-13"><strong>{{$follow}}</strong></p>
                                                      <p class="text-muted mb-2 font-13">Follow</p>
                                                          </li>
                                                   <li class="list-inline-item">
                                                         <p class="text-muted mb-2 font-13"><strong>{{$followed}}</strong></p>
                                                        <p class="text-muted mb-2 font-13 ">Followed</p>
                                                    </li>
                                                    
                                            </ul>

                                        <hr>
                                        <div class="text-start">
                
                                       
                                            <p class="text-muted mb-2 font-13"><strong>Birthday</strong> <span class="ms-2">{{$idussers->birthday}}</span></p>

                                            <p class="text-muted mb-2 font-13"><strong>Phone:</strong> <span class="ms-2 ">{{$idussers->phone_user}}</span></p>
                                      
                                        </div>
                                        <hr>
                                        <div class="text-start list-group list-group-flush">
                                            <a id="pro0" class="list-group-item list-group-item-action y border-0">
                                              <span style="cursor:default;" class="text-muted mb-2 font-13" > <i class="dripicons-user me-1"></i>My profile</span> </a>
                                     
                                            <a id="pro1" class="list-group-item list-group-item-action y border-0">
                                              <span style="cursor:default;" class="text-muted mb-2 font-13" > <i class="dripicons-to-do me-1"></i>Purchase order</span> </a>

                                            <a id="pro2" class="list-group-item list-group-item-action border-0">
                                                 <span style="cursor:default;"  class="text-muted mb-2 font-13"> <i class=" dripicons-bell me-1"></i> Notification</span></a>

                                            <a id="pro3" class="list-group-item list-group-item-action border-0">
                                                 <span style="cursor:default;"  class="text-muted mb-2 font-13"> <i class=" dripicons-blog me-1"></i>Vocher</span></a>


                                              <div class="list-group-item list-group-item-action " id="changetypeuser">
                                       
                                             </div>     
                                           
                                        </div>


                                        <ul class="social-list list-inline mt-3 mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                            </li>
                                        </ul>
                                    </div> <!-- end card-body -->
                                </div>


         @endforeach






<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Edit Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
          @foreach($idusserssss as $key => $idussers)
                 <form action="{{url('/saveprofile')}}" method="post" enctype='multipart/form-data'>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >
                     <div style="display: flex; justify-content: center; margin-top: 7px;">
                        <label for="images" class="drop-containerss">
                             <span class="drop-title">

                                          @if (Auth::user()->image_user == 0)
                                             <img id="uploadPreview"  src="{{asset('/uploads/profile/avt_user.png')}}"  alt="user-image" 
                                             class="img-fluid rounded-circle" width="80">
                                            @else
                                             <img id="uploadPreview"  src="{{asset('/uploads/profile/'.Auth::user()->id.'/'.Auth::user()->image_user)}}" alt="user-image" 
                                             class="img-fluid rounded-circle" width="80">
                                            @endif
                                    


                             </span>
                    
                          <input type="file" accept="image/*" id="uploadImage" name="myPhoto" onchange="PreviewImage1();" >
                        </label>

                        <script type="text/javascript">

                            function PreviewImage1() {
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                                oFReader.onload = function (oFREvent) {
                                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                                };
                            };

                        </script>
                      </div>
                            

                    </li>
                    <li class="list-group-item">
                      <div class="mb-2 row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                            <input required type="email"  name="email" value="{{$idussers->email}}" class="form-control form-control-sm" id="colFormLabelSm">
                            </div>
                      </div>
                       <div class="mb-2 row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nickname</label>
                            <div class="col-sm-10">
                            <input required type="text" name="nickname" value="{{$idussers->name}}" class="form-control form-control-sm" id="colFormLabelSm">
                            </div>
                      </div>
                      <div class="mb-2 row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Phone</label>
                            <div class="col-sm-10">
                            <input required type="text" name="phone" value="{{$idussers->phone_user}}" class="form-control form-control-sm" id="colFormLabelSm">
                            </div>
                      </div>
                         <div class="mb-2 row">
                            <label for="colFormLabelSm"  class="col-sm-2 col-form-label col-form-label-sm">Date Birthday</label>
                            <div class="col-sm-10">
                            <input required type="date" name="date" value="{{$idussers->birthday}}" class="form-control form-control-lg" id="colFormLabelSm">
                            </div>
                      </div>
                        
                    </li>
                    <li class="list-group-item">
                           <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                           <button type="submit" class="btn btn-outline-info"><i class="uil-edit-alt"></i> Save</button>
                           </div>
                    </li>
                 
                </ul>

         
                </form>

             @endforeach
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
 /////////////////click tab profile /////////////
     $(document).ready(function(){
     

      $(document).ready(function(){

         $('#content_profile').load("{{asset('/include_profile/home_profile.blade.php')}}");

          load_myProiect();
            $("#pro0").css({backgroundColor: '#DCDCDC'});
            $("#pro0").click(function(){
                 $('#content_profile').load("{{asset('/include_profile/home_profile.blade.php')}}");
                $("#pro0").css({backgroundColor: '#DCDCDC'});

                $("#pro1").css({backgroundColor: ''});
                $("#changetypeuser").css({backgroundColor: ''});
                   load_myProiect();
            });
      });
      $(document).ready(function(){
            $("#pro1").click(function(){
                 $('#content_profile').load("{{asset('/include_profile/order_profile.blade.php')}}");               
                $("#pro0").css({backgroundColor: ''});
                $("#changetypeuser").css({backgroundColor: ''});

                $("#pro1").css({backgroundColor: '#DCDCDC'});

                         load_my_order_profile();
                        
            });
      });

      $(document).ready(function(){
            $("#changetypeuser").click(function(){

                if($('.myst').text() == "My store"){
                 $('#content_profile').load("{{asset('/include_profile/mystore_profile.blade.php')}}");               
                 $("#pro0").css({backgroundColor: ''});
                 $("#pro1").css({backgroundColor: ''});

                 $("#changetypeuser").css({backgroundColor: '#DCDCDC'});
                 Load_info_store();

                }
              
            });
      }); 



           $(document).on('click', '.manager_store_click', function() {
            window.location.href ="{{url('/StoreManager')}}";
            }); 



 ////////////////////////// home profile ///////////////////////
     $(document).on('click', '.mypr', function() {
             load_myProiect();
      
       });
    $(document).on('click', '.savepr', function() {
             load_save_project();
      
       });
       function load_myProiect(){
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_myProiect')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('.load_myProiect').html(data);

               
                    }

                }); 
            }

     
       function load_save_project(){
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_save_project')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('.load_save_project').html(data);

               
                    }

                }); 
            }








    /////////////////////////// load my order  ////////////////////////////
      

          function load_my_order_profile(){
            var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_my_order_profile')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{_token:_token},
                    success:function(data){
                        $('.load_my_order_profile').html(data);

               
                    }

                }); 
            }


             $(document).on('click', '.btn_view_detail_od', function() {

                   var id_order_store = $(this).data("id_order_store");
                    var _token = $('input[name="_token"]').val();
                   $.ajax({
                       url:'{{url('/load_detail_order_my_pro')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_order_store:id_order_store,_token:_token},
                    success:function(data){
                        $('.load_my_order_profile').html(data);

               
                    }

                }); 

      
            });  
           

           var status = 0;  
           $(document).on('click', '.allxx', function() {
             load_my_order_profile();
      
            });
             $(document).on('click', '.to_Packed', function() {

              status = 1;
             load_my_order_status_profile(status);
      
            });
             $(document).on('click', '.to_ship', function() {
              status = 2;
             load_my_order_status_profile(status);
            });

            $(document).on('click', '.Completed', function() {
             var status = 3;
             load_my_order_status_profile(status);
      
            });
            $(document).on('click', '.Cancelled', function() {
              status = 4;
             load_my_order_status_profile(status);
      
            });

            $(document).on('click', '.Return', function() {
              status = 5;
             load_my_order_status_profile(status);
      
            });     


       function load_my_order_status_profile(status){
            
         var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/load_my_order_status_profile')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{status:status,_token:_token},
                    success:function(data){
                        if(status == 1){
                         $('.load_my_order_packed_profile').html(data);
                        }else if(status == 2){
                         $('.load_my_order_to_ship_profile').html(data);
                        }else if(status == 3){
                        $('.load_my_order_to_completed_profile').html(data);
                        }else if(status == 4){
                         $('.load_my_order_to_canccel_profile').html(data);
                        }else if(status == 5){
                        $('.load_my_order_to_return_profile').html(data);
                        }
                    
               
                    }

                }); 
            }

              $(document).on('click', '.btn_view_detail_od_status', function() {

                   var id_order_store = $(this).data("id_order_store");
                    var _token = $('input[name="_token"]').val();
                   $.ajax({
                       url:'{{url('/load_detail_order_my_pro')}}',
                    method:"GET",    
                    // dataType:"JSON",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id_order_store:id_order_store,_token:_token},
                      success:function(data){
                        if(status == 1){
                         $('.load_my_order_packed_profile').html(data);
                        }else if(status == 2){
                         $('.load_my_order_to_ship_profile').html(data);
                        }else if(status == 3){
                        $('.load_my_order_to_completed_profile').html(data);
                        }else if(status == 4){
                         $('.load_my_order_to_canccel_profile').html(data);
                        }else if(status == 5){
                        $('.load_my_order_to_return_profile').html(data);
                        }

               
                    }

                }); 

      
            });



     ///////////////////////// load infor store  ////////////////////

          

             function Load_info_store(){
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url:'{{url('/Load_info_store')}}',
                     method:"GET",
                     dataType:"JSON",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                     data:{_token:_token},
                    success:function(data){
                    $('#image_store').html(data.image_store);

                    $('#name_store').html(data.name_store);
                    $('#phone_store').html(data.phone_store);
                    $('#time_add').html(data.time_add);
                    $('#qty_pro_sto').html(data.qty_pro_sto);
                    $('#qty_pro_sto1').html(data.qty_pro_sto);
                    

                    $('#desc_store').html(data.desc_store);
                    $('#qty_order_store').html(data.qty_order_store);

 
                      
                    }

                }); 
               
            }


  }); 
</script>



   <script type="text/javascript">
    ////////////////////////   Phaan dang ky cua hang ///////////////

    $(document).ready(function(){
    
         loadtypeuser_store();
         load_category_store();
  
          $('.request-create-store').click(function(){
                var name_store_rq = $('.name_store_rq').val();
                var address_store_rq = $('.address_store_rq').val();
                var cmnd_store_rq = $('.cmnd_store_rq').val();
                var phone_store_rq = $('.phone_store_rq').val();
                var desc_store_rq = $('.desc_store_rq' ).val();
                var Category_store = $('.Category_store').val();
                // var _token = $('input[name="_token"]').val();

                var form_data = new FormData();

                form_data.append("file", document.getElementById("uploadImage22").files[0]);
                form_data.append("name_store_rq",name_store_rq);
                form_data.append("address_store_rq",address_store_rq);
                form_data.append("cmnd_store_rq",cmnd_store_rq);
                form_data.append("phone_store_rq",phone_store_rq);
                form_data.append("Category_store",Category_store);
                form_data.append("desc_store_rq",desc_store_rq);

              if(name_store_rq == "" || address_store_rq == "" ||cmnd_store_rq == "" || phone_store_rq == ""){

                    alert("Please enter full information");
              }else{


        
                
                $.ajax({
                    url:"{{url('/CreateShop')}}",
                    method:"POST",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                     document.getElementById("colFormLabelSm1").value ="";
                     document.getElementById("colFormLabelSm2").value ="";
                     document.getElementById("colFormLabelSm3").value ="";
                     document.getElementById("colFormLabelSm4").value ="";
                     document.getElementById("colFormLabelSm5").value ="";
                     document.getElementById("btn-closess").click();
                     loadtypeuser_store();
              
                     alert("Request has been sent waiting for approval !");
                    }
              });
       
              }
           
        });



          function loadtypeuser_store(){
                $.ajax({
                    url:'{{url('/load-type-user')}}',
                    method:"GET",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                    success:function(data){
                        $('#changetypeuser').html(data);
                        // document.getElementById("hreapsds").;
                              
                    }

                }); 
            }

          function load_category_store(){
                $.ajax({
                    url:'{{url('/load_category_store')}}',
                    method:"GET",
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                    success:function(data){
                        $('#option_category').html(data);
      
                    }

                }); 
          }


 });    
   </script>



   <!-- Info Filled Modal -->

     <div id="modal_createShop" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-info-modalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content modal-filled bg-info">
                                <div class="modal-header">
                                <h4 class="modal-title" id="myCenterModalLabel">Store registration</h4>
                                <button type="button" id="btn-closess" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
            <form>
                  {{ csrf_field() }}

       
                <ul class="list-group list-group-flush">

                    <li class="list-group-item" >
                     <h5 class="modal-title" id="myCenterModalLabel">Avatar Store:</h5>
                     <div style="margin-top: 5px; display: flex; justify-content: center">
                        <div for="images" class="row">       
                         <span class="drop-title col-sm-3">
                             <img id="uploadPreview22" src="{{asset('/uploads/store.jpg')}}" alt="image" 
                        class="img-fluid img-thumbnail rounded-circle" width="60" height="60" /> 
                             </span>
                            <div class="col-sm-9">
                          <input type="file" accept="image/*" id="uploadImage22"  name="file" class="myPhoto_store_rq" onchange="PreviewImage();" style="margin-top: 8px;">

                          </div>
                        </div>

                        <script type="text/javascript">

                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("uploadImage22").files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview22").src = oFREvent.target.result;
                                    };
                                  };

                                </script>
                              </div>
                            

                            </li>
                            <li class="list-group-item">
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Name Store:</label>
                                    <div class="col-sm-9">
                                    <input required type="text"  name="name" class="form-control form-control-sm name_store_rq" id="colFormLabelSm1"
                                    placeholder="Enter your name store...">
                                    </div>
                              </div>
                               <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Address (if any):</label>
                                    <div class="col-sm-9">
                                    <input required type="text" name="address"  class="form-control form-control-sm address_store_rq" id="colFormLabelSm2"
                                     placeholder="Enter your Address...">
                                    </div>
                              </div>
                              <div class="mb-2 row">
                                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">CMND/CCCD:</label>
                                    <div class="col-sm-9">
                                    <input required type="text" name="cmnd" class="form-control form-control-sm cmnd_store_rq" id="colFormLabelSm3"
                                     placeholder="Enter your CMND/CCCD...">
                                    </div>
                              </div>
                                 <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Shop Phone</label>
                                    <div class="col-sm-9">
                                    <input required type="text" name="phone" class="form-control form-control-sm phone_store_rq" id="colFormLabelSm4"
                                    placeholder="Enter your Shop Phone...">
                                    </div>
                                </div>

                                 <div class="mb-2 row" id="option_category">
                                   

                                        


                                 
                                 </div>

                                 <div class="mb-2 row">
                                    <label for="colFormLabelSm"  class="col-sm-3 col-form-label col-form-label-sm">Shop describe</label>
                                    <div class="col-sm-9">
                                    <textarea type="date" name="desc" rows="3" class="form-control form-control-sm desc_store_rq" id="colFormLabelSm5"
                                    placeholder="Enter describe your Shop..."></textarea>
                                    </div>
                                </div>

                                
                                
                            </li>
                            <li class="list-group-item">
                                   <div style="display: flex; justify-content: center; margin-top: 7px;"> 
                                   <button type="button" class="btn btn-outline-info request-create-store">Send Request</button>
                                   </div>
                            </li>
                         
                        </ul>

                 
                        </form>



              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!--====== Vendor Js ======-->
       <script src="{{asset('/Frontend/assets/js/vendor.js')}}"></script>

       <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('/Frontend/assets/js/jquery.shopnav.js')}}"></script>

        <!--====== App ======-->
        <script src="{{asset('/Frontend/assets/js/app.js')}}"></script>