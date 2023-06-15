@extends('User_layout')
@section('content')

<div class="row" style="position: flex;">
     <div class="col-xl-1 ">
    </div>
    <div class="col-xl-3 " >
         <div class="row">
                <div class="col-12">     
                  @include('user.include.sidebar_profile')      
               </div>
          </div>     
     
    </div>
       <div class="col-xl-7">
       <div class="row" id="content_profile">
                     
                              

       </div>



    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
     
    });

</script>



<style type="text/css">
             .drop-containerss {
              position: relative;
              display: flex;
              gap: 10px;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              height: 200px;
              padding: 20px;
              border-radius: 10px;
              border: 2px dashed #555;
              color: #444;
              cursor: pointer;
              transition: background .2s ease-in-out, border .2s ease-in-out;
            }
        
            .drop-containerss:hover {
              background: #eee;
              border-color: #111;
            }

            .drop-containerss:hover .drop-title {
              color: #222;
            }

            .drop-title {
              color: #444;
              font-size: 20px;
              font-weight: bold;
              text-align: center;
              transition: color .2s ease-in-out;
            }
</style>





@endsection