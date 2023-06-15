 <link rel="stylesheet" type="text/css" href="{{asset('/Frontend/profile.css')}}">
        
  <div class="sidebarpro" data-simplebar>
                 <!-- start profile info -->
                                <div class="">
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                             <a href="{{url('/')}}" 
                                            class="list-group-item list-group-item-action y border-0">
                                              <h4><i class='uil uil-home-alt me-1'></i> For you</h4> </a>

                                            <a href="{{url('/PagesVideo')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil uil-video me-1'></i> Video</h4></a>

                                            <a href="{{url('/PageShopping')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil  uil-shop me-1'></i> Shopping</h4></a>

                                            <a href="{{url('/PagesExplore')}}" class="list-group-item list-group-item-action border-0">
                                                <h4><i class='uil uil-users-alt me-1'></i> Explore</h4></a>
                                           {{--  <a href="javascript:void(0);" class="list-group-item list-group-item-action border-0">
                                                <i class='uil uil-copy me-1'></i> Trend</a> --}}
                                        </div>


                                     <hr class="m-0">

                                @if (!Auth::user())

                                    <p class="text-muted" style="margin-top:15px">
                                       Sign in to follow creators, like videos, view comments, and buy and sell products.
                                    </p>
                                    <a class="nav-link end-bar-toggle"  href="{{url('/LoginUser')}}">
                                      <div class="d-grid"> 
                                       <button type="button"  class="btn btn-outline-danger">
                                       <i class="mdi mdi-account-circle-outline"></i> Login</button>
                                     </div>

                                    </a>
                       
                               @endif

                                 <hr class="m-0">
                                        <h4 class="header-title mb-1">Trending</h4>

                                    @foreach($load_project_trend as $key => $vid)
                                        <div class="d-flex mt-3">
                                            <i class='uil uil-arrow-growth me-2 font-18 text-primary'></i>
                                            <div>
                                                <a class="mt-1 font-14" href="{{url('/user_detail_post/'.$vid->id_post)}}">
                                                    <strong>{{$vid->title_post}}:</strong>
                                                    <span class="text-muted">
                                                       {{$vid->desc_post}}
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
             <!-- end profile info -->
                         
    </div>
 </div>