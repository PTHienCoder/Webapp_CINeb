@extends('MangerStore_Layout')
@section('content')

<div class="row">
	 <div class="page-title-box">
        <h4 class="page-title">Edit Products</h4>
      </div>
	<div class="col-sm-12">
		<div class="card">

			<div class="tab-content">
			            <div class="card-body">
                            @foreach($load_pro as $key => $load_pro)
                             
                                                              
                                <form action="{{URL::to('/save_update_product_store ')}}" method="post" enctype='multipart/form-data'>
                                            {{ csrf_field() }}

                                <input type="hidden" value="{{$load_pro->id_product}}" name="id_product"  class="form-control">
                                <input type="hidden" value="{{$load_pro->type_product}}" name="type_product"  class="form-control type_product">
                          
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="projectname" class="form-label">Name product</label>
                                                    <input required type="text" value="{{$load_pro->name_product}}" name="name_product"  class="form-control" placeholder="Enter project name">
                                                </div>

                                               <div class="aasdadasd">    
                                               
                                                <div class="mb-3">
                                                    <label for="project-overview" class="form-label">Price product</label>
                                                    <input value="{{$load_pro->price_product}}" min=0 type="number" class="form-control" 
                                                    name="price_product" >
                                                </div>
                                                 <div class="mb-3">
                                                    <label for="project-overview" class="form-label">Quality product</label>
                                                    <input value="{{$load_pro->qty_product}}" min=0 type="number" class="form-control"
                                                     name="quality_product" >
                                                </div>
                                               </div>

                                             <div class="mb-3">
                                                    <label for="project-overview" class="form-label">Hastag product</label>
                                                    <input  value="{{$load_pro->hastag_product}}" type="text" class="form-control" name="hastag_product" >
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-xl-6">
                                                <div class="mb-3 mt-3 mt-xl-0">
                                                   <label for="project-budget"class="form-label">Category</label>
                                                    <!-- Single Select -->
                                                     <select  name="cate_product" class="form-select mb-3">
                                                        @foreach($load_cate as $key => $load_cate)
                                                          @if($load_cate->id_cate_product==$load_pro->id_cate_store) 

				                                             <option selected value="{{$load_cate->id_cate_product }}">                  
                                                             {{$load_cate->name_cate_product}}
                                                            </option>

				                                            @else

				                                            <option selected value="{{$load_cate->id_cate_product }}">                  
                                                             {{$load_cate->name_cate_product}}
                                                            </option>
				                                            @endif

                                                         @endforeach
                                                         
                                                        </select>

                                               
                                                </div>

                                   
                                               <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Image post</label>
                                                      <span class="text-muted">
                                                        (size image 300 x 300 )
                                                    </span>
                                                   
                                                   <input type="file" accept="image/*" name="image_post" id="uploadImage"  onchange="PreviewImage();" class="form-control">

                                                 
                                                </div>
                                               <div class="mb-3">
                                                     <img src="{{asset('/uploadproduct/'.$load_pro->image_product)}}" style="height: 100px;" alt="" id="uploadPreview" class="img-fluid">
                                                     <input required type="hidden" value="{{$load_pro->image_product}}" name="image_product_update"  class="form-control">
                                                 
                                                </div>


                                            </div> <!-- end col-->
                                        </div>
             
                                            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
                                              <script type="text/javascript">
                                              	 function PreviewImage() {
				                                    var oFReader = new FileReader();
				                                    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

				                                    oFReader.onload = function (oFREvent) {
				                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
				                                    };
				                                  };



                                                </script>



                                           <div class="row">

                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Detail project</label>

                                                     <textarea style="resize: none" rows="8" class="form-control" name="desc_product"  id="ckeditor111" placeholder="Nội dung sản phẩm">  {{$load_pro->desc_product}}</textarea>
                                                          
                                                </div>

                                                <div class="mb-3 position-relative" id="datepicker2">
                                                    <label class="form-label">Detail Products</label>

                                                     <textarea style="resize: none" rows="8" class="form-control" name="details_product"  id="ckeditor2222" placeholder="Nội dung sản phẩm">{{$load_pro->details_product}}</textarea>
                                                          
                                                </div>
   
   
                                         <button type="submit" class="btn btn-primary btn-lg">Update</button>

                                       </div>
                              </form>


                                  @endforeach
                           </div>
			    
			</div>


		</div>


	</div>

</div>
<script type="text/javascript">
      $(document).ready(function(){
          $('.aasdadasd').hide();
       if($('.type_product').val() == 0){
           $('.aasdadasd').show();

       }else{
          $('.aasdadasd').hide();
       }


     });
</script>

    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript">

        CKEDITOR.replace('ckeditor2222',{


        filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
        // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form',


        });

        CKEDITOR.replace('ckeditor111',{

        filebrowserImageUploadUrl : "{{ url('uploads_ckeditor?_token='.csrf_token()) }}",
        // filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form',


        });
       </script>


@endsection