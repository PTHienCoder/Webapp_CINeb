<?php

namespace App\Http\Controllers\api;

use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\tb_field_project;
use Session;
use Carbon\Carbon;
use DB;
use App\tb_user;
use App\tb_post;
use App\tb_comment_post;
use App\tb_notification;
use App\tb_follow_user;
use App\tb_save_post;


use App\tb_product_store;
use App\tb_business_areas;
use App\tb_review_product;
use App\tb_category_product;
use App\tb_type_product;
use App\tb_size_product;
use App\tb_detail_order;
use App\tb_product_of_post;
use App\Models\User;


class ApiHomeController extends Controller
{

   public function LoadPost(Request $request){
     $load_project = tb_post::join('users','tb_post.id_user','=','users.id')
     ->select('tb_post.*','users.name', 'users.image_user')->inRandomOrder()->get();   

      foreach($load_project as $key => $product){      
            $arr[] = [  
               'id_post' => $product->id_post,
               'id_user'=> $product->id_user,
               'title_post'=> $product->title_post,
               'image_post'=> $product->image_post,
               'desc_post'=> $product->desc_post,
               'detail_post'=> $product->detail_post,
               'hastag_post'=> $product->hastag_post,
               'time_create'=> $product->time_create,
               'name'=> $product->name,
               'image_user'=> $product->image_user,
               'Qty_pro_post'=> tb_product_of_post::where('id_post', $product->id_post)->get()->count()

            ];
        }
    
    return response()->json(['ModelPost'=>$arr]);
   }


   public function GetIforUser(Request $request){
     $ModelUser = tb_user::select('id', 'email', 'name', 'image_user')
     ->where('id', $request->id_user)->get();  

      $data = ['ModelUser'=>$ModelUser];
      return response()->json($data, 200);
   }


   public function Get_Qty_Follower(Request $request){

               $arr[] = [             
                         'Qty_Follow' => tb_follow_user::where('id_friends', $request->id_user)->get()->count(),
                         'Qty_Follower' => tb_follow_user::where('id_user', $request->id_user)->get()->count(),
                         'Qty_Save' => tb_save_post::where('id_user', $request->id_user)->get()->count(),
                         ];


      $data = ['Model_GetQty_Flower'=>$arr];
      return response()->json($data, 200);
   }



   public function PostLoginUser(Request $request){

       if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){


            if(Auth::user()->status == 0){
              Auth::logout();

               $data = ['ModelUser'=> 'null'];
               return response()->json($data, 201);;

            }else{
                
             $getuser = User::where('email',$request->email)
             ->get();   

             $data = ['ModelUser'=>$getuser];
              return response()->json($data, 200);
          
            }
           
        }else{
            
             $data = ['ModelUser'=> 'null'];
             return response()->json($data, 404);
        }
 
   }

   public function PostSignupUser(Request $request){
    
            $passw = Hash::make($request->password);

            $query = new User();
            $query->name = $request->usernames;
            $query->email =$request->emails;
            $query->password = $passw;
            $query->phone_user = 0;
            $query->image_user = 0;
            $query->birthday = 0;
            $query->type_user = 0;
            $query->story = "...";

             
           $checkmail = tb_user::where('email',$request->emails)->get();
           // $data = ['message'=> $checkmail];
           // return response()->json($checkmail, 404);
             if ($checkmail->count() > 0) {
               $data = ['message'=> 'faill'];
                return response()->json($data, 404);
                 
             }else{
               $query->save();
                  $data = [
                'id' => $query->id,
                'name' => $query->nickname,
                'email' => $query->email
                ];
                 Mail::to($query->email)->send(new VerifyEmail($data));
                  $data = ['message'=> 'success'];
                return response()->json($data, 200);
            }
     }



   public function Load_Cate_Post(Request $request){
     $Model_Cate_Post = tb_field_project::get();  

      $data = ['Model_Cate_Post'=>$Model_Cate_Post];
      return response()->json($data, 200);
    }

    public function Load_ItemPost_cate(Request $request){
     // $ModelPost = tb_post::where('field_post',$request->id)->get();  
     $load_project = tb_post::join('users','tb_post.id_user','=','users.id')
     ->where('field_post',$request->id)
     ->select('tb_post.*','users.name', 'users.image_user')->inRandomOrder()->get();   

      foreach($load_project as $key => $product){      
            $arr[] = [  
               'id_post' => $product->id_post,
               'id_user'=> $product->id_user,
               'title_post'=> $product->title_post,
               'image_post'=> $product->image_post,
               'desc_post'=> $product->desc_post,
               'detail_post'=> $product->detail_post,
               'hastag_post'=> $product->hastag_post,
               'time_create'=> $product->time_create,
               'name'=> $product->name,
               'image_user'=> $product->image_user,
               'Qty_pro_post'=> tb_product_of_post::where('id_post', $product->id_post)->get()->count()

            ];
        }
    
    return response()->json(['ModelPost'=>$arr], 200);
   }



    public function getnotification(Request $request){
     $Model_Notification = tb_notification::where('id_user',$request->iduser)
     ->join('users', 'tb_notification.id_user_sender', 'users.id')
     ->select('tb_notification.*', 'users.id', 'users.name', 'users.image_user')->get();  
     if($Model_Notification->count()>0){
             foreach($Model_Notification as $key => $qtypro){      
                      $arr[] = [             
                         'idnoti' => $qtypro->idnoti,
                         'idp' => $qtypro->idp,
                         'timeNoti' => $qtypro->timeNoti,
                         'content' => $qtypro->content,
                         'id' => $qtypro->id_user,
                         'username' => $qtypro->name,
                         'avatar' => $qtypro->image_user,
                         ];
              }            
             
             $data = ['Model_Notification'=>$arr];
               return response()->json($data, 200);
        }else{

             $data = ['Model_Notification'=> 'null'];
               return response()->json($data, 404);

        }
  }

   public function Clear_notification(Request $request){
     tb_notification::where('idnoti',$request->idnoti)->delete();  

      $data = ['messages'=>"Success"];
       return response()->json($data, 200);
   }



 ////////////////////// comment post /////////////////////////

     public function getCmt(Request $request){
     $Model_Comment = tb_comment_post::where('id_post',$request->id_post)
     ->join('users', 'tb_comment_post.id_user', 'users.id')
     ->select('tb_comment_post.*', 'users.name', 'users.image_user')->get();  
     if($Model_Comment->count()>0){
             foreach($Model_Comment as $key => $qtypro){      
                      $arr[] = [             
                         'id' => $qtypro->id,
                         'id_post' => $qtypro->id_post,
                         'id_of_user' => $qtypro->id_user,
                         'comment_content' => $qtypro->content,
                         'date' => $qtypro->time_comment,
                         'username' => $qtypro->name,
                         'avatar' => $qtypro->image_user,
                         ];
              }            
             
             $data = ['Model_Comment'=>$arr];
               return response()->json($data, 200);
        }else{

             $data = ['Model_Comment'=> 'null'];
               return response()->json($data, 200);

        }
  }
      
      

    public function postComment(Request $request){

             $review = new tb_comment_post();
             $review->id_user = $request->id_of_user;
             $review->id_post = $request->id_post;
             $review->content =$request->content;

             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_comment =$mytime;
               
             $review->save();

       $data = ['messages'=>"Success"];
       return response()->json($data, 200);
   }


//////////////////// followe user ////////////////////

    public function getiduserfollow(Request $request){
       $tb_follow_user = tb_follow_user::where('id_user', $request->id_my_user)->where('id_friends', $request->id_of_user)->get();
       if($tb_follow_user->count()>0){
        return response()->json("null", 200);
       }else{
        return response()->json("null", 404);
       }

   }

    public function deletefollow(Request $request){

      tb_follow_user::where('id_user', $request->id_my_user)->where('id_friends', $request->id_of_user)->delete();

       return response()->json("null", 200);
   }

    public function savefollow(Request $request){
             
             $review = new tb_follow_user();
             $review->id_user = $request->id_my_user;
             $review->id_friends = $request->id_of_user;
             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_add =$mytime;
               
             $review->save();

      return response()->json("null", 200);
   }




   ///////////////////// save  post ////////////////////////////

    public function getidusersavepost(Request $request){
       $tb_follow_user = tb_save_post::where('id_user', $request->id_user)->where('id_post', $request->id_post)->get();
       if($tb_follow_user->count()>0){
        return response()->json("null", 200);
       }else{
        return response()->json("null", 404);
       }

   }

    public function deletesave(Request $request){

      tb_save_post::where('id_user', $request->id_user)->where('id_post', $request->id_post)->delete();

       return response()->json("null", 200);
   }

    public function savepost(Request $request){
             
             $review = new tb_save_post();
             $review->id_user = $request->id_user;
             $review->id_post = $request->id_post;
             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $review->time_save =$mytime;     
             $review->save();


             $po = tb_post::select('id_user')->where('id_post', $request->id_post)->first();
             $noti = new tb_notification();
             $noti->id_user_sender = $request->id_user;
             $noti->idp = $request->id_post;
             $mytime = Carbon::now('Asia/Ho_Chi_Minh');
             $noti->timeNoti =$mytime;
             $noti->content ="Vừa lưu bài dự án của bạn !";
             $noti->id_user = $po->id_user;       
             $noti->save();

      return response()->json("null", 200);
   }




   public function getMy_post(Request $request){
     $load_project = tb_post::join('users','tb_post.id_user','=','users.id')
     ->select('tb_post.*','users.name', 'users.image_user')
     ->where('tb_post.id_user', $request->id_user)->get();   
    
    return response()->json(['ModelPost'=>$load_project]);
   }
   public function getsave_post(Request $request){

     $load_project = tb_save_post::join('tb_post','tb_save_post.id_post', 'tb_post.id_post')
     ->join('users','tb_post.id_user','=','users.id')
     ->select('tb_save_post.*','tb_post.*','users.name', 'users.image_user')
     ->where('tb_save_post.id_user', $request->id_user)->get();   
    
    return response()->json(['ModelPost'=>$load_project]);
   }




public function get_product_post(Request $request){

     $all_product = tb_product_of_post::join('tb_product_store', 'tb_product_of_post.id_product','=','tb_product_store.id_product')
     ->select('tb_product_of_post.*','tb_product_store.id_product','tb_product_store.type_product','tb_product_store.name_product','tb_product_store.image_product', 
        'tb_product_store.price_product')
     ->where('tb_product_of_post.id_post', $request->id_post)
     ->orderby('tb_product_of_post.id','DESC')->get();
 
        $arr = [];
        foreach($all_product as $key => $product){
         $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $product->id_product)->get()->count(); 

         if($product->type_product == 0){
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $product->price_product,
               'qty_sale'=> $qtysale

            ];

         }else if($product->type_product == 1){
              $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
              $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                     
            $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
            ];

         }else if($product->type_product == 2){
             $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
             $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

             $arr[] = [  
               'id_product' => $product->id_product,
               'type_product'=> $product->type_product,
               'name_product'=> $product->name_product,
               'image_product'=> $product->image_product,
               'price_product'=> $min,
               'price_pro2' => $max,
               'qty_sale'=> $qtysale
               ];
            


        }
     }
 
     $data = ['ModelProduct'=>$arr];
     return response()->json($data, 200);
 
   }
     

     ////////////////////search /////////////////////

   public function Search_Post(Request $request){
      
        if($request->key_search == "all"){
             $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
              ->join('users', 'tb_post.id_user','=','users.id')
              ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
              ->orderby('tb_post.id_post','DESC')
              ->get();


           
               foreach($load_project as $key => $product){      
                $arr[] = [  
                   'id_post' => $product->id_post,
                   'id_user'=> $product->id_user,
                   'title_post'=> $product->title_post,
                   'image_post'=> $product->image_post,
                   'desc_post'=> $product->desc_post,
                   'detail_post'=> $product->detail_post,
                   'hastag_post'=> $product->hastag_post,
                   'time_create'=> $product->time_create,
                   'name'=> $product->name,
                   'image_user'=> $product->image_user,
                   'Qty_pro_post'=> tb_product_of_post::where('id_post', $product->id_post)->get()->count()

                ];
            }


           $data = ['ModelPost'=>$arr];
           return response()->json($data, 200);

        }else{

              $load_project = tb_post::join('tb_field_project', 'tb_post.field_post','=','tb_field_project.id_field')
              ->join('users', 'tb_post.id_user','=','users.id')
              ->select('tb_post.*', 'tb_field_project.name_field', 'users.image_user', 'users.name', 'users.id')
              ->where('tb_post.title_post','LIKE','%'.$request->key_search.'%')
              ->orwhere('tb_post.hastag_post','LIKE','%'.$request->key_search.'%')
              ->orwhere('tb_field_project.name_field','LIKE','%'.$request->key_search.'%')
              ->orderby('tb_post.id_post','DESC')
              ->get();


           
               foreach($load_project as $key => $product){      
                $arr[] = [  
                   'id_post' => $product->id_post,
                   'id_user'=> $product->id_user,
                   'title_post'=> $product->title_post,
                   'image_post'=> $product->image_post,
                   'desc_post'=> $product->desc_post,
                   'detail_post'=> $product->detail_post,
                   'hastag_post'=> $product->hastag_post,
                   'time_create'=> $product->time_create,
                   'name'=> $product->name,
                   'image_user'=> $product->image_user,
                   'Qty_pro_post'=> tb_product_of_post::where('id_post', $product->id_post)->get()->count()

                ];
            }


           $data = ['ModelPost'=>$arr];
           return response()->json($data, 200);

        }


    }

    public function Search_Product(Request $request){
     

         if($request->key_search == "all"){
           $all_product = tb_product_store::join('tb_business_areas', 'tb_product_store.id_areas', 'tb_business_areas.id_areas')
           ->join('tb_category_product', 'tb_product_store.id_cate_store', 'tb_category_product.id_cate_product')
           ->orderBy('tb_product_store.id_product', "DESC")->get();

                 $arr = [];
                    foreach($all_product as $key => $product){
                     $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $product->id_product)->get()->count(); 

                     if($product->type_product == 0){
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $product->price_product,
                           'qty_sale'=> $qtysale

                        ];

                     }else if($product->type_product == 1){
                          $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                          $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                 
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                        ];

                     }else if($product->type_product == 2){
                         $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                         $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                         $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                           ];
                        


                    }
                 }
              usort($arr, function($a, $b) {
            return $b['qty_sale'] - $a['qty_sale'];
           });
           

          $data = ['ModelProduct'=>$arr];
         return response()->json($data, 200);

         }else{

           $all_product = tb_product_store::join('tb_business_areas', 'tb_product_store.id_areas', 'tb_business_areas.id_areas')
           ->join('tb_category_product', 'tb_product_store.id_cate_store', 'tb_category_product.id_cate_product')
           ->where('tb_product_store.name_product','LIKE','%'.$request->key_search.'%')
           ->orwhere('tb_product_store.hastag_product','LIKE','%'.$request->key_search.'%')
           ->orwhere('tb_business_areas.name_areas','LIKE','%'.$request->key_search.'%')
           ->orwhere('tb_category_product.name_cate_product','LIKE','%'.$request->key_search.'%')
           ->orderBy('tb_product_store.id_product', "DESC")->get();


                 $arr = [];
                    foreach($all_product as $key => $product){
                     $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $product->id_product)->get()->count(); 

                     if($product->type_product == 0){
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $product->price_product,
                           'qty_sale'=> $qtysale

                        ];

                     }else if($product->type_product == 1){
                          $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                          $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                 
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                        ];

                     }else if($product->type_product == 2){
                         $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                         $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                         $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                           ];
                        


                    }
                 }

           usort($arr, function($a, $b) {
            return $b['qty_sale'] - $a['qty_sale'];
           });
      

          $data = ['ModelProduct'=>$arr];
          return response()->json($data, 200);

         }



    }
        public function Get_Product_category(Request $request){

           $all_product = tb_product_store::join('tb_business_areas', 'tb_product_store.id_areas', 'tb_business_areas.id_areas')
           ->join('tb_category_product', 'tb_product_store.id_cate_store', 'tb_category_product.id_cate_product')
           ->where('tb_business_areas.id_areas',$request->id)
           ->orderBy('tb_product_store.id_product', "DESC")->get();

                 $arr = [];
                    foreach($all_product as $key => $product){
                     $qtysale = tb_detail_order::select('id_details_order', 'id_product')->where('id_product', $product->id_product)->get()->count(); 

                     if($product->type_product == 0){
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $product->price_product,
                           'qty_sale'=> $qtysale

                        ];

                     }else if($product->type_product == 1){
                          $min = tb_type_product::where('id_product', $product->id_product)->min('price_type_product');
                          $max = tb_type_product::where('id_product', $product->id_product)->max('price_type_product');
                                                 
                        $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                        ];

                     }else if($product->type_product == 2){
                         $min = tb_size_product::where('id_product', $product->id_product)->min('price_size_product');
                         $max = tb_size_product::where('id_product', $product->id_product)->max('price_size_product');

                         $arr[] = [  
                           'id_product' => $product->id_product,
                           'type_product'=> $product->type_product,
                           'name_product'=> $product->name_product,
                           'image_product'=> $product->image_product,
                           'price_product'=> $min,
                           'price_pro2' => $max,
                           'qty_sale'=> $qtysale
                           ];
                        


                    }
                 }
  

          $data = ['ModelProduct'=>$arr];
          return response()->json($data, 200);




    }




}
