@extends('User_layout')
@section('content')

    @include('user.include.sidebar_small')


    <div class="feed" data-simplebar>
        <h3 class="page-title" style="margin-bottom: 15px;">Some new projects</h3>

         <div id="load_post_page_home">
             
         </div>

   </div>

<script type="text/javascript">
 $(document).ready(function(){
    load_post_page_home();
         function load_post_page_home(){  
                    var id_store = $('.id_storexx').val();
                      
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_post_page_home')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{_token:_token},
                        success:function(data){
                             $('#load_post_page_home').html(data);
                  
                        }

                    }); 
                 }


     $(document).on('click', '.btn_Nosave_post', function(e) {
          e.preventDefault();
         
                var id_post = $(this).closest(".card_posts").find(".id_post").val();

                  $(this).closest(".more_post").find(".icon-links").html(`<a class="btn_save_post"><i class="mdi mdi-heart-outline"></i></a> 
                                                                        <a class="btn_detail_post"><i class="mdi mdi-eye"></i></a> `)
                var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('user_Nosave_post')}}',
                        method:"POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,_token:_token},
                        success:function(data){
   
                             
                      }

                    }); 

        }); 
     $(document).on('click', '.btn_save_post', function(e) {
            e.preventDefault();
             var id_post = $(this).closest(".card_posts").find(".id_post").val();
        
               $(this).closest(".more_post").find(".icon-links").html(`<a class="btn_Nosave_post"><i class="mdi mdi-heart"></i></a>
                                                                      <a class="btn_detail_post"><i class="mdi mdi-eye"></i></a> `);   
       
                var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('user_save_post')}}',
                        method:"POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id_post:id_post,_token:_token},
                        success:function(data){
                        add_active_post(id_post);
                        }

                    }); 

        }); 

     $(document).on('click', '.btn_detail_post', function(e) {
            e.preventDefault();
             var id_post = $(this).closest(".card_posts").find(".id_post").val();
             window.location.href ="{{url('/user_detail_post')}}"+"/"+id_post;
             add_active_post(id_post);

        }); 


  

         function add_active_post(id_post){
            var id_productss ="";          
                var key_active = "Search_Post";
                var content_key = $('.input_searchxx').val();

                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                    url:"{{url('add_product_active_shopping')}}",
                    method:"POST",
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{id_productss:id_productss,
                     id_post:id_post,
                     content_key:content_key,
                     key_active:key_active,
                     _token:_token},
                      success:function(data){
                    
                     }
                   });
   }

     


}); 
</script>



@endsection