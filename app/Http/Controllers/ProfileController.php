<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Session;
use DB;
use App\tb_user;
use App\tb_order_of_user;
use App\tb_order_of_store;
use App\tb_store;
use App\tb_shipping_order;
use App\tb_detail_order;
use App\tb_product_store;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\tb_comment_post;
use App\tb_post;
use App\tb_follow_user;


class ProfileController extends Controller
{

     public function index(){
        $idusser = Auth::user()->id;
        $login = tb_user::where('id',$idusser)->get();


         $follow = tb_follow_user::where('id_user',$idusser)->get()->count();
         $followed = tb_follow_user::where('id_friends',$idusser)->get()->count();

       return view('user.page.My_profile')
        ->with('follow',$follow)
        ->with('followed',$followed)
        ->with('idusserssss',$login);

     }



 

      public function saveprofile (Request $request){
        $data = array();
        $idusser = Auth::user()->id;
        $data['email'] = $request->email;
        $data['phone_user'] = $request->phone;
        $data['name'] = $request->nickname;
        $data['birthday'] = $request->date;
        $imgass = $request->myPhoto;
   

        // $path = 'public/uploads/profile';
        if($imgass == null){
          tb_user::where('id', $idusser)->update($data);
        }else{

            $get_name_image = rand(0,99). '_' .$imgass->getClientOriginalName();

                if (!is_dir(public_path('/uploads/profile/' . Auth::user()->id))) {
                    mkdir(public_path('/uploads/profile/' . Auth::user()->id));
                }

             // $name_image = current(explode('.',$get_name_image));
            // $get_image->move($path,$new_image);
             $path = public_path('uploads/profile/' . Auth::user()->id . '/' . $get_name_image);

             Image::make($imgass->getRealPath())->fit(150, 150)->save($path);


            $data['image_user'] = $get_name_image;
            tb_user::where('id', $idusser)->update($data);
        
        }
           

        return Redirect::to('MyProfile');
    }
/////////////////// load My project /////////////////////////
    public function load_myProiect(){
         $idusser = Auth::user()->id;
      $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
      ->join('users', 'tb_post.id_user','=','users.id')
      ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
      ->where('tb_post.id_user', $idusser)
      ->orderby('tb_post.id_post','DESC')
      ->get();  

     if($load_project->count() >0){
        $output='';
         foreach($load_project as $key => $vid){
             $count_cm = tb_comment_post::where('id_post', $vid->id_post)->get()->count();
             $output .= '
                <div class="col-lg-4 col-md-6 col-sm-6"  style="margin-top: 30px;">
                    <div class="bp-mini bp-mini--img">
                                    <div class="bp-mini__thumbnail">

                                        <!--====== Image Code ======-->

                                        <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="'.url('/user_detail_post/'.$vid->id_post).'">

                                            <img class="aspect__img" src="'.asset('/uploadproject/'.$vid->image_post).'" alt=""></a>
                                        <!--====== End - Image Code ======-->
                                    </div>
                                    <div class="bp-mini__content">
                                        <div class="bp-mini__stat">

                                          
                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__publish-date">
                                                <a><span>Time: '.$vid->time_create.'</span></a></span></span>
                                                <br>

                                            <span class="bp-mini__stat-wrap">
                                                     
                                                <span class="bp-mini__preposition">Field: </span>

                                                <span class="bp-mini__author">

                                                    <a>'.$vid->name_field.'</a></span></span>

                                            <span class="bp-mini__stat">

                                                <span class="bp-mini__comment">

                                                    <a ><i class="far fa-comments u-s-m-r-4"></i>

                                                        <span>'.$count_cm.'</span></a></span></span></div>
                                        <div class="bp-mini__category">

                                            <a>'.$vid->hastag_post.'</a></div>

                                        <span class="bp-mini__h1">

                                            <a href="'.url('/user_detail_post/'.$vid->id_post).'">'.$vid->title_post.'</a></span>
                                        <p class="bp-mini__p name_prouctxxs" >'.$vid->desc_post.'</p>
                                        <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend</a>
                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend1</a>

                                       </div>
                                    </div>
                                </div>           
                    
                 </div>
            ';
         }

     }else{

     }
     echo $output;


   
  
  }

    public function load_save_project(){
       $idusser = Auth::user()->id;
      $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
      ->join('users', 'tb_post.id_user','=','users.id')
      ->join('tb_save_post', 'tb_post.id_post','=','tb_save_post.id_post')
      ->select('tb_post.*','tb_save_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
      ->where('tb_save_post.id_user',$idusser)
      ->orderby('tb_post.id_post','DESC')
      ->get();  

     if($load_project->count() >0){
        $output='';
         foreach($load_project as $key => $vid){
       
             $count_cm = tb_comment_post::where('id_post', $vid->id_post)->get()->count();
             $output .= '
                <div class="col-lg-4 col-md-6 col-sm-6"  style="margin-top: 30px;">
                    <div class="bp-mini bp-mini--img">
                                    <div class="bp-mini__thumbnail">

                                        <!--====== Image Code ======-->

                                        <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="'.url('/user_detail_post/'.$vid->id_post).'">

                                            <img class="aspect__img" src="'.asset('/uploadproject/'.$vid->image_post).'" alt=""></a>
                                        <!--====== End - Image Code ======-->
                                    </div>
                                    <div class="bp-mini__content">
                                        <div class="bp-mini__stat">

                                          
                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__publish-date">
                                                <a><span>Time: '.$vid->time_create.'</span></a></span></span>

                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__preposition">Field: </span>

                                                <span class="bp-mini__author">

                                                    <a>'.$vid->name_field.'</a></span></span>

                                            <span class="bp-mini__stat">

                                                <span class="bp-mini__comment">

                                                    <a ><i class="far fa-comments u-s-m-r-4"></i>

                                                        <span>'.$count_cm.'</span></a></span></span></div>
                                        <div class="bp-mini__category">

                                            <a>'.$vid->hastag_post.'</a></div>

                                        <span class="bp-mini__h1">

                                            <a href="'.url('/user_detail_post/'.$vid->id_post).'">'.$vid->title_post.'</a></span>
                                        <p class="bp-mini__p name_prouctxx">'.$vid->desc_post.'</p>
                                        <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend</a>
                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="">Hagtag_trend1</a>

                                       </div>
                                    </div>
                                </div>           
                    
                 </div>
            ';
         }

     }else{

     }
     echo $output;


   
  
  }





  //////////////////page my Store /////////////////////////////
 public function Load_info_store(Request $request){
           $id_user = Auth::user()->id;
           $load_idstore = DB::table('tb_store')->where('id_user', $id_user)->first();
           $id_store = $load_idstore->id_store;

          $store = tb_store::where('id_store',$id_store)
         ->join('users','users.id','=','tb_store.id_user')
         ->join('tb_business_areas','tb_business_areas.id_areas','=','tb_store.Category_store')
         ->get();

         $count_pro_store = tb_product_store::select('id_product')->where('id_store',$id_store)->get()->count();
     

         $count_order_store = tb_order_of_store::select('id_order_store')->where('id_store',$id_store)->get()->count();
         
        $output['qty_pro_sto'] = $count_pro_store;
        $output['qty_order_store'] = $count_order_store;  

        foreach($store as $key => $store){
        $output['name_store'] = $store->name_store; 
        $output['phone_store'] = $store->phone_store;
        $output['address_store'] = $store->address_store;
        $output['time_add'] = $store->time_add;
        $output['desc_store'] = $store->desc_store;
        

        $output['image_store'] = '<img  width="150" height="150" alt="image" src="'.asset('/uploads/store/'.$store->avt_store).'" 
        class="rounded-circle avatar-md img-thumbnail" />';

        }
      
        echo json_encode($output);     
  }
  



  public function load_my_order_profile (Request $request){
         $id_user = Auth::user()->id;

         $load_od = tb_order_of_user::where('id_user', $id_user)->orderby('id_order_user', "DESC")->get();
         if($load_od->count()>0){
             $output ='';
           foreach($load_od as $key => $vid){
           $output.='<div class="card mb-0" style="margin-top: 15px">
                           <div class="card-body">
                                   <div class="row justify-content-sm-between mt-2">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="task3">
                                                              Order code:   '.$vid->order_code.' 
                                                            </label>
                                                        </div> <!-- end checkbox -->
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between">
                                                            <div id="tooltip-container2">
                                                          
                                                            </div>
                                                            <div>
                                                                <ul class="list-inline font-13 text-end mb-0">
                                                                   
                                                                    <li class="list-inline-item ms-1">
                                                                        <i class="uil uil-align-alt font-16 me-1"></i> '.$vid->time_order.' 
                                                                    </li>
                                                             
                                                              
                                                                      <li class="list-inline-item ms-2">
                                                                        <span class="badge badge-info-lighten p-1"> '.$vid->method_payment.' </span>
                                                                      </li>

                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
                                                </div>

                                               <hr>';
                         $loadorder_store = tb_order_of_store::where('id_order_user', $vid->id_order_user)->get();
                                foreach($loadorder_store as $key => $vid2){

                                     $output .='  <!-- end task -->
                                                               <div class="row">
                                                                    <div class="col-lg-9">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                             <div class="table-responsive">
                                                                                    <table class="table mb-0">
                                                                                    <thead class="table-light">
                                                                                            <tr>
                                                                                                <th>Item</th>
                                                                                                <th>type product</th>
                                                                                                <th>Quantity</th>
                                                                                                <th>Price</th>
                                                                                                <th>Total</th>
                                                                                            </tr>
                                                                                        </thead>

                                                                                        <tbody>
                                                                                        ';
                          
         $itemd_order = tb_detail_order::where('tb_detail_order.id_store', $vid2->id_store)->where('tb_detail_order.id_order_user', $vid2->id_order_user)
        ->join('tb_product_store','tb_detail_order.id_product','=','tb_product_store.id_product')
        ->select('tb_detail_order.id_product','tb_detail_order.qty_product','tb_detail_order.price_product','tb_detail_order.type_pro','tb_detail_order.price_items','tb_detail_order.name_type','tb_detail_order.name_size',
                  'tb_product_store.name_product','tb_product_store.image_product')->get();

        $sum_qty = tb_detail_order::where('id_store', $vid2->id_store)->where('id_order_user', $vid2->id_order_user)->sum('qty_product');
        $tottal_od = tb_detail_order::where('tb_detail_order.id_store', $vid2->id_store)->where('tb_detail_order.id_order_user', $vid2->id_order_user)->sum('price_items');
                                                                           foreach($itemd_order as $key => $vid3){    
                                                                                 $output .='
                                                                                        <tr>
                                                                                            <td> <img src="'.asset('/uploadproduct/'.$vid3->image_product).'" class="img-thumbnail" width="40" height="40">'.$vid3->name_product.'</td>';

                                                                                    if ($vid3->type_pro == 0 ) {
                                                                                        $output .=' <td> </td>  ';
                                                                                    }else if ($vid3->type_pro == 1 ) {
                                                                                      $output .=' <td>'.$vid3->name_type.' </td>  ';
                                                                                    }else  if ($vid3->type_pro == 2 ) {
                                                                                     
                                                                                   $output .=' <td>'.$vid3->name_type.', '.$vid3->name_size.'</td>  ';
                                                                                    }


                                                                                    $output .='
                                                                                             <td>'.$vid3->qty_product.'</td>
                                                                                            <td>$'.$vid3->price_product.'</td>
                                                                                            <td>$'.$vid3->price_items.'</td>
                                                                                        </tr> 
                                                                                        ';
                                                                                   } 
                                                                                  $output .=' </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <!-- end table-responsive -->
                                                    
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                
                                                                    <div class="col-lg-3">
                                                                        <div class="card">
                                                                            <div class="card-body">'; 
                                                                        if($vid2->order_status == 0) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                               <span class="badge badge-warning-lighten">Processing</span>
                                                                             </h2>  ';
                                                                             

                                                                        }else if($vid2->order_status == 1) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                           <span class="badge badge-info-lighten">Packed</span>
                                                                             </h2>  ';
                                                                             

                                                                        }else if($vid2->order_status == 2) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                            <span class="badge badge-primary-lighten">Shipped</span>
                                                                             </h2>  ';
                                                                             

                                                                        }else if($vid2->order_status == 3) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                              <span class="badge badge-success-lighten">Delivered</span>
                                                                             </h2>  ';
                                                                             

                                                                        }else if($vid2->order_status == 4) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                              <span class="badge badge-danger-lighten">Cancelled</span>
                                                                             </h2>  ';
                                                                             

                                                                        }else if($vid2->order_status == 5) {
                                                                             $output .='
                                                                            <h2 class="header-title mb-3">
                                                                             <span class="badge badge-success-lighten">Paid</span>
                                                                             </h2>  ';
                                                                             

                                                                        }
                                                                          
                                                                            
                                                                             
                                                                       $output .='
                                                                                <div class="table-responsive">
                                                                                    <table class="table mb-0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Quality: </td>
                                                                                            <td>'.$sum_qty.'</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Total:</th>
                                                                                            <th>$'.$tottal_od.'</th>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                    
                                                                            </div>
                                                                               <button type="button" data-id_order_store="'.$vid2->id_order_store.'" class="btn btn-outline-info btn_view_detail_od">View</button>
                                                                                <!-- end table-responsive -->
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                                     <hr>
                                                                </div>
                                                        </div> <!-- end card-body-->       

                                             </div>

                                    ';

                                }
                                         
           }

         }else{


         $output .='';
         }
    
   
        echo $output;
    }

     public function load_my_order_status_profile (Request $request){
      
       $id_user = Auth::user()->id;
         $load_od = tb_order_of_user::where('id_user', $id_user)->orderby('id_order_user', "DESC")->get();         
         if($load_od->count()>0){  
          $output ='';      
           foreach($load_od as $key => $vid){
               $checkst = tb_order_of_store::where('id_order_user', $vid->id_order_user)->where('order_status', $request->status)->get();
                 if($checkst->count()>0){
                  $output.='<div class="card mb-0" style="margin-top: 15px">
                           <div class="card-body">
                                   <div class="row justify-content-sm-between mt-2">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="task3">
                                                              Order code:   '.$vid->order_code.' 
                                                            </label>
                                                        </div> <!-- end checkbox -->
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between">
                                                            <div id="tooltip-container2">
                                                          
                                                            </div>
                                                            <div>
                                                                <ul class="list-inline font-13 text-end mb-0">
                                                                   
                                                                    <li class="list-inline-item ms-1">
                                                                        <i class="uil uil-align-alt font-16 me-1"></i> '.$vid->time_order.' 
                                                                    </li>
                                                             
                                                              
                                                                      <li class="list-inline-item ms-2">
                                                                        <span class="badge badge-info-lighten p-1"> '.$vid->method_payment.' </span>
                                                                      </li>

                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
                                                </div>

                                               <hr>';
                             $loadorder_store = tb_order_of_store::where('id_order_user', $vid->id_order_user)->where('order_status', $request->status)->get();
                                foreach($loadorder_store as $key => $vid2){

                                     $output .='  <!-- end task -->
                                                               <div class="row">
                                                                    <div class="col-lg-9">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                             <div class="table-responsive">
                                                                                    <table class="table mb-0">
                                                                                    <thead class="table-light">
                                                                                            <tr>
                                                                                                <th>Item</th>
                                                                                                <th>type product</th>
                                                                                                <th>Quantity</th>
                                                                                                <th>Price</th>
                                                                                                <th>Total</th>
                                                                                            </tr>
                                                                                        </thead>

                                                                                        <tbody>
                                                                                        ';
                          
         $itemd_order = tb_detail_order::where('tb_detail_order.id_store', $vid2->id_store)->where('tb_detail_order.id_order_user', $vid2->id_order_user)
        ->join('tb_product_store','tb_detail_order.id_product','=','tb_product_store.id_product')
        ->select('tb_detail_order.id_product','tb_detail_order.qty_product','tb_detail_order.price_product','tb_detail_order.type_pro','tb_detail_order.price_items','tb_detail_order.name_type','tb_detail_order.name_size',
                  'tb_product_store.name_product','tb_product_store.image_product')->get();

        $sum_qty = tb_detail_order::where('id_store', $vid2->id_store)->where('id_order_user', $vid2->id_order_user)->sum('qty_product');
        $tottal_od = tb_detail_order::where('tb_detail_order.id_store', $vid2->id_store)->where('tb_detail_order.id_order_user', $vid2->id_order_user)->sum('price_items');
                                                                               foreach($itemd_order as $key => $vid3){    
                                                                               $output .='
                                                                                        <tr>
                                                                                            <td> <img src="'.asset('/uploadproduct/'.$vid3->image_product).'" class="img-thumbnail" width="40" height="40">'.$vid3->name_product.'</td>';

                                                                                    if ($vid3->type_pro == 0 ) {
                                                                                        $output .=' <td> </td>  ';
                                                                                    }else if ($vid3->type_pro == 1 ) {
                                                                                      $output .=' <td>'.$vid3->name_type.' </td>  ';
                                                                                    }else  if ($vid3->type_pro == 2 ) {
                                                                                     
                                                                                   $output .=' <td>'.$vid3->name_type.', '.$vid3->name_size.'</td>  ';
                                                                                    }


                                                                                    $output .='
                                                                                             <td>'.$vid3->qty_product.'</td>
                                                                                            <td>$'.$vid3->price_product.'</td>
                                                                                            <td>$'.$vid3->price_items.'</td>
                                                                                        </tr> 
                                                                                        ';
                                                                                   } 
                                                                                  $output .=' </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <!-- end table-responsive -->
                                                    
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                
                                                                    <div class="col-lg-3">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                   
                                                                            <h2 class="header-title mb-3">';

                                                                            if ($request->status == 1 ) {

                                                                            $output .='<span class="badge badge-warning-lighten">Packed</span>';
                                                                            }else if ($request->status == 2 ) {

                                                                           $output .='<span class="badge badge-primary-lighten">Shipped</span>';
                                                                            }else  if ($request->status == 3 ) {
                                                                                     
                                                                            $output .='<span class="badge badge-success-lighten">Delivered</span>';
                                                                            }else  if ($request->status ==  4) {
                                                                                     
                                                                            $output .='<span class="badge badge-danger-lighten">Cancelled</span>';
                                                                            }else  if ($request->status ==  5) {
                                                                                     
                                                                            $output .='<span class="badge badge-success-lighten">Paid</span>';
                                                                            }


                                                                         $output .='
                                                                          
                                                                             </h2> 
                                                                                <div class="table-responsive">
                                                                                    <table class="table mb-0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>Quality: </td>
                                                                                            <td>'.$sum_qty.'</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Total:</th>
                                                                                            <th>$'.$tottal_od.'</th>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                    
                                                                            </div>
                                                                            <button type="button" data-id_order_store="'.$vid2->id_order_store.'" class="btn btn-outline-info btn_view_detail_od_status">View</button>
                                                                                <!-- end table-responsive -->
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                                     <hr>
                                                                </div>
                                                        </div> <!-- end card-body-->       

                                             </div>

                                    ';

                                }
                         }                 
               }
 
         }else{

          $output.='ajsdkadj';

         }
    
   
        echo $output;


    }



    public function load_detail_order_my_pro(Request $request){

       $loadorder_store = tb_order_of_store::where('id_order_store', $request->id_order_store)
       ->select('id_store','id_order_user','order_status')->first();
       $ifor_store = tb_store::where('id_store', $loadorder_store->id_store)
       ->select('name_store')->first();

       $method_pay = tb_order_of_user::where('id_order_user', $loadorder_store->id_order_user)->select('method_payment','order_code','time_order')->first();

         $info_shipping = tb_shipping_order::where('id_order_user', $loadorder_store->id_order_user)->first();
           $output ='';
                   if($loadorder_store->order_status == 0){
                        $output .='
                       <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-11">
        
                                <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                    <div class="horizontal-steps-content">
                                        <div class="step-item st1 current" >
                                            <span class="time_ordersx" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                        </div>
                                        <div class="step-item st2">
                                            <span>Packed</span>
                                        </div>
                                        <div class="step-item st3">
                                            <span data-bs-container="#tooltip-container">Shipped</span>
                                        </div>
                                        <div class="step-item st4">
                                            <span>Delivered</span>
                                        </div>
                                    </div>
        
                                    <div class="process-line" style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>
                 
                        ';
                      }else if($loadorder_store->order_status == 1){
                        $output .='
                       <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-11">
        
                                <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                    <div class="horizontal-steps-content">
                                        <div class="step-item st1 " >
                                            <span class="time_ordersx" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                        </div>
                                        <div class="step-item st2 current">
                                            <span>Packed</span>
                                        </div>
                                        <div class="step-item st3">
                                            <span data-bs-container="#tooltip-container">Shipped</span>
                                        </div>
                                        <div class="step-item st4">
                                            <span>Delivered</span>
                                        </div>
                                    </div>
        
                                    <div class="process-line" style="width: 33%;"></div>
                                </div>
                            </div>
                          </div>
                 
                        ';
                      }else if($loadorder_store->order_status == 2){
                          $output .='
                           <div class="row justify-content-center">
                                <div class="col-lg-7 col-md-10 col-sm-11">
            
                                    <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                        <div class="horizontal-steps-content">
                                            <div class="step-item st1 " >
                                                <span class="time_ordersx" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                            </div>
                                            <div class="step-item st2 ">
                                                <span>Packed</span>
                                            </div>
                                            <div class="step-item st3 current">
                                                <span data-bs-container="#tooltip-container">Shipped</span>
                                            </div>
                                            <div class="step-item st4">
                                                <span>Delivered</span>
                                            </div>
                                        </div>
            
                                        <div class="process-line" style="width: 66%;"></div>
                                    </div>
                                </div>
                              </div>
                 
                        ';
                      }else if($loadorder_store->order_status == 3){
                         $output .='
                           <div class="row justify-content-center">
                                <div class="col-lg-7 col-md-10 col-sm-11">
            
                                    <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                        <h3 class="st_3" style="text-align: center;"><span class="badge badge-success-lighten">
                                        <i class="mdi mdi-check-underline"></i>Delivered Succecss</span></h3>
                                        <div class="horizontal-steps-content">
                                            <div class="step-item st1 " >
                                                <span class="time_ordersx" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                                            </div>
                                            <div class="step-item st2 ">
                                                <span>Packed</span>
                                            </div>
                                            <div class="step-item st3 ">
                                                <span data-bs-container="#tooltip-container">Shipped</span>
                                            </div>
                                            <div class="step-item st4 current">
                                                <span>Delivered</span>
                                            </div>
                                        </div>
            
                                        <div class="process-line" style="width: 100%;"></div>
                                    </div>
                                </div>
                              </div>
                 
                        ';
                      }
                      else if($loadorder_store->order_status == 4){
                         $output .='
                           <div class="row justify-content-center">
                                   <h3 class="st_4" style="text-align: center;"><span class="badge badge-danger-lighten">
                                        <i class="mdi mdi-exclamation-thick"></i>Cancelled</span></h3>

                              </div>
                 
                        ';
                      }
                      else if($loadorder_store->order_status == 5){
                         $output .='
                             <div class="row justify-content-center">
                                         <h3 class="st_5" style="text-align: center;"><span class="badge badge-success-lighten">
                                        <i class="mdi mdi-cancel"></i>Paid</span></h3>
                        
                              </div>
                 
                        ';
                      }

         $output .='
                       <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Shipping Information</h4>

                                        <h5>'.$info_shipping->name_shipping.'</h5>
                                        
                                        <address class="mb-0 font-14 address-lg">
                                           '.$info_shipping->desc_address_ship.',   '.$info_shipping->address_ship.'<br>
                                            
                                            <abbr title="Phone">P: </abbr>  '.$info_shipping->phone_order.'<br>
                                            <abbr title="Mobile">M: </abbr>   '.$info_shipping->email_user.'
                                        </address>
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Billing Information</h4>

                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span> <span class="method_order">'.$method_pay->method_payment.'</span></p>
                                                <p class="mb-2"><span class="fw-bold me-2">Provider:</span><span class="name_store">'.$ifor_store->name_store.'</span></p>
                                                <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span><span class="time_order">'.$method_pay->time_order.'</span></p>
                                                <p class="mb-0"><span class="fw-bold me-2">CVV:</span> xxx</p>
                                            </li>
                                        </ul>
            
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Delivery Info</h4>
            
                                        <div class="text-center">
                                            <i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b>UPS Delivery</b></h5>
                                            <p class="mb-1"><b>Order ID :</b>xxx<span class="coder_order">'.$method_pay->order_code.'</span></p>
                                            <p class="mb-0"><b>Payment Mode :</b> <span class="method_order">'.$method_pay->method_payment.'</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                 
                        ';


           echo $output;    
   
   }


}




