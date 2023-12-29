<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\DeliveryStatus;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\OrderDetail;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Auth\TokenGuard;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
  

    public function login(Request $request) {
       
         if(auth()->guard('api')->attempt(['emailid' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'api']);
            
            $client = Customer::select('clients.*')->find(auth()->guard('api')->user()->id);
             
            $success =  $client;
            $success['token'] =  $client->createToken('MyApp',['api'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
       





         if(Auth::guard('api')->attempt(['emailid' => $request->email,'password'=>'12345'])){ 

            
            $user = Auth::user(); 
            
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['name'] =  $user->name;
            dd($success);
            return $this->sendResponse($success, 'User login successfully.');
        } 
        die;

        $validator = Validator::make($request->json()->all(), [
            'email' => 'required',
            'otp' => 'required',
            'deviceId' => 'required',            
            'firebaseToken' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
        $data = json_decode($request->getContent());
        if(is_numeric($data->email)){
            $validatormobile = Validator::make($request->json()->all(), [ 
                'email' =>'regex:/^[6-9][0-9]{9}$/', 
            ]);
            
            if ($validatormobile->fails()) { 
                return response()->json([ 'status'=> false, 'message'=> implode(",", $validatormobile->messages()->all()) ]);
            }
            
            $result = Customer::where('phone', $data->email)->where('is_active', true)->first();
            if(!is_null($result) && Hash::check($data->otp, $result->otp)) {
                $tokenid = getRandomGeneratedString(16);
                Customer::where('id', $result->id)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseToken, 'token_id' => $tokenid]);
                return response()->json([
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'data' => ['customer_id' => $result->id, 'emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'tokenId' => $tokenid, 'deviceId' => $data->deviceId, 'firebaseTokenId' => $data->firebaseToken, "profileImage" => $result->image]
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP.'
                ], 200);
            }
        } else {
            $validatoremail = Validator::make($request->json()->all(), [ 
                'email' =>'email', 
            ]);
            
            if ($validatoremail->fails()) { 
                return response()->json([ 'status'=> false, 'message'=> implode(",", $validatoremail->messages()->all()) ]);
            }
            
            $result = Customer::where('emailid', $data->email)->where('is_active', true)->first();
            if(!is_null($result) && Hash::check($data->otp, $result->otp)) {
                $tokenid = getRandomGeneratedString(16);
                //Customer::where('id', $result->id)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseToken, 'token_id' => $tokenid]);
                return response()->json([
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'data' => ['id' => $result->id, 'emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'tokenId' => $tokenid,  "profileImage" => $result->image]
                ], 200);   //'deviceId' => $data->deviceId, 'firebaseTokenId' => $data->firebaseToken,
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.'
                ], 200);
            }
        }
    }
}
