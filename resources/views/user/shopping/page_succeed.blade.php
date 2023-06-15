@extends('Shopping_layout')
@section('content')
 <div class="app-content app" style="margin-top: 70px;">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 u-s-m-b-30">
                                <div class="empty">
                                    <div class="empty__wrap">

                                        <span class="empty__big-text"> <img src="{{asset('/uploads/icon_register_success.png')}}" alt="" height="100"></span>

                                        <span class="empty__text-1">Your search, did not match any products. A partial match of your keywords is listed below.</span>

                                        <span class="empty__text-2">Related searches:

                                            <a href="shop-side-version-2.html">men's clothing</a>

                                            <a href="shop-side-version-2.html">mobiles &amp; tablets</a>

                                            <a href="shop-side-version-2.html">books &amp; audible</a></span>
                                        <form class="empty__search-form">

                                            <label for="search-label"></label>

                                      

                                           <a class="empty__redirect-link btn--e-brand" href="{{url('/PageShopping')}}">CONTINUE SHOPPING</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 1 ======-->
        </div>


@endsection