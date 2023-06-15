@extends('Admin_layout')

@section('sidebar-left')
  @include('admin.include_admin.sidebar_left')
@endsection

@section('navbar-top')
  @include('admin.include_admin.navbar_top')
@endsection
@section('contents')
<div class="row">
              <div class="col-12">
                                <div class="page-title-box">
                               
                                    <h4 class="page-title">User</h4>
                                </div>
                            </div>
                        </div>
      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                
                                        <div class="table-responsive">
                                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>User</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Create Date</th>
                                                        <th>Status</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($load_user as $key => $vid)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="table-user">
                                                          @if ($vid->image_user == 0)
                                                           <img  src="{{asset('/uploads/profile/avt_user.png')}}" alt="user-image" 
                                                           class="img-fluid rounded-circle" width="40">
                                                          @else
                                                            <img src="{{asset('/uploads/profile/'.$vid->id.'/'.$vid->image_user)}}" alt="table-user" class="me-2 rounded-circle">
                                                          @endif
                                                          
                                                            <a href="javascript:void(0);" class="text-body fw-semibold">{{$vid->name}}</a>
                                                        </td>
                                                        <td>
                                                         {{$vid->phone_user}}
                                                        </td>
                                                        <td>
                                                          {{$vid->email}}
                                                        </td>
                                                     
                                                        <td>
                                                           {{$vid->created_at}}
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-success-lighten">Active</span>
                                                        </td>
                    
                                                        <td>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>


@endsection