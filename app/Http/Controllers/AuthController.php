<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\Reward;
use App\Models\RewardHistory;
use App\Models\StaticPage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Mail as MailModel;
use App\Models\Message;
use App\Models\Notification;
//use DB;

use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{


    public function index()
    {
        if (Session::get('customer-logged-in') == true) {
            return redirect("/dashboard")->withSuccess('You have signed-in');
        }
        Session::put('login-url', request()->headers->get('referer'));
        $headercategories = getHeaderCategories();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        return view('auth.login', ['activePage' => '', 'headercategories' => $headercategories, 'categories' => $categories, 'vendors' => $vendors, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true))]);
    }

    public function login_process(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $result = Customer::where('emailid', $request->email)->orWhere('phone', $request->email)->first();
        if (!is_null($result) && Hash::check($request->password, $result->otp)) {
            $redirectUri = $request->session()->get('login-url');

            $request->session()->put('customer-logged-in', true);
            $request->session()->put('customer-loggedin-id', $result->id);
            $request->session()->put('customer-loggedin-name', $result->name);
            $request->session()->put('customer-loggedin-email', $result->emailid);
            $request->session()->put('customer-loggedin-phone', $result->phone);

            /**Manage notification */
            $search_customer_id = session('customer-loggedin-id');
            $notifications = Notification::where('source', 2)
                                ->where('is_active', 0)
                                ->whereRaw("find_in_set('".$search_customer_id."',notifications.customers)")
                                ->orderBy('id','ASC')
                                ->count();
            $request->session()->put('notificationCount', $notifications);
                            
            /**Manage notification */
            if (!is_null($request->session()->get('customer-wishlist'))) {
                $wishlist = $request->session()->get('customer-wishlist');
                foreach ($wishlist as $list) {
                    $resultWish = Wishlist::where('customer_id', $result->id)->where('product_id', $list)->get();
                    if (count($resultWish) == 0) {
                        $wishlistObj = new Wishlist();
                        $wishlistObj->customer_id = $result->id;
                        $wishlistObj->product_id = $list;
                        $wishlistObj->save();
                    }
                }
            }
            $wishlists = array();
            $wishlist = Wishlist::where('customer_id', Session::get('customer-loggedin-id'))->get();
            if(count($wishlist) > 0){
                foreach($wishlist as $wish_list){
                    array_push($wishlists, $wish_list->product_id);
                }
            }
            $request->session()->put('customer-wishlist', $wishlists);

            if (!is_null($request->session()->get('customer-cart'))) {
                $carts = $request->session()->get('customer-cart');
                foreach ($carts as $productid => $cart) {
                    foreach ($cart as $variantid => $customercart) {
                        $data = Cart::where('customerid', Session::get('customer-loggedin-id'))->where('productid', $productid)->where('variantid', $variantid)->first();
                        if ($data == null) {
                            $data = new Cart();
                        }
                        $data->customerid = Session::get('customer-loggedin-id');
                        $data->productid = $productid;
                        $data->variantid = $variantid;
                        $data->quantity = $customercart['quantity'];
                        $data->save();
                    }
                }
            }

            $totalquantity = 0;
            $carts = Cart::where('customerid', Session::get('customer-loggedin-id'))->get();
            $cartData=array();
            foreach ($carts as $cart) {
                $variantid = $cart->variantid;
                $product = Product::join('vendors', 'vendors.id', '=', 'products.vendor_id')->select('products.*', 'vendors.store_name AS storename', 'vendors.vendor_alias as vendorNickName', 'vendors.slug AS vendorSlug')->find($cart->productid);
                $variant = ProductVerientPrice::join('product_variant_values AS pvv1', 'pvv1.id', '=', 'product_variant_price.variant_value_id_1')->join('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')->leftjoin('product_variant_values AS pvv2', 'pvv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')->leftjoin('product_variant_values AS pvv3', 'pvv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')->select('product_variant_price.*', 'pvv1.value AS variantValue1', 'pvv2.value AS variantValue2', 'pvv3.value AS variantValue3', 'pv1.name AS variantName1', 'pv2.name AS variantName2', 'pv3.name AS variantName3')->find($variantid);
                $image = ProductImage::where('product_id', $cart->productid)->first();
                $quantity = $cart->quantity;
                $varianttype = array();
                if (!is_null($variant->variantValue1)) {
                    array_push($varianttype, ($variant->variantName1 . ": " . $variant->variantValue1));
                }
                if (!is_null($variant->variantValue2)) {
                    array_push($varianttype, ($variant->variantName2 . ": " . $variant->variantValue2));
                }
                if (!is_null($variant->variantValue3)) {
                    array_push($varianttype, ($variant->variantName3 . ": " . $variant->variantValue3));
                }

                $netprice = $variant->net_price;
                $baseprice = ($product->gst_rate == 0 || is_null($product->gst_rate)) ? round($netprice, 2) : round(($netprice * 100) / (100 + $product->gst_rate), 2);
                $gstprice = round(($netprice - $baseprice), 2);
                $totalquantity += $quantity;
                $cartData[$cart->productid][$variantid] = array('title' => $product->name, 'netprice' => $netprice, 'price' => $baseprice, 'quantity' => $quantity, 'totalprice' => ($netprice * $quantity), 'image' => $image->image, 'gst_amount' => ($gstprice), 'variant' => implode(", ", $varianttype), 'store_name' => $product->storename, 'vendor_alias' => $product->vendorNickName, 'storeid' => $product->vendor_id, 'categoryid' => $product->category_id, 'subcategoryid' => $product->sub_category_id, 'storeslug' => $product->vendorSlug, 'productGstRate' => $product->gst_rate);
            }
            $request->session()->put('customer-cart', $cartData);
            $request->session()->put('totalquantity', $totalquantity);

            $request->session()->put('login-url', '');
            $minutes = 60 * 60 * 24 * 7;
            $response = new Response();
            $response->withCookie(cookie('customer-loggedin-name', $result->name, $minutes));
            if (!empty($redirectUri)) {
                return redirect($redirectUri)->withSuccess('You have signed-in');
            }
            return redirect("/dashboard")->withSuccess('You have signed-in');
        }

        return redirect("login")->with('message', 'Login details are not valid')->withInput();
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
        if ($request->session()->get('customer-logged-in') == true) {
            $orders = Order::where('customer_id', Session::get('customer-loggedin-id'))->orderBy('orders.id', 'desc')->get();
			$Sesuserid = Session::get('customer-loggedin-id');
			/********************* code by me **************/
			$walletdetial = DB::table('tbl_wallet_cart')->where('userid',$Sesuserid)->first();
			//echo  "ok_".$walletdetial->wallet_amount;
			if ($walletdetial !== null) {
    				$walletAmount =  $walletdetial->wallet_amount;
				} else {
   						$walletAmount = 0;	// Handle the case when $yourVariable is null
					}
			
			/******************code*******************/
            $headercategories = getHeaderCategories();
            $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
            $customer = Customer::where('id', Session::get('customer-loggedin-id'))->first();
            $addresses = CustomerAddress::where('customer_id', Session::get('customer-loggedin-id'))->where('is_active', true)->get();
            $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
            $rewardsdata = Reward::where('is_active', true)->get();
            $maxValue = 0;
            $rewardsArray = array("0");
            foreach ($rewardsdata as $rewards) {
                if ($rewards->points > $maxValue) {
                    $maxValue = $rewards->points;
                }
                array_push($rewardsArray, "$rewards->points");
            }
            array_pop($rewardsArray);
            $rewardhistoryCredit = RewardHistory::where([['customerid', Session::get('customer-loggedin-id')], ['type', 'credit']])->sum('points');
            $rewardhistoryDebit = RewardHistory::where([['customerid', Session::get('customer-loggedin-id')], ['type', 'debit']])->sum('points');

            $rewardhistory = 0;
            $rewardhistory = $rewardhistoryCredit - $rewardhistoryDebit;
            $header = StaticPage::where('url', 'header')->first();
            $footer = StaticPage::where('url', 'footer')->first();

            return view('auth.dashboard', ['status' => true, 'orders' => $orders,  'walletdetail' => $walletAmount,
			 'headercategories' => $headercategories, 'rewardhistory' => $rewardhistory, 'rewards' => $rewardsArray, 'maxValue' => $maxValue, 'minValue' => 0, 'customer' => $customer, 'addresses' => $addresses, 'activePage' => '', 'categories' => $categories, 'vendors' => $vendors, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true))]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout(Request $request)
    {
        $request->session()->put('customer-logged-in', false);
        $request->session()->put('customer-loggedin-id', '');
        $request->session()->put('customer-loggedin-name', '');
        $request->session()->put('customer-loggedin-email', '');
        $request->session()->put('customer-loggedin-phone', '');
        $request->session()->put('customer-wishlist', array());
        $request->session()->put('customer-cart', array());
        return redirect('login');
    }

    public function send_otp(Request $request)
    {
        $customer = Customer::where('emailid', $request->emailphone)->orWhere('phone', $request->emailphone)->first();
        $otpnumber = rand(100000, 999999);
        if (is_null($customer)) {
            $customer = new Customer();
            $SmsContent = Message::GetSmsDetail(11);
        }else{
             $SmsContent = Message::GetSmsDetail(1);
        }
        if (is_numeric($request->get('emailphone'))) {
            $validatormobile = Validator::make($request->all(), [
                'emailphone' => 'required|regex:/^[6-9][0-9]{9}$/|digits:10',
            ]);

            if ($validatormobile->fails()) {
                return response()->json(['status' => false, 'error' => $validatormobile->errors()]);
            }

            $tokenid = getRandomGeneratedString(16);
             
           
            if(!empty($SmsContent)){

                $Smsbody = $SmsContent['message'];          
                 // replace otp here 
                $smsmessage =  str_replace("{{CUSTOMERNAME}}",$customer->name,$Smsbody);  
                $smsmessage =  str_replace("{{OTP}}",$otpnumber,$smsmessage);  
                     
            }else{
                die('Please contact to us');
            }
            
            sendSMS($request->get('emailphone'), $smsmessage);
            $customer->phone = $request->emailphone;
            $customer->otp = Hash::make($otpnumber);
            $customer->token_id = $tokenid;
            $customer->save();
        } else {
            $validatoremail = Validator::make($request->all(), [
                'emailphone' => 'required|email',
            ]);

            if ($validatoremail->fails()) {
                return response()->json(['status' => false, 'error' => $validatoremail->errors()]);
            }
            // Mail::send('mailtemplate.sendotp', array('otp' => $otpnumber), function ($message) use ($request) {
            //     $message->to($request->emailphone)->subject('Welcome to SpiceBucket.');
            //     $message->from('info@spicebucket.net', 'Spice Bucket');
            // });

            // top mail 
            $mailContent = MailModel::GetMailDetail(9);
            if(!empty($mailContent)){

                $mailbody = $mailContent['message'];          
                 // replace otp here 
                $content =  str_replace("{{OTP}}",$otpnumber,$mailbody);  
                Mail::send('mailtemplate.mailbody', array('content' => $content), function ($message) use ($request,$mailContent) {
                        $message->to($request->emailphone)->subject($mailContent['subject']);
                        $message->from($mailContent['from_email'], $mailContent['from_name']);
                });      
            }else{
                die('Please contact to us');
            }
            
            // Mail::to($request->emailphone)->send(new OTPMail($otpnumber));
            $tokenid = getRandomGeneratedString(16);
            $customer->emailid = $request->emailphone;
            $customer->token_id = $tokenid;
            $customer->otp = Hash::make($otpnumber);
            $customer->save();
        }
        return response()->json(['status' => true]);
    }

    public function addToCart(Request $request)
    {
        $Sesuserid = 0;
        $cart = $request->session()->get('customer-cart');
        $value = $request->session()->get('customer-logged-in');
        //db($value);
        $Sesuserid = Session::get('customer-loggedin-id');
        /************** code by Praveen *******/
        $walletdetial = DB::table('tbl_wallet_cart')->where('userid',$Sesuserid)->first();
		
        if ($walletdetial !== null) {
    				$walletAmount =  $walletdetial->wallet_amount;
				} else {
   						$walletAmount = 0;	// Handle the case when $yourVariable is null
					}
        /****************************/
        //print_r($walletdetial);
        $customercart = array();
        foreach ($cart as $productid => $product) {
            $productdetail = Product::findOrFail($productid);
            foreach ($product as $variantid => $cartelement) {
                if (!array_key_exists($cartelement['store_name'], $customercart)) {
                    $customercart[$cartelement['store_name']]
                     = array('storeid' => $cartelement['storeid'],
                      'vendor_alias' => $cartelement['vendor_alias'],
                       'storeslug' => $cartelement['storeslug'], 'shippingGstAmount' => 0, 
                       'wallet_amount'  => $walletAmount,
                       'child' => array());
                }
                array_push($customercart[$cartelement['store_name']]['child'],
                 array('productid' => $productid,
                 'wallet_amount' => $walletAmount,
                  'variantid' => $variantid,
                   'title' => $cartelement['title'],
                    'quantity' => $cartelement['quantity'],
                     'image' => $cartelement['image'], 
                     'gst_amount' => $cartelement['gst_amount'],
                      'variant' => $cartelement['variant'],
                       'price' => $cartelement['price'], 
                       'totalprice' => (($cartelement['price'] * $cartelement['quantity']) + ($cartelement['quantity'] * $cartelement['gst_amount'])),
                        'slug' => $productdetail->slug, 
                        'minoq' => $productdetail->minoq,
                         'maxoq' => $productdetail->maxoq));
                if ($customercart[$cartelement['store_name']]['shippingGstAmount'] < $cartelement['productGstRate']) {
                    $customercart[$cartelement['store_name']]['shippingGstAmount'] = $cartelement['productGstRate'];
                }
            }
        }
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        return 
        view('cart', ['customercart' => $customercart, 
        'headercategories' => $headercategories,
         'activePage' => '',
          'header' => ($header == null ? array() : json_decode($header->description, true)),
           'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 
           'categories' => $categories, 'vendors' => $vendors]);
    }

    public function showCart()
    {
        $totalprice = $subprice = $gstprice = 0;
        if (Session::get('totalquantity') == '') {
            Session::put('totalquantity', 0);
        }
        if (!empty(Session::get('customer-cart'))) {
            $html = "<ul>";
            foreach (Session::get('customer-cart') as $product_id => $cart) {
                foreach ($cart as $variantid => $product) {
                    $html .= '<li>
                    <div class="row">
                    <div class="col-md-2">
                    <div class="shopping-cart-img">
                    <a href="javascript:void(0)"><img alt="' . $product['title'] . '" src="' . (env('APP_ENV') == "production" ? url('/public/images/products/' . $product['image']) : url('/images/products/' . $product['image'])) . '"></a>
                    </div>
                    </div>
                    <div class="col-md-10">
                    <div class="shopping-cart-title">
                    <h4><a href="javascript:void(0)">' . $product['title'] . '</a></h4>
                    <h3><span class="d-inline-block"></span>
                    <div class="row">
                    <div class="col-md-4">
                    <div class="detail-extralink mr-15">
                    <div class="detail-sign"><a href="javascript:void(0)" id="cart__quantity-minus-' . $product_id . '-' . $variantid . '" class="qty-down cart__quantity__minus"><i class="fi-rs-minus"></i></a></div>
                    <div class="detail-qty border radius">
                    <input name="quantity" type="text" class="cart__quantity__input cart__quantity-input-' . $product_id . '-' . $variantid . '" id="cart__quantity-input-' . $product_id . '-' . $variantid . '" value="' . $product['quantity'] . '" readonly>
                    <input type="hidden" id="min-quantity-input-' . $product_id . '-' . $variantid . '" value="' . $product_id . '-' . $variantid . '" name="min-quantity-input" />
                                <input type="hidden" id="max-quantity-input-' . $product_id . '-' . $variantid . '" value="' . $product_id . '-' . $variantid . '" name="max-quantity-input" /> 
                    </div>
                    <div class="detail-sign"><a href="javascript:void(0)" id="cart__quantity-plus-' . $product_id . '-' . $variantid . '" class="qty-up cart__quantity__plus"><i class="fi-rs-plus"></i></a></div>
                    </div>
                    </div>
                    <div class="col-md-7">
                    <span class="d-inline-block"> x </span> <span class="d-inline-block"><i class="fa fa-rupee-sign"></i> ' . $product['price'] . '</span>';
                    if (array_key_exists('variant', $product) && !empty($product['variant'])) {
                        $html .= '<p class="mb-0"><small>' . $product['variant'] . '</small></p>';
                    }
                    $html .= '</div>
                    <div class="col-md-1">
                    <div class="shopping-cart-delete">
                    <a href="javascript:void(0)" onclick="removeCart(' . $product_id . ', ' . $variantid . ')" class="remove-cart-item"><i class="fi-rs-cross-small"></i></a>
                    </div>
                    </div>
                    </div>
                    </h3>
                    </div>
                    </div>
                    </div>
                    </li>';
                    $subprice += $product['price'] * $product['quantity'];
                    $gstprice += $product['gst_amount'] * $product['quantity'];
                    $totalprice += ($product['price'] * $product['quantity']) + ($product['gst_amount'] * $product['quantity']);
                }
            }
            $html .= "</ul>";
            $html .= '    <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
            <h4><strong class="d-inline-block">Sub Total:</strong> <span><i class="fa fa-rupee-sign"></i> ' . number_format($subprice, 2) . '</span></h5>
            <div class="clearfix"></div>
            <h4><strong class="d-inline-block">Tax  :</strong> <span><i class="fa fa-rupee-sign"></i> ' . number_format($gstprice, 2) . '</span></h5>
            <div class="clearfix"></div>
            <h4><strong class="d-inline-block">Total:</strong> <span><i class="fa fa-rupee-sign"></i> ' . number_format($totalprice, 2) . '</span></span></h4>
            </div>
            <div class="shopping-cart-button">
            <a href="/cart">View cart</a>
            <a href="/checkout">Checkout</a>
            </div>
            </div>
            ';
        } else {
            $html = '<span>No products in the cart.</span>';
        }

        return response()->json(['count' => Session::get('totalquantity'), 'html' => $html]);
    }

    public function updateCart(Request $request)
    {
        $totalquantity = $request->session()->get('totalquantity');
        $cart = $request->session()->get('customer-cart');
        if (is_null($cart)) {
            $cart = array();
            $totalquantity = 0;
        }

        $variantid = $request->variantid;
        $product = Product::join('vendors', 'vendors.id', '=', 'products.vendor_id')->select('products.*', 'vendors.store_name AS storename', 'vendors.vendor_alias as vendorNickName', 'vendors.slug AS vendorSlug')->find($request->productid);
        $variant = ProductVerientPrice::join('product_variant_values AS pvv1', 'pvv1.id', '=', 'product_variant_price.variant_value_id_1')->join('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')->leftjoin('product_variant_values AS pvv2', 'pvv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')->leftjoin('product_variant_values AS pvv3', 'pvv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')->select('product_variant_price.*', 'pvv1.value AS variantValue1', 'pvv2.value AS variantValue2', 'pvv3.value AS variantValue3', 'pv1.name AS variantName1', 'pv2.name AS variantName2', 'pv3.name AS variantName3')->find($variantid);
        $image = ProductImage::where('product_id', $request->productid)->first();
        $quantity = $request->qty;
        if ($variant->quantity < $quantity) {
            return response()->json(['status' => false, 'message' => 'No more product available in stock.']);
        }
        if ($quantity < $product->minoq) {
            return response()->json(['status' => false, 'message' => 'Minimum order quantity reached.']);
        }
        if ($quantity > $product->maxoq) {
            return response()->json(['status' => false, 'message' => 'Maximum order quantity reached.']);
        }

        $varianttype = array();
        if (!is_null($variant->variantValue1)) {
            array_push($varianttype, ($variant->variantName1 . ": " . $variant->variantValue1));
        }
        if (!is_null($variant->variantValue2)) {
            array_push($varianttype, ($variant->variantName2 . ": " . $variant->variantValue2));
        }
        if (!is_null($variant->variantValue3)) {
            array_push($varianttype, ($variant->variantName3 . ": " . $variant->variantValue3));
        }

        $netprice = $variant->net_price;
        $baseprice = ($product->gst_rate == 0 || is_null($product->gst_rate)) ? round($netprice, 2) : round(($netprice * 100) / (100 + $product->gst_rate), 2);
        $gstprice = round(($netprice - $baseprice), 2);
        $cart[$request->productid][$variantid] = array('title' => $product->name, 'netprice' => $netprice, 'price' => $baseprice, 'quantity' => $quantity, 'totalprice' => ($netprice * $quantity), 'image' => $image->image, 'gst_amount' => ($gstprice), 'variant' => implode(", ", $varianttype), 'store_name' => $product->storename, 'vendor_alias' => $product->vendorNickName, 'storeid' => $product->vendor_id, 'categoryid' => $product->category_id, 'subcategoryid' => $product->sub_category_id, 'storeslug' => $product->vendorSlug, 'productGstRate' => $product->gst_rate);
        $request->session()->put('customer-cart', $cart);

        $netpriceforBrand = array();
        $remainingforBrand = array();
        $shippingbasepriceforBrand = array();
        $totalquantity = $totalsubprice = $totalgstprice = 0;
        foreach ($request->session()->get('customer-cart') as $cart) {
            foreach ($cart as $variantproduct) {
                $totalsubprice += $variantproduct['price'] * $variantproduct['quantity'];
                $totalgstprice += $variantproduct['gst_amount'] * $variantproduct['quantity'];
                $totalquantity += $variantproduct['quantity'];
                if (!array_key_exists($variantproduct['storeid'], $netpriceforBrand)) {
                    $netpriceforBrand[$variantproduct['storeid']] = 0;
                }
                $netpriceforBrand[$variantproduct['storeid']] += $variantproduct['totalprice'];
                if (!array_key_exists($variantproduct['storeid'], $remainingforBrand)) {
                    $remainingforBrand[$variantproduct['storeid']] = 0;
                }
                $remainingforBrand[$variantproduct['storeid']] += $variantproduct['totalprice'];
                if (!array_key_exists($variantproduct['storeid'], $shippingbasepriceforBrand)) {
                    $shippingbasepriceforBrand[$variantproduct['storeid']] = $variantproduct['productGstRate'];
                }
            }
        }
        $shippingforbrand = array_map(function ($item) {
            if ($item <= 149) {
                return 50;
            } else if ($item <= 349 && $item > 149) {
                return 70;
            } else if ($item <= 498 && $item > 349) {
                return 100;
            } else {
                return 0;
            }
        }, $netpriceforBrand);
        array_walk($shippingforbrand, function (&$item, $key) use ($shippingbasepriceforBrand) {
            $item = array('shippingprice' => $item, 'baseshippingprice' => round(($item * 100) / (100 + $shippingbasepriceforBrand[$key]), 2), 'gstshippingprice' => round(($item - ($item * 100) / (100 + $shippingbasepriceforBrand[$key])), 2));
        });

        $remainingamount = array_map(function ($item) {
            $remaingingamount = 499 - $item;
            if ($remaingingamount <= 0) {
                $remaingingamount = 0;
            }
            return number_format($remaingingamount, 2);
        }, $remainingforBrand);

        $request->session()->put('totalquantity', $totalquantity);
        $totalprice = $totalgstprice + $totalsubprice + array_sum(array_column($shippingforbrand, 'shippingprice'));

        if (Session::get('customer-logged-in') == true) {
            $data = Cart::where('customerid', Session::get('customer-loggedin-id'))->where('productid', $request->productid)->where('variantid', $variantid)->first();
            if ($data == null) {
                $data = new Cart();
            }
            $data->customerid = Session::get('customer-loggedin-id');
            $data->productid = $request->productid;
            $data->variantid = $variantid;
            $data->quantity = $quantity;
            $data->save();
        }

        return response()->json(['status' => true, 'message' => 'Cart updated successfully.', 'price' => number_format(($variant->net_price * $quantity), 2), 'totalprice' => number_format($totalprice, 2), 'totalgstprice' => number_format(($totalgstprice + array_sum(array_column($shippingforbrand, 'gstshippingprice'))), 2), 'remainingamount' => $remainingamount, 'totalsubprice' => number_format($totalsubprice, 2), 'shippingcharge' => number_format(array_sum(array_column($shippingforbrand, 'baseshippingprice')), 2)]);
    }

    public function checkout(Request $request)  
    {
        /*if (!$request->has('debug')) {
            die("<h1>Page is under maintenance</h1>");
        }*/
        $Sesuserid = Session::get('customer-loggedin-id');
        /************** code by Praveen *******/
        $wallet_amount = DB::table('tbl_wallet_cart')->where('userid',$Sesuserid)->first();
		
			if ($wallet_amount !== null) {
    				$walletAmount =  $wallet_amount->wallet_amount;
				} else {
   						$walletAmount = 0;	// Handle the case when $yourVariable is null
					}
		
        if ($request->session()->get('customer-logged-in') == true) {
            $cart = $request->session()->get('customer-cart');
            if ($cart == null || count($cart) == 0) {
                return redirect('/');
            }
            $customercart = array();
            foreach ($cart as $productid => $product) {
                foreach ($product as $variantid => $cartelement) {
                    if (!array_key_exists($cartelement['store_name'], $customercart)) {
                        $vendor = Vendor::find($cartelement['storeid']);
                        $vendor_image = $vendor->image;
                        $shipping_pincode = $vendor->shipping_pincode;
                        $customercart[$cartelement['store_name']] = array('storeid' => $cartelement['storeid'], 'vendor_alias' => $cartelement['vendor_alias'], 'vendor_image' => $vendor_image, 'vendor_shipping_pincode' => $shipping_pincode, 'shippingGstAmount' => 0, 'child' => array());
                    }
                    $variantQuantity = ProductVerientPrice::where('id', $variantid)->first();
                    if ($variantQuantity->quantity <= 0){
                        unset($cart[$productid][$variantid]);
                        if(count($cart[$productid]) == 0){
                            unset($cart[$productid]);
                        }
                    } else {
                        if ($variantQuantity->quantity < $cartelement['quantity']) {
                            $cart[$productid][$variantid]['quantity'] = $variantQuantity->quantity;
                        }
                        array_push($customercart[$cartelement['store_name']]['child'], array('title' => $cartelement['title'], 'quantity' => $cartelement['quantity'], 'image' => $cartelement['image'], 'gst_amount' => $cartelement['gst_amount'], 'variant' => $cartelement['variant'], 'price' => $cartelement['price']));
                    }
                    if ($customercart[$cartelement['store_name']]['shippingGstAmount'] < $cartelement['productGstRate']) {
                        $customercart[$cartelement['store_name']]['shippingGstAmount'] = $cartelement['productGstRate'];
                    }
                }
            }
            $request->session()->put('customer-cart', $cart);
            $addresses = CustomerAddress::where('customer_id', $request->session()->get('customer-loggedin-id'))->get();
            $headercategories = getHeaderCategories();
            $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
            $coupons = Coupon::whereRaw("DATE(start_datetime) <= DATE(SYSDATE())")->whereRaw("DATE(end_datetime) >= DATE(SYSDATE())")->where('is_active', true)->get();
            $header = StaticPage::where('url', 'header')->first();
            $footer = StaticPage::where('url', 'footer')->first();
            $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
            return view('checkout', ['customercart' => $customercart, 'wallet_amount' => $walletAmount ,'addresses' => $addresses, 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'headercategories' => $headercategories, 'activePage' => '', 'categories' => $categories, 'vendors' => $vendors, 'coupons' => $coupons]);
        } else {
            return redirect('login');
        }
    }
    public function removemycart(Request $request)
    {
        $totalquantity = $request->session()->get('totalquantity');
        $cart = $request->session()->get('customer-cart');
        $pid = $request->product_id;
        $vid = $request->variant_id;
        if (array_key_exists($pid, $cart)) {
            if (array_key_exists($vid, $cart[$pid])) {
                $totalquantity -= $cart[$pid][$vid]['quantity'];
                unset($cart[$pid][$vid]);
                if(Session::get('customer-logged-in') == true) {
                    Cart::where('customerid', Session::get('customer-loggedin-id'))->where('productid', $pid)->where('variantid', $vid)->delete();
                }
                if (count($cart[$pid]) == 0) {
                    unset($cart[$pid]);
                }
                $request->session()->put('totalquantity', $totalquantity);
                $request->session()->put('customer-cart', $cart);
            } else {
                return response()->json(['status' => false, 'message' => 'Unable to remove the item.']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Unable to remove the item.']);
        }
        $totalsubprice = $totalgstprice = 0;
        $netpriceforBrand = array();
        $remainingforBrand = array();
        $shippingbasepriceforBrand = array();
        foreach ($request->session()->get('customer-cart') as $product) {
            foreach ($product as $cart) {
                $totalsubprice += $cart['price'] * $cart['quantity'];
                $totalgstprice += $cart['gst_amount'] * $cart['quantity'];
                if (!array_key_exists($cart['storeid'], $netpriceforBrand)) {
                    $netpriceforBrand[$cart['storeid']] = 0;
                }
                $netpriceforBrand[$cart['storeid']] += $cart['totalprice'];
                if (!array_key_exists($cart['storeid'], $remainingforBrand)) {
                    $remainingforBrand[$cart['storeid']] = 0;
                }
                $remainingforBrand[$cart['storeid']] += $cart['totalprice'];
                if (!array_key_exists($cart['storeid'], $shippingbasepriceforBrand)) {
                    $shippingbasepriceforBrand[$cart['storeid']] = $cart['productGstRate'];
                }
            }
        }
        $shippingforbrand = array_map(function ($item) {
            if ($item <= 149) {
                return 50;
            } else if ($item <= 349 && $item > 149) {
                return 70;
            } else if ($item <= 498 && $item > 349) {
                return 100;
            } else {
                return 0;
            }
        }, $netpriceforBrand);
        array_walk($shippingforbrand, function (&$item, $key) use ($shippingbasepriceforBrand) {
            $item = array('shippingprice' => $item, 'baseshippingprice' => round(($item * 100) / (100 + $shippingbasepriceforBrand[$key]), 2), 'gstshippingprice' => round(($item - ($item * 100) / (100 + $shippingbasepriceforBrand[$key])), 2));
        });
        $remainingamount = array_map(function ($item) {
            $remaingingamount = 499 - $item;
            if ($remaingingamount <= 0) {
                $remaingingamount = 0;
            }
            return number_format($remaingingamount, 2);
        }, $remainingforBrand);
        $totalprice = $totalgstprice + $totalsubprice + array_sum(array_column($shippingforbrand, 'shippingprice'));
        return response()->json(['status' => true, 'message' => 'Item removed successfully from cart.', 'totalprice' => number_format($totalprice, 2), 'totalgstprice' => number_format($totalgstprice + array_sum(array_column($shippingforbrand, 'gstshippingprice')), 2), 'remainingamount' => $remainingamount,  'totalsubprice' => number_format($totalsubprice, 2), 'shippingcharge' => number_format(array_sum(array_column($shippingforbrand, 'baseshippingprice')), 2)]);
    }

    public function Wishlist(Request $request)
    {
        if (Session::get('customer-logged-in') == true) {
            $result = Wishlist::where('customer_id', $request->session()->get('customer-loggedin-id'))->where('product_id', $request->product_id)->get();
            if (count($result) == 0) {
                $wishlist = new Wishlist();
                $wishlist->product_id = $request->product_id;
                $wishlist->customer_id = $request->session()->get('customer-loggedin-id');
                $wishlist->save();
            }
            $wishlists = array();
            $wishlist = Wishlist::where('customer_id', Session::get('customer-loggedin-id'))->get();
            if(count($wishlist) > 0){
                foreach($wishlist as $wish_list){
                    array_push($wishlists, $wish_list->product_id);
                }
            }
            $request->session()->put('customer-wishlist', $wishlists);
        } else {
            $wishlist = $request->session()->get('customer-wishlist');
            if (is_null($wishlist)) {
                $wishlist = array();
            }
            if (!in_array($request->product_id, $wishlist)) {
                array_push($wishlist, $request->product_id);
            }
            $request->session()->put('customer-wishlist', $wishlist);
        }
        return response()->json(['status' => true, 'message' => 'Item successfully added in wishlist', 'count' => count($wishlist)]);
    }

    public function showWishlistCount()
    {
        $wishlist = Session::get('customer-wishlist');
        if (is_null($wishlist)) {
            $wishlist = array();
        }
        return response()->json(['status' => true, 'count' => count($wishlist)]);
    }


    public function showWishlist(REQUEST $request)
    {   
        if (!$request->session()->get('customer-logged-in')) {
            return redirect('login');
        }
        $wishlistid = array();
        if (Session::get('customer-logged-in') == true) {
            $result = Wishlist::where('customer_id', Session::get('customer-loggedin-id'))->get();
            if (!is_null($result)) {
                foreach ($result as $row) {
                    array_push($wishlistid, $row->product_id);
                }
            }
        } else {
            $wishlistid = Session::get('customer-wishlist');
            if (is_null($wishlistid)) {
                $wishlistid = array();
            }
        }

        if (count($wishlistid) > 0) {
            $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')->where('products.is_active', true)
                ->whereIn('products.id', $wishlistid)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName')->get();
        } else {
            $products = array();
        }

        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        return view('wishlist', ['products' => $products, 'headercategories' => $headercategories, 'activePage' => '', 'header' => ($header == null ? array() : json_decode($header->description, true)), 'footer' => ($footer == null ? array() : json_decode($footer->description, true)), 'categories' => $categories, 'vendors' => $vendors]);
    }

    public function removeWishlist(Request $request)
    {
        $pid = $request->product_id;
        if (Session::get('customer-logged-in') == true) {
            Wishlist::where('customer_id', Session::get('customer-loggedin-id'))->where('product_id', $pid)->delete();
            $wishlist = Wishlist::where('customer_id', Session::get('customer-loggedin-id'))->get();
        } else {
            $wishlist = $request->session()->get('customer-wishlist');
            if (in_array($pid, $wishlist)) {
                unset($wishlist[array_search($pid, $wishlist)]);
                $request->session()->put('customer-wishlist', $wishlist);
            }
        }
        return response()->json(['status' => true, 'message' => 'Item removed in wishlist', 'count' => count($wishlist)]);
    }
    /**Notifications */
    public function customer_notifications(Request $request)
    {
        if (!$request->session()->get('customer-logged-in')) {
            return redirect('login');
        }
        $notifications = array();
        if (Session::get('customer-logged-in') == true) {
            $search_id = session('customer-loggedin-id');
            $notifications = Notification::where('source', 2)
                            ->whereRaw("find_in_set('".$search_id."',notifications.customers)")
                            ->orderBy('id','ASC')
                            ->get();
          
        }
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'header')->first();
        $footer = StaticPage::where('url', 'footer')->first();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();

        $count = 0;
        foreach($notifications as $notification){
            if(!$notification->is_active)
                $count++;
        }
        
        $request->session()->put('notificationCount', $count);
        
        return view('notifications', [
                                    'notifications'=>$notifications,
                                    // 'products' => $products, 
                                    'headercategories' => $headercategories,
                                    'activePage' => '', 
                                    'header' => ($header == null ? array() : json_decode($header->description, true)), 
                                    'footer' => ($footer == null ? array() : json_decode($footer->description, true)),
                                    'categories' => $categories, 
                                    'vendors' => $vendors
                                ]);
    }
    // public function customer_notifications_view($id){
    //     try {
    //       //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //         $data['id'] = $id;
    //         if($data['id'] != ''){
    //             $data['res'] = Notification::where(DB::raw('md5(id)'), $id)->first();
    //             $data['id'] = $data['res']->id; 
    //         }
    //         return view('vendor.notifications.view' , ['data'=>$data,'title' => 'Edit Notification - SpiceBucket Administrator']);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}
