<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'email' => 'required',
            'password' => 'required',
            'deviceId' => 'required',
            'firebaseToken' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        if(is_numeric($data->email)){
            $validatormobile = Validator::make($request->json()->all(), [ 
                'email' =>'regex:/^[6-9][0-9]{9}$/', 
            ]);
            
            if ($validatormobile->fails()) { 
                return response()->json([ 'status'=> false, 'message'=> $validatormobile->errors() ]);
            }
            
            $result = Customer::where('phone', $data->email)->where('is_active', true)->first();
            if(!is_null($result) && Hash::check($data->password, $result->otp)) {
                $tokenid = getRandomGeneratedString(16);
                Customer::where('id', $result->id)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseToken, 'token_id' => $tokenid]);
                return response()->json([
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'data' => ['emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'tokenId' => $tokenid, 'deviceId' => $data->deviceId, 'firebaseTokenId' => $data->firebaseToken, "profileImage" => $result->image]
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
                return response()->json([ 'status'=> false, 'message'=> $validatoremail->errors() ]);
            }
            
            $result = Customer::where('emailid', $data->email)->where('is_active', true)->first();
            if(!is_null($result) && (Hash::check($data->password, $result->password) || Hash::check($data->password, $result->otp))) {
                $tokenid = getRandomGeneratedString(16);
                Customer::where('id', $result->id)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseToken, 'token_id' => $tokenid]);
                return response()->json([
                    'status' => true,
                    'message' => 'User logged in successfully',
                    'data' => ['emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'tokenId' => $tokenid, 'deviceId' => $data->deviceId, 'firebaseTokenId' => $data->firebaseToken, "profileImage" => $result->image]
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.'
                ], 200);
            }
        }
    }
    
    /*    
    public function register(Request $request){
        $validator = Validator::make($request->json()->all(), [
            'email' => "required|email|unique:customers,emailid",
            'password' => 'required',
            'firstname' => 'required',
            'phone' => "required|unique:customers,phone",
            'secret_code' => 'required',
            'secret_key' => 'unique:customers,secretKey|required',
            'device_id' => 'unique:customers,deviceId|required',
            'firebase_token_id' => 'unique:customers,firebaseTokenId|required',
            'device_type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $insertedId = DB::table('customers')->insertGetId([
            'emailid' => $data->email,
            'password' => Hash::make($data->password),
            'name' => $data->name,
            'phone' => (property_exists($data, "phone") ? $data->phone : ""),
            'device_id' => $data->device_id,
            'firebase_token_id' => $data->firebase_token_id,
            'device_type' => $data->device_type,
            'secret_code' => Str::random(40),
            'secret_key' => Str::random(40),
            'token_id' => Str::random(16),
            'access_token' => Str::random(40),
            'access_token_expires' => date('Y-m-d H:i:s', strtotime('+1 Hour')),
            'dob' => (property_exists($data, "dob") ? $data->dob : "")
        ]);
        $result = DB::table('customers')->where('id', $insertedId)->first();
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'data' => ['emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'device_id' => $result->device_id, 'firebase_token_id' => $result->firebase_token_id, 'device_type' => $result->device_type, ] 
        ], 200);
    }
    
    public function forgot_password(Request $request) {
        $validator = Validator::make($request->json->all(), [
            'email' => "required|email"
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $result = DB::table('customers')->where('emailid', $data->email)->where('is_active', true)->first();
        if(!is_null($result)) {
            
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email ID is not registered with us.'
            ], 200);
        }
    }
    */    
    public function send_otp(Request $request) {
        $data = json_decode($request->getContent());
        $customer = Customer::where('emailid', $data->emailphone)->orWhere('phone', $data->emailphone)->first();
        $otpnumber = rand(100000, 999999);
        if(is_null($customer)) {
            $customer = new Customer();
        }
        if(is_numeric($data->emailphone)) {
            $validatormobile = Validator::make($request->json()->all(), [ 
                'emailphone' =>'required|regex:/^[6-9][0-9]{9}$/|digits:10', 
            ]);
            
            if ($validatormobile->fails()) { 
                return response()->json([ 'status'=> false, 'message'=> $validatormobile->errors() ]);
            }
            
            $smsmessage = "Dear Customer, your OTP " . $otpnumber . " For Registration on Spicebucket.com Thanks Spice Bucket E-Retail (OPC) Pvt. Ltd.";
            sendSMS($data->emailphone, $smsmessage);
            $customer->phone = $data->emailphone;
            $customer->otp = Hash::make($otpnumber);
            $customer->save();
        } else {
            $validatoremail = Validator::make($request->json()->all(), [ 
                'emailphone' =>'required|email', 
            ]);
            
            if ($validatoremail->fails()) { 
                return response()->json([ 'status'=> false, 'message'=> $validatoremail->errors() ]);
            }
            Mail::send('mailtemplate.sendotp', array('otp' => $otpnumber), function($message) use ($data) {
                $message->to($data->emailphone)->subject('Welcome to SpiceBucket.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            $customer->emailid = $data->emailphone;
            $customer->otp = Hash::make($otpnumber);
            $customer->save();
        }
        return response()->json([ 'status'=> true, 'message' => 'OTP Sent Successfully.' ]);
    }
    
    public function get_user_details(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseToken' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $result = Customer::where('token_id', $data->tokenId)->first();
        if(!is_null($result)) {
            Customer::where('id', $result->id)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseToken]);
            return response()->json([
                'status' => true,
                'message' => 'User found.',
                'data' => ['emailid' => $result->emailid, 'name' => $result->name, 'phone' => $result->phone, 'dob' => $result->dob, 'tokenId' => $result->token_id, 'deviceId' => $data->deviceId, 'firebaseTokenId' => $data->firebaseToken, "profileImage" => $result->image]
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 200);
        }
    }
    
    public function get_customer_addresses(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseToken' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $result = Customer::where('token_id', $data->tokenId)->first();
        if(!is_null($result)){
            $address = CustomerAddress::where('customer_id', $result->id)->get();
            if($address->count() > 0){
                return response()->json([
                    'status' => true,
                    'message' => count($address) . ' Address(es) found.',
                    'data' => $address
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "No address found. Please add new."
                ], 200);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => "No customer found."
            ], 200);
        }
    }
    
    public function update_customer(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseToken' => 'required',
            'name' => 'required',
            'emailid' => 'email',
            'phone' => 'regex:/^[6-9][0-9]{9}$/'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $customer = Customer::where('token_id', $data->tokenId)->first();
        $customer->device_id = $data->deviceId;
        $customer->firebase_token_id = $data->firebaseToken;
        $customer->name = $data->name;
        if(!empty($data->emailid)) {
            $customer->emailid = $data->emailid;
        }
        if(!empty($data->phone)) {
            $customer->phone = $data->phone;
        }
        if(!empty($data->dob)) {
            $customer->dob = $data->dob;
        }
        $customer->save();
        return response()->json([
            'status' => true,
            'message' => 'Data saved successfully.'
        ], 200);
    }
    
    public function update_customer_addresses(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseToken' => 'required',
            'address_type' => 'required',
            'addressline1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $data = json_decode($request->getContent());
        $customer = Customer::where('token_id', $data->tokenId)->first();
        if(!is_null($customer)) {
            $address = new CustomerAddress();
            if(!empty($data->id) && strlen($data->id) > 0 && is_numeric($data->id)) {
                $address = CustomerAddress::findOrFail($data->id);
            }
            $address->customer_id = $customer->id;
            $address->address_type = $data->address_type;
            $address->address_line_1 = $data->addressline1;
            if(!empty($data->addressline2)){
                $address->address_line_2 = $data->addressline2;
            }
            if(!empty($data->addressline3)){
                $address->address_line_3 = $data->addressline3;
            }
            $address->city = $data->city;
            $address->state = $data->state;
            $address->pincode = $data->pincode;
            $address->country = $data->country;
            $address->created_by = 0;
            $address->updated_by = 0;
            $address->save();
            $address = CustomerAddress::where('customer_id', $customer->id)->get();
            return response()->json([
                'status' => true,
                'message' => "Address Saved Successfully.",
                'data' => $address
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No customer found"
            ]);
        }
    }
}
