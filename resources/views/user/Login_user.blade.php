@extends('User_layout')
@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="card " style="margin-top: 100px; padding: 40px;">
             <div class="text-center">
                     <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                      <h3 class="mt-0">LOGIN CINeb !!</h3>  
                    
               </div>      
                           @if($errors->any())
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Error - </strong> {{$errors->first()}}
                                </div>
                            @endif
                       
                <form action="{{url('/PostLoginUser')}}" method="post">
                         @csrf
                         
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" placeholder="Enter your email">
                                 @error('email')
                                 <span style="color: red;">{{ $message }}</span>
                                 @enderror
                            </div>
                            <div class="mb-3">
                                <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                                <label for="password" class="form-label">Password</label>       
                                    <div class="input-group input-group-merge">                                         
                                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                 
                                 <div class="input-group-text" data-password="false">
                                   <span class="password-eye"></span>
                                 </div>
                                 </div> 
                                    @error('password')
                                 <span style="color: red;">{{ $message }}</span>
                                 @enderror 
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remembers" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                                @if (\Session::has('message'))
                                    <div class="alert alert-dancer">
                                        
                                        {!! \Session::get('message') !!}
                                       
                                    </div>
                                @endif
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

    </div>
    </div>
    <div class="col-sm-4"></div>
    
</div>



@endsection