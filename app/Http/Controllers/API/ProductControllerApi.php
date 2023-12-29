<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\ProductVerientValue;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Vendor;
use App\Models\Cart;
use App\Models\RecentlyView;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductControllerApi extends Controller
{
    
    public function api_product_detail($productid, $customerid = null)
    {
        $result = Product::where('products.is_approved', true)
            ->where('products.id', $productid)
            ->where('products.is_active', true)
            ->first();
  
        // Check if the customer ID is provided
        $inWishlist = \DB::table('wishlist')
        ->where('product_id', $productid)
        ->where('customer_id', $customerid)
        ->exists(); 
    
        if (!$result) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ]);
        }
    
       
        $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
            ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
            ->where('product_variant_price.product_id', $productid) // Add condition for specific product ID
            ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')->orderBy('product_variant_price.product_mrp','desc')
            ->get();
    
        $cartData = Cart::where('customerid', $customerid)
            ->whereIn('variantid', $productVariants->pluck('id'))
            ->pluck('quantity', 'variantid')
            ->toArray();
        $variantImages = ProductImage::where('product_id', $productid)->pluck('image','id')->toArray();
        $productVariantsData = [];
        foreach ($productVariants as $variant) {
            $productVariantsData[] = [
                'id' => $variant['id'],
                'product_id' => $variant['product_id'],
                'variant_value_id_1' => $variant['size'],
                'variant_value_id_2' => $variant['packing'],
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
                'cart_quantity' => isset($cartData[$variant['id']]) ? $cartData[$variant['id']] : 0,
            ];
        }
    
        $images = ProductImage::where('product_id', $productid)->get();
    
        $data = $result->toArray();
        $data['product_images'] = $images->toArray();
        $data['product_variant_price'] = $productVariantsData;
        $data['fav'] = (bool) $inWishlist;
        
    
        return response()->json([            
            'product_detail' => $data,  
            'status' => true,        
        ]);
    }
    
    public function api_relatedProduct_detail($productid, $customerid = null)
    {
        $product = Product::where('is_approved', true)
            ->where('id', $productid)
            ->where('is_active', true)
            ->first();
    
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ]);
        }
    
        $relatedProductsQuery = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->where('products.is_approved', true)
            ->where('products.category_id', $product->category_id)
            ->where('products.is_active', true)
            ->where('products.id', '!=', $productid)
            ->selectRaw('products.*, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName');
    
        if ($customerid !== null) {
            $relatedProductsQuery->leftJoin('wishlist', function ($join) use ($customerid) {
                $join->on('products.id', '=', 'wishlist.product_id')
                    ->where('wishlist.customer_id', $customerid);
            })
            ->selectRaw('products.*, CAST((wishlist.product_id IS NOT NULL) AS UNSIGNED) AS in_wishlist');
        }
    
        $result = $relatedProductsQuery->orderBy('products.id','desc')->get();
    
        $productIds = $result->pluck('id')->toArray();
        
    
        $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
            ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
            ->whereIn('product_variant_price.product_id', $productIds)
            ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')
            ->get();
    
        $cartData = [];
    
        if ($customerid !== null) {
            $cartData = Cart::where('customerid', $customerid)
                ->whereIn('variantid', $productVariants->pluck('id'))
                ->pluck('quantity', 'variantid')
                ->toArray();
        }
    
        $data = [];
    
        foreach ($result as $row) {
            $variantsData = $productVariants->where('product_id', $row->id)->toArray();
            $variantImages = ProductImage::where('product_id', $row->id)->pluck('image','id')->toArray();
                        
            $productVariantsData = [];
            $images = ProductImage::where('product_id',  $row->id)->get();
            foreach ($variantsData as $variant) {
                    $variantImageId = $variant['image_id']; 
                    $variantImage = ProductImage::where('id', $variantImageId)->first();
                    $variantImagePath = $variantImage ? $variantImage->image : null;
            
                    $productVariantsData[] = [
                        'id' => $variant['id'],
                        'product_id' => $variant['product_id'],
                        'variant_image' => $variantImagePath,
                        'variant_value_id_1' => $variant['size'],
                        'variant_value_id_2' => $variant['packing'],
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
                        'cart_quantity' => isset($cartData[$variant['id']]) ? $cartData[$variant['id']] : 0,
                    ];
                }
    
            $data[] = [
                'product_title' => $row->name,
                'product_id' => $row->id,
                'product_image' => url(env('APP_URL') . ('/public/images/products/') . $row->image),
                'product_subcategory' => $row->subCategoryName,
                'product_category' => $row->categoryName,
                'product_vendor' => $row->vendorName,
                'product_category_id' => $row->category_id,
                'product_vendor_id' => $row->vendor_id,
                'price' => $row->net_price,
                'gst_amount' => number_format(($row->net_price * $row->gst_rate) / 100, 2, '.', ''),
                'fav' => $row->in_wishlist == 1,
                'product_Images' => $images,
                'variants_data' => $productVariantsData,
            ];
        }
    
        return response()->json([
            'status' => true,
            'count' => count($data),
            'related_products' => $data,
        ]);
    }
    

    
     
///////
    public function api_add_review(Request $request)
    {
        $validator = Validator::make($request->all(), [                      
            'star' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors()->all(),
                'status_code' => false
            ],422);
        }
       

        $existingReview = Review::where('customerid', $request->customer_id)
                                ->where('productid', $request->product_id)
                                ->first();

        if ($existingReview) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Customer has already rated this product.',
                'status' => true
            ]);
        }

        $review = new Review();
        $review->star = $request->star;
        $review->review = $request->review;
        $review->customerid = $request->customer_id;
        $review->productid = $request->product_id;
        $review->save();

        return response()->json([
            'status' => true,
            'message' => 'Review added successfully.',
            'data' => $review,
            'status' => true,
        ]);
    }
///////
    public function api_get_reviews($productid)
    {
        $product = Product::find($productid);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
                
            ]);
        }
    
        $perPage = 15;
        $reviews = Review::where('productid', $productid)
        ->paginate($perPage);
         $totalReviews = $reviews->count();
         

        return response()->json([
             'message' => 'Product reviews retrieved successfully.',
            'review_count' => $totalReviews,            
            'review' => $reviews->items(),
            'current_page' => $reviews->currentPage(),
            'total_pages' => $reviews->lastPage(),
            'total_records' => $reviews->total(),
            'status' => true, 
        ]);
    }
 
    /////
    public function api_product_rating($productid)
{
    // Retrieve the product
    $product = Product::find($productid);

    if (!$product) {
        return response()->json([        
            'message' => 'Product not found.',
            'status' => false,
        ]);
    }

    $ratingCounts = Review::where('productid', $productid)
        ->selectRaw('star, COUNT(*) as count')
        ->groupBy('star')
        ->pluck('count', 'star')
        ->toArray();

    $ratingCategoryCounts = [
        'Excellent' => 0,
        'Very Good' => 0,
        'Good' => 0,
        'Average' => 0,
        'Poor' => 0,
    ];

    $totalRatingCount = 0;
    $totalRatingSum = 0;

    foreach ($ratingCounts as $star => $count) {
        if ($star == 5) {
            $ratingCategoryCounts['Excellent'] += $count;
        } elseif ($star == 4) {
            $ratingCategoryCounts['Very Good'] += $count;
        } elseif ($star == 3) {
            $ratingCategoryCounts['Good'] += $count;
        } elseif ($star == 2) {
            $ratingCategoryCounts['Average'] += $count;
        } else {
            $ratingCategoryCounts['Poor'] += $count;
        }

        $totalRatingCount += $count;
        $totalRatingSum += ($star * $count);
    }

    $totalAverageRating = ($totalRatingCount > 0) ? ($totalRatingSum / $totalRatingCount) : 0;

    return response()->json([
        'message' => 'Product rating retrieved successfully.',      
        'rating_count' => $totalRatingCount,
        'average_rating' => $totalAverageRating,
        'rating_counts' => $ratingCategoryCounts,        
        'product' => $product,
        'status' => true,        
    ]);
}

    
      //////////////   
    public function api_subcategoryProduct_detail($category_id )
    {
        $productCategory = ProductCategory::where('parent', $category_id)        
        ->get();

        if ($productCategory->isEmpty()) {
        return response()->json([
        'status' => 'Error',
        'message' => 'No products found for the given category ID.',
        'status_code' => false
        ], 404);
        }

        return response()->json([
        'status' => 'Success',
        'message' => 'Products retrieved successfully.',
        'sub_categorey' => $productCategory,
        'status' => true
        ]);
            }


    public function add_recently_view(Request $request)
    {                
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            ]);
            
            if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false]);
            }
            
            $data = $validator->validated();
                        
            $recentlyView = RecentlyView::where('customer_id', $data['customer_id'])
                ->where('product_id', $data['product_id'])
                ->first();
        
            if ($recentlyView) {
                $recentlyView->update(['updated_at' => now()]);
                } else {
                    RecentlyView::create($data);
                }        
                return response()->json(['message' => 'Product added to recently viewed.',  'status' => true]);
            }

     public function get_recently_viewed(Request $request, $customerId)
    {
       
        $productId= DB::table('recently_view')
        ->select('product_id')
        ->where('customer_id', $customerId)
        ->orderBy('updated_at', 'desc')
        ->pluck('product_id');

        $data = array();
        $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->where('products.is_approved', true)
            ->whereIn('products.id', $productId)
            ->where('products.is_active', true)
            ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName');
    
        // Check if the customer ID is provided
        if ($customerId !== null) {
            $result->leftJoin('wishlist', function ($join) use ($customerId) {
                $join->on('products.id', '=', 'wishlist.product_id')
                    ->where('wishlist.customer_id', $customerId);
            })
            ->selectRaw('products.*, CAST((wishlist.product_id IS NOT NULL) AS UNSIGNED) AS in_wishlist');
        }
        $result = $result->get();
    
        // Get product IDs from the result
        $productIds = $result->pluck('id')->toArray();
    
        // Retrieve variant table data for the product IDs
        $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
        ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
        ->whereIn('product_variant_price.product_id', $productIds)
        ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')
        ->get();
    
        $cartData = Cart::where('customerid', $customerId)
            ->whereIn('variantid', $productVariants->pluck('id'))
            ->pluck('quantity', 'variantid')
            ->toArray();
    
        $data = array();
    
        foreach ($result as $row) {
            // Find variant table data for the current product
            $variantsData = $productVariants->where('product_id', $row->id)->toArray();
    
            $productVariantsData = [];
    
            foreach ($variantsData as $variant) {
                $productVariantsData[] = [
                    'id' => $variant['id'],
                    'product_id' => $variant['product_id'],
                    'variant_value_id_1' => $variant['size'],
                    'variant_value_id_2' => $variant['packing'],
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
                    'created_by' => $variant['created_by'],
                    'updated_by' => $variant['updated_by'],
                    'created_at' => $variant['created_at'],
                    'updated_at' => $variant['updated_at'],
                    'cart_quantity' => isset($cartData[$variant['id']]) ? $cartData[$variant['id']] : 0,
                ];
            }
    
            array_push($data, array(
                'product_title' => $row->name,
                'product_id' => $row->id,
                'product_image' => (url(env('APP_URL') . ('/public/images/products/') . $row->image)),
                'product_subcategory' => $row->subCategoryName,
                'product_category' => $row->categoryName,
                'product_vendor' => $row->vendorName,
                'product_category_id' => $row->category_id,
                'product_vendor_id' => $row->vendor_id,
                'price' => $row->net_price,
                'gst_amount' => number_format((($row->net_price * $row->gst_rate) / 100), 2, '.', ''),
                'fav' => $row->in_wishlist == 1 ? true : false,
                'variants_data' => $productVariantsData,
            ));
        }
    
        return response()->json([
            'status' => true,
            'count' => count($data),
            'products' => $data,
        ]);
    }
    
}