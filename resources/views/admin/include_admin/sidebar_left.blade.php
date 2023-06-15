   <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="{{URL::to('admin')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                    <img src="{{asset('/Image/logono.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('/backend/assets/images/logo_sm.png')}}" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('/backend/assets/images/logo-dark.png')}}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('/backend/assets/images/logo_sm_dark.png')}}" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar="">

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                 
					   
                         <li class="side-nav-item">
                            <a href="{{URL::to('/ShowDashboardAdmin')}}" class="side-nav-link">
                                <i class="uil-chart-line"></i>
                                <span> Analytics </span>
                            </a>
                        </li>

{{--                         <li class="side-nav-item">
                            <a href="apps-calendar.html" class="side-nav-link">
                                <i class="uil-chart-growth"></i>
                                <span> CRM </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="apps-calendar.html" class="side-nav-link">
                                <i class="uil-chart-pie-alt"></i>
                                <span> Ecommerce </span>
                            </a>
                        </li> --}}

                        <li class="side-nav-item">
                            <a href="{{URL::to('/Project_management')}}" class="side-nav-link">
                                <i class="uil-lightbulb-alt"></i>
                                <span> Projects </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{URL::to('/Catalog_management')}}" class="side-nav-link">
                                <i class="uil-server"></i>
                                <span> Catalog management </span>
                            </a>
                        </li>
                         <li class="side-nav-item">
                            <a href="{{URL::to('/store_manager')}}" class="side-nav-link">
                                <i class=" uil-shop"></i>
                                <span> store manager </span>
                            </a>
                          <li>
                 {{--           <li class="side-nav-item">
                            <a href="{{URL::to('/slide_manager')}}" class="side-nav-link">
                                <i class=" uil-image-resize-square"></i>
                                <span> Slide manager </span>
                            </a>
                          <li>
                   --}}
                    

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span> Ecommerce </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{URL::to('/Product_management')}}">Products</a>
                                    </li>

                                    
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{URL::to('/user_management')}}" class="side-nav-link">
                                <i class="uil-rss"></i>
                                <span>User Social</span>
                            </a>
                        </li>

			

                  
            
                        <li class="side-nav-title side-nav-item mt-1">Support</li>

						<li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-comments-alt"></i>
                                <span> Chat </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="widgets.html" class="side-nav-link">
                                <i class="uil-layer-group"></i>
                                <span> FAQ</span>
                            </a>
                        </li>

                       <li class="side-nav-item">
                            <a href="{{URL::to('/')}}" class="side-nav-link">
                                <i class="uil-arrow-from-right"></i>
                                <span> Come Back CINeb</span>
                            </a>
                        </li>
                    </ul>

               

                </div>
                <!-- Sidebar -left -->

            </div>