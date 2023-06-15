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
                <span class="d-none d-md-block">Store on CINeb</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#Business" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">List store</span>
            </a>
        </li>
      
    </ul>

      <div class="tab-content">
        <div class="tab-pane show active" id="Project">
            <div class="card-body">
                    <div class="row">
                 
                                <div class="card card-h-100">
                                    <div class="card-body">

                                  
                                        <h4 class="header-title mb-3">New store registered, waiting for approval</h4>

                                         <div id="load_store_new">
                                     
                                            

                                        </div>

                           
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  
                                    <div class="card-body">
                                       <h4 class="header-title mb-3">list of businesses currently in business<h4>
                                         <div id="load_store_old">
                                     
                                            

                                        </div>


                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                     
                        </div>
                        <!-- end row -->
               

          </div>
      </div>



  

        <div class="tab-pane " id="Business">

                 <div class="card-body">




                 </div>


       
        </div>

        </div>

    </div>
  </div>
</div>


</div>



<!-- Info Header Modal -->

<div id="info-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="info-header-modalLabel">Store information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
            <div class="row">
               <h4 class="font-13 text-uppercase">About owner :</h4>
                <div class="col-lg-6">
                    <span id="image_user">

                    </span>
                           
                            <h4 class="mb-0 mt-2" id="nickname"></h4>
                            <p class="text-muted font-14" id="email_user" style="overflow-wrap: break-word;"></p>
                           
                                  
                </div>
                <div class="col-lg-6">

                      
                       <p class="text-muted mb-2 font-13"><strong>Birthday :</strong> <span class="ms-2" id="birthday"></span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2" id="phone_user"></span></p>

                         <p class="text-muted mb-2 font-13"><strong>stoty :</strong> <span class="ms-2" id="story_user"></span></p>
                         <button class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Send Email</button>
                    

                </div>
             </div>
              <hr class="m-0">
             <div class="row">
                 <div class="col-lg-8">
                         <div class="text-start mt-3">
                               <h4 class="font-13 text-uppercase">About store :</h4>
                                 <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ms-2" id="name_store"></span></p>
                           
                                 <p class="text-muted mb-2 font-13"><strong>Category :</strong> <span class="ms-2" id="Category_store"></span></p>
                                 <p class="text-muted mb-2 font-13"><strong>Mobile :</strong> <span class="ms-2" id="phone_store"></span></p>

                                 <p class="text-muted mb-2 font-13"><strong>CMND :</strong><span class="ms-2"  id="cmnd_user"></span></p>

                                 <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ms-2 "id="address_store"></span></p>

                           </div>

                 </div>
                <div class="col-lg-4 mt-3">
                     <span id="avt_store">

                    </span>
                    <!-- Thumbnail-->
                  
                </div>

             </div>
                <div class="row"> 
                  <strong>Describe :</strong>  
                  <p class="text-muted mb-1 font-13" id="desc_store"></p>
             </div>
                    
            </div>
            <div class="modal-footer" id="foofetr">
          {{--   <button id="appro" type="button" class="btn btn-light" data-bs-dismiss="modal">Approve</button>
                <button id="no_appro" type="button" class="btn btn-danger" data-bs-dismiss="modal">Not approved</button>
                <button type="button" class="btn btn-info">Close</button> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





   




<script type="text/javascript">
        load_store_new();

        function load_store_new(){
             $.ajax({
                    url:'{{url('/load_store_new')}}',
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){

                        $('#load_store_new').html(data);
                        // document.getElementById("hreapsds").href = "{{URL::to('/StoreManager')}}";
                              
                    }

            }); 
        }

         function view_storenew(id){
            var id_store = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('view_store_new')}}",
            method:"POST",
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType:"JSON",
            data:{id_store:id_store, _token:_token},
              success:function(data){

                $('#image_user').html(data.image_user);
                $('#nickname').html(data.nickname);
                $('#email_user').html(data.email_user);
                $('#birthday').html(data.birthday);
                $('#phone_user').html(data.phone_user);
                $('#story_user').html(data.story_user);

                $('#name_store').html(data.name_store);   
                $('#Category_store').html(data.Category_store);    
                $('#phone_store').html(data.phone_store);
                $('#cmnd_user').html(data.cmnd_user);
                $('#address_store').html(data.address_store);
                $('#avt_store').html(data.avt_store);
                $('#desc_store').html(data.desc_store);
                
                $('#foofetr').html(data.foofetr);

              }
            });
        }

         function Approve_store(id){
            var id_store = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('Approve_store')}}",
            method:"POST",
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data:{id_store:id_store, _token:_token},
              success:function(data){
               load_store_new();
               load_store_old();
               $.NotificationApp.send("","Approve store areas success","top-right","rgba(0,0,0,0.2)","success")
              }
            });
        }

         function No_Approve_store(id){
           var id_store = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('No_Approve_store')}}",
            method:"POST",
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data:{id_store:id_store, _token:_token},
              success:function(data){
              load_store_new();

             load_store_old();
                $.NotificationApp.send("","No Approve store success","top-right","rgba(0,0,0,0.2)","success")
              }
            });
        }


        load_store_old();

        function load_store_old(){
             $.ajax({
                    url:'{{url('/load_store_old')}}',
                    method:"GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){

                        $('#load_store_old').html(data);
                        // document.getElementById("hreapsds").href = "{{URL::to('/StoreManager')}}";               
                    }

            }); 
        }

         function view_store_old(id){
            var id_store = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('view_store_old')}}",
            method:"GET",
             headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            dataType:"JSON",
            data:{id_store:id_store, _token:_token},
              success:function(data){

                $('#image_user').html(data.image_user);
                $('#nickname').html(data.nickname);
                $('#email_user').html(data.email_user);
                $('#birthday').html(data.birthday);
                $('#phone_user').html(data.phone_user);
                $('#story_user').html(data.story_user);

                $('#name_store').html(data.name_store);   
                $('#Category_store').html(data.Category_store);    
                $('#phone_store').html(data.phone_store);
                $('#cmnd_user').html(data.cmnd_user);
                $('#address_store').html(data.address_store);
                $('#avt_store').html(data.avt_store);
                $('#desc_store').html(data.desc_store);
                
                $('#foofetr').html(data.foofetr);
              }
            });
        }

 

</script>




@endsection