@extends('User_layout')
@section('content')
   @include('user.include.sidebar_full')
   <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/style_card_product.css')}}">

        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/vendor.css')}}">

        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/utility.css')}}css/utility.css">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('/Frontend/assets/css/app.css')}}">
<style type="text/css">
    .aspect__img{
        object-fit: cover;
        object-position: 80% 20%;
    }
</style>

    <div class="feedpro" data-simplebar>
        <h3 class="page-title" style="margin-bottom: 15px;">Some new explore</h3>

               <div class="row is-grid-active" id="Load_project_Explore">
 
              </div>
              
        

   </div>

   <script type="text/javascript">
      
       $(document).ready(function(){
        Load_project_Explore();
         function Load_project_Explore(){  
 
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:'{{url('/Load_project_Explore')}}',
                        method:"GET",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{_token:_token},
                        success:function(data){
                             $('#Load_project_Explore').html(data);
                  
                        }

                    }); 
                 }

      }); 
   </script>


    <!--====== Vendor Js ======-->
       <script src="{{asset('/Frontend/assets/js/vendor.js')}}"></script>

       <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('/Frontend/assets/js/jquery.shopnav.js')}}"></script>

        <!--====== App ======-->
        <script src="{{asset('/Frontend/assets/js/app.js')}}"></script>
@endsection