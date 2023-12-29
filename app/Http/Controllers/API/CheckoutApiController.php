<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderExtraCharges;
use App\Models\OrderDetail;
use App\Models\ServiceType;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Product;
use App\Models\ProductVerientPrice;
use App\Models\CardDetail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\VendorOrderNumber;
use App\Jobs\SendEmailJob;
use App\Traits\CommonTrait;
class CheckoutApiController extends Controller
{
    use CommonTrait;
/////////////////////////////////////////
private function cartDetailByCustomer($customerid){


     $carts = Cart::where('customerid', $customerid)->get();
            $cartData=array();
            foreach ($carts as $cart) {
                $variantid = $cart->variantid;
                $product = Product::join('vendors', 'vendors.id', '=', 'products.vendor_id')->select('products.*', 'vendors.store_name AS storename', 'vendors.vendor_alias as vendorNickName', 'vendors.slug AS vendorSlug')->find($cart->productid);
                $variant = ProductVerientPrice::join('product_variant_values AS pvv1', 'pvv1.id', '=', 'product_variant_price.variant_value_id_1')->join('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')->leftjoin('product_variant_values AS pvv2', 'pvv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')->leftjoin('product_variant_values AS pvv3', 'pvv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')->select('product_variant_price.*', 'pvv1.value AS variantValue1', 'pvv2.value AS variantValue2', 'pvv3.value AS variantValue3', 'pv1.name AS variantName1', 'pv2.name AS variantName2', 'pv3.name AS variantName3')->find($variantid);
               // $image = ProductImage::where('product_id', $cart->productid)->first();
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
                //$totalquantity += $quantity;
                $cartData[$cart->productid][$variantid] = array('title' => $product->name, 'netprice' => $netprice, 'price' => $baseprice, 'quantity' => $quantity, 'totalprice' => ($netprice * $quantity), 'gst_amount' => ($gstprice), 'variant' => implode(", ", $varianttype), 'store_name' => $product->storename, 'vendor_alias' => $product->vendorNickName, 'storeid' => $product->vendor_id, 'categoryid' => $product->category_id, 'subcategoryid' => $product->sub_category_id, 'storeslug' => $product->vendorSlug, 'productGstRate' => $product->gst_rate);
            }
            return $cartData;

}
public function checkout(Request $request)
{
    $vendor_wise_address = [];
    
    
    \Log::info('Mobile app Request');
    \Log::info($request->all());  
    // $validator = Validator::make($request->all(), [
    //     'customer_id' => 'required|exists:customers,id',
    //     'payment_amount' => 'required|numeric',
    //     'gst_on_amount' => 'required|numeric',
    //     'cod_charges' => 'nullable|numeric',
    //     'discount' => 'nullable|numeric',
    //     'delivery_fee' => 'nullable|numeric',
    //     'total_amount' => 'required|numeric',
    //     'payment_status' => 'nullable|string',
    //     'payment_source' => 'nullable|string',
    //     'order_status' => 'nullable|string',
    //     'payment_api_response' => 'nullable|string',
    //     'order_details' => 'required|array',
    //     'order_details.*.vendor_id' => 'required|exists:vendors,id',
    //     'order_details.*.product_id' => 'required|exists:products,id', // Adding validation for product_id
    //   //  'order_details.*.product_variant_price_id' => 'required|exists:product_variant_price,id',
    // ]);
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
        
        'cod_charges' => 'nullable|numeric',
        'discount' => 'nullable|numeric', 
        'total_amount' => 'required|numeric',
        'payment_status' => 'nullable|string',
        'payment_source' => 'nullable|string',
        'address' => 'required|array',
        'payment_api_response' => 'nullable|string',
      
    ]);

    if ($validator->fails()) {
        return response()->json([
             
            //'message' => $validator->errors()->all(),
            'message' => implode(",", $validator->messages()->all()),
            'status' => false
        ]);
    }
    
    // validation end here 
    // get customer detail here 

    $customerData = Customer::where('id', $request->input('customer_id'))->first();
   // $cart_data = Cart::where('customerid', $request->input('customer_id'))->get();
     
    if(!empty($customerData)){
        $subprice = $gstprice = $totalcartamount = 0;
        $orderdetails = $vendorCartAmountArray = array();
        $cartData = $this->cartDetailByCustomer($request->input('customer_id'));
        if(empty($cartData)){
            // return if cart is empty 
            return response()->json([
                 
                'message' => 'Your cart is empty, Please add products',
                 
                'status' => false
            ]);
        }   

        $address = $request->input('address');
        foreach($address as $add){
            $vendor_wise_address[$add['vendor_id']]=array('billing_customer_address_id'=>$add['billing_customer_address_id'],'shipping_customer_address_id'=>$add['shipping_customer_address_id']);
        }

        // $address = $request->input('address');

        // $billing_customer_address_id  = $address[0]['billing_customer_address_id']; 
        // $shipping_customer_address_id  = $address[0]['shipping_customer_address_id'];
       
           foreach ($cartData as $product_id => $cart) {
            foreach ($cart as $variantid => $cartelement) {
                $product = Product::find($product_id);
                if($vendor_wise_address[$product->vendor_id]['billing_customer_address_id'] =="null" or $vendor_wise_address[$product->vendor_id]['shipping_customer_address_id']=="null" ){
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Please enter billing and shipping address.',
                         
                        'status' => false
                    ]);
                }
                
                array_push($orderdetails, array(
                    'billing_customer_address_id' => $vendor_wise_address[$product->vendor_id]['billing_customer_address_id'],
                    'shipping_customer_address_id' => $vendor_wise_address[$product->vendor_id]['shipping_customer_address_id'],
                     
                    'vendor_id' => $product->vendor_id,
                    'product_id' => $product_id,
                    'product_variant_price_id' => $variantid,
                    'product_qunatity' => $cartelement['quantity'],
                    'product_price' => $cartelement['price'],
                    'gst_on_product_price' => $cartelement['gst_amount'],
                    'total_product_price' => $cartelement['totalprice']
                ));
                $subprice += ($cartelement['price'] * $cartelement['quantity']);
                $gstprice += ($cartelement['gst_amount'] * $cartelement['quantity']);
                $totalcartamount += $cartelement['totalprice'];
                if (!array_key_exists($product->vendor_id, $vendorCartAmountArray)) {
                    $vendorCartAmountArray[$product->vendor_id] = 0;
                }
                $vendorCartAmountArray[$product->vendor_id] += $cartelement['totalprice'];
                
                
                ProductVerientPrice::where('id', $variantid)->update(['quantity' => DB::raw('quantity - ' . $cartelement["quantity"])]);
            }
        }
        // calculate shipping price here 
        $vendors = array_unique(array_column($orderdetails, 'vendor_id'));
        $totalshippingPrice = 0;
        $VendorWiseShippingPrice = [];
        foreach ($vendors as $vendor) {
			// calculate shipping price here 
			$vendortotalprice = $vendorCartAmountArray[$vendor];
			if($vendortotalprice >= 499){
				$vendortotalshippingprice = 0;
			}else if($vendortotalprice <=149){ $vendortotalshippingprice=50; }else if($vendortotalprice <=349 && $vendortotalprice> 149){
				$vendortotalshippingprice = 70;

			}else if($vendortotalprice <=498 && $vendortotalprice> 349){
				$vendortotalshippingprice = 100;
			}
			$VendorWiseShippingPrice[$vendor]= $vendortotalshippingprice;
			$totalshippingPrice +=$vendortotalshippingprice;
				
			
		} 
       
           //get here financial year     
        if ( date('m') > 3 ) {
            $Fyear = date('Y') . (date('y') + 1);
        }
        else {
            $Fyear =(date('Y') - 1). date('y');
        }          

        $nextId  = DB::table('orders')->max('id') + 1;
        $invoice_no =  str_pad($nextId , 7, "0", STR_PAD_LEFT). "-" .$Fyear ;
        $orderid = "SBRL-".$invoice_no;
        

          try {
            
            DB::beginTransaction();
            
            $order = new Order();
            $order->orderid = $orderid;
            $order->customer_id = $request->input('customer_id');
            $order->total_amount = $request->input('total_amount');
            $order->payment_status = 'pending';
            $order->payment_source = 'cod';
            $order->payment_api_response = (@$request->input('payment_api_response')?$request->input('payment_api_response'):'pending');
            $order->payment_amount = $subprice;
            $order->gst_on_amount = $gstprice;
            $order->cod_charges = $request->input('cod_charges');
            $order->discount = $request->input('discount');
            $order->delivery_fee = $totalshippingPrice;
            $order->save();
            $orderid = $order->id;
            
            if (!empty($request->coupon_id)) {
                $data = new CouponUsage();
                $data->customer_id =$request->input('customer_id');
                $data->order_id = $order->id;
                $data->coupon_id = $request->coupon_id;
                $data->save();
            }

            $vendors = array_unique(array_column($orderdetails, 'vendor_id'));
            $vendorCount = count($vendors);
            
            foreach ($vendors as $vendor) {
				
				
                $orderExtraCharge = new OrderExtraCharges();
                $orderExtraCharge->order_id = $orderid;
                $orderExtraCharge->vendor_id = $vendor;
                $orderExtraCharge->shipping_charges = $VendorWiseShippingPrice[$vendor];
                $orderExtraCharge->cod_charges = ($request->cod_charges / $vendorCount);
                if (!empty($request->coupon_id)) {
                    $orderExtraCharge->discount = round((($vendorCartAmountArray[$vendor] * $request->discount) / $totalcartamount), 2);
                }
                $orderExtraCharge->save();
            }
             
             
            $vendorOrder=[];
             
            foreach ($orderdetails as $orderdetail) {
                $detail = new OrderDetail();
                $vendorOrder[$orderdetail['vendor_id']] =$orderid;
                $detail->order_id = $orderid;
                $detail->vendor_id = $orderdetail['vendor_id'];
                $detail->product_id = $orderdetail['product_id'];
                $detail->product_qunatity = $orderdetail['product_qunatity'];
                $detail->product_price = $orderdetail['product_price'];
                $detail->gst_on_product_price = $orderdetail['gst_on_product_price'];
                $detail->total_product_price = $orderdetail['total_product_price'];
                $detail->product_variant_price_id = $orderdetail['product_variant_price_id'];
                $detail->billing_customer_address_id = $orderdetail['billing_customer_address_id'];
                $detail->shipping_customer_address_id = $orderdetail['shipping_customer_address_id'];
                //$detail->vendor_order_id =$VendorOrderInvoice;
                $detail->save();
            }
            // vendor order number update 
            
            $vendororderserial= 1;
            foreach($vendorOrder as $vendor_id => $order_id){               

                 // vendor order detais 
                
                $vendor_code = $this->vendorNickNamewithStateCode($vendor_id);
                // $ordreinovice_id = 1;
                // $nextTransactionId = VendorOrderNumber::orderBy('id','desc')->first() ;
                // if(!empty($nextTransactionId)){
                //     $ordreinovice_id = $nextTransactionId->id +1;
                // } 
                //$GenerateInvoice =  str_pad($ordreinovice_id , 7, "0", STR_PAD_LEFT). "-" .$Fyear  ;

                $GenerateInvoice =str_pad($nextId , 7, "0", STR_PAD_LEFT). "-" .$vendororderserial. "-" .$Fyear ;
                $vendororderserial++;

                
                $VendorOrderInvoice = $vendor_code."-".$GenerateInvoice; 
                $VondorOrderObject =new VendorOrderNumber();
                $VondorOrderObject->order_id = $orderid;
                $VondorOrderObject->save();
                // increament order id
                 $order_update = OrderDetail::where('order_id', $order_id)->where('vendor_id', $vendor_id)->whereRaw('(vendor_order_id = "" OR vendor_order_id IS NULL)')->update(['vendor_order_id' =>$VendorOrderInvoice]); 
            }
              
             DB::commit();
       
        } catch (\Exception $e) {   
             DB::rollback();
            return response()->json([
                'status' => 'Error',
                'message' =>  $e->getMessage(),
                 
                'status' => false
            ]);
     }
        dispatch(new SendEmailJob($orderid,$customerData->emailid));
        // cart is clear for cod 
        if($request->input('payment_source') == 'COD')
        Cart::where('customerid', $request->input('customer_id'))->delete();   
        return response()->json([
                'status' => 'Success',
                'message' => 'Order, order details created successfully.',
                'order' => $order,
                 
                'status' => true
            ]);

           
    }else{
         return response()->json([
                'status' => 'Error',
                'message' => 'There are no item in cart',
                 
                'status' => false
            ]);

    }
     
     
}
///////////////////////
public function update_order(Request $request)
{
    \Log::info('Mobile app Request update_order');
    \Log::info($request->all());  


    $validator = Validator::make($request->all(), [
        'order_id' => 'required|exists:orders,id',
        'payment_api_response' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            
            'message' => $validator->errors()->all(),
            'status' => true
        ]);
    }

    $order = Order::where('id', $request->order_id)->first();

    if (!$order) {
        
        return response()->json([
            
            'message' => 'Order not found.',
            'status' => false
        ]);
    }

    $paymentApiResponse = json_encode($request->input('payment_api_response'));
    if($request->input('status') ==true)
    Cart::where('customerid', $order->customer_id)->delete(); 
    $order->payment_api_response = $paymentApiResponse;
    $order->save();
   // $order->orderid=$orderid;
    return response()->json([
        'status' => 'Success',
        'message' => 'Payment API response updated successfully.',
        'order' => $order,
        'status' => true
    ]);
}


    
///////

public function OrdersExtraCharge(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'order_id' => 'required|integer',
        'vendor_id' => 'required|integer',
        'shipping_charges' => 'nullable|numeric',
        'delivery_status_id' => 'nullable|integer',
        'delivery_fee' => 'nullable||numeric',
        'cod_charges' => 'nullable|numeric',
        'delivery_date' => 'nullable|date',
    ]);

    if ($validator->fails()) {
        return response()->json([
           
            'message' => $validator->errors()->all(),
            'status' => false
        ]);
    }

    // Create a new entry in the orders_extra_charges table
    $extraCharges = new OrderExtraCharges;
    $extraCharges->order_id = $request->input('order_id');
    $extraCharges->vendor_id = $request->input('vendor_id');
    $extraCharges->shipping_charges = $request->input('shipping_charges');
    $extraCharges->delivery_status_id = $request->input('delivery_status_id');
    $extraCharges->delivery_fee = $request->input('delivery_fee');
    $extraCharges->cod_charges = $request->input('cod_charges');
    $extraCharges->delivery_date = $request->input('delivery_date');
    $extraCharges->save();

    // Return a response with the created entry
    return response()->json([
        'message' => 'Extra charges created successfully',
        'data' => $extraCharges,
    ]);
}

////
public function api_add_address(Request $request)
{
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
        'address_type' => 'required|string',
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'phonenumber' => 'required|string',
        'emailid' => 'nullable|email',
        'address_line_1' => 'required|string',
        'address_line_2' => 'nullable|string',
        'address_line_3' => 'nullable|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'pincode' => 'required|Integer',
        'lat' => 'required||string',
        'long' => 'required||string',
        'companyname' => 'nullable|string',
        'country' => 'required|string',
        'additional_information' => 'nullable|string',
        'is_active' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json([
            
            'message' => $validator->errors()->all(),
            'status' => false
        ]);
    }

    // Create a new customer address record
    $address = CustomerAddress::create([
        'customer_id' => $request->input('customer_id'),
        'address_type' => $request->input('address_type'),
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'phonenumber' => $request->input('phonenumber'),
        'emailid' => $request->input('emailid'),
        'address_line_1' => $request->input('address_line_1'),
        'address_line_2' => $request->input('address_line_2'),
        'address_line_3' => $request->input('address_line_3'),
        'city' => $request->input('city'),
        'state' => $request->input('state'),
        'pincode' => $request->input('pincode'),
        'lat' => $request->input('lat'),
        'long' => $request->input('long'),
        'companyname' => $request->input('companyname'),
        'country' => $request->input('country'),
        'additional_information' => $request->input('additional_information'),
        'is_active' => $request->input('is_active', true),
    ]);

    return response()->json([
        'status' => 'Success',
        'message' => 'Address added successfully.',
        'address' => $address,
        'status' => true
    ]);
}
/////////////////

public function api_edit_address(Request $request, $address_id)
{
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
        'address_type' => 'required|string',
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'phonenumber' => 'required|string',
        'emailid' => 'required|email',
        'address_line_1' => 'required|string',
        'address_line_2' => 'nullable|string',
        'address_line_3' => 'nullable|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'pincode' => 'required|string',
        'lat' => 'nullable|string',
        'long' => 'nullable|string',
        'companyname' => 'nullable|string',
        'country' => 'required|string',
        'additional_information' => 'nullable|string',
        'is_active' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json([
            
            'message' => $validator->errors()->all(),
            'status' => false
        ]);
    }

    // Find the address record to be edited
    $address = CustomerAddress::find($address_id);

    if (!$address) {
        return response()->json([
            
            'message' => 'Address not found.',
            'status' => false
        ]);
    }

    // Update the address record with the new data
    $address->update([
        'customer_id' => $request->input('customer_id'),
        'address_type' => $request->input('address_type'),
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'phonenumber' => $request->input('phonenumber'),
        'emailid' => $request->input('emailid'),
        'address_line_1' => $request->input('address_line_1'),
        'address_line_2' => $request->input('address_line_2'),
        'address_line_3' => $request->input('address_line_3'),
        'city' => $request->input('city'),
        'state' => $request->input('state'),
        'pincode' => $request->input('pincode'),
        'lat' => $request->input('lat'),
        'long' => $request->input('long'),
        'companyname' => $request->input('companyname'),
        'country' => $request->input('country'),
        'additional_information' => $request->input('additional_information'),
        'is_active' => $request->input('is_active', true),
    ]);

    return response()->json([
        'status' => 'Success',
        'message' => 'Address updated successfully.',
        'address' => $address,
        'status' => true
    ]);
}

//////////////////////
public function api_get_addresses($customer_id,$addressType=null)
{
  
    // Retrieve the customer's addresses based on the address type if provided
    if ($addressType) {
        $customerAddresses = CustomerAddress::where('customer_id', $customer_id)
            ->where('address_type', $addressType)
            ->get();

        if ($customerAddresses->isEmpty()) {
            return response()->json([
                'error' => 'Address not found for the given address type.',
                'status' => false
            ]);
        }
    } else {
        // Retrieve all customer addresses if address type is not provided
        $customerAddresses = CustomerAddress::where('customer_id', $customer_id)->get();
    }
    // Retrieve addresses based on the provided customer ID
     

    return response()->json([
        'status' => 'Success',
        'message' => 'Addresses retrieved successfully.',
        'addresses' => $customerAddresses,
        'status' => true
    ]);
}

///////
public function api_delete_address($address_id)
{
    // Find the address record to be deleted
    $address = CustomerAddress::find($address_id);

    if (!$address) {
        return response()->json([
            
            'message' => 'Address not found.',
            'status' => false
        ]);
    }

    // Delete the address record
    $address->delete();

    return response()->json([
         
        'message' => 'Address deleted successfully.',
        'status' => true
    ]);
}

    public function getCoupon(Request $request)
    {     
        {
            $currentDate = Carbon::now()->toDateString();
    
            $coupons = Coupon::whereDate('start_datetime', '<=', $currentDate)
                ->whereDate('end_datetime', '>=', $currentDate)->where('is_active',1)
                ->get();    
            return response()->json([
                'coupons'=>$coupons,
                'status'=>true
            ]);
        }
    
    }
////////////////

    public function CouponCart($customerid)
    {
        $cartItems = Cart::where('customerid', $customerid)->get();
        $productIds = $cartItems->pluck('productid')->all();
        $variantIds = $cartItems->pluck('variantid')->all();
        $products = Product::with('vendors')->whereIn('id', $productIds)->get()->keyBy('id');
        $gstRates = $products->map(function ($product) {
            return $product->gst_rate;
        });

        $variantPrices = ProductVerientPrice::with('product_images', 'product_variant_values_1', 'product_variant_values_2')
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $groupedCartItems = $cartItems->groupBy(function ($item) use ($products) {
            return $products[$item['productid']]->vendors->store_name;
        });

        $groupedData = [];

        foreach ($groupedCartItems as $storeName => $items) {
            foreach ($items as $cartItem) {
                if (isset($variantPrices[$cartItem['variantid']])) {
                    $quantity = $cartItem['quantity'];

                    $variantPrice = $variantPrices[$cartItem['variantid']];

                    $gstRate = $gstRates[$cartItem['productid']];
                    $product = $products[$cartItem['productid']];

                    $itemData = [
                        'title' => $product->name,
                        'netprice' => number_format($variantPrice->net_price * $quantity, 2),
                        'price' => $variantPrice->discount_price,
                        'quantity' => (string) $quantity,
                        'totalprice' => number_format($variantPrice->discount_price * $quantity, 2),
                        'image' => $variantPrice->product_images->image,
                        'gst_amount' => number_format(($gstRate / 100) * ($variantPrice->net_price * $quantity), 2),
                        'variant' => 'Size: ' . $variantPrice->product_variant_values_1->value . ', Package: ' . $variantPrice->product_variant_values_2->value,
                        'store_name' => $storeName,
                        'vendor_alias' => $product->vendors->vendor_alias,
                        'storeid' => $product->vendors->id,
                        'categoryid' => $product->category_id,
                        'subcategoryid' => $product->sub_category_id,
                        'storeslug' => $product->vendors->slug,
                        'productGstRate' => $product->gst_rate,
                    ];

                    $groupedData[$cartItem['productid']][$cartItem['variantid']] = $itemData;
                } else {
                    error_log('Variant ID not found in variantPrices: ' . $cartItem['variantid']);
                }
            }
        }
        return response()->json($groupedData);
    }

    public function verifyCoupon(Request $request, $customerid)
    {
        $coupons = Coupon::with('coupon_mapping')->with('coupon_usage')->where('coupon_code', $request->couponCodeText)->whereRaw("DATE(start_datetime) <= DATE(SYSDATE())")->whereRaw("DATE(end_datetime) >= DATE(SYSDATE())")->where('is_active', true) ->selectRaw('coupons.*, coupons.id AS coupondid')->first();
        if ($coupons == null) {
            return response()->json(['status' => false, 'discount' => @$discount,'message' => 'Coupon is not available'], 200);
        }
        $validPaymentModes = ['online' => 1, 'cod' => 2]; // Define valid payment modes and their corresponding values

    // if (array_key_exists($request->payment_mode, $validPaymentModes)) {
    //     $validPaymentModeValue = $validPaymentModes[$request->payment_mode];
    //     if ($coupons->payment_mode_apply != $validPaymentModeValue) {
    //         return response()->json(['status' => false, 'discount' => 0,'message' => 'Coupon is not available for ' . $request->payment_mode], 200);
    //     }
    // } else {
    //     return response()->json(['status' => false, 'discount' => 0, 'message' => 'Invalid payment mode'], 200);
    // }


        // $paymentArray['online']= 1;
        // $paymentArray['cod']= 2; 
        // if(in_array($coupons->payment_mode_apply,[1,2])){
        //     if($coupons->payment_mode_apply != $paymentArray[$request->payment_mode]){

        //             return response()->json(['status' => false, 'discount' => 0,'message' => 'Coupon is not available for '. $request->payment_mode], 200);
        //     }

        // }
        // if($coupons->payment_mode_apply ==1 and  $request->payment_mode

        $couponid = $coupons->coupondid;
        $vendorfilter = is_null($coupons->coupon_mapping->vendor_id) ? array() : explode(", ", $coupons->coupon_mapping->vendor_id);
        $customerfilter = is_null($coupons->coupon_mapping->customer_id) ? array() : explode(", ", $coupons->coupon_mapping->customer_id);
        $categoryfilter = is_null($coupons->coupon_mapping->category_id) ? array() : explode(", ", $coupons->coupon_mapping->category_id);
        $productfilter = is_null($coupons->coupon_mapping->product_id) ? array() : explode(", ", $coupons->coupon_mapping->product_id);
        $discount = $subtotal = $subtotalproductwise = $subtotalvendorwise = $subtotalcategorywise = 0;
        $vendorwisecart = $categorywisecart = $productwisecart = array();
        $cartItems = Cart::where('customerid', $customerid)->get();
        $productIds = $cartItems->pluck('productid')->all();
        $variantIds = $cartItems->pluck('variantid')->all();
        $products = Product::with('vendors')->whereIn('id', $productIds)->get()->keyBy('id');
        $gstRates = $products->map(function ($product) {
            return $product->gst_rate;
        });

        $variantPrices = ProductVerientPrice::with('product_images', 'product_variant_values_1', 'product_variant_values_2')
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $groupedCartItems = $cartItems->groupBy(function ($item) use ($products) {
            return $products[$item['productid']]->vendors->store_name;
        });

        $groupedData = [];

        foreach ($groupedCartItems as $storeName => $items) {
            foreach ($items as $cartItem) {
                if (isset($variantPrices[$cartItem['variantid']])) {
                    $quantity = $cartItem['quantity'];
                    $variantPrice = $variantPrices[$cartItem['variantid']];
                    $gstRate = $gstRates[$cartItem['productid']];
                    $product = $products[$cartItem['productid']];

                    $itemData = [
                        'title' => $product->name,
                        'netprice' =>$variantPrice->net_price,
                        'price' => $variantPrice->product_mrp,
                        'quantity' => (string) $quantity,
                        'totalprice' => $variantPrice->net_price * $quantity,
                        //'image' => $variantPrice->product_images->image,
                        'gst_amount' => ($gstRate / 100) * ($variantPrice->net_price * $quantity),
                        'variant' => 'Size: ' . $variantPrice->product_variant_values_1->value . ', Package: ' . $variantPrice->product_variant_values_2->value,
                        'store_name' => $storeName,
                        'vendor_alias' => $product->vendors->vendor_alias,
                        'storeid' => $product->vendors->id,
                        'categoryid' => $product->category_id,
                        'subcategoryid' => $product->sub_category_id,
                        'storeslug' => $product->vendors->slug,
                        'productGstRate' => $product->gst_rate,
                    ];

                    $groupedData[$cartItem['productid']][$cartItem['variantid']] = $itemData;
                    
                } else {
                    error_log('Variant ID not found in variantPrices: ' . $cartItem['variantid']);
                }
            }
        }
      
    {
        foreach ($groupedData as $product_id => $cart) {
        foreach ($cart as $cartelement) {
        //  dd($cartelement);
                $subtotal += $cartelement['totalprice'];
                $array = array('storeid' => $cartelement['storeid'], 'productid' => $product_id, 'categoryid' => $cartelement['categoryid'], 'quantity' => $cartelement['quantity'], 'price' => $cartelement['totalprice']);
                if (count($productfilter) > 0) {
                    if (in_array($product_id, $productfilter)) {
                        if (!array_key_exists($product_id, $productwisecart)) {
                            $productwisecart[$product_id] = array();
                        }
                        $subtotalproductwise += $cartelement['totalprice'];
                        array_push($productwisecart[$product_id], $array);
                    }
                }
                if (count($categoryfilter) > 0) {
                    if (in_array($cartelement['categoryid'], $categoryfilter)) {
                        if (!array_key_exists($cartelement['categoryid'], $categorywisecart)) {
                            $categorywisecart[$cartelement['categoryid']] = array();
                        }
                        $subtotalcategorywise += $cartelement['totalprice'];
                        array_push($categorywisecart[$cartelement['categoryid']], $array);
                    }
                }
                if (count($vendorfilter) > 0) {
                    if (in_array($cartelement['storeid'], $vendorfilter)) {
                        if (!array_key_exists($cartelement['storeid'], $vendorwisecart)) {
                            $vendorwisecart[$cartelement['storeid']] = array();
                        }
                        $subtotalvendorwise += $cartelement['totalprice'];
                        array_push($vendorwisecart[$cartelement['storeid']], $array);
                    }
                }
            }
        }

        if (count($customerfilter) > 0) {
            if (in_array($customerid, $customerfilter)) {
        
                if ($subtotal < $coupons->minimum_cart_amount) {
                    return response()->json(['status' => false, 'discount' => $discount,'message' => 'Add ' . ($coupons->minimum_cart_amount - $subtotal) . ' to avail this coupon.'], 200);
                }
                if ($coupons->coupon_type == "flat") {
                    $discount = $coupons->coupon_off;
                } else {
                    $discount = (($subtotal * $coupons->coupon_off) / 100);
                    if ($coupons->maximum_discount_amount <= $discount) {
                        $discount = $coupons->maximum_discount_amount;
                    }
                }
            } else {
                return response()->json(['status' => false, 'discount' => $discount,'message' => 'Coupon not applicable'], 200);
            }
        } else if (count($productfilter) > 0) {
            if ($subtotalproductwise < $coupons->minimum_cart_amount) {
                return response()->json(['status' => false, 'discount' => $discount,'message' => 'Add ' . ($coupons->minimum_cart_amount - $subtotalproductwise) . ' to avail this coupon.'], 200);
            }
            $productsids = array_keys($productwisecart);
            foreach ($productsids as $productsid) {
                if (in_array($productsid, $productfilter)) {
                    if ($coupons->coupon_type == "flat") {
                        $discount = $coupons->coupon_off;
                    } else {
                        $discount = (($subtotalproductwise * $coupons->coupon_off) / 100);
                        if ($coupons->maximum_discount_amount <= $discount) {
                            $discount = $coupons->maximum_discount_amount;
                        }
                    }
                }
            }
        } else if (count($vendorfilter) > 0) {
            if ($subtotalvendorwise < $coupons->minimum_cart_amount) {
                return response()->json(['status' => false, 'discount' => $discount,'message' => 'Add ' . ($coupons->minimum_cart_amount - $subtotalvendorwise) . ' to avail this coupon.'], 200);
            }
            $vendorsids = array_keys($vendorwisecart);
            foreach ($vendorsids as $vendorsid) {
                if (in_array($vendorsid, $vendorfilter)) {
                    if ($coupons->coupon_type == "flat") {
                        $discount = $coupons->coupon_off;
                    } else {
                        $discount = (($subtotalvendorwise * $coupons->coupon_off) / 100);
                        if ($coupons->maximum_discount_amount <= $discount) {
                            $discount = $coupons->maximum_discount_amount;
                        }
                    }
                }
            }
        } else if (count($categoryfilter) > 0) {
            if ($subtotalcategorywise < $coupons->minimum_cart_amount) {
                return response()->json(['status' => false,'discount' => $discount, 'message' => 'Add ' . ($coupons->minimum_cart_amount - $subtotalcategorywise) . ' to avail this coupon.'], 200);
            }
            $categoriesids = array_keys($productwisecart);
            foreach ($categoriesids as $categoriesid) {
                if (in_array($categoriesid, $categoryfilter)) {
                    if ($coupons->coupon_type == "flat") {
                        $discount = $coupons->coupon_off;
                    } else {
                        $discount = (($subtotalcategorywise * $coupons->coupon_off) / 100);
                        if ($coupons->maximum_discount_amount <= $discount) {
                            $discount = $coupons->maximum_discount_amount;
                        }
                    }
                }
            }
        } else {
            if ($subtotal < $coupons->minimum_cart_amount) {
                return response()->json(['status' => false,'discount' => $discount, 'message' => 'Add ' . ($coupons->minimum_cart_amount - $subtotal) . ' to avail this coupon.'], 200);
            }
            if ($coupons->coupon_type == "flat") {
                $discount = $coupons->coupon_off;
            } else {
                $discount = (($subtotal * $coupons->coupon_off) / 100);
                if ($coupons->maximum_discount_amount <= $discount) {
                    $discount = $coupons->maximum_discount_amount;
                }
            }
        }

        return response()->json([
            'status' => true,
            'discount' => $discount,
            'couponid' => $couponid
        ], 200);
    }
}
   



    public function save_card_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'cardholder_name' => 'required',
            'expiration_month' => 'required',
            'expiration_year' => 'required',
            'customer_id'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'staus_code'=>400]);
        }

        $existingCard = CardDetail::where('customer_id',$request->input('customer_id'))
            ->where('card_number', $request->input('card_number'))
            ->first();

        if ($existingCard) {
            return response()->json(['error' => 'This card is already added for the customer.','staus_code'=>409]);
        }

        $cardDetail = new CardDetail();
        $cardDetail->customer_id = $request->input('customer_id');
        $cardDetail->card_number = $request->input('card_number');
        $cardDetail->cardholder_name = $request->input('cardholder_name');
        $cardDetail->expiration_month = $request->input('expiration_month');
        $cardDetail->expiration_year = $request->input('expiration_year');
        $cardDetail->save();

        return response()->json(['message' => 'Card details saved successfully.', 'status' => 201]);
    }


    public function delete_card_detail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'card_id' => 'required',            
            'customer_id'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'staus_code'=>400]);
        }
        $cardDetail = CardDetail::where('customer_id', $request->input('customer_id'))
            ->where('id', $request->input('card_id'))
            ->first();

        if (!$cardDetail) {
            return response()->json(['message' => 'Card detail not found.', 'status' => false]);
        }

        $cardDetail->delete();

        return response()->json(['message' => 'Card detail deleted successfully.', 'status' => true]);
    }


    public function get_card_details($customerId)
    {
        $cardDetails = CardDetail::where('customer_id', $customerId)->get();

        if ($cardDetails->isEmpty()) {
            return response()->json(['message' => 'No card details found for the customer.', 'status' => false]);
        }

        return response()->json(['card_details' => $cardDetails, 'status' => true]);
    }
}





