<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Log In | Admin CINeb</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/images/favicon.ico')}}">

        <!-- App css -->

                <!-- App css -->
        <link rel="stylesheet" type="text/css" id="light-style" href="{{asset('/backend/assets/css/icons.min.css')}}">
        <link rel="stylesheet" type="text/css" d="light-style" href="{{asset('/backend/assets/css/app.min.css')}}">
        <link rel="stylesheet" type="text/css" id="dark-style" i href="{{asset('/backend/assets/css/app-dark.min.css')}}">

    </head>

    <body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a href="index.html" class="logo-dark">
                                <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50">
                            </a>
                            <a href="index.html" class="logo-light">
                                <span>  <img src="{{asset('/Image/logoweb.jpg')}}" alt="" height="50"></span>
                            </a>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">Login Admin</h4>
                        <p class="text-muted mb-4">

                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert" sty>'.$message.'</span>';
                                Session::put('message', null);
                            }
                            ?>
                        </p>

                        <!-- form -->
                   <form action="{{url('/LoginAdmin')}}" method="post">
                         @csrf
                         
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email_admin" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" name="admin_password" required="" id="password" placeholder="Enter your password">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
                            </div>

                            <!-- social-->
                            <div class="text-center mt-4">
                                <p class="text-muted font-16">Sign in with</p>
                                <ul class="social-list list-inline mt-3">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                   {{--      <footer class="footer footer-alt">
                            <p class="text-muted">Don't have an account? <a href="pages-register-2.html" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </footer> --}}

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">well come to admin !</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> creative community, e-commerce! . <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>
                        - CINeb Admin User
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- bundle -->
       <script src="{{asset('/backend/assets/js/vendor.min.js')}}"></script>
       <script src="{{asset('/backend/assets/js/app.min.js')}}"></script>
    </body>

</html>