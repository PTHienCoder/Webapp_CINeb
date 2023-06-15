
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- Profile -->
                                        <div class="card bg-primary">
                                            <div class="card-body profile-user-box">

                                               <div class="row">
                                                      <div class="col-sm-1">

                                                        </div>
                                                      <div class="col-sm-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-lg" id="image_store">
                                                                {{--   <img src="{{asset('/uploads/store/'.$store->avt_store)}}" alt="image" 
                                                                  class="img-fluid img-thumbnail rounded-circle" width="150" height="150" />  --}}
                                                             
                                                                </div> 
                                                                     <h5 class="mt-1 mb-1 text-white" id="name_store"></h5>
                                                            </div>
                                                            
                                                        </div>
                                                    </div> <!-- end col-->
                                                    <div class="col-sm-4">
                                                        
                                                     <p class="font-15 text-white"><strong>The number of products :</strong><span class="ms-2" id="qty_pro_sto"></span></p>
                                                     <p class="font-15 text-white"><strong>Join date :</strong> <span class="ms-2" id="time_add"></span></p>
                                                      <p  class="font-15 text-white"><strong>Address store :</strong> <span class="ms-2" id="address_store"></span></p>
                                                      <button id="mangea" class="btn btn-light manager_store_click">
                                                                <i class="mdi mdi-account-edit me-1 "></i> Manager store
                                                            </button>
                                                    </div>

                                                  <div class="col-sm-4">
                                                        
                                                     <p class="font-15 text-white"><strong>Follower :</strong><span class="ms-2" id="qty_pro_sto">1.3k</span></p>
                                                     <p class="font-15 text-white"><strong>Rating :</strong><span class="ms-2" id="time_add">  4.6 </span><i class="fas fa-star"></i></p>
                                                      <p  class="font-15 text-white"><strong>About store :</strong> <br><span class="ms-2" id="desc_store"></span></p>
                                                  
                                                    </div>

                                                    
                                                </div> <!-- end row -->

 

                                            </div> <!-- end card-body/ profile-user-box-->
                                        </div><!--end profile/ card -->
                                    </div> <!-- end col-->
                        </div>


             <div class="row">
                     <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-basket float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                                                <h2 class="m-b-20" id="qty_order_store"></h2>
                                              
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-box float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                                                <h2 class="m-b-20">$<span>46,782</span></h2>
                                            
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-jewel float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                                                <h2 class="m-b-20" id="qty_pro_sto1"></h2>
                                               
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

 </div>
<script type="text/javascript">
       
              
</script>