<?php

namespace App\Http\Controllers;

use App\Mail\OTPMail;
use App\Models\Customer;
use App\Models\cart;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(){
        if(!Session::has('customer-cart')){
            Session::put('customer-cart', array());
        }
    }

    public function index()
    {
        return view('auth.login');
    }  
    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $result = Customer::where('emailid', $request->email)->orWhere('phone', $request->email)->first();
        if (!is_null($result) && Hash::check($request->password, $result->otp)) {
            $request->session()->put('customer-logged-in', true);
            $request->session()->put('customer-loggedin-id', $result->id);
            $request->session()->put('customer-loggedin-name', $result->name);
            $request->session()->put('customer-loggedin-email', $result->emailid);
            $request->session()->put('customer-loggedin-phone', $result->phone);
            
            return redirect("/dashboard")->withSuccess('You have signed-in');
        }
        
        return redirect("login")->withSuccess('Login details are not valid');
    }
    
    public function registration()
    {
        return view('auth.registration');
    }
    
    public function registration_process(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,emailid',
            'mobile_number' => 'unique:customers,phone',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        
        $data = new Customer();
        $data->name = $request->name;
        $data->emailid = $request->email;
        $data->phone = $request->mobile_number;
        $data->password = Hash::make($request->password);
        $data->save();
        
        $request->session()->put('customer-logged-in', true);
        $request->session()->put('customer-loggedin-id', $data->id);
        $request->session()->put('customer-loggedin-name', $data->name);
        $request->session()->put('customer-loggedin-email', $data->emailid);
        $request->session()->put('customer-loggedin-phone', $data->phone);
        
        return redirect("/dashboard")->withSuccess('You have signed-in');
    }
    
    public function dashboard(Request $request)
    {
        if($request->session()->get('customer-logged-in') == true) {
            $products = Product::where('is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id    
            LIMIT 1) AS image')->get();
            return view('auth.dashboard', ['products' => $products]);
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function logout(Request $request) {
        $request->session()->put('customer-logged-in', false);
        $request->session()->put('customer-loggedin-name', '');
        $request->session()->put('customer-loggedin-email', '');
        $request->session()->put('customer-loggedin-phone', '');
        return redirect('login');
    }
    
    public function send_otp(Request $request) {
        $customer = Customer::where('emailid', $request->emailphone)->orWhere('phone', $request->emailphone)->first();
        $otpnumber = rand(100000, 999999);
        if(is_null($customer)) {
            $customer = new Customer();
        }
        if(is_numeric($request->get('emailphone'))) {
            $validatormobile = Validator::make($request->all(), [ 
                'emailphone' =>'required|regex:/^[6-9][0-9]{9}$/|digits:10', 
            ]);
            
            if ($validatormobile->fails()) { 
                return response()->json([ 'status'=> false, 'error'=> $validatormobile->errors() ]);
            }
            
            $smsmessage = "Dear Customer, your OTP " . $otpnumber . " For Registration on Spicebucket.com Thanks Spice Bucket E-Retail (OPC) Pvt. Ltd.";
            sendSMS($request->get('emailphone'), $smsmessage);
            $customer->phone = $request->emailphone;
            $customer->otp = Hash::make($otpnumber);
            $customer->save();
        } else {
            $validatoremail = Validator::make($request->all(), [ 
                'emailphone' =>'required|email', 
            ]);
            
            if ($validatoremail->fails()) { 
                return response()->json([ 'status'=> false, 'error'=> $validatoremail->errors() ]);
            }
            Mail::send('mailtemplate.sendotp', array('otp' => $otpnumber), function($message) use ($request) {
                $message->to($request->emailphone)->subject('Welcome to SpiceBucket.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            // Mail::to($request->emailphone)->send(new OTPMail($otpnumber));
            $customer->emailid = $request->emailphone;
            $customer->otp = Hash::make($otpnumber);
            $customer->save();
        }
        return response()->json([ 'status'=> true ]);
    }
    
    public function addToCart(Request $request)
    {
        $cart = $request->session()->get('customer-cart');
        return view('cart', ['customercart' => $cart]);
    }
    
    public function mycart(Request $request){
        $totalquantity = $request->session()->get('totalquantity');
        $cart = $request->session()->get('customer-cart');
        if(is_null($cart)){
            $cart = array();
            $totalquantity = 0;
        }
        $product = Product::find($request->product_id);
        $image = ProductImage::where('product_id', $request->product_id)->first();
        $cart[$request->product_id] = array('title' => $product->name, 'price' => $product->net_price, 'quantity' => $request->quantity, 'totalprice' => number_format(($product->net_price * $request->quantity), 2), 'image' => $image->image);
        $request->session()->put('customer-cart', $cart);
        $totalquantity += 1;
        $request->session()->put('totalquantity', $totalquantity);
        return response()->json([ 'status'=> true ]);   
    }
    
    public function checkout(Request $request){
        if($request->session()->get('customer-logged-in') == true){
            $cart = $request->session()->get('customer-cart');
            return view('checkout',['customercart' => $cart]);
        }
        else{
            return redirect('login');
        }
    }
    public function removemycart(Request $request){
        $request->session()->put('customer-cart');
    }
}
