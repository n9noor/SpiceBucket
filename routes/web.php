<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SellerNotificationController;
// use App\Http\Controllers\CustomerNotificationsController;
use App\Http\Controllers\VendorUserController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

/**Clear cache */
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    Cache::flush();
    cache()->flush();

    return 'cache cleared';
});

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

Route::get('/our-sellers', [HomeController::class, 'our_sellers']);
Route::get('/', [HomeController::class, 'index']);
Route::get('/cart', [AuthController::class, 'addToCart']);
Route::get('/mycart', [AuthController::class, 'mycart']);
Route::get('/show-cart', [AuthController::class, 'showCart']);
Route::get('/wishlist-count', [AuthController::class, 'showWishlistCount']);
Route::post('/update-cart', [AuthController::class, 'updateCart']);
Route::post('/remove-mycart', [AuthController::class, 'removemycart']);
Route::get('/checkout', [AuthController::class, 'checkout']);
Route::get('/wishlist', [AuthController::class, 'showWishlist']);
Route::post('/wishlist', [AuthController::class, 'Wishlist']);
Route::post('/remove-wishlist', [AuthController::class, 'removeWishlist']);

/**Notifications */
Route::get('/notification', [AuthController::class, 'customer_notifications']);
Route::get('/notification/{id}/view', [AuthController::class, 'customer_notifications_view']); 

//Route::get('/about-us', [HomeController::class, 'aboutus']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/contact-us', [HomeController::class, 'contact']);
Route::get('/faq', [HomeController::class, 'faq']);
// Route::get('/brands', [HomeController::class, 'vendors_list']);
Route::get('/quickviewProduct', [HomeController::class, 'quickviewProduct']);
Route::get('/quick-view-variant-price', [HomeController::class, 'quickviewVariantProductPrice']);
Route::post('/add-customer-detail', [HomeController::class, 'addCustomerDetail']);
Route::get('/verify-email/{encryptId}', [HomeController::class, 'verifyEmail']);
Route::get('/product-categories/{slug}', [HomeController::class, 'product_category_view']);
Route::get('/product/{slug}', [HomeController::class, 'product_view']);
Route::get('/brand/{slug}', [HomeController::class, 'vendor_view']);
Route::post('/customer-enquiry', [HomeController::class, 'enquiry']);

Route::get('/get-orderid-sellers', [HomeController::class, 'getOrderidSellers']);
Route::get('/get-orderid-seller-status', [HomeController::class, 'getOrderidSellersStatus']);
Route::get('/get-city-state-from-pincode', [HomeController::class, 'getCityStatePincode']);
Route::post('/update-default-address', [HomeController::class, 'updateDefaultAddress']);
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::post('/dashboard', [HomeController::class, 'editCustomerDetial']);
Route::get('/download-invoice/{filename}', [HomeController::class, 'downloadInvoice']);
Route::post('/update-customer-addresss', [HomeController::class, 'editCustomerAddress']);
Route::get('/get-customer-address', [HomeController::class, 'getCustomerAddress']);
Route::get('/get-customer-addresses', [HomeController::class, 'getCustomerAddresses']);
Route::post('/delete-customer-address', [HomeController::class, 'deleteCustomerAddress']);
Route::get('/get-order-invoice', [HomeController::class, 'getOrderInvoice']);
Route::get('/get-order-invoice-pdf', [HomeController::class, 'getOrderInvoicePdf']);
Route::get('/sellet-to-customer-invoice-pdf', [HomeController::class, 'sellerToCustomerInvoice']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login-process', [AuthController::class, 'login_process']);
Route::get('/registration', [AuthController::class, 'registration']);
Route::post('/registration-process', [AuthController::class, 'registration_process']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/send-otp', [AuthController::class, 'send_otp']);

Route::get('/login/google', [GoogleController::class, 'redirect']);
Route::get('/login/google/callback', [GoogleController::class, 'callback']);

Route::get('/login/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::get('/razorpay', [RazorpayController::class, 'razorpay']);
Route::post('/orderid-generate', [RazorpayController::class, 'orderIdGenerate']);
Route::post('/razorpaypayment', [RazorpayController::class, 'payment']);
// Route::get('/razorpaypayment', [RazorpayController::class, 'testMailOrder']);
Route::post('/razorpaypaymentcod', [RazorpayController::class, 'paymentcod']);
Route::get('/razorpaypaymentcodtest', [RazorpayController::class, 'paymentcodtest']);

Route::get('/razorpaypaymentwallet', [RazorpayController::class, 'paymentwalletcodtest']); // for wallet test
Route::post('/razorpaypaymentwallet', [RazorpayController::class, 'paymentwalletcodtest']); // for wallet test
Route::get('/pdf-view/{orderid}', [RazorpayController::class, 'pdfView']);

Route::post('/verify-coupon', [CouponsController::class, 'verify']);

Route::get('/blog', [BlogController::class, 'frontpage']);
Route::get('/blog/{category}', [BlogController::class, 'frontpage']);
Route::get('/blog/{category}/{slug}', [BlogController::class, 'frontpage_detail']);

Route::get('/offers', [OffersController::class, 'index']);
Route::get('/popular-stores', [OffersController::class, 'popular_stores']);

Route::post('/cancel-order/{id}', [ProductController::class, 'cancel_order']);
Route::post('/cancel-order-vendorwise/{id}/{orderid}', [ProductController::class, 'cancel_order_vendorwise']);
Route::post('/check-pincode-availablity', [ProductController::class, 'check_availablity']);
Route::get('/products/view-live-product/{id}', [HomeController::class, 'product_live_view']);
Route::prefix('administrator')->group(function () {

    Route::get('/blogs', [BlogController::class, 'bloglist']);
    Route::get('/add-blog', [BlogController::class, 'add']);
    Route::post('/save-blog', [BlogController::class, 'save']);
    Route::get('/edit-blog/{id}', [BlogController::class, 'edit']);
    Route::post('/update-blog/{id}', [BlogController::class, 'update']);
    Route::get('/delete-blog/{id}', [BlogController::class, 'deleteblog']);

    Route::get('/customers', [CustomerController::class, 'index']);

    Route::get('/add-faq', [FaqController::class, 'add']);
    Route::get('/faq', [FaqController::class, 'list']);
    Route::get('/get-faq/{id}', [FaqController::class, 'getFAQ']);

    Route::post('/', [AdministratorController::class, 'login_process']);
    Route::get('/', [AdministratorController::class, 'index']);
    Route::get('/dashboard', [AdministratorController::class, 'index']);
    Route::get('/login', [AdministratorController::class, 'login']);
    Route::get('/logout', [AdministratorController::class, 'logout']);

    Route::get('/verify-vendor', [VendorController::class, 'verify_vendor']);
    Route::get('/add-vendor', [VendorController::class, 'add_vendor']);
    Route::get('/view-vendor/{vendor}', [VendorController::class, 'edit_vendor']);
    Route::post('/save-vendor', [VendorController::class, 'save_vendor']);
    Route::post('/approve-status', [AdministratorController::class, 'approve_status']);
    Route::post('/product-approve-status', [AdministratorController::class, 'product_approve_status']);
    Route::post('/update-status', [AdministratorController::class, 'update_status']);
    Route::get('/vendor-document-type', [AdministratorController::class, 'vendor_documenttype']);
    Route::post('/save-document-type', [AdministratorController::class, 'save_documenttype']);
    Route::post('/map-vendor-qac', [AdministratorController::class, 'map_vendor_qac']);
    Route::post('/map-tab-category-vendor', [AdministratorController::class, 'map_vendor_tabcategory']);

    Route::get('/users', [UserController::class, 'user_list']);
    Route::get('/add-user', [UserController::class, 'user_add']);
    Route::get('/edit-user/{user}', [UserController::class, 'user_edit']);
    Route::post('/save-user', [UserController::class, 'user_save']);
    Route::put('/update-user/{user}', [UserController::class, 'user_update']);
    Route::get('/delete-user/{user}', [UserController::class, 'user_delete']);

    Route::get('/roles', [UserController::class, 'role_list']);
    Route::get('/add-role', [UserController::class, 'role_add']);
    Route::get('/edit-role/{role}', [UserController::class, 'role_edit']);
    Route::post('/save-role', [UserController::class, 'role_save']);
    Route::put('/update-role/{role}', [UserController::class, 'role_update']);
    Route::get('/delete-role/{role}', [UserController::class, 'role_delete']);

    Route::get('/coupons', [CouponsController::class, 'index']);
    Route::get('/add-coupon', [CouponsController::class, 'add_coupon']);
    Route::post('/save-coupon', [CouponsController::class, 'save_coupon']);
    Route::get('/delete-coupon/{id}', [CouponsController::class, 'delete_coupon']);

    Route::get('/static-page', [StaticPageController::class, 'index']);
    Route::get('/add-static-page', [StaticPageController::class, 'add_staticpage']);
    Route::post('/save-static-page', [StaticPageController::class, 'save_staticpage']);
    Route::get('/edit-static-pages/mobile-app-home-page', [StaticPageController::class, 'mobileAppHomePage']);
    Route::post('/edit-static-pages/save-mobile-app-home-page', [StaticPageController::class, 'saveMobileAppHomePage']);
    Route::post('/edit-static-pages/delete-mobile-app-home-page-element', [StaticPageController::class, 'deleteMobileAppHomePageElement']);
    Route::get('/edit-static-pages/header', [StaticPageController::class, 'staticHeader']);
    Route::post('/edit-static-pages/save-header', [StaticPageController::class, 'saveStaticHeader']);
    Route::get('/edit-static-pages/footer', [StaticPageController::class, 'staticFooter']);
    Route::post('/edit-static-pages/save-footer', [StaticPageController::class, 'saveStaticFooter']);
    Route::get('/edit-static-pages/about-us', [StaticPageController::class, 'staticAboutUs']);
    Route::post('/edit-static-pages/save-about-us', [StaticPageController::class, 'saveStaticAboutUs']);
    Route::get('/edit-static-pages/contact-us', [StaticPageController::class, 'staticContactUs']);
    Route::post('/edit-static-pages/save-contact', [StaticPageController::class, 'saveStaticContact']);
    Route::get('/edit-static-pages/contact-us', [StaticPageController::class, 'staticContactUs']);
    Route::post('/edit-static-pages/save-contact', [StaticPageController::class, 'saveStaticContact']);
    Route::get('/edit-static-pages/home', [StaticPageController::class, 'staticHome']);
    Route::post('/edit-static-pages/save-home', [StaticPageController::class, 'saveStaticHomeBanner']);
    Route::post('/edit-static-pages/delete-home-banner', [StaticPageController::class, 'deleteStaticHomeBanner']);
    Route::get('/edit-static-page/{id}', [StaticPageController::class, 'edit_staticpage']);
    Route::post('/update-static-page/{id}', [StaticPageController::class, 'update_staticpage']);
});
    Route::group(['prefix' => 'administrator','middleware' => ['admin']], function () {
    // mail routes
     Route::get('/mail', [MailController::class, 'index']);
     Route::get('/mail/add', [MailController::class, 'add']);
     Route::post('/mail/save', [MailController::class, 'save']);
     Route::get('/mail/{id}/edit', [MailController::class, 'edit']); 
   

     // message 
     Route::get('/message', [MessageController::class, 'index']);
     Route::get('/message/add', [MessageController::class, 'add']);
     Route::post('/message/save', [MessageController::class, 'save']);
     Route::get('/message/{id}/edit', [MessageController::class, 'edit']); 
  
     // Seller Notification 
     Route::get('/notification/sellers', [SellerNotificationController::class, 'index']);
     Route::get('/notification/sellers/add', [SellerNotificationController::class, 'add']);
     Route::post('/notification/sellers/save', [SellerNotificationController::class, 'save']);
     Route::get('/notification/sellers/{id}/edit', [SellerNotificationController::class, 'edit']); 
     Route::get('/notification/sellers/{id}/view', [SellerNotificationController::class, 'view']); 

      // Customer Notification 
      Route::get('/notification/customers', [SellerNotificationController::class, 'list']);
      Route::get('/notification/customers/add', [SellerNotificationController::class, 'add_customer']);
      Route::post('/notification/customers/save', [SellerNotificationController::class, 'save_customer']);
      Route::get('/notification/customers/{id}/edit', [SellerNotificationController::class, 'edit_customer']); 
      Route::get('/notification/customers/{id}/view', [SellerNotificationController::class, 'view']); 

     
    
});

Route::prefix('sellers')->group(function () {
    Route::get('/list', [VendorController::class, 'index']);
    Route::get('/', [VendorController::class, 'dashboard']);
    Route::get('/dashboard', [VendorController::class, 'dashboard']);
    Route::get('/login', [VendorController::class, 'login']);
    Route::get('/register', [VendorController::class, 'register']);
    Route::post('/registration', [VendorController::class, 'registration']);
    Route::post('/login_process', [VendorController::class, 'login_process']);
    Route::get('/logout', [VendorController::class, 'logout']);

    Route::post('/verify/attribute', [VendorController::class, 'verify_vendor_property']);
    Route::post('/verify/{type}', [VendorController::class, 'verify_property']);

    Route::get('/my-profile', [VendorController::class, 'profile']);
    Route::post('/update-profile', [VendorController::class, 'update_profile']);
    Route::get('/settings', [VendorController::class, 'settings']);
    Route::post('/update-setting', [VendorController::class, 'update_setting']);
    Route::post('/delete-slider-banner-image', [VendorController::class, 'deletesliderbanner_image']);

    Route::get('/users', [VendorUserController::class, 'user_list']);
    Route::get('/add-user', [VendorUserController::class, 'user_add']);
    Route::get('/edit-user/{user}', [VendorUserController::class, 'user_edit']);
    Route::post('/save-user', [VendorUserController::class, 'user_save']);
    Route::put('/update-user/{user}', [VendorUserController::class, 'user_update']);
    Route::get('/delete-user/{user}', [VendorUserController::class, 'user_delete']);

    Route::get('/roles', [VendorUserController::class, 'role_list']);
    Route::get('/add-role', [VendorUserController::class, 'role_add']);
    Route::get('/edit-role/{role}', [VendorUserController::class, 'role_edit']);
    Route::post('/save-role', [VendorUserController::class, 'role_save']);
    Route::put('/update-role/{role}', [VendorUserController::class, 'role_update']);
    Route::get('/delete-role/{role}', [VendorUserController::class, 'role_delete']);

    Route::get('/orders', [OrderController::class, 'vendor_orders']);
    Route::post('/orders', [OrderController::class, 'vendor_orders']);
    Route::post('/update-order-details', [OrderController::class, 'update_order']);
    Route::get('/orders/view/{id}/{vendorid}', [OrderController::class, 'order_view']);
    Route::get('/orders/download-invoice/{id}', [OrderController::class, 'downloadInvoice']);


    Route::post('/generate-waybill-reference-number', [OrderController::class, 'generateReferenceNumber']);
    Route::post('/cancelled-waybill-reference-number', [OrderController::class, 'cancelledReferenceNumber']);

    Route::prefix('ticket')->group(function () {
        Route::get('/', [TicketsController::class, 'vendor_ticketlist']);
        Route::get('/add', [TicketsController::class, 'vendor_add']);
        Route::post('/save', [TicketsController::class, 'vendor_save']);
        Route::get('/{id}', [TicketsController::class, 'vendor_detail']);
        Route::post('/update-status/{id}', [TicketsController::class, 'vendor_update_status']);
        Route::post('/update-comment/{id}', [TicketsController::class, 'vendor_update_comment']);
        Route::get('/read-notes/{id}', [TicketsController::class, 'vendor_get_notes']);
    });
    Route::get('/notification', [SellerNotificationController::class, 'seller_notifications']);
    Route::get('/notification/{id}/view', [SellerNotificationController::class, 'seller_notifications_view']); 
});

Route::prefix('report')->group(function () {
    Route::get('/order', [ReportController::class, 'order']);
    Route::get('/invoice-tax', [ReportController::class, 'invoice_tax']);
    Route::get('/get-invoice-tax', [ReportController::class, 'get_invoice_tax']);
    Route::get('/sale-summary', [ReportController::class, 'sale_summary']);
    Route::post('/order', [ReportController::class, 'order']);
    Route::post('/invoice-tax', [ReportController::class, 'invoice_tax']);
    Route::post('/sale-summary', [ReportController::class, 'sale_summary']);
});

Route::prefix('products')->group(function () {
    Route::get('/list', [ProductController::class, 'product_list']);
    Route::post('/list', [ProductController::class, 'product_list']);
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/view-product/{product}', [ProductController::class, 'view_product']);
    Route::get('/edit-product/{product}', [ProductController::class, 'edit_product']);
    Route::post('/save-product', [ProductController::class, 'save_product']);
    Route::put('/update-product/{product}', [ProductController::class, 'update_product']);
    Route::get('/delete-product/{product}', [ProductController::class, 'delete_product']);
    Route::get('/delete-image', [ProductController::class, 'delete_product_image']);
    Route::post('/review-product', [ProductController::class, 'reviewProduct']);

    Route::get('/categories', [ProductController::class, 'product_category']);
    Route::get('/add-product-category', [ProductController::class, 'add_category']);
    Route::get('/edit-product-category/{product_category}', [ProductController::class, 'edit_category']);
    Route::post('/save-product-category', [ProductController::class, 'save_category']);
    Route::put('/update-product-category/{product_category}', [ProductController::class, 'update_category']);
    Route::get('/delete-product-category/{product_category}', [ProductController::class, 'delete_category']);

    Route::get('/variant-type', [VariantController::class, 'variant_type']);
    Route::get('/variant-value', [VariantController::class, 'variant_value']);
    Route::post('/save-variant-type', [VariantController::class, 'save_variant_type']);
    Route::post('/save-variant-value', [VariantController::class, 'save_variant_value']);

   // Route::get('/view-live-product/{id}', [HomeController::class, 'product_live_view']);
});

Route::prefix('offer')->group(function () {
    Route::get('/list', [OffersController::class, 'list']);
    Route::get('/add', [OffersController::class, 'add']);
    Route::post('/save', [OffersController::class, 'save']);
    Route::get('/edit/{id}', [OffersController::class, 'edit']);
    Route::post('/update/{id}', [OffersController::class, 'update']);
    Route::get('/delete/{id}', [OffersController::class, 'delete']);
});

Route::prefix('ticket')->group(function () {
    Route::get('/', [TicketsController::class, 'ticketlist']);
    Route::get('/get-department-user', [TicketsController::class, 'getDepartmentUser']);
    Route::get('/add', [TicketsController::class, 'add']);
    Route::post('/save', [TicketsController::class, 'save']);
    Route::get('/{id}', [TicketsController::class, 'detail']);
    Route::post('/update-status/{id}', [TicketsController::class, 'update_status']);
    Route::post('/update-comment/{id}', [TicketsController::class, 'update_comment']);
    Route::get('/read-notes/{id}', [TicketsController::class, 'get_notes']);
});



Route::domain('businesssite.spicebucket.com')->group(function () {
});




Route::get('{slug}', [StaticPageController::class, 'getPage'])->where('slug', '([A-Za-z0-9\-\/]+)');


 