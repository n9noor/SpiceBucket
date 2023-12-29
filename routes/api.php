<?php

use App\Http\Controllers\ApiController;
// old comment by Niraj
//use App\Http\Controllers\AuthController;

use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\NotiApiController;
use App\Http\Controllers\API\OrderApiController;
use App\Http\Controllers\API\VendorProfileController;
use App\Http\Controllers\API\VendorProductController;
use App\Http\Controllers\API\CheckoutApiController;
use App\Http\Controllers\API\ProductControllerApi;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!|

*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [ApiController::class, 'login']);
Route::post('customer-login', [AuthController::class, 'login']);

// Route::post('register', [ApiController::class, 'register']);
// Route::post('forgot_password', [ApiController::class, 'forgot_password']);
// Route::post('change_password', [ApiController::class, 'change_password']);
// Route::post('verify_otp', [ApiController::class, 'verify_otp']);
// Route::post('add_address', [ApiController::class, 'add_address']);

Route::post('send-otp', [ApiController::class, 'send_otp']);
Route::post('delete-account', [ApiController::class, 'delete_account']);
Route::post('get-user-details', [ApiController::class, 'get_user_details']);
Route::post('get-user-addresses', [ApiController::class, 'get_customer_addresses']);
Route::post('update-user-details', [ApiController::class, 'update_customer']);
Route::post('update-user-addresses', [ApiController::class, 'update_customer_addresses']);

Route::post('get-wishlist', [WishlistController::class, 'api_wishlist']);
Route::post('add-wishlist', [WishlistController::class, 'api_wishlist_add']);
Route::post('delete-wishlist/{productId}/{customerId}', [WishlistController::class, 'deleteWishlist']);

Route::get('category', [ProductController::class, 'api_product_category']);
Route::get('shopByCategory', [ProductController::class, 'api_products']);
Route::get('shopByBrand/{customerid?}', [ProductController::class, 'api_products_vendors']);

Route::get('offer', [OffersController::class, 'api_category_wise_offer']);

Route::get('searchCategoryAndProduct', [HomeController::class, 'api_product_search']);
Route::get('search-suggestion', [HomeController::class, 'api_search_suggestion']);

Route::get('bannerList', [HomeController::class, 'api_banner_list']);
Route::get('topSellingProduct', [HomeController::class, 'api_top_selling_product']);
Route::get('mostPopularProduct', [HomeController::class, 'api_most_popular_product']);
Route::get('latestOffer', [HomeController::class, 'api_latest_offer']);
Route::get('highlyDiscountedOffer', [HomeController::class, 'api_highly_discounted_offer']);
Route::get('recommendedForYou', [HomeController::class, 'api_recommended_for_you']);
Route::get('bestsellers', [HomeController::class, 'api_besellers']);
Route::get('newAtSpiceBucket', [HomeController::class, 'api_new_at_spicebucket']);
Route::get('dailyEssentialNeeds', [HomeController::class, 'api_daily_essential_needs']);
Route::get('homePageOffers/{customerid?}', [HomeController::class, 'api_home_page_details']);
Route::get('mobileHomepage', [HomeController::class, 'getMobileAppHomePage']);

Route::get('brand', [VendorController::class, 'api_vendors']);
Route::get('store-list', [VendorController::class, 'api_vendors']);
Route::get('store-detail', [VendorController::class, 'api_store_detail']);
Route::get('store-offer', [VendorController::class, 'api_store_offer']);
Route::get('store-product', [VendorController::class, 'api_store_product']);
Route::get('store_wise_categorylist', [VendorController::class, 'api_store_categorey']);


// new api

Route::post('add-cart', [CartController::class, 'api_cart_add']);
Route::get('get-cart/{customerid}', [CartController::class, 'api_get_cart']);
Route::post('edit-cart', [CartController::class, 'api_edit_cart']);
Route::post('remove-cart', [CartController::class, 'api_cart_remove']);
Route::get('get-cart-address/{customerid}/{addressType?}', [CartController::class, 'api_get_cart_address']);

Route::get('product-detail/{productid}/{customerid?}', [ProductControllerApi::class, 'api_product_detail']);
Route::get('related-product/{productid}/{customerid?}', [ProductControllerApi::class, 'api_relatedProduct_detail']);
Route::get('Sub-category-list/{category_id}', [ProductControllerApi::class, 'api_subcategoryProduct_detail']);
Route::post('add-review', [ProductControllerApi::class, 'api_add_review']);
Route::get('get-review/{productid}', [ProductControllerApi::class, 'api_get_reviews']);
Route::get('get-rating/{productid}', [ProductControllerApi::class, 'api_product_rating']);
Route::post('add-recently-view', [ProductControllerApi::class, 'add_recently_view']);
Route::get('get-recently-view/{customerId}', [ProductControllerApi::class, 'get_recently_viewed']);

Route::post('verify-coupon/{customerid}', [CheckoutApiController::class, 'verifyCoupon']);
Route::get('get-coupon', [CheckoutApiController::class, 'getCoupon']);
Route::post('check-out', [CheckoutApiController::class, 'checkout']);
Route::get('my-order/{customerid}/{status?}', [OrderApiController::class, 'myorder']);
Route::get('order-status', [OrderApiController::class, 'getOrderStatus']);
Route::get('order-detail-status', [OrderApiController::class, 'getOrderDetailStatus']);
Route::get('my-order-detail/{orderId}', [OrderApiController::class, 'myorderdetail']);
Route::get('shipping-detail/{orderId}/{tracking_code}', [OrderApiController::class, 'trackingCode']);

Route::post('cancel-order', [OrderApiController::class, 'api_cancelOrder']);
Route::post('checkout', [CheckoutApiController::class, 'checkout']);
Route::post('update-order', [CheckoutApiController::class, 'update_order']);
Route::post('add-shipping-address', [CheckoutApiController::class, 'api_add_address']);
Route::get('get-shipping-address/{customer_id}/{addressType?}', [CheckoutApiController::class, 'api_get_addresses']);
Route::post('edit-shipping-address/{address_id}', [CheckoutApiController::class, 'api_edit_address']);
Route::post('delete-shipping-address/{address_id}', [CheckoutApiController::class, 'api_delete_address']); 

Route::post('save-card-detail', [CheckoutApiController::class, 'save_card_detail']);
Route::post('delete-card-detail', [CheckoutApiController::class, 'delete_card_detail']);
Route::get('get-card-detail/{customerId}', [CheckoutApiController::class, 'get_card_details']);

Route::get('get-notification', [NotiApiController::class, 'api_notifications']);

Route::post('vendor-register', [VendorProfileController::class, 'vendor_register_profile']);
Route::post('edit-profile/{id}', [VendorProfileController::class, 'edit_profile']);
Route::post('update-vendor/{id}', [VendorProfileController::class, 'update_Vendor']);
Route::get('get-vendor/{id}', [VendorProfileController::class, 'getVendorDetails']);
Route::post('upload-documnets/{id}', [VendorProfileController::class, 'uploadVendorDocuments']);
Route::post('remove-documnets/{id}', [VendorProfileController::class, 'removeUpdateDocuments']);
Route::post('vendor-login', [VendorProfileController::class, 'vendorlogin']);

Route::get('get-vendor-product/{vendorId}', [VendorProductController::class, 'api_get_products_by_vendor']);
Route::post('add-vendor-product', [VendorProductController::class, 'api_add_product']);
Route::post('add-product-url/{productId}', [VendorProductController::class, 'api_add_video_url']);
Route::post('update-product-price/{productId}', [VendorProductController::class, 'api_update_product']);
Route::post('update-B2b-price/{productId}', [VendorProductController::class, 'api_update_b2b_price']);
Route::post('add-product-image/{productId}', [VendorProductController::class, 'api_add_product_image']);
Route::get('get-variants-lisit', [VendorProductController::class, 'get_Variants_lisit']);
Route::get('get-variant-value-lisit/{variant_id}', [VendorProductController::class, 'get_Variant_value_lisit']);
Route::post('add-productvariant-price', [VendorProductController::class, 'add_productvariant_price']);
Route::get('get-productvariant-price/{product_id}', [VendorProductController::class, 'get_productvariant_prices']);
Route::post('update-productvariant-price/{product_variantprice_id}', [VendorProductController::class, 'update_product_variantprice']);

Route::get('vendor-order-detail/{vendorId}', [VendorProductController::class, 'getOrderDetailsWithExtraCharges']);

Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);

});




