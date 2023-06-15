@extends('Shopping_layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_category_store.css')}}">
<div class="row">
    
           <div class="card">
                                <div class="card-body profile-user-box">

                                             @foreach($store as $key => $store)
                                                <div class="row">
                                                      <div class="col-sm-1">

                                                        </div>
                                                      <div class="col-sm-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-lg">
                                                                  <img src="{{asset('/uploads/store/'.$store->avt_store)}}" alt="image" 
                                                                  class="img-fluid img-thumbnail rounded-circle" width="150" height="150" /> 
                                                             
                                                                </div> 
                                                                     <h5 class="mb-0 mt-2" id="name_store">{{$store->name_store}}</h5>
                                                            </div>
                                                            
                                                        </div>
                                                    </div> <!-- end col-->
                                                    <div class="col-sm-4">
                                                        
                                                     <p class="text-muted mb-2 font-13"><strong>The number of products :</strong><span class="ms-2" id="qty_pro_sto">{{$pro_qtyxx}}</span></p>
                                                     <p class="text-muted mb-2 font-13"><strong>Join date :</strong> <span class="ms-2" id="time_add">{{$store->time_add}}</span></p>
                                                      <p  class="text-muted mb-2 font-13"><strong>Address store :</strong> <span class="ms-2" id="address_store">{{$store->address_store}}</span></p>

                                                     <a href="{{url('/Chat_Page/'.$store->id_store)}}" class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Chat</a>
                                                    </div>

                                                  <div class="col-sm-4">
                                                        
                                                     <p class="text-muted mb-2 font-13"><strong>Follower :</strong><span class="ms-2" id="qty_pro_sto">1.3k</span></p>
                                                     <p class="text-muted mb-2 font-13"><strong>Rating :</strong><span class="ms-2" id="time_add">  4.6 </span><i class="fas fa-star"></i></p>
                                                      <p  class="text-muted mb-2 font-13"><strong>About store :</strong> <br><span class="ms-2" id="address_store">{{$store->desc_store}}</span></p>
                                                  
                                                    </div>

                                                    
                                                </div> <!-- end row -->
                                                <input type="hidden" class="id_storexx" value="{{$store->id_store}}">

                                          @endforeach
                                            <hr>


                                            <div class="row">
                                                <div class="carousel-container">
                                                  <div class="inner-carousel">
                                                    <div class="track">
                                                         <div style="margin-right: 10px;">
                                                               <a id="all_proxx" class="category-o__shop-now btn--e-white-brand">
                                                                 All
                                                               </a>
 
                                                               @foreach($cate as $key => $cate)
                                                               <span class="abcdsssxx">
                                                               <input type="hidden" class="id_cate_fill" value="{{$cate->id_cate_product}}">
                                                                <a id="filter_pro_catexx" class="category-o__shop-now btn--e-white-brand">
                                                                      {{$cate->name_cate_product}}
                                                                </a>
                                                               </span>  
                                                             
                                                                 
                                                                 @endforeach
                                                         </div>
                                                    </div>
                                                    <div class="nav_slide">
                                                      <button class="prev"><i class="dripicons-chevron-left"></i></button>
                                                      <button class="next"><i class="dripicons-chevron-right"></i></button>
                                                    </div>
                                                  </div>

                                                </div>
                                            </div>

                        </div> <!-- end card-body/ profile-user-box-->       
 
                 </div><!--end profile/ card -->

  

  </div>





  <div class="row">
             
                    <div class="card">

                        <div class="card-body profile-user-box">
                        <h4 style="display: flex;justify-content: center;"><span class="text_cate">All ptoduct of store</span></h4>
                        <hr>
                        <div class="row is-grid-active" id="load_prodouct_store">
                            
                        </div>


                         </div> <!-- end card-body/ profile-user-box-->       
 
                 </div><!--end profile/ card -->

  

  </div>

  <script type="text/javascript">
      $(document).ready(function(){
         var id_store = $('.id_storexx').val();
         var id = '';
         load_all_products_of_store(id, id_store);

               $(document).on('click','#all_proxx',function(){
                     var id_store = $('.id_storexx').val();
                     var id = '';
                     load_all_products_of_store(id, id_store);
                   
                      
                })

               function load_all_products_of_store(id = '', id_store){  
                    var id_store = $('.id_storexx').val();
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_products_of_store')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id,id_store:id_store,_token:_token},
                        success:function(data){
                             $('#load_more_button').remove();
                            $('#load_prodouct_store').html(data);
                            
                            
                        }

                    }); 
                }



             function load_more_products_of_store(id = '', id_store){  
                    var id_store = $('.id_storexx').val();
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_products_of_store')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id,id_store:id_store,_token:_token},
                        success:function(data){
                             $('#load_more_button').remove();
                            $('#load_prodouct_store').append(data);
                            
                            
                        }

                    }); 
                }
            
                $(document).on('click','#load_more_button',function(){
                    var id = $(this).data('id');
                    var id_store = $(this).closest(".abcd").find(".id_store").val();
                    $('#load_more_button').html('<b>Loading...</b>');
                    load_more_products_of_store(id, id_store);
                   
                      
                })


                ///////////////////////////////loc theo danh muc

                var idcate = "";
                $(document).on('click','#filter_pro_catexx',function(e){
                       e.preventDefault();
                    var id_store = $('.id_storexx').val();
                     idcate = $(this).closest(".abcdsssxx").find(".id_cate_fill").val();
                    var id = '';
                  
                    load_products_category_of_store(id, idcate, id_store);
                   
                      
                })
              function load_products_category_of_store(id = '',idcate, id_store){  
                    var id_store = $('.id_storexx').val();
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_products_category_of_store')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id,id_store:id_store,idcate:idcate,_token:_token},
                        success:function(data){
                     
                            $('#load_prodouct_store').html(data);
                            
                            
                        }

                    }); 
                 }
                 


                 ///load more


                  $(document).on('click','#load_more_procate_store_button',function(){
                    var id = $(this).data('id');
                    var id_store = $(this).closest(".abcd").find(".id_store").val();
                    var idcate = $(this).closest(".abcd").find(".idcate").val();       
                    
                    $('#load_more_procate_store_button').html('<b>Loading...</b>');
                    load_more_products_category_of_store(id, idcate,  id_store);
                   
                      
                })

                 function load_more_products_category_of_store(id = '',idcate, id_store){  
                    var id_store = $('.id_storexx').val();
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_products_category_of_store')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id,id_store:id_store,idcate:idcate,_token:_token},
                        success:function(data){
                             $('#load_more_procate_store_button').remove();
                            $('#load_prodouct_store').append(data);
                            
                            
                        }

                    }); 
                 }
             



     });

  </script>
    <script type="text/javascript">
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const carousel = document.querySelector(".carousel-container");
        const track = document.querySelector(".track");
        let width = carousel.offsetWidth;
        let index = 0;
        window.addEventListener("resize", function () {
          width = carousel.offsetWidth;
        });
        next.addEventListener("click", function (e) {
          e.preventDefault();
          index = index + 1;
          prev.classList.add("show");
          track.style.transform = "translateX(" + index * -width + "px)";
          if (track.offsetWidth - index * width < index * width) {
            next.classList.add("hide");
          }
        });
        prev.addEventListener("click", function () {
          index = index - 1;
          next.classList.remove("hide");
          if (index === 0) {
            prev.classList.remove("show");
          }
          track.style.transform = "translateX(" + index * -width + "px)";
        });


    </script>

@endsection




 {{--       $(document).ready(function(){
    
          Load_info_store()

             function Load_info_store(){
                 var id_store  = $('.id_store').val();

                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url:'{{url('/Load_info_store')}}',
                     method:"GET",
                     dataType:"JSON",
                       headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                     data:{id_store:id_store,_token:_token},
               
                    success:function(data){
                    $('#image_store').html(data.image_store);

                    $('#name_store').html(data.name_store);
                    $('#phone_store').html(data.phone_store);
                    $('#time_add').html(data.time_add);
                    $('#qty_pro_sto').html(data.qty_pro_sto);
                    $('#address_store').html(data.address_store);

 
                      
                    }

                }); 
               
            }


   


      });
          --}}