 <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                 <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                    <div class="offcanvas-body">
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
                                        </div>
                                    </div>
                                </div>
                                <!-- end profile info -->
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

{{--                                  <hr class="m-0">
                                        <h4 class="header-title mb-1">Trending</h4>
 --}}
{{--                                        @foreach($load_project_trend as $key => $vid)
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
                                      @endforeach --}}
            
           </div>
       </div>


                        