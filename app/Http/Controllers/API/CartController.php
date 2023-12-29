<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

use function GuzzleHttp\Promise\all;

class CartController extends Controller
{
     
    public function api_cart_add(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'variant_id' => 'required',
            'product_id' => 'required',
            'customer_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }
    
        // Check if the product is already added to the cart for the customer
        $existingCartItem = Cart::where('productid', $request->product_id)
                                ->where('customerid', $request->customer_id)
                                ->where('variantid', $request->variant_id)
                                ->first();
    
        if ($existingCartItem) {
            // Increment the quantity of the existing cart item
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
    
            return response()->json(['message' => 'Product quantity updated in the cart.', 'data' => $existingCartItem, 'status' => true]);
        }
    
        // Create a new cart item
        $cart = Cart::create([
            'variantid' => $request->variant_id,
            'productid' => $request->product_id,
            'customerid' => $request->customer_id,
            'quantity' => $request->quantity,
        ]);
    
        // Return a success response
        return response()->json(['message' => 'Product added to cart successfully', 
                        'data' => $cart,
                        'status' => true,
            ]);
    }

  ///////
   public function api_edit_cart(Request $request)

    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'variant_id' => 'required',
            'product_id' => 'required',
            'customer_id' => 'required',
            'quantity' => 'required|integer|min:1',
            
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }
        $cartId = $request->input('cart_id');
        // Find the cart item
        $cart = Cart::where('id', $cartId)->first();
    
        if (!$cart) {
            return response()->json(['error' => 'Cart item not found'], false);
        }
    
        // Update the cart item
        $cart->variantid = $request->variant_id;
        $cart->productid = $request->product_id;
        $cart->customerid = $request->customer_id;
        $cart->quantity = $request->quantity;
        $cart->save();
    
        // Return a success response
        return response()->json(['message' => 'Cart item updated successfully', 'data' => $cart,'status'=>true]);
    }
   
   ///////////////////////////////////////////////////////////    
   public function api_cart_remove(Request $request)
   {
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'product_id' => 'required',
        'customer_id' => 'required',
        'variant_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(), 'status' => 422]);
    }

    // Find the cart item for the product and customer
    $cartItem = Cart::where('productid', $request->product_id)
                    ->where('customerid', $request->customer_id)
                    ->where('variantid', $request->variant_id)
                    ->first();

    if (!$cartItem) {
        return response()->json(['status' => false, 'error' => 'Cart item not found.', 'status' => false]);
    }

    // Check if the quantity is already 1
    if ($cartItem->quantity === 1) {
        // If the quantity is 1, remove the cart item from the database
        $cartItem->delete();
        return response()->json(['status' => true, 'message' => 'Cart item deleted successfully.']);
    }

    // Decrease the quantity by 1
    $cartItem->quantity -= 1;
    $cartItem->save();

    return response()->json(['status' => true, 'message' => 'Quantity decreased in the cart.', 'data' => $cartItem, 'status' => true]);
}
//////

public function api_get_cart($customerid)
{  
    $cartItems = Cart::where('customerid', $customerid)->get();   
    $productIds = $cartItems->pluck('productid')->all();
    $variantIds = $cartItems->pluck('variantid')->all();

    // Retrieve the product details from the product table, including the vendor relationship and GST rate
    $products = Product::with('vendors')->whereIn('id', $productIds)->get()->keyBy('id');

    // Create a dictionary to store the GST rates for each product
    $gstRates = $products->map(function ($product) {
        return $product->gst_rate;
    });

    // Retrieve the variant prices from the variant_price table
    $variantPrices = ProductVerientPrice::with('product_images', 'product_variant_values_1', 'product_variant_values_2')
        ->whereIn('id', $variantIds)
        ->get()
        ->keyBy('id');

    $groupedCartItems = $cartItems->groupBy(function ($item) use ($products) {
        return $products[$item['productid']]->vendors->store_name;
    });

    $shippingChargesTax =0;
    $groupedData = [];
    $sumTotalQuantity = 0;
    $sumTotalProductMRP = 0;
    $sumTotalDiscountPrice = 0;
    $sumSubTotal= 0;
    $sumTotalNetPrice = 0;
    $sumTotalGST = 0;
    $sumShippingCharges = 0;

    foreach ($groupedCartItems as $storeName => $items) {
        $vendorData = [];
        $vendorData['store_name'] = $storeName;
        $vendorData['vendor_id'] = $products[$items[0]['productid']]->vendors->id;

        $vendorData['items'] = [];
        $vendorData['total_quantity'] = 0;
        $vendorData['total_product_mrp'] = 0;
        $vendorData['total_discount_price'] = 0;
        $vendorData['total_net_price'] = 0;
        $vendorData['subTotal'] = 0;
        $vendorData['total_gst'] = 0;
        $vendorData['shipping_charges'] = 0; // Initialize shipping charges for the vendor

        foreach ($items as $cartItem) {
            if (isset($variantPrices[$cartItem['variantid']])) {
                $quantity = $cartItem['quantity'];
                $vendorData['total_quantity'] += $quantity;
                $variantPrice = $variantPrices[$cartItem['variantid']];
                $vendorData['total_product_mrp'] += $variantPrice->product_mrp * $quantity;
                $vendorData['total_discount_price'] += $variantPrice->discount_price * $quantity;
                $vendorData['total_net_price'] += $variantPrice->net_price * $quantity;
                $gstRate = $gstRates[$cartItem['productid']];                                      
                $vendorData['total_gst'] += round(($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity, 2);
                $vendorData['subTotal'] += round(($variantPrice->net_price * $quantity)- ($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity,2);
                $product = $products[$cartItem['productid']];
                $cartItem['product_name'] = $product->name;
                $cartItem['variant_data'] = [
                    'product_mrp' => $variantPrice->product_mrp,
                    'discount_price' => $variantPrice->discount_price,                   
                    'gst' => round(($variantPrice->net_price *$gstRate )/(100+$gstRate), 2),
                    'net_price_without_tax'=>round(($variantPrice->net_price)- ($variantPrice->net_price *$gstRate )/(100+$gstRate),2),               
                    'net_price' => $variantPrice->net_price,
                    'quantity' => $quantity,
                    'subtotal' =>round(($variantPrice->net_price * $quantity)- ($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity,2),
                    'total_tax' => round(($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity, 2),
                    'total_amount' => $variantPrice->net_price * $quantity,            
                ];

                 $productImage = $variantPrice->product_images;
                if ($productImage) {
                    $cartItem['product_image'] = $productImage->image;
                }

                $productVariantValues_1 = $variantPrice->product_variant_values_1;
                if ($productVariantValues_1) {
                    $cartItem['product_variant_value'] = $productVariantValues_1->value;
                }

                $productVariantValues_2 = $variantPrice->product_variant_values_2;
                if ($productVariantValues_2) {
                    $cartItem['product_variant_value_2'] = $productVariantValues_2->value;
                }

                $vendorData['items'][] = $cartItem;
            } else {
                error_log('Variant ID not found in variantPrices: ' . $cartItem['variantid']);
            }
        }

        $totalNetPrice = $vendorData['total_net_price'];
        if ($totalNetPrice <= 149) {
            $vendorData['shipping_charges'] = 50;
        } elseif ($totalNetPrice <= 349 && $totalNetPrice > 149) {
            $vendorData['shipping_charges'] = 70;
        } elseif ($totalNetPrice <= 498 && $totalNetPrice > 349) {
            $vendorData['shipping_charges'] = 100;
        } else {
            $vendorData['shipping_charges'] = 0;
        }

        if ($vendorData['shipping_charges'] > 0) {
            $shippingChargesWithTax = $vendorData['shipping_charges'];
            $shippingChargesTax =round(($shippingChargesWithTax * 5) / (100 + 5),2); // Calculating the tax amount
            $shippingChargesWithoutTax = $shippingChargesWithTax - $shippingChargesTax;
        
            $vendorData['shipping_charges'] =$shippingChargesWithoutTax;
            $vendorData['total_gst'] += $shippingChargesTax;
            $vendorData['total_net_price'] +=  $shippingChargesTax;
        }    
        
        $groupedData[] = $vendorData;

        $sumTotalQuantity += $vendorData['total_quantity'];
        $sumTotalProductMRP += $vendorData['total_product_mrp'];
        $sumTotalDiscountPrice += $vendorData['total_discount_price'];
        $sumTotalNetPrice += $vendorData['total_net_price'];
        $sumSubTotal += $vendorData['subTotal'];
        $sumTotalGST += $vendorData['total_gst'];
        $sumShippingCharges += $vendorData['shipping_charges'];
    }

    $checkoutAmount = $sumTotalNetPrice + $sumShippingCharges;

    return response()->json([        
        'data' => $groupedData,
        'sum_total_quantity' => $sumTotalQuantity,
        'sum_total_product_mrp' => $sumTotalProductMRP,
        'sum_total_discount_price' => $sumTotalDiscountPrice,
        'sum_total_net_price' => $sumTotalNetPrice,
        'sum_Sub_Total' => $sumSubTotal,
        'sum_total_gst' => $sumTotalGST,
        'sum_shipping_charges' => $sumShippingCharges,
        'checkout_amount' => $checkoutAmount,
        'status' => true,
    ]);
}


///////////
public function api_get_cart_address($customerid, $addressType = null)
{
    
    if ($addressType) {
        $customerAddresses = CustomerAddress::where('customer_id', $customerid)
            ->where('address_type', $addressType)
            ->get();

        if ($customerAddresses->isEmpty()) {
            return response()->json([
                'error' => 'Address not found for the given address type.',
                'status' => false,
            ]);
        }
    } else {
        
        $customerAddresses = CustomerAddress::where('customer_id', $customerid)->first();
    }

  
    $cartItems = Cart::where('customerid', $customerid)->get();   
    $productIds = $cartItems->pluck('productid')->all();
    $variantIds = $cartItems->pluck('variantid')->all();

    // Retrieve the product details from the product table, including the vendor relationship and GST rate
    $products = Product::with('vendors')->whereIn('id', $productIds)->get()->keyBy('id');

    // Create a dictionary to store the GST rates for each product
    $gstRates = $products->map(function ($product) {
        return $product->gst_rate;
    });

    // Retrieve the variant prices from the variant_price table
    $variantPrices = ProductVerientPrice::with('product_images', 'product_variant_values_1', 'product_variant_values_2')
        ->whereIn('id', $variantIds)
        ->get()
        ->keyBy('id');

    $groupedCartItems = $cartItems->groupBy(function ($item) use ($products) {
        return $products[$item['productid']]->vendors->store_name;
    });

   
    $groupedData = [];
    $sumTotalQuantity = 0;
    $sumTotalProductMRP = 0;
    $sumTotalDiscountPrice = 0;
    $sumSubTotal= 0;
    $sumTotalNetPrice = 0;
    $sumTotalGST = 0;
    $sumShippingCharges = 0;

    foreach ($groupedCartItems as $storeName => $items) {
        $vendorData = [];
        $vendorData['store_name'] = $storeName;
        $vendorData['items'] = [];
        $vendorData['total_quantity'] = 0;
        $vendorData['total_product_mrp'] = 0;
        $vendorData['total_discount_price'] = 0;
        $vendorData['total_net_price'] = 0;
        $vendorData['subTotal'] = 0;
        $vendorData['total_gst'] = 0;
        $vendorData['shipping_charges'] = 0; // Initialize shipping charges for the vendor

        foreach ($items as $cartItem) {
            if (isset($variantPrices[$cartItem['variantid']])) {
                $quantity = $cartItem['quantity'];
                $vendorData['total_quantity'] += $quantity;
                $variantPrice = $variantPrices[$cartItem['variantid']];
                $vendorData['total_product_mrp'] += $variantPrice->product_mrp * $quantity;
                $vendorData['total_discount_price'] += $variantPrice->discount_price * $quantity;
                $vendorData['total_net_price'] += $variantPrice->net_price * $quantity;
                $gstRate = $gstRates[$cartItem['productid']];                
                $vendorData['total_gst'] += round(($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity, 2);
                $vendorData['subTotal'] += round(($variantPrice->net_price * $quantity)- ($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity,2);
                $product = $products[$cartItem['productid']];
                $cartItem['product_name'] = $product->name;
                $cartItem['variant_data'] = [
                    'product_mrp' => $variantPrice->product_mrp,
                    'discount_price' => $variantPrice->discount_price,                   
                    'gst' => round(($variantPrice->net_price *$gstRate )/(100+$gstRate), 2),
                    'net_price_without_tax'=>round(($variantPrice->net_price)- ($variantPrice->net_price *$gstRate )/(100+$gstRate),2),
               
                    'net_price' => $variantPrice->net_price,
                    'quantity' => $quantity,
                    'subtotal' =>round(($variantPrice->net_price * $quantity)- ($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity,2),
                    'total_tax' => round(($variantPrice->net_price *$gstRate )/(100+$gstRate) * $quantity, 2),
                    'total_amount' => $variantPrice->net_price * $quantity,            
                ];

                 $productImage = $variantPrice->product_images;
                if ($productImage) {
                    $cartItem['product_image'] = $productImage->image;
                }

                $productVariantValues_1 = $variantPrice->product_variant_values_1;
                if ($productVariantValues_1) {
                    $cartItem['product_variant_value'] = $productVariantValues_1->value;
                }

                $productVariantValues_2 = $variantPrice->product_variant_values_2;
                if ($productVariantValues_2) {
                    $cartItem['product_variant_value_2'] = $productVariantValues_2->value;
                }

                $vendorData['items'][] = $cartItem;
            } else {
                error_log('Variant ID not found in variantPrices: ' . $cartItem['variantid']);
            }
        }

        $totalNetPrice = $vendorData['total_net_price'];
        if ($totalNetPrice <= 149) {
            $vendorData['shipping_charges'] = 50;
        } elseif ($totalNetPrice <= 349 && $totalNetPrice > 149) {
            $vendorData['shipping_charges'] = 70;
        } elseif ($totalNetPrice <= 498 && $totalNetPrice > 349) {
            $vendorData['shipping_charges'] = 100;
        } else {
            $vendorData['shipping_charges'] = 0;
        }
      
        $groupedData[] = $vendorData;

        $sumTotalQuantity += $vendorData['total_quantity'];
        $sumTotalProductMRP += $vendorData['total_product_mrp'];
        $sumTotalDiscountPrice += $vendorData['total_discount_price'];
        $sumTotalNetPrice += $vendorData['total_net_price'];
        $sumSubTotal += $vendorData['subTotal'];
        $sumTotalGST += $vendorData['total_gst'];
        $sumShippingCharges += $vendorData['shipping_charges'];
    }

    $checkoutAmount = $sumTotalNetPrice + $sumShippingCharges;

    return response()->json([
        'customer_addresses' => $customerAddresses,
        'data' => $groupedData,
        'sum_total_quantity' => $sumTotalQuantity,
        'sum_total_product_mrp' => $sumTotalProductMRP,
        'sum_total_discount_price' => $sumTotalDiscountPrice,
        'sum_total_net_price' => $sumTotalNetPrice,
        'sum_Sub_Total' => $sumSubTotal,
        'sum_total_gst' => $sumTotalGST,
        'sum_shipping_charges' => $sumShippingCharges,
        'checkout_amount' => $checkoutAmount,
        'status' => true,
    ]);
}
}






