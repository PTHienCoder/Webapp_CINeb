
<link rel="stylesheet" type="text/css" href="{{asset('/Frontend/slide_category.css')}}">

<div class="carousel-container">
  <div class="inner-carousel">
    <div class="track">

   @foreach($cate as $key => $cate)
     <div class="card-container category-o" style="margin-right: 10px;">
        <div class=" aspect aspect--bg-grey aspect--square category-o__img-wrap">
            <img alt="image" class="aspect__img category-o__img" src="{{url('/uploads/category/'.$cate->image_areas)}}">
            {{-- <h4 class="mb-0 mt-2">{{$cate->name_areas}}</h4> --}}
              <div class="category-o__info">
               <a class="category-o__shop-now btn--e-white-brand" 
                href="{{url('/category_product_pages/'.$cate->id_areas)}}">
                 {{$cate->name_areas}}
               </a>
             </div>
        </div>
      </div>
     
     @endforeach

    </div>
    <div class="nav_slide">
      <button class="prev"><i class="dripicons-chevron-left"></i></button>
      <button class="next"><i class="dripicons-chevron-right"></i></button>
    </div>
  </div>

</div>
<script type="text/javascript">
  


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