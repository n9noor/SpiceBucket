<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\OrderExtraCharges;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\ProductVerientValue;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Vendor;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VendorProductController extends Controller
{

    public function api_get_products_by_vendor($vendorId)
    {
        // Retrieve products based on the vendor ID
        $products = Product::with(['product_images','product_variant_price','product_variant_value'])
                            ->where('vendor_id', $vendorId)
            ->where('is_active', true)
            ->get();

        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'No products found for the vendor ID.',
                'status_code' => 404,
                'status' => false
            ], 404);
        }

        return response()->json([
            'products' => $products,
            'status_code' => 200,
            'status' => true
        ]);
    }
    ///////////////////////////////////////

    public function api_add_product(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required',
            'product_type' => 'required',
            'name' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'hsn_code' => 'required',
            'sku' => 'required',
            'gst_rate' => 'required',
            'barcode' => 'required',
            'origin' => 'required',
            // Include any other required fields for the product
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }

        // Create a new product
        $product = Product::create([
            'vendor_id' => $request->vendor_id,
            'product_type' => $request->product_type,
            'name' => $request->name,
            'summary' => $request->summary,
            'description' => $request->description,
            'hsn_code' => $request->hsn_code,
            'sku' => $request->sku,
            'gst_rate' => $request->gst_rate,
            'barcode' => $request->barcode,
            'origin' => $request->origin,
            // Include any other relevant product details
        ]);

        return response()->json(['message' => 'Product added successfully.', 'status' => true,'data' => $product]);
    }
    //////////////////
    public function api_add_video_url(Request $request, $productId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'video_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }

        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.','status' => false], 404);
        }

        // Add the video URL to the product
        $product->video_url = $request->video_url;
        $product->save();

        return response()->json(['message' => 'Video URL added successfully.','status' => true, 'data' => $product]);
    }

    ///////////////////////////////
    public function api_update_product(Request $request, $productId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'product_mrp' => 'required|numeric',
            'discount_percentage' => 'required|numeric',
            'net_price_with_tax' => 'required|numeric',
            'minoq' => 'required|integer',
            'maxoq' => 'required|integer',
            'cost' => 'required|numeric',
            'taxable' => 'required|boolean',
            'tax_rate' => 'required|numeric',
            'tax_amount' => 'required|numeric',
            'net_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }

        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.','status' => false], 404);
        }

        // Update the product fields
        $product->product_mrp = $request->product_mrp;
        $product->discount_percentage = $request->discount_percentage;
        $product->net_price_with_tax = $request->net_price_with_tax;
        $product->minoq = $request->minoq;
        $product->maxoq = $request->maxoq;
        $product->cost = $request->cost;
        $product->taxable = $request->taxable;
        $product->tax_rate = $request->tax_rate;
        $product->tax_amount = $request->tax_amount;
        $product->net_price = $request->net_price;
        $product->save();

        return response()->json(['message' => 'Product updated successfully.','status' => true, 'data' => $product]);
    }
    //////////////
    public function api_update_b2b_price(Request $request, $productId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'b2b_price' => 'required|numeric',
            'b2b_minoq' => 'required|integer',
            'b2b_maxoq' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }

        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.','status' => false], 404);
        }

        // Update the B2B price fields
        $product->b2b_price = $request->b2b_price;
        $product->b2b_minoq = $request->b2b_minoq;
        $product->b2b_maxoq = $request->b2b_maxoq;
        $product->save();

        return response()->json(['message' => 'B2B price updated successfully.','status' => true, 'data' => $product]);
    }

    public function api_add_product_image(Request $request, $productId)
    {
        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.','status' => false], 404);
        }
        $counter = 1;
        if ($request->hasfile('product_image')) {
            foreach ($request->file('product_image') as $image) {
                // Validate the image
                $validator = Validator::make(['image' => $image], [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors(),'status' => false], 422);
                }

                // Process and store the image
                $imageName = 'p' . $counter . '-' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);

                // Create a new product image
                $productImage = new ProductImage();
                $productImage->product_id = $productId;
                $productImage->image = $imageName;
                $productImage->imagesetid = $counter;
                $productImage->save();
                $counter++;
            }
        }

        return response()->json(['message' => 'Product images added successfully.','status' => true]);
    }

    public function api_add_variant_prices(Request $request, $productId)
    {
        // Find the product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.','status' => false], 404);
        }

        $counter = 1;
        if ($request->varient_property_manual == 'yes') {
            $variantDefault = explode("_", $request->variant_default);

            foreach ($request->variant as $variantValueId1 => $variantsValue1) {
                if (is_array($variantsValue1) && !array_key_exists('product_mrp', $variantsValue1)) {
                    foreach ($variantsValue1 as $variantValueId2 => $variantsValue2) {
                        if (is_array($variantsValue2) && !array_key_exists('product_mrp', $variantsValue2)) {
                            foreach ($variantsValue2 as $variantValueId3 => $variantsValue3) {
                                $productVariantPrice = new ProductVariantPrice();
                                $productVariantPrice->product_id = $productId;
                                $productVariantPrice->variant_value_id_1 = $variantValueId1;
                                $productVariantPrice->variant_value_id_2 = $variantValueId2;
                                $productVariantPrice->variant_value_id_3 = $variantValueId3;
                                $productVariantPrice->product_mrp = $variantsValue3['product_mrp'];
                                $productVariantPrice->net_price = $variantsValue3['net_price'];
                                $productVariantPrice->discount_percentage = $variantsValue3['discount_price'];
                                $productVariantPrice->discount_price = ($variantsValue3['product_mrp'] - $variantsValue3['net_price']);
                                $productVariantPrice->sku = $variantsValue3['sku'];
                                $productVariantPrice->barcode = $variantsValue3['barcode'];
                                $productVariantPrice->net_weight = $variantsValue3['net_weight'];
                                $productVariantPrice->quantity = $variantsValue3['quantity'];

                                if ($request->hasFile("variant.{$variantValueId1}.{$variantValueId2}.{$variantValueId3}.image")) {
                                    $imageObj = new ProductImage();
                                    $imageName = 'pv-' . $productId . '-' . $variantValueId1  . '-' . $variantValueId2 . '-' . $variantValueId3 . '-' . time() . '.' . $request["variant.{$variantValueId1}.{$variantValueId2}.{$variantValueId3}.image"]->extension();
                                    $request["variant.{$variantValueId1}.{$variantValueId2}.{$variantValueId3}.image"]->move(public_path('images/products'), $imageName);
                                    $imageObj->product_id = $productId;
                                    $imageObj->image = $imageName;
                                    $imageObj->imagesetid = $counter;
                                    $imageObj->save();
                                    $counter++;
                                    $productVariantPrice->image_id = $imageObj->id;
                                }

                                $productVariantPrice->save();
                            }
                        } else {
                            $productVariantPrice = new ProductVariantPrice();
                            $productVariantPrice->product_id = $productId;
                            $productVariantPrice->variant_value_id_1 = $variantValueId1;
                            $productVariantPrice->variant_value_id_2 = $variantValueId2;
                            $productVariantPrice->product_mrp = $variantsValue2['product_mrp'];
                            $productVariantPrice->net_price = $variantsValue2['net_price'];
                            $productVariantPrice->discount_percentage = $variantsValue2['discount_price'];
                            $productVariantPrice->discount_price = ($variantsValue2['product_mrp'] - $variantsValue2['net_price']);
                            $productVariantPrice->sku = $variantsValue2['sku'];
                            $productVariantPrice->barcode = $variantsValue2['barcode'];
                            $productVariantPrice->net_weight = $variantsValue2['net_weight'];
                            $productVariantPrice->quantity = $variantsValue2['quantity'];

                            if ($request->hasFile("variant.{$variantValueId1}.{$variantValueId2}.image")) {
                                $imageObj = new ProductImage();
                                $imageName = 'pv-' . $productId . '-' . $variantValueId1 . '-' . $variantValueId2 . '-' . time() . '.' . $request["variant.{$variantValueId1}.{$variantValueId2}.image"]->extension();
                                $request["variant.{$variantValueId1}.{$variantValueId2}.image"]->move(public_path('images/products'), $imageName);
                                $imageObj->product_id = $productId;
                                $imageObj->image = $imageName;
                                $imageObj->imagesetid = $counter;
                                $imageObj->save();
                                $counter++;
                                $productVariantPrice->image_id = $imageObj->id;
                            }

                            $productVariantPrice->save();
                        }
                    }
                } else {
                    $productVariantPrice = new ProductVariantPrice();
                    $productVariantPrice->product_id = $productId;
                    $productVariantPrice->variant_value_id_1 = $variantValueId1;
                    $productVariantPrice->product_mrp = $variantsValue1['product_mrp'];
                    $productVariantPrice->net_price = $variantsValue1['net_price'];
                    $productVariantPrice->discount_percentage = $variantsValue1['discount_price'];
                    $productVariantPrice->discount_price = ($variantsValue1['product_mrp'] - $variantsValue1['net_price']);
                    $productVariantPrice->sku = $variantsValue1['sku'];
                    $productVariantPrice->barcode = $variantsValue1['barcode'];
                    $productVariantPrice->net_weight = $variantsValue1['net_weight'];
                    $productVariantPrice->quantity = $variantsValue1['quantity'];

                    if ($request->hasFile("variant.{$variantValueId1}.image")) {
                        $imageObj = new ProductImage();
                        $imageName = 'pv-' . $productId . '-' . $variantValueId1 . '-' . time() . '.' . $request["variant.{$variantValueId1}.image"]->extension();
                        $request["variant.{$variantValueId1}.image"]->move(public_path('images/products'), $imageName);
                        $imageObj->product_id = $productId;
                        $imageObj->image = $imageName;
                        $imageObj->imagesetid = $counter;
                        $imageObj->save();
                        $counter++;
                        $productVariantPrice->image_id = $imageObj->id;
                    }

                    $productVariantPrice->save();
                }
            }

            $whereData = [];
            if (array_key_exists(0, $variantDefault) && !is_null($variantDefault[0]) && !empty($variantDefault[0])) {
                $whereData['variant_value_id_1'] = $variantDefault[0];
                if (array_key_exists(1, $variantDefault) && !is_null($variantDefault[1]) && !empty($variantDefault[1])) {
                    $whereData['variant_value_id_2'] = $variantDefault[1];
                    if (array_key_exists(2, $variantDefault) && !is_null($variantDefault[2]) && !empty($variantDefault[2])) {
                        $whereData['variant_value_id_3'] = $variantDefault[2];
                    }
                }
            }

            ProductVariantPrice::where($whereData)->update(['mark_as_default' => 1]);

            if ($request->variant_property_copy) {
                $variants = ProductVariantPrice::where('product_id', $request->copy_from_product)->get();
                foreach ($variants as $variant) {
                    $productVariantPrice = new ProductVariantPrice();
                    $productVariantPrice->product_id = $productId;
                    $productVariantPrice->variant_value_id_1 = $variant->variant_value_id_1;
                    $productVariantPrice->variant_value_id_2 = $variant->variant_value_id_2;
                    $productVariantPrice->variant_value_id_3 = $variant->variant_value_id_3;
                    $productVariantPrice->product_mrp = $variant->product_mrp;
                    $productVariantPrice->net_price = $variant->net_price;
                    $productVariantPrice->discount_percentage = $variant->discount_percentage;
                    $productVariantPrice->discount_price = $variant->discount_price;
                    $productVariantPrice->sku = $variant->sku;
                    $productVariantPrice->barcode = $variant->barcode;
                    $productVariantPrice->net_weight = $variant->net_weight;
                    $productVariantPrice->quantity = $variant->quantity;
                    $productVariantPrice->mark_as_default = $variant->mark_as_default;
                    $productVariantPrice->save();
                }
            }
        }
    }




    // API endpoint to get order details, order information, and extra charges by vendor_id
    public function getOrderDetailsWithExtraCharges(Request $request,$vendorId)
    {
        
        $orderDetails = OrderDetail::where('vendor_id', $vendorId)->get();
    
        // Check if any order details found
        if ($orderDetails->isEmpty()) {
            return response()->json(['message' => 'No order details found for the provided vendor_id.','status' => false], 404);
        }
        ;
        // Retrieve order information based on the order details
        $orderIds = [];
        foreach ($orderDetails as $orderDetail) {
            if (!in_array($orderDetail->order_id, $orderIds)) {
                $orderIds[] = $orderDetail->order_id;
            }
        }

        // Retrieve order information based on the order details
        $orders = Order::whereIn('id', $orderIds)->get();
    
        // Retrieve extra charges based on the order_ids and vendor_id
        $extraCharges = OrderExtraCharges::whereIn('order_id', $orderIds)->where('vendor_id', $vendorId)->get();

        // Combine order details, order information, and extra charges
        $orderData = [];
        foreach ($orders as $order) {
            $orderData[] = [
                'order' => $order,
                'order_details' => $orderDetails->where('order_id', $order->id),
                'extra_charges' => $extraCharges->where('order_id', $order->id),
            ];
        }

        // Return the order details, order information, and extra charges
        return response()->json(['order_data' => $orderData,'status' => true], 200);
    }

            //////////////////

    public function get_Variants_lisit()
    {
        
        $variants = ProductVerient::where('is_active', true)->get();

        return response()->json($variants);
    }
    
    
    public function get_Variant_value_lisit($variant_id)
    {   
        $variantValues = ProductVerientValue::where('variant_id', $variant_id)->get();

        return response()->json($variantValues);
    }

    //////////////////////
    public function add_productvariant_price(Request $request)
    {
        
        try {
            $request->validate([
                'product_id' => 'required',
                'variants' => 'required|array',
                'variants.*.variant_value_id_1' => 'required',
                'variants.*.variant_value_id_2' => 'required',
                
            ]);
            
            $variants = $request->input('variants', []);
            $productVariancePrices = [];
    
            foreach ($variants as $variant) {
                $productVariancePrices[] = ProductVerientPrice::create([
                    'product_id' => $request->input('product_id'),
                    'variant_value_id_1' => $variant['variant_value_id_1'],
                    'variant_value_id_2' => $variant['variant_value_id_2'],
                  
                ]);
            }
    
            return response()->json([
                'message' => 'Product variance prices created successfully.',
                'data' => $productVariancePrices,
                'status' => true
            ], 201);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Validation failed.',
                'status' => false,
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    ////////////

    public function get_productvariant_prices($product_id)
    {
        $productVariancePrices = ProductVerientPrice::with(['products',
            'product_variant_values_1',
            'product_variant_values_2',
        ])->where('product_id', $product_id)->get();

        return response()->json([
            'message' => 'Product variance prices retrieved successfully.',
            'data' => $productVariancePrices,
            'status' => true
        ], 200);
}


public function update_product_variantprice(Request $request, $product_variantprice_id)
{
    $request->validate([
        'variant_value_id_1' => 'required',
        'variant_value_id_2' => 'required',
        'product_mrp' => 'nullable|numeric',
        'discount_price' => 'nullable|numeric',
        'discount_percentage' => 'nullable|numeric',
        'net_price' => 'nullable|numeric',
        'b2b_price' => 'nullable|numeric',
        'sku' => 'nullable|string',
        'barcode' => 'nullable|string',
        'net_weight' => 'nullable|numeric',
        'quantity' => 'nullable|integer',
        'mark_as_default' => 'nullable|boolean',
        'image_id' => 'nullable|integer',
        'created_by' => 'nullable|string',
        'updated_by' => 'nullable|string',
    ]);

    $productVariantPrice = ProductVerientPrice::find($product_variantprice_id);

    if (!$productVariantPrice) {
        return response()->json([
            'message' => 'Product variant price not found.',
            'status' => false
        ], 404);
    }

    $productVariantPrice->update($request->all());

    return response()->json([
        'message' => 'Product variant price updated successfully.',
        'data' => $productVariantPrice,
        'status' => true
    ], 200);
}


}

