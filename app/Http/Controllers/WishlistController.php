<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\ProductVerientPrice;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function api_wishlist_add(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseTokenId' => 'required',
            'productId' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
        $data = json_decode($request->getContent());
        $result = Customer::where('token_id', $data->tokenId)->first();
        if(!is_null($result)) {
            $customerid = $result->id;
            $result = Wishlist::where('product_id', $data->productId)->where('customer_id', $customerid)->first();
            if(!is_null($result)){
                return response()->json([
                    'status' => false,
                    'message' => "Product already available in the wishlist."
                ], 200);
            } else {
                $result = Product::where('id', $data->productId)->where('is_active', true)->first();
                if(is_null($result)){
                    return response()->json([
                        'status' => false,
                        'message' => "Product not available."
                    ], 200);
                } else {
                    Customer::where('id', $customerid)->update(['device_id' => $data->deviceId, 'firebase_token_id' => $data->firebaseTokenId]);
                    $wishlist = new Wishlist();
                    $wishlist->customer_id = $customerid;
                    $wishlist->product_id = $data->productId;
                    $wishlist->save();
                    $data = array();
                    $result = Wishlist::where('customer_id', $customerid)->get();
                    if(!is_null($result)) {
                        foreach($result as $row){
                            $rowResult = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')->join('vendors', 'products.vendor_id', '=', 'vendors.id')->where('products.id', $row->product_id)->where('products.is_approved', true)->where('products.is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName')->first();
                            array_push($data, array('product_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $rowResult->image) : url('/images/products/' . $rowResult->image)), 'product_name' => $rowResult->name, 'product_price' => $rowResult->net_price, 'status' => 'In Stock', 'category' => $rowResult->categoryName, 'subcategory' => $rowResult->subCategoryName, 'vendor' => $rowResult->vendorName));
                        }
                    }
                    return response()->json([
                        'status' => true,
                        'message' => 'Product added to wishlist.',
                        'data' => $data,
                        'count' => count($data)
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 200);
        }
    }

    public function api_wishlist(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseTokenId' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
    
        $data = json_decode($request->getContent());
        $result = Customer::where('token_id', $data->tokenId)->first();
    
        if (!is_null($result)) {
            Customer::where('id', $result->id)->update([
                'device_id' => $data->deviceId,
                'firebase_token_id' => $data->firebaseTokenId
            ]);
    
            $wishlistData = [];
            $wishlistItems = Wishlist::where('customer_id', $result->id)->get();
    
            if (!is_null($wishlistItems)) {
                foreach ($wishlistItems as $wishlistItem) {
                    $product = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
                        ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
                        ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                        ->where('products.id', $wishlistItem->product_id)
                        ->where('products.is_approved', true)
                        ->where('products.is_active', true)
                        ->selectRaw('products.*, 
                            (SELECT image FROM product_images WHERE product_id = products.id LIMIT 1) AS image, 
                            pc1.name as categoryName, 
                            pc2.name as subCategoryName, 
                            vendors.store_name as vendorName')
                        ->first();
    
                    if (!is_null($product)) {
                        $productVariants = ProductVerientPrice::with('product_variant_values_1','product_variant_values_2')->where('product_id', $product->id)->get();
                      
                        $variantsData = [];
                        
                        $wishlistData[] = [
                            'product_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $product->image) : url('/images/products/' . $product->image)),
                            'product_name' => $product->name,
                            'product_price' => $product->net_price,
                            'status' => 'In Stock',
                            'category' => $product->categoryName,
                            'subcategory' => $product->subCategoryName,
                            'vendor' => $product->vendorName,
                            'created_at' => $wishlistItem->created_at,
                            'updated_at' => $wishlistItem->updated_at,
                            'variants' => [], // Initialize an empty array for variants
                        ];
                        $variantImages = ProductImage::where('product_id',$product->id)->pluck('image','id')->toArray();
                        foreach ($productVariants as $variant) {
                            $variantData = [
                                'id' => $variant['id'],
                                'product_id' => $variant['product_id'],
                                'variant_value_id_1' => $variant->product_variant_values_1->value,
                                'variant_value_id_2' => $variant->product_variant_values_2->value,
                                'variant_value_id_3' => $variant['variant_value_id_3'],
                                'product_mrp' => $variant['product_mrp'],
                                'discount_price' => $variant['discount_price'],
                                'discount_percentage' => $variant['discount_percentage'],
                                'net_price' => $variant['net_price'],
                                'b2b_price' => $variant['b2b_price'],
                                'sku' => $variant['sku'],
                                'barcode' => $variant['barcode'],
                                'net_weight' => $variant['net_weight'],
                                'quantity' => $variant['quantity'],
                                'mark_as_default' => $variant['mark_as_default'],
                                'image_id' => $variant['image_id'],
                                'variant_image' => array_key_exists($variant['image_id'],$variantImages)?
                    url(env('APP_URL') . ('/public/images/products/') .$variantImages[$variant['image_id']]):'',
                                'created_by' => $variant['created_by'],
                                'updated_by' => $variant['updated_by'],
                                'created_at' => $variant['created_at'],
                                'updated_at' => $variant['updated_at'],
                            ];
    
                            $cartQuantitySum = Cart::where('customerid', $result->id)
                                ->where('variantid', $variant->id)
                                ->sum('quantity');
    
                            $variantData['cart_quantity'] = (string)$cartQuantitySum;
    
                            $wishlistData[count($wishlistData) - 1]['variants'][] = $variantData;
                        }
                    }
                }
            }    
            return response()->json([
                'status' => true,
                'message' => 'Wishlist available.',
                'data' => $wishlistData,
                'count' => count($wishlistData)
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 200);
        }
    }
    
    public function api_wishlists(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'tokenId' => 'required',
            'deviceId' => 'required',
            'firebaseTokenId' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
    
        $data = json_decode($request->getContent());
        $result = Customer::where('token_id', $data->tokenId)->first();
    
        if (!is_null($result)) {
            Customer::where('id', $result->id)->update([
                'device_id' => $data->deviceId,
                'firebase_token_id' => $data->firebaseTokenId
            ]);
    
            $wishlistData = [];
            $wishlistItems = Wishlist::where('customer_id', $result->id)->get();
    
            if (!is_null($wishlistItems)) {
                foreach ($wishlistItems as $wishlistItem) {
                    $product = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
                        ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
                        ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                        ->where('products.id', $wishlistItem->product_id)
                        ->where('products.is_approved', true)
                        ->where('products.is_active', true)
                        ->selectRaw('products.*, 
                            (SELECT image FROM product_images WHERE product_id = products.id LIMIT 1) AS image, 
                            pc1.name as categoryName, 
                            pc2.name as subCategoryName, 
                            vendors.store_name as vendorName')
                        ->first();
    
                    if (!is_null($product)) {
                        $productVariants = ProductVerientPrice::with('product_variant_values_1','product_variant_values_2')->where('product_id', $product->id)->get();
                        $variantsData = [];
    
                        foreach ($productVariants as $variant) {
                            $variantsData[] = $variant->toArray();
                        }    
                        $wishlistData[] = [
                            'product_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $product->image) : url('/images/products/' . $product->image)),
                            'product_name' => $product->name,
                            'product_price' => $product->net_price,
                            'status' => 'In Stock',
                            'category' => $product->categoryName,
                            'subcategory' => $product->subCategoryName,
                            'vendor' => $product->vendorName,
                            'created_at' => $wishlistItem->created_at,
                            'updated_at' => $wishlistItem->updated_at,
                            'variants' => $variantsData,
                        ];
                    }
                }
            }    
            return response()->json([
                'status' => true,
                'message' => 'Wishlist available.',
                'data' => $wishlistData,
                'count' => count($wishlistData)
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 200);
        }
    }
    

    

    public function deleteWishlist($productId, $customerId)
    {
        // Find the wishlist item based on product ID and customer ID
        $wishlistItem = Wishlist::where('product_id', $productId)
            ->where('customer_id', $customerId)
            ->first();

        // Check if the wishlist item exists
        if ($wishlistItem) {
            // Delete the wishlist item
            $wishlistItem->delete();

            // Return a success response
            return response()->json([
                'success' => true,
                 'status' => true,
                'message' => 'Product removed from wishlist successfully.',
            ]);
        } else {
            // Return an error response if the wishlist item doesn't exist
            return response()->json([
                'success' => false,
                'status' => false,
                'message' => 'Product not found in the customer\'s wishlist.',
            ], 404);
        }
    }
}

