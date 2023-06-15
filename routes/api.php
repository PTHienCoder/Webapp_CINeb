<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiHomeController;
use App\Http\Controllers\api\ApiShoppingController;
use App\Http\Controllers\api\ApiCheckout;
use App\Http\Controllers\api\ApiCart;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/PostLoginUser', [ApiHomeController::class, 'PostLoginUser']);
Route::post('/PostSignupUser', [ApiHomeController::class, 'PostSignupUser']);


Route::get('/GetIforUser', [ApiHomeController::class, 'GetIforUser']);
Route::get('/Get_Qty_Follower', [ApiHomeController::class, 'Get_Qty_Follower']);

Route::get('/LoadPost', [ApiHomeController::class, 'LoadPost']);


Route::get('/LoadCategory', [ApiShoppingController::class, 'LoadCategory']);

Route::get('/LoadProduct_Sale', [ApiShoppingController::class, 'LoadProduct_Sale']);
Route::get('/LoadProduct_All', [ApiShoppingController::class, 'LoadProduct_All']);

Route::get('/LoadDetailProduct', [ApiShoppingController::class, 'LoadDetailProduct']);
Route::get('/LoadIforStore', [ApiShoppingController::class, 'LoadIforStore']);

Route::get('/LoadRview_Product', [ApiShoppingController::class, 'LoadRview_Product']);

Route::get('/LoadTypeProduct', [ApiShoppingController::class, 'LoadTypeProduct']);
Route::get('/LoadSizeProduct', [ApiShoppingController::class, 'LoadSizeProduct']);
Route::get('/getDetails_Affter_choose', [ApiShoppingController::class, 'getDetails_Affter_choose']);


Route::post('/AddProductCart', [ApiCart::class, 'AddProductCart']);
Route::get('/Get_Qty_Cart', [ApiCart::class, 'Get_Qty_Cart']);

Route::get('/LoadProductCart', [ApiCart::class, 'LoadProductCart']);
Route::post('/Update_checkItemCart', [ApiCart::class, 'Update_checkItemCart']);
Route::post('/Update_QtyItemCart', [ApiCart::class, 'Update_QtyItemCart']);
Route::post('/Clear_IteamCart', [ApiCart::class, 'Clear_IteamCart']);

Route::get('/LoadPriceCheckout', [ApiCart::class, 'LoadPriceCheckout']);



Route::post('/PostCommentProduct', [ApiShoppingController::class, 'PostCommentProduct']);
Route::get('/Load_Qty_Review', [ApiShoppingController::class, 'Load_Qty_Review']);


Route::get('/GetInfo_Ship', [ApiCheckout::class, 'GetInfo_Ship']);
Route::get('/LoadItem_CheckOut', [ApiCheckout::class, 'LoadItem_CheckOut']);

Route::post('comfirm_checkout_CartItem', [ApiCheckout::class, 'comfirm_checkout_CartItem']);
Route::post('comfirm_checkout_BuyItem', [ApiCheckout::class, 'comfirm_checkout_BuyItem']);


////////////////////////////////

Route::get('Load_Cate_Post', [ApiHomeController::class, 'Load_Cate_Post']);
Route::get('Load_ItemPost_cate', [ApiHomeController::class, 'Load_ItemPost_cate']);

Route::get('getnotification', [ApiHomeController::class, 'getnotification']);
Route::get('Clear_notification', [ApiHomeController::class, 'Clear_notification']);

Route::get('getCmt', [ApiHomeController::class, 'getCmt']);
Route::post('postComment', [ApiHomeController::class, 'postComment']);

Route::get('getiduserfollow', [ApiHomeController::class, 'getiduserfollow']);
Route::post('deletefollow', [ApiHomeController::class, 'deletefollow']);
Route::post('savefollow', [ApiHomeController::class, 'savefollow']);


Route::get('getidusersavepost', [ApiHomeController::class, 'getidusersavepost']);
Route::post('deletesave', [ApiHomeController::class, 'deletesave']);
Route::post('savepost', [ApiHomeController::class, 'savepost']);


Route::get('getMy_post', [ApiHomeController::class, 'getMy_post']);
Route::get('getsave_post', [ApiHomeController::class, 'getsave_post']);

Route::get('get_product_post', [ApiHomeController::class, 'get_product_post']);



Route::get('Get_My_Order', [ApiCheckout::class, 'Get_My_Order']);
Route::get('Get_My_Store_Order', [ApiCheckout::class, 'Get_My_Store_Order']);
Route::get('Get_My_Order_Product', [ApiCheckout::class, 'Get_My_Order_Product']);

Route::get('Load_Shipping', [ApiCheckout::class, 'Load_Shipping']);
Route::get('Clear_Shipping', [ApiCheckout::class, 'Clear_Shipping']);
Route::post('Update_Check_Shipping', [ApiCheckout::class, 'Update_Check_Shipping']);


Route::post('Search_Post', [ApiHomeController::class, 'Search_Post']);
Route::post('Search_Product', [ApiHomeController::class, 'Search_Product']);
Route::post('Get_Product_category', [ApiHomeController::class, 'Get_Product_category']);







