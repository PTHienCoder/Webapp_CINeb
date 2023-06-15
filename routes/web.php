<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shoppingcontroller;
use App\Http\Controllers\StoreManagerController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\statisticalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//// ckeditor
Route::post('/uploads_ckeditor',[UserController::class, 'uploads_ckeditor']);
Route::get('/file_browser',[UserController::class, 'file_browser']);

///// Backend 

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/adminreset', [AdminController::class, 'indexreset']);
Route::post('/LoginAdmin', [AdminController::class, 'LoginAdmin']);
Route::get('/logout', [AdminController::class, 'logout']);

Route::get('/ShowDashboardAdmin', [AdminController::class, 'ShowDashboardAdmin']);
Route::get('/store_manager', [AdminController::class, 'store_manager']);

Route::get('/Catalog_management', [AdminController::class, 'Catalog_management']);

Route::post('/add_field_project',[AdminController::class, 'add_field_project']);
Route::post('/load_field_project',[AdminController::class, 'load_field_project']);
Route::post('/delete_field',[AdminController::class, 'delete_field']);


Route::post('/add_business_areas',[AdminController::class, 'add_business_areas']);
Route::post('/load_business_areas',[AdminController::class, 'load_business_areas']);
Route::post('/delete_areas',[AdminController::class, 'delete_areas']);

Route::post('/load_store_new',[AdminController::class, 'load_store_new'] );
Route::post('/view_store_new',[AdminController::class, 'view_store_new']);
Route::post('/Approve_store',[AdminController::class, 'Approve_store']);
Route::post('/No_Approve_store',[AdminController::class, 'No_Approve_store']);

Route::get('/load_store_old',[AdminController::class, 'load_store_old']);
Route::get('/view_store_old',[AdminController::class, 'view_store_old']);


Route::get('/Project_management',[AdminController::class, 'Project_management']);
// Route::get('/view_store_old',[AdminController::class, 'view_store_old']);

Route::get('/Product_management',[AdminController::class, 'Product_management']);

Route::get('/user_management',[AdminController::class, 'user_management']);
Route::get('/load_products_manager_admin',[AdminController::class, 'load_products_manager_admin']);



///////// User

Route::get('/LoginUser', [UserController::class, 'LoginUser']);
Route::post('/PostLoginUser', [UserController::class, 'PostLoginUser']);
Route::get('/SignupUser', [UserController::class, 'SignupUser']);
Route::post('/PostSignupUser', [UserController::class, 'PostSignupUser']);
Route::get('/logoutuser', [UserController::class, 'logoutuser']);

Route::get('/VerifyEmail/{id}', [UserController::class, 'VerifyEmail']);



/////////////////////////////// Chat  //////////////

Route::get('/Chat_Page/{id_fr}', [UserController::class, 'Chat_Page']);
Route::get('/loadstore_Chat_user', [UserController::class, 'loadstore_Chat_user']);
Route::get('/load_Infor_store_chat', [UserController::class, 'load_Infor_store_chat']);
Route::post('/post_chat', [UserController::class, 'post_chat']);



Route::get('/Chat_Page_store', [StoreManagerController::class, 'Chat_Page_store']);
Route::get('/loadUser_Chat_store', [StoreManagerController::class, 'loadUser_Chat_store']);
Route::get('/load_Infor_user_chat', [StoreManagerController::class, 'load_Infor_user_chat']);
Route::post('/post_chat_store', [StoreManagerController::class, 'post_chat_store']);





/////////////// seacrh //////////////////////

Route::post('/Search_Product', [SearchController::class, 'index_search_product']);
Route::post('/load_product_key_search', [SearchController::class, 'load_product_key_search']);
Route::post('/load_product_search_ajax', [SearchController::class, 'load_product_search_ajax']);


Route::post('/Search_Post', [SearchController::class, 'index_search_post']);
Route::post('/load_post_key_search', [SearchController::class, 'load_post_key_search']);
Route::post('/load_post_search_ajax', [SearchController::class, 'load_post_search_ajax']);




Route::post('/add_product_active_shopping', [SearchController::class, 'add_product_active_shopping']);
Route::post('/remove_active_user', [SearchController::class, 'remove_active_user']);


/////////////////// xu ly POst ?//////////////////////////

Route::get('/AddProject',[PostController::class, 'AddProject'] )->middleware('authLoginUser');
Route::post('/savepost',[PostController::class, 'savepost']);
Route::get('/edit_post/{id_post}',[PostController::class, 'edit_post']);
Route::post('Save_edit',[PostController::class, 'Save_edit']);
Route::get('/remove_post/{id_post}',[PostController::class, 'remove_post']);


Route::post('/user_save_post',[PostController::class, 'user_save_post']);
Route::post('/user_Nosave_post',[PostController::class, 'user_Nosave_post']);
Route::get('user_detail_post/{id_post}',[PostController::class, 'user_detail_post']);
Route::get('/load_Product_of_Post_Right__Details',[PostController::class, 'load_Product_of_Post_Right__Details']);


Route::get('/add_product_for_post/{id_post}',[PostController::class, 'add_product_for_post']);
Route::get('/load_more_product_add_post',[PostController::class, 'load_more_product_add_post']);
Route::get('/load_product_add_post_store',[PostController::class, 'load_product_add_post_store']);

Route::get('/load_qty_product_of_Post',[PostController::class, 'load_qty_product_of_Post']);
Route::post('/add_product_to_post',[PostController::class, 'add_product_to_post']);
Route::get('/load_Product_of_Post_Right',[PostController::class, 'load_Product_of_Post_Right']);
Route::get('/Remove_item_Pro_post',[PostController::class, 'Remove_item_Pro_post']);

Route::post('/post_commen_post',[PostController::class, 'post_commen_post']);
Route::get('/load_comment_post',[PostController::class, 'load_comment_post']);
Route::get('/Load_qty_comment_post',[PostController::class, 'Load_qty_comment_post']);


///////////////// ajax khi can
Route::get('/load-type-user',[UserController::class, 'loadtypeuser']);
Route::get('/load_category_store',[UserController::class, 'load_category_store']);



/////// ///////////////// Home /////////////////////

Route::get('ssss', [HomeController::class, 'index']);
Route::get('/load_post_page_home',[HomeController::class, 'load_post_page_home']);





///////////////// foloww user ///////////

Route::get('/Load_btn_follow',[UserController::class, 'Load_btn_follow']);
Route::post('/btn_follow_user',[UserController::class, 'btn_follow_user']);
Route::post('/btn_Nofollow_user',[UserController::class, 'btn_Nofollow_user']);






//////  Profile /
Route::get('/MyProfile',[ProfileController::class, 'index'])->middleware('authLoginUser');
Route::post('/saveprofile',[ProfileController::class, 'saveprofile']);
Route::get('/load_myProiect',[ProfileController::class, 'load_myProiect']);
Route::get('load_save_project',[ProfileController::class, 'load_save_project']);

Route::get('load_my_order_profile', [ProfileController::class, 'load_my_order_profile']);
Route::get('load_my_order_packed_profile', [ProfileController::class, 'load_my_order_packed_profile']);
Route::get('load_my_order_to_ship_profile', [ProfileController::class, 'load_my_order_to_ship_profile']);
Route::get('load_my_order_to_completed_profile', [ProfileController::class, 'load_my_order_to_completed_profile']);

Route::get('load_my_order_status_profile', [ProfileController::class, 'load_my_order_status_profile']);
Route::get('load_detail_order_my_pro', [ProfileController::class, 'load_detail_order_my_pro']);

Route::get('/Load_info_store',[ProfileController::class, 'Load_info_store'] );


/////////      video       /////////////////
Route::get('PagesVideo',[VideoController::class, 'index']  );


//////////    explore       ////////////
Route::get('PagesExplore',[ExploreController::class, 'index']  );
Route::get('/Load_project_Explore',[ExploreController::class, 'Load_project_Explore']);

//////////shopping  ////////////////
Route::get('/',[Shoppingcontroller::class, 'index']);
Route::get('/PageShopping',[Shoppingcontroller::class, 'index']);
Route::get('/load_more_product_home',[Shoppingcontroller::class, 'load_more_product_home'] );

Route::post('/CreateShop',[Shoppingcontroller::class, 'CreateShop']);

Route::get('/detail_products/{id_product}',[Shoppingcontroller::class, 'detail_products']);
Route::post('/post_review_product',[Shoppingcontroller::class, 'post_review_product']);
Route::get('/load_review_product',[Shoppingcontroller::class, 'load_review_product']);

Route::get('/load_qty_review_product',[Shoppingcontroller::class, 'load_qty_review_product']);
Route::get('/load_sao_review_product',[Shoppingcontroller::class, 'load_sao_review_product']);

Route::get('/load_more_review',[Shoppingcontroller::class, 'load_more_review']);
Route::get('/load_review_of_start',[Shoppingcontroller::class, 'load_review_of_start']);

Route::get('/load_product_of_price',[Shoppingcontroller::class, 'load_product_of_price']);



////////////page details product /////////////////

Route::get('/load_qty_and_price_product_details',[Shoppingcontroller::class, 'load_qty_and_price_product_details']);
Route::get('/load_type_pro_detals',[Shoppingcontroller::class, 'load_type_pro_detals']);
Route::get('/load_size_pro_detals',[Shoppingcontroller::class, 'load_size_pro_detals']);


//// category product page /////////////
Route::get('/category_product_pages/{id_aresa}',[Shoppingcontroller::class, 'category_product_pages']);
Route::get('/load_more_product_category',[Shoppingcontroller::class, 'load_more_product_category']);

Route::get('/load_product_of_start',[Shoppingcontroller::class, 'load_product_of_start']);



/////////// page product store /////////////
Route::get('/Pages_store_product/{id_store}',[Shoppingcontroller::class, 'Pages_store_product']);
Route::get('/load_products_of_store',[Shoppingcontroller::class, 'load_products_of_store']);
Route::get('/load_products_category_of_store',[Shoppingcontroller::class, 'load_products_category_of_store']);


////////////////////// page checkout/////////////////////
Route::get('/page_checkout',[CheckoutController::class, 'page_checkout'])->middleware('authLoginUser');
Route::get('/load_pro_checkout_page',[CheckoutController::class, 'load_pro_checkout_page']);

Route::get('/load_info_delivery_checkout',[CheckoutController::class, 'load_info_delivery_checkout']);
Route::get('/load_all_info_delivery_checkout',[CheckoutController::class, 'load_all_info_delivery_checkout']);

Route::post('/select-delivery-home',[CheckoutController::class, 'select_delivery_home']);
Route::post('/add_shipping_checkout',[CheckoutController::class, 'add_shipping_checkout']);
Route::post('/update_check_shipping_default',[CheckoutController::class, 'update_check_shipping_default']);

Route::get('/load_info_update_shipping_checkout',[CheckoutController::class, 'load_info_update_shipping_checkout']);
Route::post('/save_edit_shipping_checkout',[CheckoutController::class, 'save_edit_shipping_checkout']);

Route::post('/comfirm_checkout',[CheckoutController::class, 'comfirm_checkout']);
Route::get('/page_checkout_success',[CheckoutController::class, 'page_checkout_success'])->middleware('authLoginUser');




// //////////   cart  //////////////////////
Route::post('/add_to_cart',[CartController::class, 'add_to_cart'])->middleware('authLoginUser');
Route::get('/load_qty_pro_cart',[CartController::class, 'load_qty_pro_cart'])->middleware('authLoginUser');
Route::get('/load_pro_cart_layout',[CartController::class, 'load_pro_cart_layout'])->middleware('authLoginUser');

Route::get('/go_to_cart',[CartController::class, 'go_to_cart'])->middleware('authLoginUser');
Route::get('/load_pro_cart_page',[CartController::class, 'load_pro_cart_page']);

Route::get('/delete_item_cart',[CartController::class, 'delete_item_cart']);
Route::post('/update_quanty',[CartController::class, 'update_quanty']);
Route::get('/load_qty_cart_page',[CartController::class, 'load_qty_cart_page']);

Route::get('/load_info_checkout_cart',[CartController::class, 'load_info_checkout_cart']);
Route::get('/checked_iteam',[CartController::class, 'checked_iteam']);



//////////Store manager
Route::get('/logout_store',[StoreManagerController::class, 'logout_store']);
Route::get('/StoreManager',[StoreManagerController::class, 'index'])->middleware('authLoginUser');
Route::get('/manage_product',[StoreManagerController::class, 'manage_product']  )->middleware('authLoginUser');
Route::get('/manage_category',[StoreManagerController::class, 'manage_category'] )->middleware('authLoginUser');
Route::get('/load_products_manager',[StoreManagerController::class, 'load_products_manager'] );



Route::post('/add_category_product',[StoreManagerController::class, 'add_category_product'] )->middleware('authLoginUser');
Route::get('/load_category_product',[StoreManagerController::class, 'load_category_product']  );
Route::get('/view_category_product',[StoreManagerController::class, 'view_category_product'] );
Route::post('/save_update_category_product',[StoreManagerController::class, 'save_update_category_product']  );
Route::get('/delete_cate_product',[StoreManagerController::class, 'delete_cate_product'] );


Route::get('/add_product_store',[StoreManagerController::class, 'add_product_store'] )->middleware('authLoginUser');
Route::post('/save_product_store',[StoreManagerController::class, 'save_product_store'] );
Route::get('/edit_product_store/{id_product}',[StoreManagerController::class, 'edit_product_store'] );
Route::post('/save_update_product_store/',[StoreManagerController::class, 'save_update_product_store'] );
Route::get('/delete_product_store',[StoreManagerController::class, 'delete_product_store'] );


Route::get('/attributes_1_classic_pro/{id_product}',[StoreManagerController::class, 'attributes_1_classic_pro'] )->middleware('authLoginUser');
Route::get('/attributes_2_classic_pro/{id_product}',[StoreManagerController::class, 'attributes_2_classic_pro'] )->middleware('authLoginUser');

Route::post('/save_type_products_classic/',[StoreManagerController::class, 'save_type_products_classic'] );
Route::get('/load_type_products_classic/',[StoreManagerController::class, 'load_type_products_classic'] );
Route::get('/delete_type_products_classic/',[StoreManagerController::class, 'delete_type_products_classic']);
Route::post('/edit_type_products_classic/',[StoreManagerController::class, 'edit_type_products_classic']);

Route::post('/save_type_products_2_classic/',[StoreManagerController::class, 'save_type_products_2_classic'] );
Route::get('/load_type_products_2_classic/',[StoreManagerController::class, 'load_type_products_2_classic'] );


Route::get('/load_option_type/',[StoreManagerController::class, 'load_option_type'] );

Route::post('/save_size_products_classic/',[StoreManagerController::class, 'save_size_products_classic'] );
Route::get('/load_size_products_classic/',[StoreManagerController::class, 'load_size_products_classic'] );
Route::post('/edit_size_products_classic/',[StoreManagerController::class, 'edit_size_products_classic']);
Route::get('/delete_size_products_classic/',[StoreManagerController::class, 'delete_size_products_classic']);

Route::get('/save_page_attributes_class/',[StoreManagerController::class, 'save_page_attributes_class'] );

Route::get('/manage_order_store',[StoreManagerController::class, 'manage_order_store'] )->middleware('authLoginUser');
Route::get('/load_order_manager',[StoreManagerController::class, 'load_order_manager'] );
Route::get('/delete_order_store',[StoreManagerController::class, 'delete_order_store'] );


Route::get('/view_detail_order_store/{id_order_store}',[StoreManagerController::class, 'view_detail_order_store'] )->middleware('authLoginUser');
Route::get('/update_status_order',[StoreManagerController::class, 'update_status_order']);


////////////////////////thong ke ///////////////////////////
Route::post('/filter-by-date',[statisticalController::class, 'filter_by_date']);

Route::post('/days-order',[statisticalController::class, 'days_order']);

Route::post('/dashboard-filter',[statisticalController::class, 'dashboard_filter']);


