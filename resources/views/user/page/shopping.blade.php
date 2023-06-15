@extends('Shopping_layout')
@section('content')

<div class="row" style="background-color: white;">
	<div class="col-lg-12">
	<div class="row " style="height: 300px; background-color: transparent;">

 	@include('user.include.slide_shopping')

   </div>
   </div>
</div>


<div class="row card" style="background: white; margin-top: 15px;">
 <div class="col-lg-12">
 	<h3 class="header-title" style="margin-top: 15px;">CATEGORY</h3>
 	<hr>
 	 @include('user.include.slide_category')
 </div>
</div>



{{--       <div class="row" style=" margin-top: 15px;">
 
 	   <div class="card" style="margin-bottom: 0px;">
 		<h3 class="header-title" style="margin-top: 15px;display: flex; justify-content: center;">Top Search</h3>
     	<hr>
      	</div>

 	   <div class="row is-grid-active" id="c" style="margin-top: 20px;">
 		  
   
      </div>
 --}}


      <div class="row" style=" margin-top: 15px;">
 
       <div class="card" style="margin-bottom: 0px;">
        <h3 class="header-title" style="margin-top: 15px;display: flex; justify-content: center;">New Product</h3>
        <hr>
        </div>

       <div class="row is-grid-active" id="load_more_product" style="margin-top: 20px;">
          
         {{--  @foreach($product as $key => $product) 

           @endforeach  --}}

      </div>
          
          


 

 
</div>

<script type="text/javascript">
 $(document).ready(function(){
      load_more_product_home();
   });
               function load_more_product_home(id = ''){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/load_more_product_home')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data:{id:id,_token:_token},
                        success:function(data){
                             $('#load_more_button').remove();
                            $('#load_more_product').append(data);
                            
                            
                        }

                    }); 
                }
                $(document).on('click','#load_more_button',function(){
                    var id = $(this).data('id');
                    $('#load_more_button').html('<b>Loading...</b>');
                    load_more_product_home(id);
                   
                      
                })


               // function Load_product_top_search(){
               //      var _token = $('input[name="_token"]').val();
               //      $.ajax({
               //          url:'{{url('/Load_product_top_search')}}',
               //          method:"GET",
               //          headers:{
               //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               //          },

               //          data:{_token:_token},
               //          success:function(data){
               //              $('#Load_product_top_search').html(data);
                            
                            
               //          }

               //      }); 
               //  }
 



</script>



@endsection