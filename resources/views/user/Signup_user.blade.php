@extends('User_layout')
@section('content')
 <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        
            <div class="card" style="margin-top: 100px;">
                <div class="text-center">
                     <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                      <h3 class="mt-0">SIGNUP ACCOUNT !</h3>   
          
               </div>
                        <div class="card-body">
                                        <form  action="{{url('/PostSignupUser')}}" method="post">
                                                @csrf


                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email1">NickName</label>
                                                                    <div class="col-md-9">
                                                                        <input required="" type="text" placeholder="Enter your nickname" id="email1" name="nickname" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="userName1">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" placeholder="Enter your email" id="userName1" name="email" value="">
                                                                        @error('email')
                                                                            <span style="color: red;">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="password1"> Password</label>
                                                                    <div class="col-md-9">
                                                                         <div class="input-group input-group-merge">
                                                                            <input required="" name="password" type="password" id="password" class="form-control" placeholder="Enter your password">
                                                                            <div class="input-group-text" data-password="false">
                                                                                <span class="password-eye"></span>
                                                                            </div>

                                                                             @error('password')
                                                                            <span style="color: red;">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="confirm1" >Re Password</label>
                                                                    <div class="col-md-9">
                                                                            <div class="input-group input-group-merge">
                                                                                <input type="password" name="repassword" id="password" class="form-control" placeholder=" Comfirm Enter your password">
                                                                                <div class="input-group-text" data-password="false">
                                                                                    <span class="password-eye"></span>
                                                                                </div>
                                                                               
                                                                            </div>
                                                                              @error('repassword')
                                                                                <span style="color: red;">{{ $message }}</span>
                                                                                @enderror
                                                                    </div>
                                                                </div>

{{--                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name1">Date of birth</label>
                                                                    <div class="col-md-9">
                                                                      <input required="" class="form-control" id="example-date" type="date" name="date">
                                                                
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname1">Phone</label>
                                                                    <div class="col-md-9">
                                                                        <input  type="text" id="surname1" name="phone" class="form-control" placeholder="Enter your phone" value="">
                                                                        
                                                                    </div>
                                                                     @error('phone')
                                                                                <span style="color: red;">{{ $message }}</span>
                                                                          @enderror
                                                                </div> --}}
                                        
                                                             

                                                                 <div class="row mb-3"> 
                                                                    <div class="col-md-12 text-center"> 
                                                                     <input hidden type="text" name="avt_user" value="avt_user.png">

                                                                    <button type="submit" class="btn btn-info"><i class="mdi mdi-cloud me-1"></i> <span>Signup</span> </button>
                                                                    </div>
                                                                </div>
                                                             


                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                  
                                            </form>
                                     
                           
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->


    </div>
    <div class="col-sm-4"></div>
</div>
@endsection