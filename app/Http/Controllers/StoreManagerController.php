<?php

namespace App\Http\Controllers;

use App\Mail\Order_Success;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\tb_store;
use App\tb_product_store;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_order_of_store;
use App\tb_order_of_user;
use App\tb_detail_order;
use App\tb_shipping_order;
use App\tb_user;

use Carbon\Carbon;
use Session;
use DB;
use App\tb_statistical_order;
use App\tb_chat;
class StoreManagerController extends Controller
{

///////////////// chat ////////////////////////

    public function Chat_Page_store(){
     return view('user.ManageStore.chat_page');
    }

     public function post_chat_store(Request $request){
         $now = Carbon::now('Asia/Ho_Chi_Minh');
            $query = new tb_chat();
            $query->id_user = Session::get('id_store');
            $query->id_friends = $request->id_fr;
            $query->content = $request->content_chat;
            $query->time_chat = $now;
            $query->save();


    }

     public function loadUser_Chat_store(Request $request){
      $user_chat = tb_chat::where('id_friends', Session::get('id_store'))
                   ->join('users', 'tb_chat.id_user','users.id')->get()->unique('id_user');

                   // dd($user_chat->count());

       $output = '';
        if($user_chat->count() >0 ){
           foreach($user_chat as $key => $user_chat){
              $output .= ' <a  class="text-body item_user" >
                                              <input type="hidden" class="id_user" value="'.$user_chat->id.'">
                                                                <div class="d-flex align-items-start mt-1 p-2">
                                                                    <img src="'.asset('/uploads/profile/'.$user_chat->id.'/'.$user_chat->image_user).'" class="me-2 rounded-circle" height="48" alt="Brandon Smith">
                                                                    <div class="w-100 overflow-hidden">
                                                                        <h5 class="mt-0 mb-0 font-14">
                                                                   
                                                                            '.$user_chat->name.'
                                                                        </h5>
                                                                        <p class="mt-1 mb-0 text-muted font-14">
                                                                            
                                                                            <span class="w-75">'.$user_chat->content.'</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </a>';


          }

        }else{
           $output .= '';
        }          
       

          echo $output;

    }


     public function load_Infor_user_chat(Request $request){
        $user = tb_user::where('id', $request->id_user)->first();

    // dd($request->id_store);
     $output['image_store'] = ' <img src="'.asset('/uploads/profile/'.$user->id.'/'.$user->image_user).'" alt="shreyu" class="img-thumbnail avatar-lg rounded-circle">';
     $output['name_store'] = $user->name;
     $output['email'] = $user->email;
     $output['location'] = $user->birthday;
     $output['phone'] = $user->phone_store;


    
     $output['data_chat'] = '';
     $all_chat = tb_chat::where('id_user', Session::get('id_store'))->orwhere('id_friends', Session::get('id_store'))->orderby('id_chat', "DESC")->get();

       foreach($all_chat as $key => $all_chat){
          if($all_chat->id_user == Session::get('id_store') && $all_chat->id_friends == $request->id_user){

                  $inf_store = tb_store::where('id_store', Session::get('id_store'))->first();

                 $output['data_chat'] .= '<li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="'.asset('/uploads/store/'.$inf_store->avt_store).'" class="rounded" alt="Shreyu N">
                                                    <i>'.$all_chat->time_chat.'</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i> '.$inf_store->name_store.' N</i>
                                                        <p>
                                                           '.$all_chat->content.'
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                            </li>';
          
          }else if($all_chat->id_user == $request->id_user && $all_chat->id_friends == Session::get('id_store')){


                $output['data_chat'] .= '<li class="clearfix ">
                                                <div class="chat-avatar">
                                                    <img src="'.asset('/uploads/profile/'.$user->id.'/'.$user->image_user).'" class="rounded" alt="dominic">
                                                    <i>'.$all_chat->time_chat.'</i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i> '.$user->name.'</i>
                                                        <p>
                                                          '.$all_chat->content.'
                                                        </p>
                                                    </div>
                                                </div>
                                              
                                            </li>';

          }


       }
   
      
 
 

      echo json_encode($output);

    }

/////////////////////////////////////////////////////////////////////

 public function index(){
   $id_user = Auth::user()->id;
   $load_idstore = DB::table('tb_store')->where('id_user', $id_user)->first();

     Session::put('id_store',$load_idstore->id_store);
     Session::put('avt_st',$load_idstore->avt_store);
     Session::put('name_st',$load_idstore->name_store);
    

    $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
    $count_customer = tb_order_of_store::where('id_store', $load_idstore->id_store)
    ->join('tb_order_of_user','tb_order_of_store.id_order_user','=','tb_order_of_user.id_order_user')
    ->get()->unique('id_user')->count();

    // $count_customer_thang_truoc = tb_order_of_store::where('id_store', $load_idstore->id_store)
    // ->join('tb_order_of_user','tb_order_of_store.id_order_user','=','tb_order_of_user.id_order_user')
    // ->whereBetween('tb_order_of_user.time_order',[$dau_thangtruoc,$cuoi_thangtruoc])
    // ->get()->unique('id_user')->count();



    $count_oder = tb_order_of_store::where('id_store', $load_idstore->id_store)
    ->get()->count();

    //  $count_oder_thang_truoc = tb_order_of_store::where('id_store', $load_idstore->id_store)
    //  ->whereBetween('time_order',[$dau_thangtruoc,$cuoi_thangtruoc])
    // ->get()->count();


    $profit = tb_order_of_store::where('id_store', $load_idstore->id_store)
    ->get()->sum('total_order');
    $profit_to = $profit*0.2;


     // $nows = Carbon::now('Asia/Ho_Chi_Minh');
     //  $cuoi_thang1 = $nows->startOfYear()->endOfMonth()->toDateString();
     //  $dau_thang1 = $nows->startOfYear()->startOfMonth()->toDateString();



    return view('user.ManageStore.index')
    ->with('profit_to', $profit_to)
    ->with('count_oder', $count_oder)
    ->with('count_customer', $count_customer);
 }
 public function logout_store(){
     Session::put('id_store',null);
     Session::put('avt_st',null);
     Session::put('name_st',null);
     return redirect('/');

    }

  public function manage_category(){
   
    return view('user.ManageStore.Category_product');
 }
   public function manage_product(){
   
   return view('user.ManageStore.manage_product');

  }
   public function manage_order_store(){
 
   return view('user.ManageStore.manage_order_store');
  }
   public function view_detail_order_store($id_order_store){

   $id_store = Session::get('id_store');

      $name_store  = tb_store::where('id_store', $id_store)->first();

      $de_order_st  = tb_order_of_store::where('id_store', $id_store)->where('id_order_store', $id_order_store)->first();

      $de_orderxs_us = tb_order_of_user::where('id_order_user', $de_order_st->id_order_user)->first();

      $de_orderxs_ship = tb_shipping_order::where('id_order_user', $de_order_st->id_order_user)->first();


      $itemd_order = tb_detail_order::where('tb_detail_order.id_order_user', $de_order_st->id_order_user)->where('tb_detail_order.id_store', $id_store)->join('tb_product_store','tb_detail_order.id_product','=','tb_product_store.id_product')
        ->select('tb_detail_order.id_product','tb_detail_order.type_pro','tb_detail_order.name_type','tb_detail_order.name_size','tb_detail_order.qty_product','tb_detail_order.price_product','tb_detail_order.type_pro','tb_detail_order.price_items','tb_product_store.name_product','tb_product_store.image_product')->get();

    $pt_dis = $de_orderxs_us->discount_order * 100;

    $pri_dis = round(($de_order_st->total_order * $de_orderxs_us->discount_order ));

    $price_total_dis = $de_order_st->total_order - $pri_dis;


   return view('user.ManageStore.details_order_store')
   ->with('name_store', $name_store)
   ->with('de_order_st', $de_order_st)
   ->with('de_orderxs_us', $de_orderxs_us)
   ->with('de_orderxs_ship', $de_orderxs_ship)
   ->with('itemd_order', $itemd_order)
   ->with('pt_dis', $pt_dis)
   ->with('pri_dis', $pri_dis)
   ->with('price_total_dis', $price_total_dis);

  }
  


    public function update_status_order(Request $request){
       $id_store = Session::get('id_store');
       $loadorder_store = tb_order_of_store::where('id_store', $id_store)->where('id_order_store', $request->id_order_store)
       ->update(['order_status' => $request->status_order]);

       $date_order_store = tb_order_of_store::where('id_store', $id_store)->where('id_order_store', $request->id_order_store)->first();

       $qty_order_store = tb_order_of_store::where('id_store', $id_store)->where('time_order', $date_order_store->time_order)->get();
        
         $quantity=0;
          $total_order=0;
        foreach($qty_order_store as $key1 => $qty_order){
           $total_order++;
           $qty_pro_order_date = tb_detail_order::where('order_code', $qty_order->order_code)->where('id_store', $id_store)->get()->count();
           $quantity+= $qty_pro_order_date;

         } 

        if($request->status_order == 3){
              $statistic_check = tb_statistical_order::where('order_date', $date_order_store->time_order)->where('id_store', $id_store)->get()->count();
              if($statistic_check >0){
                  $statistic_update = tb_statistical_order::where('order_date', $date_order_store->time_order)->where('id_store', $id_store)->first();
                  $statistic_update->id_store = Session::get('id_store');
                
                  $profit = ($statistic_update->sales + $date_order_store->total_order)*0.2;
                  $statistic_update->profit = $profit;
                  $statistic_update->sales = $statistic_update->sales + $date_order_store->total_order;
                  $statistic_update->quantity =  $statistic_update->quantity + $quantity;
                  $statistic_update->total_order = $statistic_update->total_order + $total_order;
                  $statistic_update->save();

              }else{

                  $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                  $statistic_new = new tb_statistical_order();
                  $statistic_new->id_store = Session::get('id_store');
                  $statistic_new->order_date = $now;
                  $statistic_new->sales = $date_order_store->total_order;
                  $statistic_new->profit =  ($date_order_store->total_order)*0.2;
                  $statistic_new->quantity =  $quantity;
                  $statistic_new->total_order = $total_order;
                  $statistic_new->save();

              }

              $asdasd = tb_order_of_user::where('id_order_user', $date_order_store->id_order_user)->first();

              $user = tb_user::where('id', $asdasd->id_user)->first();
              $data = [
                'name' => $user->name,
                'email' =>$user->email,
                'code_oder' =>$asdasd->order_code
                ];
               Mail::to($user->email)->send(new Order_Success($data));

          }

   }

  public function load_order_manager(){
    $id_store = Session::get('id_store');
    $load_order = tb_order_of_store::where('id_store', $id_store)
    ->join('tb_order_of_user','tb_order_of_store.id_order_user','=','tb_order_of_user.id_order_user')
    ->select('tb_order_of_store.id_store','tb_order_of_store.id_order_store','tb_order_of_store.order_status',
             'tb_order_of_user.*')
    ->orderBy('id_order_store','DESC')->get();
      $output ='';
      if($load_order->count()>0){
                  $i=0;
                    foreach($load_order as $key => $vid){
                           $i++;
                            $coun_item = tb_detail_order::where('id_order_user', $vid->id_order_user)->where('id_store', $vid->id_store)->get()->count();
                               $output.='<tr>
                                                        <td>'.$i.'</td>
                                                        <td>'.$vid->order_code.'</td>
                                                        <td>
                                                           '.$vid->time_order.'
                                                        </td>
                                                        <td>
                                                          '.$coun_item.'
                                                        </td>
                                                           
                                                        <td>
                                                           '.$vid->total_order.'.000đ
                                                        </td>

                                                          <td>
                                                          <span class="badge badge-info-lighten">'.$vid->method_payment.'</span>
                                                        </td>
                                                        ';
                                             if($vid->order_status == 0){
                                                 $output.='<td><h5><span class="badge badge-warning-lighten"><i class="mdi mdi-timer-sand">
                                                             </i>Processing</span></h5></td> ';

                                             }else if($vid->order_status == 1){
                                                 $output.='  <td><h5><span class="badge badge-info-lighten">Packed</span></h5> </td>';

                                             }else if($vid->order_status == 2){
                                                 $output.='  <td><h5><span class="badge badge-primary-lighten">Shipped</span></h5></td> ';

                                             }else if($vid->order_status == 3){
                                                 $output.='  <td><h5><span class="badge badge-success-lighten">Delivered</span></h5></td> ';

                                             }else if($vid->order_status == 4){
                                                 $output.='  <td><h5><span class="badge badge-danger-lighten">Cancelled</span></h5></td> ';

                                             }else if($vid->order_status == 5){
                                                 $output.='  <td><h5><span class="badge badge-success-lighten">Paid</span></h5></td> ';

                                             }    
                                              $output.='
                                                        <td>
                                                            <input class="id_order_store" type="hidden" value="'.$vid->id_order_store.'">
                                                            <a href="'.url('/view_detail_order_store/'.$vid->id_order_store).'" class="action-icon"> <i class="mdi mdi-eye"></i></a>  

                                                                  
                                                         
                                                        </td>
                                     </tr>
            
                             ';

                       }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No order</td>
                                               
                              </tr>


                        ';

                }

         echo $output;


  }

   // nut xoa or der
  // <a class="action-icon delete_order_store"> <i class="mdi mdi-delete"></i></a>  

  public function delete_order_store(Request $request){
    $delete_order_store = tb_order_of_store::find($request->id_order_store);
    $delete_order_store->delete();
  }


  
    public function load_products_manager(){
    $id_store = Session::get('id_store');
    $load_pro = tb_product_store::where('tb_product_store.id_store', $id_store)
   ->join('tb_category_product','tb_category_product.id_cate_product','=','tb_product_store.id_cate_store')
    ->orderBy('id_product','DESC')->get();
      $output = '';
      if($load_pro->count()>0){
                    foreach($load_pro as $key => $vid){
               
                            $output.='   
                              <tr>
                              <td>
                                <img src="'.asset('/uploadproduct/'.$vid->image_product).'" class="img-thumbnail" width="50" height="50">
                                <p class="m-0 d-inline-block align-middle font-15" style="overflow-wrap: break-word; width: 250px;>
                                   <a class="text-body">  
                                       '.$vid->name_product.'</a>
                                       <br>
                                                            
                                 </p>
                              </td>
                               <td class="a">'.$vid->name_cate_product.'</td>
                        
                               '; 


                                if($vid->type_product == 0){
                        

                                      $output.='
                                      <td>'.$vid->date_time.'</td> 
                                      <td><span class="badge badge-outline-secondary">No attribute</span> </td>    
                                      <td>'.$vid->price_product.'.000đ</td>    
                                      <td>'.$vid->qty_product.'</td>    
                                       
                                      <td>  
                                        <input type="hidden" value="'.$vid->id_product.'" class="form-control id_product">
                                        <input type="hidden" value="'.$vid->type_product.'" class="form-control type_product">           
                                        <a class="action-icon btn_edit_pro"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a class="action-icon btn_delete_pro"> <i class="mdi mdi-delete"></i></a>
                     

                                      </td>
                                     </tr>'; 

                                }else if($vid->type_product == 1){
                                      $min = tb_type_product::where('id_product', $vid->id_product)
                                      ->min('price_type_product');
                                      $max = tb_type_product::where('id_product', $vid->id_product)
                                      ->max('price_type_product');
                                      $sum = tb_type_product::where('id_product', $vid->id_product)->max('qty_type_product');


                                      $output.='
                                      <td>'.$vid->date_time.'</td>
                                      <td><span class="badge badge-outline-primary">1 attribute </span></td>    
                                      <td>'.$min.'.000đ - '.$max.'.000đ</td>   
                                      <td>'.$sum.'</td>    
                                     

                                      <td>  
                                        <input type="hidden" value="'.$vid->id_product.'" class="form-control id_product">
                                        <input type="hidden" value="'.$vid->type_product.'" class="form-control type_product">          
                                        <a class="action-icon btn_edit_pro"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a class="action-icon btn_delete_pro"> <i class="mdi mdi-delete"></i></a>
                                        <button  data-id_product="'.$vid->id_product.'" type="button" 
                                        class="btn btn-danger btn-sm btn_enter_qty_pro">Enter Quality</button>

                                      </td>
                                     </tr>'; 
                                }else if($vid->type_product == 2){
                                      $min = tb_size_product::where('id_product', $vid->id_product)->min('price_size_product');
                                      $max = tb_size_product::where('id_product', $vid->id_product)->max('price_size_product');
                                      $sum = tb_size_product::where('id_product', $vid->id_product)->max('qty_size_product');


                                      $output.='
                                     <td>'.$vid->date_time.'</td>
                                      <td> <span class="badge badge-outline-danger">2 attribute </span></td>    
                                      <td>'.$min.'.000đ - '.$max.'.000đ</td>    
                                      <td>'.$sum.'</td>     
                                      <td>  
                                       <input type="hidden" value="'.$vid->id_product.'" class="form-control id_product">
                                        <input type="hidden" value="'.$vid->type_product.'" class="form-control type_product">            
                                        <a class="action-icon btn_edit_pro"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a class="action-icon btn_delete_pro"> <i class="mdi mdi-delete"></i></a>
                                        <button  data-id_product="'.$vid->id_product.'" type="button" 
                                        class="btn btn-danger btn-sm btn_enter_qty_pro">Enter Quality</button>

                                      </td>
                                     </tr>'; 
                                }
                     


                    }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
  }



   public function add_product_store(){

    $id_store = Session::get('id_store');
    $load_store =   DB::table('tb_category_product')->where('id_store', $id_store)->get();
    return view('user.ManageStore.add_product_store')->with('load_cate', $load_store);
  }

   public function edit_product_store( $id_product){
    $id_store = Session::get('id_store');
    $load_cate =   DB::table('tb_category_product')->where('id_store', $id_store)->get();

    $load_pro =  tb_product_store::where('id_product', $id_product)->get();

    return view('user.ManageStore.edit_product_store')
    ->with('load_pro', $load_pro)
    ->with('load_cate', $load_cate);
  }

 
     public function attributes_1_classic_pro( $id_product){
    $load_pro =  tb_product_store::where('id_product', $id_product)->get();

     return view('user.ManageStore.attributes_class_pro.1_attributes_classic_pro')
    ->with('load_pro', $load_pro);
  }

  public function attributes_2_classic_pro( $id_product){
    $load_pro =  tb_product_store::where('id_product', $id_product)->get();

      return view('user.ManageStore.attributes_class_pro.2_attributes_classic_pro')
    ->with('load_pro', $load_pro);
  }



   public function save_type_products_classic(Request $request){

         $tb_type_product = new tb_type_product();
         $tb_type_product->id_product = $request->id_product;
         $tb_type_product->name_type_pro = $request->name_type;

         $tb_type_product->qty_type_product = $request->qty_type;
         $tb_type_product->price_type_product = $request->price_type;


          $get_image = $request->file('file');

          if($get_image == null){
            $tb_type_product->save();
    
          }
          else {
          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproduct/type/'.$get_name_image);

          Image::make($get_image->getRealPath())->fit(150, 160)->save($path);

          $tb_type_product->image_type = $get_name_image;
          $tb_type_product->save();
        }

  }

     public function edit_type_products_classic(Request $request){

 
         $tb_type_product = tb_type_product::find($request->id_type_pro);
         
         $tb_type_product->id_product = $request->id_product;
         $tb_type_product->name_type_pro = $request->name_type;
         $tb_type_product->qty_type_product = $request->qty_type;
         $tb_type_product->price_type_product = $request->price_type;
      


          $get_image = $request->file('file');

          if($get_image == null){
            $tb_type_product->save();
    
          }
          else {
          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproduct/type/'.$get_name_image);

          Image::make($get_image->getRealPath())->fit(150, 160)->save($path);

          $tb_type_product->image_type = $get_name_image;
          $tb_type_product->save();


        }

  }

   public function load_type_products_classic(Request $request){
             $type = tb_type_product::where('id_product', $request->id_product)->orderby('id_type_pro', 'DESC')->get();
                $output ='';
              if($type->count()>0){
                    foreach($type as $key => $vid){
                        if($vid->image_type != null){
                              $output.='
                             <tr>
                              <td>
                                <img src="'.asset('/uploadproduct/type/'.$vid->image_type).'" class="img-thumbnail" width="50" height="50">
                 
                              </td> ';

                        }else{
                             $output.='
                             <tr>
                              <td></td>
                            '; 
                        }
        
  
                            $output.='       
                               <td class="a">'.$vid->name_type_pro.'</td>
                               <td>$<span class="b">'.$vid->price_type_product.'</span></td>
                               <td class="c">'.$vid->qty_type_product.'</td>
                     

                               <td>
                             
                                <button  data-id_type_pro="'.$vid->id_type_pro.'" type="button" 
                                class="btn btn-light btn-sm btn_edit_type">   <i class="mdi mdi-pencil"></i>  </button>

                                <button  data-id_type_pro="'.$vid->id_type_pro.'" type="button" 
                                class="btn btn-light btn-sm btn_delete_type"> <i class="mdi mdi-delete"></i> </button>

                              </td>
                             </tr>
                                            

                        ';
                    }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   
   }

       public function delete_type_products_classic(Request $request){

        $type = tb_type_product::find($request->id_type_pro);
        if($type->image_type !=null){      
           unlink('uploadproduct/type/'.$type->image_type);  
        }

        $type->delete();
      
    }



///////////////////// 2 thuoc tinhs

     public function load_option_type(Request $request){
             $type = tb_type_product::where('id_product', $request->id_product)->orderby('id_type_pro', 'DESC')->get();
                $output ='';
              if($type->count()>0){
                 $output.=' <option value="0" > -- Choose type product --</option>  ';
                    foreach($type as $key => $vid){

                            $output.=' <option value="'.$vid->id_type_pro.'">'.$vid->name_type_pro.' </option>  ';
                    }


                    }else{ 
                    $output.='
                     <option value="0" > -- Choose type product --</option>  ';

                }

         echo $output;
   
     }

      public function save_type_products_2_classic(Request $request){
        
         $tb_type_product = new tb_type_product();
         $tb_type_product->id_product = $request->id_product;
         $tb_type_product->name_type_pro = $request->name_type;
          
          $get_image = $request->file('file');


          if($get_image == null){
            $tb_type_product->save();
    
          }
          else {
          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproduct/size/'.$get_name_image);

          Image::make($get_image->getRealPath())->fit(150, 160)->save($path);

          $tb_type_product->image_type = $get_name_image;
          $tb_type_product->save();


        }

  }



     public function load_type_products_2_classic(Request $request){
             $type = tb_type_product::where('id_product', $request->id_product)->orderby('id_type_pro', 'DESC')->get();
                $output ='';
              if($type->count()>0){
                    foreach($type as $key => $vid){
                        if($vid->image_type != null){
                              $output.='
                             <tr>
                              <td>
                                <img src="'.asset('/uploadproduct/type/'.$vid->image_type).'" class="img-thumbnail" width="50" height="50">
                 
                              </td> ';

                        }else{
                             $output.='
                             <tr>
                              <td></td>
                            '; 
                        }
                     
                            $output.='       
                               <td class="a">'.$vid->name_type_pro.'</td>

                               <td>

                                <button  data-id_type_pro="'.$vid->id_type_pro.'" type="button" 
                                class="btn btn-light btn-sm btn_delete_type"> <i class="mdi mdi-delete"></i> </button>

                              </td>
                             </tr>
                                            

                        ';
                    }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   
   }


   public function save_size_products_classic(Request $request){

       $checkname = tb_size_product::where('id_product', $request->id_product)
       ->where('id_type_pro', $request->id_type_pro)->where('name_size', $request->name_size)->first();
       if($checkname){

        echo json_encode(0);

       }else{

         $tb_size_product = new tb_size_product();
         $tb_size_product->id_product = $request->id_product;
         $tb_size_product->id_type_pro = $request->id_type_pro;
         $tb_size_product->name_size = $request->name_size;

         $tb_size_product->qty_size_product = $request->qty_size;
         $tb_size_product->price_size_product = $request->price_size;


          $tb_size_product->save();
        echo json_encode(1);
       }

       
    }


   public function save_page_attributes_class(Request $request){

          tb_product_store::where('id_product', $request->id_product)->update(['title_type' => $request->title_type_pro]);
       
        }




     public function edit_size_products_classic(Request $request){
       $checkname = tb_size_product::where('id_product', $request->id_product)
       ->where('id_type_pro', $request->id_type_pro)->where('name_size', $request->name_size)
       ->whereNotIn('id_size_pro', [$request->id_size_pro])
       ->first();

       if($checkname){

        echo json_encode(0);

       }else{
         
 
         $tb_size_product = tb_size_product::find($request->id_size_pro);
         
         $tb_size_product->id_product = $request->id_product;
         $tb_size_product->id_type_pro = $request->id_type_pro;
         $tb_size_product->name_size = $request->name_size;

         $tb_size_product->qty_size_product = $request->qty_size;
         $tb_size_product->price_size_product = $request->price_size;

          $tb_size_product->save();

         echo json_encode(1);
       }

       
    }



   public function load_size_products_classic(Request $request){
             $type = tb_size_product::where('id_type_pro', $request->id_type_pro)->orderby('id_size_pro', 'DESC')->get();
                $output ='';
              if($type->count()>0){
                    foreach($type as $key => $vid){
   
                            $output.='       
                              <tr>
                               <td class="a">'.$vid->name_size.'</td>
                               <td>$<span class="b">'.$vid->price_size_product.'</span></td>
                               <td class="c">'.$vid->qty_size_product.'</td>
                            

                               <td>
                             
                                <button  data-id_size_pro="'.$vid->id_size_pro.'" type="button" 
                                class="btn btn-light btn-sm btn_edit_size">   <i class="mdi mdi-pencil"></i>  </button>

                                <button  data-id_size_pro="'.$vid->id_size_pro.'" type="button" 
                                class="btn btn-light btn-sm btn_delete_size"> <i class="mdi mdi-delete"></i> </button>

                              </td>
                             </tr>
                                            

                        ';
                    }


                    }else{ 
                    $output.='
                              <tr>
                                   <td colspan="4">No item</td>
                                               
                              </tr>


                        ';

                }

         echo $output;
   
   }
    public function delete_size_products_classic(Request $request){

        $size = tb_size_product::find($request->id_size_pro);

        $size->delete();
      
    }
 




    public function delete_product_store(Request $request){

        $product = tb_product_store::find($request->id_product);
           unlink('uploadproduct/'.$product->image_product);  

          $product->delete();

      
    }
 


   public function save_update_product_store(Request $request){


         $data = array();
         $data['id_cate_store'] = $request->cate_product;
         $data['name_product'] = $request->name_product;
         $data['price_product'] = $request->price_product;
         $data['qty_product'] = $request->quality_product;
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');
         $data['date_time'] = $mytime;
         $data['hastag_product'] = $request->hastag_product;
         $data['details_product'] = $request->details_product;
         $data['desc_product'] = $request->desc_product;
         $data['status'] = 0;
         
      
          $get_image = $request->file('image_post');

          if($get_image == null){
        
           tb_product_store::where('id_product', $request->id_product)->update($data);

           Session::put('message','update products success');

           return redirect('/manage_product');
           }
           else {
          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproduct/'.$get_name_image);

          Image::make($get_image->getRealPath())->fit(450, 480)->save($path);

          $data['image_product'] = $get_name_image;
 
           tb_product_store::where('id_product', $request->id_product)->update($data);

           Session::put('message','update products success');

           return redirect('/manage_product'); 
              
        }

  }

   public function save_product_store(Request $request){
     $id_store = Session::get('id_store');
     $load_store = DB::table('tb_store')->where('id_store', $id_store)->first();
           
         // dd($request->choose_attribute);

         $product_store = new tb_product_store();
         $product_store->id_store = $id_store;
         $product_store->id_areas = $load_store->Category_store;

         $product_store->id_cate_store = $request->cate_product;
         $product_store->name_product = $request->name_product;

         if($request->choose_attribute == 0){
         $product_store->price_product = $request->price_product;
         $product_store->qty_product = $request->quality_product;
         }
         $mytime = Carbon::now('Asia/Ho_Chi_Minh');

         $product_store->type_product = $request->choose_attribute;
         $product_store->hastag_product = $request->Input_Hastag_product;
         $product_store->date_time = $mytime;

         $product_store->desc_product = $request->desc_product;
         $product_store->details_product = $request->details_product;
         $product_store->status = 0;
         
      
         $get_image = $request->file('file');

          $get_name_image = rand(0,99). '_' .$get_image->getClientOriginalName();
          $path = public_path('uploadproduct/'.$get_name_image);
          Image::make($get_image->getRealPath())->fit(450, 480)->save($path);
          $product_store->image_product = $get_name_image;
 
          $product_store->save();

          $output['id_product'] = $product_store->id_product;

        echo json_encode($output);
       
  }


   public function add_category_product(Request $request){
       $id_store = Session::get('id_store');

         $data = array(); 
         $data1 = array();
         $data1 = $request->all();
         $data['id_store'] = $id_store;
         $data['name_cate_product'] = $data1['name_category_product'];
         $data['desc_cate_product'] = $data1['desc_category_product'];
         //dd($data1);
         DB::table('tb_category_product')->insert($data);

       
    }
      public function view_category_product(Request $request){
        $id_cate = $request->id_cate_product;
        $cate = DB::table('tb_category_product')->where('id_cate_product', $id_cate)->first();

        $output['name_cate_product'] = $cate->name_cate_product;
        $output['desc_cate_product'] = $cate->desc_cate_product;
        $output['id_cate_product'] = $cate->id_cate_product;
    
        echo json_encode($output);
     }

    public function save_update_category_product(Request $request){

         $data = array(); 
         $data1 = array();
         $data1 = $request->all();
        
         $data['name_cate_product'] = $data1['name_category_product'];
         $data['desc_cate_product'] = $data1['desc_category_product'];
         //dd($data1);
          $idcate = $data1['id_cate_product'];
         DB::table('tb_category_product')->where('id_cate_product', $idcate)->update($data);
       
    }
     public function delete_cate_product(Request $request){
         $id_cate = $request->id_cate;
        DB::table('tb_category_product')->where('id_cate_product', $id_cate)->delete();
      
    }
 

       public function load_category_product(Request $request){
           $id_store = Session::get('id_store');
            $load_store =   DB::table('tb_category_product')->where('id_store', $id_store)->get();
              $load_store_count = $load_store->count();
              $output ='';
              $output = '<form>
                            '.csrf_field().'                          
                                          <div class="row">
                                            <div class="col-sm-12 col-md-9"></div>
                                            <div class="col-sm-12 col-md-3">
                                                <div id="scroll-vertical-datatable_filter" class="dataTables_filter">
                                                    <label>Search:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="scroll-vertical-datatable">
                                                    </label>
                                                </div>
                                            </div>
                                          </div>
                                           <table id="scroll-vertical-datatable" class="table dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                       <th>STT</th>
                                                        <th>Name</th>
                                                        <th>Describe</th>              
                                                        
                                         
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                ';
                if($load_store_count>0){
                    $i = 0;
                    foreach($load_store as $key => $vid){
                        $i++;
                        $output.='

                             <tr>
                              <td>'.$i.'</td>
                               <td>'.$vid->name_cate_product.'</td>
                               <td>'.$vid->desc_cate_product.'</td>

                               <td>
                               <button onclick="view_category_product(this.id);" id="'.$vid->id_cate_product.'"  data-id_store="'.$vid->id_cate_product.'"  data-bs-toggle="modal" data-bs-target="#update_category_product" type="button" 
                                   class="btn btn-light btn-sm btn-update_cate"> <i class="mdi mdi-pencil"></i> </button>

                                <button  data-id_cate="'.$vid->id_cate_product.'" type="button" 
                                class="btn btn-light btn-sm btn_delete_cate"> <i class="mdi mdi-delete"></i> </button>

                              </td>
                             </tr>
                                            

                        ';
                    }
                }else{ 
                    $output.='
                             <tr>
                                   <td colspan="4">Chưa có store nào hết</td>
                                               
                              </tr>


                        ';

                }
                $output.='
                         </tbody>
                        </table>
                    </form>
                        ';
                echo $output;
      
  
     }
}
