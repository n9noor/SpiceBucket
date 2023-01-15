<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [ApiController::class, 'login']);
/*
Route::post('register', [ApiController::class, 'register']);
Route::post('forgot_password', [ApiController::class, 'forgot_password']);
Route::post('change_password', [ApiController::class, 'change_password']);
Route::post('verify_otp', [ApiController::class, 'verify_otp']);
Route::post('add_address', [ApiController::class, 'add_address']);
*/
Route::post('send-otp', [ApiController::class, 'send_otp']);
Route::post('get-user-details', [ApiController::class, 'get_user_details']);
Route::post('get-user-addresses', [ApiController::class, 'get_customer_addresses']);
Route::post('update-user-details', [ApiController::class, 'update_customer']);
Route::post('update-user-addresses', [ApiController::class, 'update_customer_addresses']);