<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VendorController;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Variable;

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
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [AuthController::class, 'dashboard']); 
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

Route::prefix('administrator')->group(function (){
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
    Route::post('/update-status', [AdministratorController::class, 'update_status']);
    Route::get('/vendor-document-type', [AdministratorController::class, 'vendor_documenttype']);
    Route::post('/save-document-type', [AdministratorController::class, 'save_documenttype']);
    
    Route::get('/users', [UserController::class, 'user_list']);
    Route::get('/add-user', [UserController::class, 'user_add']);
    Route::get('/edit-user/{user}', [UserController::class, 'user_edit']);
    Route::post('/save-user', [UserController::class, 'user_save']);
    Route::put('/update-user/{user}', [UserController::class, 'user_update']);
    Route::get('/delete-user/{user}', [UserController::class, 'user_delete']);
    
    Route::get('/roles', [UserController::class, 'role_list']);
});

Route::prefix('vendors')->group(function () {
    Route::get('/', [VendorController::class, 'index']);
    Route::get('/dashboard', [VendorController::class, 'dashboard']);
    Route::get('/login', [VendorController::class, 'login']);
    Route::get('/register', [VendorController::class, 'register']);
    Route::post('/registration', [VendorController::class, 'registration']);
    Route::post('/login_process', [VendorController::class, 'login_process']);
    Route::get('/logout', [VendorController::class, 'logout']);

    Route::get('/my-profile', [VendorController::class, 'profile']);
    Route::post('/update-profile', [VendorController::class, 'update_profile']);
});

Route::prefix('products')->group(function () {
    Route::get('/list', [ProductController::class, 'product_list']);
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/edit-product/{product}', [ProductController::class, 'edit_product']);
    Route::post('/save-product', [ProductController::class, 'save_product']);
    Route::put('/update-product/{product}', [ProductController::class, 'update_product']);
    Route::get('/delete-product/{product}', [ProductController::class, 'delete_product']);

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
});
