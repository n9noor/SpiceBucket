<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\ProductVerientValue;
use App\Models\Review;
use App\Models\Cart;
use App\Models\ReviewImage;
use App\Models\Vendor;
use App\Models\Wishlist;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;


class ProductController extends Controller
{
     use CommonTrait;
    public function __construct()
    {
        if (Session::get('admin-logged-in') == false && Session::get('vendor-logged-in') == false) {
            $panel = Session::get('admin-logged-in') == true ? "administrator" : "sellers";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
    }

    public function product_list(Request $request)
    {
        if ($request->session()->get('admin-logged-in') == false && $request->session()->get('vendor-logged-in') == false) {
            $panel = $request->session()->get('admin-logged-in') == true ? "administrator" : "sellers";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
        $whereData = array();
        if ($request->has('fromdate') && !empty($request->fromdate)) {
            array_push($whereData, ['products.created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->fromdate))]);
        }
        if ($request->has('todate') && !empty($request->todate)) {
            array_push($whereData, ['products.created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->todate))]);
        }
        if ($request->has('category') && !empty($request->category)) {
            array_push($whereData, ['products.category_id', '=', $request->category]);
        }
        if ($request->has('name') && !empty($request->name)) {
            array_push($whereData, ["products.name", "like", "%" . $request->name . "%"]);
        }
        if ($request->has('approve_status') && !empty($request->approve_status)) {
            array_push($whereData, ['products.is_approved', '=', ($request->approve_status == 'approved' ? 1 : ($request->approve_status == 'disapproved' ? 2 : 0))]);
        }
        if ($request->has('status') && !empty($request->status)) {
            array_push($whereData, ['products.is_active', '=', ($request->status == 'active' ? 1 : 0)]);
        }
        if ($request->session()->get('admin-logged-in') == true) {
            if (strtolower(Session::get('admin-loggedin-rolename')) == "qac department") {
                $vendors = Vendor::where('qac_user_id', Session::get('admin-loggedin-id'))->select(DB::raw("GROUP_CONCAT(id) AS vendor_ids"))->get()->first()->vendor_ids;
                $products = Product::join('product_category', 'product_category.id', '=', 'products.category_id')->join('vendors', 'vendors.id', '=', 'products.vendor_id')->whereIn('products.vendor_id', explode(",", $vendors))->where($whereData)->select('products.*', 'product_category.name AS categoryname', 'vendors.store_name AS vendor')->get();
            } else {
                $products = Product::join('product_category', 'product_category.id', '=', 'products.category_id')->join('vendors', 'vendors.id', '=', 'products.vendor_id')->where($whereData)->select('products.*', 'product_category.name AS categoryname', 'vendors.store_name AS vendor')->get();
            }
        } else if ($request->session()->get('vendor-logged-in') == true) {
            $products = Product::join('product_category', 'product_category.id', '=', 'products.category_id')->where('products.vendor_id', $request->session()->get('vendor-loggedin-id'))->where($whereData)->select('products.*', 'product_category.name AS categoryname')->get();
        }
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        return view('products.list', ['title' => 'Products - Spicebucket Administrator', 'products' => $products, 'maincategories' => $categories]);
    }

    public function add_product(Request $request)
    {
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        $subcategories = [];
        $childcategories = ProductCategory::where('is_active', true)->where('parent', '<>', 0)->get();
        foreach ($childcategories as $subcategory) {
            if (!array_key_exists($subcategory->parent, $subcategories)) {
                $subcategories[$subcategory->parent] = array();
            }
            array_push($subcategories[$subcategory->parent], array('id' => $subcategory->id, 'name' => $subcategory->name));
        }
        $products = Product::where('vendor_id', $request->session()->get('vendor-loggedin-id'))->get();
        $variants = ProductVerient::where('is_active', true)->get();
        $variantsValueMap = array();
        foreach ($variants as $variant) {
            if (!array_key_exists($variant->id, $variantsValueMap)) {
                $variantsValueMap[$variant->id] = array('name' => $variant->name, 'values' => array());
            }
        }
        $variantsValue = ProductVerientValue::where('is_active', true)->whereIn('variant_id', array_keys($variantsValueMap))->select('variant_id', DB::raw('GROUP_CONCAT(CONCAT(id, "|", value) ORDER BY weight DESC) AS variantvalues'))->groupBy('variant_id')->get();
        foreach ($variantsValue as $variant) {
            if (array_key_exists($variant->variant_id, $variantsValueMap)) {
                $variantsValueMap[$variant->variant_id]['values'] = array_map(function ($value) {
                    list($key, $val) = explode("|", $value);
                    return array('id' => $key, 'value' => $val);
                }, explode(",", $variant->variantvalues));
            }
        }
        return view('products.add', ['title' => 'Add Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'products' => $products, 'variantsValueMap' => $variantsValueMap, 'subcategories' => $subcategories]);
    }

    public function edit_product(Product $product)
    {
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        $subcategories = [];
        $childcategories = ProductCategory::where('is_active', true)->where('parent', '<>', 0)->get();
        foreach ($childcategories as $subcategory) {
            if (!array_key_exists($subcategory->parent, $subcategories)) {
                $subcategories[$subcategory->parent] = array();
            }
            array_push($subcategories[$subcategory->parent], array('id' => $subcategory->id, 'name' => $subcategory->name));
        }
        $productImages = ProductImage::leftjoin('product_variant_price', 'product_variant_price.image_id', '=', 'product_images.id')->where('product_images.product_id', $product->id)->select("product_images.*", "product_variant_price.id AS variantId")->get();
        $productVariant = ProductVerientPrice::leftjoin('product_variant_values AS ppv1', 'ppv1.id', '=', 'product_variant_price.variant_value_id_1')->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'ppv1.variant_id')->leftjoin('product_variant_values AS ppv2', 'ppv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'ppv2.variant_id')->leftjoin('product_variant_values AS ppv3', 'ppv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'ppv3.variant_id')->leftjoin('product_images', 'product_images.id', '=', 'product_variant_price.image_id')->select('product_variant_price.*', 'ppv1.value AS Object1Value', 'ppv2.value AS Object2Value', 'ppv3.value AS Object3Value', 'pv1.name AS Object1', 'pv2.name AS Object2', 'pv3.name AS Object3', DB::raw('IF(product_images.image IS NULL, "", product_images.image) AS variantImage'))->where('product_variant_price.product_id', $product->id)->get();
        $mappedVariant = array();
        foreach ($productVariant as $variant) {
            if (!is_null($variant->variant_value_id_1) && !in_array($variant->variant_value_id_1, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_1);
            }
            if (!is_null($variant->variant_value_id_2) && !in_array($variant->variant_value_id_2, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_2);
            }
            if (!is_null($variant->variant_value_id_3) && !in_array($variant->variant_value_id_3, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_3);
            }
        }

        $variants = ProductVerient::where('is_active', true)->get();
        $variantsValueMap = array();
        foreach ($variants as $variant) {
            if (!array_key_exists($variant->id, $variantsValueMap)) {
                $variantsValueMap[$variant->id] = array('name' => $variant->name, 'checked' => 0, 'values' => array());
            }
        }
        $variantsValue = ProductVerientValue::where('is_active', true)->whereIn('variant_id', array_keys($variantsValueMap))->select('variant_id', DB::raw('GROUP_CONCAT(CONCAT(id, "|", value)) AS variantvalues'))->groupBy('variant_id')->orderBy('weight', 'desc')->get();
        foreach ($variantsValue as $variant) {
            if (array_key_exists($variant->variant_id, $variantsValueMap)) {
                $variantsValueMap[$variant->variant_id]['values'] = array_map(function ($value) use ($mappedVariant) {
                    list($key, $val) = explode("|", $value);
                    return array('id' => $key, 'value' => $val, 'selected' => (in_array($key, $mappedVariant) ? 1 : 0));
                }, explode(",", $variant->variantvalues));
                if (array_sum(array_column($variantsValueMap[$variant->variant_id]['values'], 'selected')) > 0) {
                    $variantsValueMap[$variant->variant_id]['checked'] = 1;
                }
            }
        }
        
        return view('products.edit', ['title' => 'Edit Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'product' => $product, 'productImages' => $productImages, 'productVariant' => $productVariant, 'subcategories' => $subcategories, 'variantsValueMap' => $variantsValueMap]);
    }

    public function view_product(Product $product)
    {
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        $subcategories = [];
        $childcategories = ProductCategory::where('is_active', true)->where('parent', '<>', 0)->get();
        foreach ($childcategories as $subcategory) {
            if (!array_key_exists($subcategory->parent, $subcategories)) {
                $subcategories[$subcategory->parent] = array();
            }
            array_push($subcategories[$subcategory->parent], array('id' => $subcategory->id, 'name' => $subcategory->name));
        }
        $productImages = ProductImage::leftjoin('product_variant_price', 'product_variant_price.image_id', '=', 'product_images.id')->where('product_images.product_id', $product->id)->select("product_images.*", "product_variant_price.id AS variantId")->get();
        $productVariant = ProductVerientPrice::leftjoin('product_variant_values AS ppv1', 'ppv1.id', '=', 'product_variant_price.variant_value_id_1')->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'ppv1.variant_id')->leftjoin('product_variant_values AS ppv2', 'ppv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'ppv2.variant_id')->leftjoin('product_variant_values AS ppv3', 'ppv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'ppv3.variant_id')->leftjoin('product_images', 'product_images.id', '=', 'product_variant_price.image_id')->select('product_variant_price.*', 'ppv1.value AS Object1Value', 'ppv2.value AS Object2Value', 'ppv3.value AS Object3Value', 'pv1.name AS Object1', 'pv2.name AS Object2', 'pv3.name AS Object3', DB::raw('IF(product_images.image IS NULL, "", product_images.image) AS variantImage'))->where('product_variant_price.product_id', $product->id)->get();
        $mappedVariant = array();
        foreach ($productVariant as $variant) {
            if (!is_null($variant->variant_value_id_1) && !in_array($variant->variant_value_id_1, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_1);
            }
            if (!is_null($variant->variant_value_id_2) && !in_array($variant->variant_value_id_2, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_2);
            }
            if (!is_null($variant->variant_value_id_3) && !in_array($variant->variant_value_id_3, $mappedVariant)) {
                array_push($mappedVariant, $variant->variant_value_id_3);
            }
        }

        $variants = ProductVerient::where('is_active', true)->get();
        $variantsValueMap = array();
        foreach ($variants as $variant) {
            if (!array_key_exists($variant->id, $variantsValueMap)) {
                $variantsValueMap[$variant->id] = array('name' => $variant->name, 'checked' => 0, 'values' => array());
            }
        }
        $variantsValue = ProductVerientValue::where('is_active', true)->whereIn('variant_id', array_keys($variantsValueMap))->select('variant_id', DB::raw('GROUP_CONCAT(CONCAT(id, "|", value)) AS variantvalues'))->groupBy('variant_id')->orderBy('weight', 'desc')->get();
        foreach ($variantsValue as $variant) {
            if (array_key_exists($variant->variant_id, $variantsValueMap)) {
                $variantsValueMap[$variant->variant_id]['values'] = array_map(function ($value) use ($mappedVariant) {
                    list($key, $val) = explode("|", $value);
                    return array('id' => $key, 'value' => $val, 'selected' => (in_array($key, $mappedVariant) ? 1 : 0));
                }, explode(",", $variant->variantvalues));
                if (array_sum(array_column($variantsValueMap[$variant->variant_id]['values'], 'selected')) > 0) {
                    $variantsValueMap[$variant->variant_id]['checked'] = 1;
                }
            }
        }

        return view('products.view', ['title' => 'View Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'product' => $product, 'productImages' => $productImages, 'productVariant' => $productVariant, 'subcategories' => $subcategories, 'variantsValueMap' => $variantsValueMap]);
    }

    public function save_product(Request $request)
    {
        $product = new Product();
        $this->validate($request, [
            'vendor_id' => 'required',
            'main_category_id' => 'required',
            'sub_category_id' => 'required',
            'gst_rate' => 'required',
            'name' => 'required',
            'summary' => 'required',
            // 'description' => 'required',
            'hsn_code' => 'required',
            'sku' => 'required',
            // 'barcode' => 'required',
            'origin' => 'nullable',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'net_price' => 'required',
            'minoq' => 'required|regex:/^\d+$/',
            'maxoq' => 'required|regex:/^\d+$/',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:png,jpg,jpeg|max:4096'
        ]);
        $product->vendor_id = $request->vendor_id;
        $product->gst_rate = $request->gst_rate;
        $product->category_id = $request->main_category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_type = $request->product_type;
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->hsn_code = $request->hsn_code;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->origin = $request->origin;
        $product->minoq = $request->minoq;
        $product->maxoq = $request->maxoq;
        $product->cost = $request->cost;
        $product->slug = $this->generateSlug($request->name,'');  
        /*
        $product->b2b_minoq = $request->b2b_minoq;
        $product->b2b_maxoq = $request->b2b_maxoq;
        $product->b2b_price = $request->b2b_price;
*/
        $product->product_mrp = $request->selling_price;
        $product->discount_percentage = $request->discount_price;
        $product->discount_price = ($request->selling_price - $request->net_price);
        $product->net_price = $request->net_price;
        $product->taxable = $request->taxable;
        $product->tax_rate = $request->taxable_rate;
        $product->tax_amount = $request->taxable_amount;
        $product->net_price_with_tax = $request->net_price_without_tax;
        $product->video_url = json_encode($request->video_link);
        $product->is_approved = false;
        $product->save();
        $productid = $product->id;

        $counter = 1;
        if ($request->hasfile('product_image')) {
            foreach ($request->product_image as $image) {
                $imageObj = new ProductImage();
                $imageName = 'p' . $counter . '-' . time() . '.' . $image->extension();
                $image->move(public_path('images/products'), $imageName);
                $imageObj->product_id = $productid;
                $imageObj->image = $imageName;
                $imageObj->imagesetid = $counter;
                $imageObj->save();
                $counter++;
            }
        }

        if ($request->varient_property_manual == 'yes') {
            $variant_default = explode("_", $request->variant_default);
            foreach ($request->variant as $varient_value_id1 => $variantsValue1) {
                if (is_array($variantsValue1) && !array_key_exists('product_mrp', $variantsValue1)) {
                    foreach ($variantsValue1 as $varient_value_id2 => $variantsValue2) {
                        if (is_array($variantsValue2) && !array_key_exists('product_mrp', $variantsValue2)) {
                            foreach ($variantsValue2 as $varient_value_id3 => $variantsValue3) {
                                $productVariantPrice = new ProductVerientPrice();
                                $productVariantPrice->product_id = $productid;
                                $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                                $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                                $productVariantPrice->variant_value_id_3 = $varient_value_id3;
                                $productVariantPrice->product_mrp = $variantsValue3['product_mrp'];
                                $productVariantPrice->net_price = $variantsValue3['net_price'];
                                $productVariantPrice->discount_percentage = $variantsValue3['discount_price'];
                                $productVariantPrice->discount_price = ($variantsValue3['product_mrp'] - $variantsValue3['net_price']);
                                $productVariantPrice->sku = $variantsValue3['sku'];
                                $productVariantPrice->barcode = $variantsValue3['barcode'];
                                $productVariantPrice->net_weight = $variantsValue3['net_weight'];
                                $productVariantPrice->quantity = $variantsValue3['quantity'];
                                if ($request->hasFile("variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image")) {
                                    $imageObj = new ProductImage();
                                    $imageName = 'pv-' . $productid . '-' . $varient_value_id1  . '-' . $varient_value_id2 . '-' . $varient_value_id3 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image"]->extension();
                                    $request["variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image"]->move(public_path('images/products'), $imageName);
                                    $imageObj->product_id = $productid;
                                    $imageObj->image = $imageName;
                                    $imageObj->imagesetid = $counter;
                                    $imageObj->save();
                                    $counter++;
                                    $productVariantPrice->image_id = $imageObj->id;
                                }
                                $productVariantPrice->save();
                            }
                        } else {
                            $productVariantPrice = new ProductVerientPrice();
                            $productVariantPrice->product_id = $productid;
                            $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                            $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                            $productVariantPrice->product_mrp = $variantsValue2['product_mrp'];
                            $productVariantPrice->net_price = $variantsValue2['net_price'];
                            $productVariantPrice->discount_percentage = $variantsValue2['discount_price'];
                            $productVariantPrice->discount_price = ($variantsValue2['product_mrp'] - $variantsValue2['net_price']);
                            $productVariantPrice->sku = $variantsValue2['sku'];
                            $productVariantPrice->barcode = $variantsValue2['barcode'];
                            $productVariantPrice->net_weight = $variantsValue2['net_weight'];
                            $productVariantPrice->quantity = $variantsValue2['quantity'];
                            if ($request->hasFile("variant.{$varient_value_id1}.{$varient_value_id2}.image")) {
                                $imageObj = new ProductImage();
                                $imageName = 'pv-' . $productid . '-' . $varient_value_id1 . '-' . $varient_value_id2 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.{$varient_value_id2}.image"]->extension();
                                $request["variant.{$varient_value_id1}.{$varient_value_id2}.image"]->move(public_path('images/products'), $imageName);
                                $imageObj->product_id = $productid;
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
                    $productVariantPrice = new ProductVerientPrice();
                    $productVariantPrice->product_id = $productid;
                    $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                    $productVariantPrice->product_mrp = $variantsValue1['product_mrp'];
                    $productVariantPrice->net_price = $variantsValue1['net_price'];
                    $productVariantPrice->discount_percentage = $variantsValue1['discount_price'];
                    $productVariantPrice->discount_price = ($variantsValue1['product_mrp'] - $variantsValue1['net_price']);
                    $productVariantPrice->sku = $variantsValue1['sku'];
                    $productVariantPrice->barcode = $variantsValue1['barcode'];
                    $productVariantPrice->net_weight = $variantsValue1['net_weight'];
                    $productVariantPrice->quantity = $variantsValue1['quantity'];
                    if ($request->hasFile("variant.{$varient_value_id1}.image")) {
                        $imageObj = new ProductImage();
                        $imageName = 'pv-' . $productid . '-' . $varient_value_id1 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.image"]->extension();
                        $request["variant.{$varient_value_id1}.image"]->move(public_path('images/products'), $imageName);
                        $imageObj->product_id = $productid;
                        $imageObj->image = $imageName;
                        $imageObj->imagesetid = $counter;
                        $imageObj->save();
                        $counter++;
                        $productVariantPrice->image_id = $imageObj->id;
                    }
                    $productVariantPrice->save();
                }
            }
            $whereData = array();
            if (array_key_exists(0, $variant_default) && !is_null($variant_default[0]) && !empty($variant_default[0])) {
                $whereData['variant_value_id_1'] = $variant_default[0];
                if (array_key_exists(1, $variant_default) && !is_null($variant_default[1]) && !empty($variant_default[1])) {
                    $whereData['variant_value_id_2'] = $variant_default[1];
                    if (array_key_exists(2, $variant_default) && !is_null($variant_default[2]) && !empty($variant_default[2])) {
                        $whereData['variant_value_id_3'] = $variant_default[2];
                    }
                }
            }
            ProductVerientPrice::where($whereData)->update(['mark_as_default' => 1]);
        }

        if ($request->varient_property_copy) {
            $variants = ProductVerientPrice::where('product_id', $request->copy_from_product)->get();
            foreach ($variants as $variant) {
                $productVariantPrice = new ProductVerientPrice();
                $productVariantPrice->product_id = $productid;
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

        return redirect('/products/list')->with('message', 'Product Added Successfully.');
    }

    public function update_product(Request $request, $product)
    {
        $product = Product::findOrFail($product);
        $this->validate($request, [
            'vendor_id' => 'required',
            'gst_rate' => 'required',
            'main_category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',

            // 'description' => 'required',
            'hsn_code' => 'required',
            'sku' => 'required',
            // 'barcode' => 'required',
            'origin' => 'nullable',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'net_price' => 'required',
            'minoq' => array('required', 'regex:/^\d+$/'),
            'maxoq' => array('required', 'regex:/^\d+$/'),
            'product_image.*' => 'image|mimes:png,jpg,jpeg|max:4096'
        ]);
        $product->category_id = $request->main_category_id;
        $product->gst_rate = $request->gst_rate;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_type = $request->product_type;
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->hsn_code = $request->hsn_code;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->origin = $request->origin;
        $product->minoq = $request->minoq;
        $product->maxoq = $request->maxoq;
        $product->cost = $request->cost;
        /*
        $product->b2b_minoq = $request->b2b_minoq;
        $product->b2b_maxoq = $request->b2b_maxoq;
        $product->b2b_price = $request->b2b_price;
*/
        $product->product_mrp = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->net_price = $request->net_price;
        $product->taxable = $request->taxable;
        $product->tax_rate = $request->taxable_rate;
        $product->tax_amount = $request->taxable_amount;
        $product->net_price_with_tax = $request->net_price_without_tax;
        $product->video_url = json_encode($request->video_link);
        $product->slug =  $this->generateSlug($request->name,$product->id);
        $product->is_approved = false;
        $product->save();

        $images = array();
        if ($request->hasfile('product_image')) {
            foreach ($request->product_image as $counter => $image) {
                $imageObj = new ProductImage();
                $imageName = 'p' . $counter . '-' . time() . '.' . $image->extension();
                $image->move(public_path('images/products'), $imageName);
                $imageObj->product_id = $product->id;
                $imageObj->image = $imageName;
                $imageObj->imagesetid = $counter;
                $imageObj->save();
                $images[$counter] = $imageObj->id;
            }
        }

        foreach ($request->variant as $varient_value_id1 => $variantsValue1) {
            if (is_array($variantsValue1) && !array_key_exists('product_mrp', $variantsValue1)) {
                foreach ($variantsValue1 as $varient_value_id2 => $variantsValue2) {
                    if (is_array($variantsValue2) && !array_key_exists('product_mrp', $variantsValue2)) {
                        foreach ($variantsValue2 as $varient_value_id3 => $variantsValue3) {
                            $productVariantPrice = new ProductVerientPrice();
                            if (array_key_exists('productpriceid', $variantsValue3) && $variantsValue3['productpriceid'] > 0) {
                                $productVariantPrice = ProductVerientPrice::find($variantsValue3['productpriceid']);
                                if ($productVariantPrice == null) {
                                    $productVariantPrice = new ProductVerientPrice();
                                }
                            }
                            $productVariantPrice->mark_as_default = 0;
                            $productVariantPrice->product_id = $product->id;
                            $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                            $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                            $productVariantPrice->variant_value_id_3 = $varient_value_id3;
                            $productVariantPrice->product_mrp = $variantsValue3['product_mrp'];
                            $productVariantPrice->net_price = $variantsValue3['net_price'];
                            $productVariantPrice->discount_percentage = $variantsValue3['discount_price'];
                            $productVariantPrice->discount_price = ($variantsValue3['product_mrp'] - $variantsValue3['net_price']);
                            $productVariantPrice->sku = $variantsValue3['sku'];
                            $productVariantPrice->barcode = $variantsValue3['barcode'];
                            $productVariantPrice->net_weight = $variantsValue3['net_weight'];
                            $productVariantPrice->quantity = $variantsValue3['quantity'];
                            if ($request->hasFile("variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image")) {
                                $imageObj = new ProductImage();
                                $imageName = 'pv-' . $product->id . '-' . $varient_value_id1  . '-' . $varient_value_id2 . '-' . $varient_value_id3 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image"]->extension();
                                $request["variant.{$varient_value_id1}.{$varient_value_id2}.{$varient_value_id3}.image"]->move(public_path('images/products'), $imageName);
                                $imageObj->product_id = $product->id;
                                $imageObj->image = $imageName;
                                $imageObj->imagesetid = $counter;
                                $imageObj->save();
                                $counter++;
                                $productVariantPrice->image_id = $imageObj->id;
                            }
                            $productVariantPrice->save();
                        }
                    } else {
                        $productVariantPrice = new ProductVerientPrice();
                        if (array_key_exists('productpriceid', $variantsValue2) && $variantsValue2['productpriceid'] > 0) {
                            $productVariantPrice = ProductVerientPrice::find($variantsValue2['productpriceid']);
                            if ($productVariantPrice == null) {
                                $productVariantPrice = new ProductVerientPrice();
                            }
                        }
                        $productVariantPrice->mark_as_default = 0;
                        $productVariantPrice->product_id = $product->id;
                        $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                        $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                        $productVariantPrice->product_mrp = $variantsValue2['product_mrp'];
                        $productVariantPrice->net_price = $variantsValue2['net_price'];
                        $productVariantPrice->discount_percentage = $variantsValue2['discount_price'];
                        $productVariantPrice->discount_price = ($variantsValue2['product_mrp'] - $variantsValue2['net_price']);
                        $productVariantPrice->sku = $variantsValue2['sku'];
                        $productVariantPrice->barcode = $variantsValue2['barcode'];
                        $productVariantPrice->net_weight = $variantsValue2['net_weight'];
                        $productVariantPrice->quantity = $variantsValue2['quantity'];
                        if ($request->hasFile("variant.{$varient_value_id1}.{$varient_value_id2}.image")) {
                            $imageObj = new ProductImage();
                            $imageName = 'pv-' . $product->id . '-' . $varient_value_id1  . '-' . $varient_value_id2 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.{$varient_value_id2}.image"]->extension();
                            $request["variant.{$varient_value_id1}.{$varient_value_id2}.image"]->move(public_path('images/products'), $imageName);
                            $imageObj->product_id = $product->id;
                            $imageObj->image = $imageName;
                            /*$imageObj->imagesetid = $counter;*/
                            $imageObj->save();
                            /*$counter++;*/
                            $productVariantPrice->image_id = $imageObj->id;
                        }
                        $productVariantPrice->save();
                    }
                }
            } else {
                $productVariantPrice = new ProductVerientPrice();
                if (array_key_exists('productpriceid', $variantsValue1) && $variantsValue1['productpriceid'] > 0) {
                    $productVariantPrice = ProductVerientPrice::find($variantsValue1['productpriceid']);
                    if ($productVariantPrice == null) {
                        $productVariantPrice = new ProductVerientPrice();
                    }
                }
                $productVariantPrice->mark_as_default = 0;
                $productVariantPrice->product_id = $product->id;
                $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                $productVariantPrice->product_mrp = $variantsValue1['product_mrp'];
                $productVariantPrice->net_price = $variantsValue1['net_price'];
                $productVariantPrice->discount_percentage = $variantsValue1['discount_price'];
                $productVariantPrice->discount_price = ($variantsValue1['product_mrp'] - $variantsValue1['net_price']);
                $productVariantPrice->sku = $variantsValue1['sku'];
                $productVariantPrice->barcode = $variantsValue1['barcode'];
                $productVariantPrice->net_weight = $variantsValue1['net_weight'];
                $productVariantPrice->quantity = $variantsValue1['quantity'];
                if ($request->hasFile("variant.{$varient_value_id1}.image")) {
                    $imageObj = new ProductImage();
                    $imageName = 'pv-' . $product->id . '-' . $varient_value_id1 . '-' . time() . '.' . $request["variant.{$varient_value_id1}.image"]->extension();
                    $request["variant.{$varient_value_id1}.image"]->move(public_path('images/products'), $imageName);
                    $imageObj->product_id = $product->id;
                    $imageObj->image = $imageName;
                    $imageObj->imagesetid = $counter;
                    $imageObj->save();
                    $counter++;
                    $productVariantPrice->image_id = $imageObj->id;
                }
                $productVariantPrice->save();
            }
        }

        if (strpos($request->variant_default, "_") === false) {
            ProductVerientPrice::find($request->variant_default)->update(['mark_as_default' => 1]);
        } else {
            $variant_default = explode("_", $request->variant_default);
            $whereData = array();
            if (array_key_exists(0, $variant_default) && !is_null($variant_default[0]) && !empty($variant_default[0])) {
                $whereData['variant_value_id_1'] = $variant_default[0];
                if (array_key_exists(1, $variant_default) && !is_null($variant_default[1]) && !empty($variant_default[1])) {
                    $whereData['variant_value_id_2'] = $variant_default[1];
                    if (array_key_exists(2, $variant_default) && !is_null($variant_default[2]) && !empty($variant_default[2])) {
                        $whereData['variant_value_id_3'] = $variant_default[2];
                    }
                }
            }
            ProductVerientPrice::where($whereData)->update(['mark_as_default' => 1]);
        }

        return redirect('/products/list')->with('message', 'Product Updated Successfully.');
    }

    public function delete_product($product)
    {
        ProductVerientPrice::where('product_id', $product)->delete();
        ProductImage::where('product_id', $product)->delete();
        DB::table('products')->delete($product);
        return redirect('/products/list')->with('message', 'Product Deleted Successfully.');
    }

    public function product_category(Request $request)
    {
        if ($request->session()->get('admin-logged-in') == false && $request->session()->get('vendor-logged-in') == false) {
            $panel = $request->session()->get('admin-logged-in') == true ? "administrator" : "sellers";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
        if ($request->session()->get('admin-logged-in') == true) {
            $categories = DB::table('product_category AS p1')->leftjoin('product_category AS p2', 'p2.id', '=', 'p1.parent')->leftjoin('vendors', 'vendors.id', '=', 'p1.vendor_id')->select('p1.*', 'p2.name AS parentName', 'vendors.store_name AS vendor')->get();
        } else if ($request->session()->get('vendor-logged-in') == true) {
            $categories = DB::table('product_category')->where('parent', 0)->get();
        }
        return view('products.category', ['title' => 'Product Categories - Spicebucket Administrator', 'categories' => $categories]);
    }

    public function add_category()
    {
        $categories = ProductCategory::where('parent', 0)->get();
        return view('products.addcategory', ['title' => 'Add Category - Spicebucket Administrator', 'categories' => $categories]);
    }

    public function edit_category(ProductCategory $product_category)
    {
        $children = $this->getChildCategories($product_category->id);
        $children = explode(",", $children);
        $children = array_filter($children);
        array_push($children, $product_category->id);
        $categories = ProductCategory::where('parent', 0)->get();
        return view('products.editcategory', ['title' => 'Edit Category - Spicebucket Administrator', 'category' => $product_category, 'categories' => $categories, 'children' => $children]);
    }

    public function save_category(Request $request)
    {
        $category = new ProductCategory();
        $this->validate($request, [
            'category_name' => 'required',
            'category_slug' => 'required|unique:product_category,slug',
            'category_description' => 'required',
            'category_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'category_parent' => ''
        ]);
        if ($request->session()->get('vendor-logged-in') == true) {
            $category->vendor_id = $request->session()->get('vendor-loggedin-id');
        }
        $category->name = $request->category_name;
        $category->slug = $request->category_slug;
        $category->description = $request->category_description;
        $imageName = 'pc-' . time() . '.' . $request->category_image->extension();
        $request->category_image->move(public_path('images/products'), $imageName);
        $category->image = $imageName;
        $category->parent = ($request->category_parent == "" ? 0 : $request->category_parent);
        $category->save();
        return redirect('/products/categories')->with('message', 'Category Added Successfully.');
    }

    public function update_category(Request $request, $product_category)
    {
        $category = ProductCategory::findOrFail($product_category);
        $this->validate($request, [
            'category_name' => 'required',
            'category_slug' => 'required|unique:product_category,slug,' . $product_category,
            'category_description' => 'required',
            'category_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'category_parent' => ''
        ]);
        $category->name = $request->category_name;
        $category->slug = $request->category_slug;
        $category->description = $request->category_description;
        $category->parent = ($request->category_parent == "" ? 0 : $request->category_parent);
        if ($request->hasFile('category_image')) {
            if (File::exists(public_path('images/products') . $category->image)) {
                File::delete(public_path('images/products') . $category->image);
            }
            $imageName = 'pc-' . time() . '.' . $request->category_image->extension();
            $request->category_image->move(public_path('images/products'), $imageName);
            $category->image = $imageName;
        }
        $category->save();
        return redirect('/products/categories')->with('message', 'Category Added Successfully.');
    }

    public function delete_category($product_category)
    {
        DB::table('product_category')->delete($product_category);
        return redirect('/products/categories')->with('message', 'Category Deleted Successfully.');
    }

    private function getChildCategories($id)
    {
        $children = array();
        $result = DB::table('product_category')->where('parent', $id)->get();
        foreach ($result as $row) {
            array_push($children, $row->id);
            $this->getChildCategories($row->id);
        }
        return implode(",", $children);
    }

    public function delete_product_image(Request $request)
    {
        $image = ProductImage::find($request->id);
        if ($image == null) {
            return response()->json([
                'ok' => false,
                'message' => 'Unable to delete the product'
            ]);
        }
        if (File::exists(public_path('/images/products/' . $image->image))) {
            File::delete(public_path('/images/products/' . $image->image));
        }
        if (ProductImage::destroy($request->id)) {
            return response()->json([
                'ok' => true
            ]);
        } else {
            return response()->json([
                'ok' => false,
                'message' => 'Unable to delete the product'
            ]);
        }
    }

    public function api_product_category()
    {
        $data = array();
        $categories = array();
        $maincategories = ProductCategory::where('is_active', true)->where('parent', 0)->get();
        foreach ($maincategories as $category) {
            array_push($categories, array('id' => $category->id, 'category_name' => $category->name, 'category_description' => $category->description, 'category_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $category->image) : url('/images/products/' . $category->image))));
        }
        $subcategories = array();
        $childcategories = ProductCategory::where('is_active', true)->where('parent', '<>', 0)->get();
        foreach ($childcategories as $subcategory) {
            if (!array_key_exists($subcategory->parent, $subcategories)) {
                $subcategories[$subcategory->parent] = array();
            }
            array_push($subcategories[$subcategory->parent], array('id' => $subcategory->id, 'category_name' => $subcategory->name, 'category_description' => $subcategory->description, 'category_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $category->image) : url('/images/products/' . $subcategory->image))));
        }
        return response()->json([
            'status' => true,
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }

    public function api_products(Request $request)
    {
        $category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;
        $data = array();
        if (!empty($category_id) && !empty($sub_category_id)) {
            $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')->join('vendors', 'products.vendor_id', '=', 'vendors.id')->where('products.category_id', $category_id)->where('products.sub_category_id', $sub_category_id)->where('products.is_approved', true)->where('products.is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName')->get();
        } else if (!empty($category_id)) {
            $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')->join('vendors', 'products.vendor_id', '=', 'vendors.id')->where('products.is_approved', true)->where('products.category_id', $category_id)->where('products.is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName')->get();
        } else {
            $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')->join('vendors', 'products.vendor_id', '=', 'vendors.id')->where('products.is_approved', true)->where('products.is_active', true)->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName')->get();
        }
        foreach ($result as $row) {
            array_push($data, array('product_title' => $row->name, 'product_id' => $row->id, 'product_image' => (env('APP_ENV') == "production" ? url('/public/images/products/' . $row->image) : url('/images/products/' . $row->image)), 'product_subcategory' => $row->subCategoryName, 'product_category' => $row->categoryName, 'product_vendor' => $row->vendorName, 'price' => $row->net_price, 'gst_amount' => number_format((($row->net_price * $row->gst_rate) / 100), 2, '.', '')));
        }
        return response()->json([
            'status' => true,
            'count' => count($data),
            'products' => $data,
        ]);
    }
	 public function api_products_vendors(Request $request, $customerid = null)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|numeric'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }
    
        $vendor_id = $request->vendor_id;
        $data = array();
        $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->where('products.is_approved', true)
            ->where('products.vendor_id', $vendor_id)
            ->where('products.is_active', true)
            ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName');
    
        // Check if the customer ID is provided
        if ($customerid !== null) {
            $result->leftJoin('wishlist', function ($join) use ($customerid) {
                $join->on('products.id', '=', 'wishlist.product_id')
                    ->where('wishlist.customer_id', $customerid);
            })
            ->selectRaw('products.*, CAST((wishlist.product_id IS NOT NULL) AS UNSIGNED) AS in_wishlist');
        }
        $result = $result->orderBy('products.id','desc')->get();
    
        // Get product IDs from the result
        $productIds = $result->pluck('id')->toArray();
    
        // Retrieve variant table data for the product IDs
        $productVariants = ProductVerientPrice::join('product_variant_values AS pv1', 'product_variant_price.variant_value_id_1', '=', 'pv1.id')
        ->join('product_variant_values AS pv2', 'product_variant_price.variant_value_id_2', '=', 'pv2.id')
        ->whereIn('product_variant_price.product_id', $productIds)
        ->selectRaw('product_variant_price.*, pv1.value AS size, pv2.value AS packing')
        ->get();
    
        $cartData = Cart::where('customerid', $customerid)
            ->whereIn('variantid', $productVariants->pluck('id'))
            ->pluck('quantity', 'variantid')
            ->toArray();
    
        $data = array();
    
        foreach ($result as $row) {
            // Find variant table data for the current product
            $variantsData = $productVariants->where('product_id', $row->id)->toArray();
            $variantImages = ProductImage::where('product_id', $row->id)->pluck('image','id')->toArray();
            
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
                    'variant_image' => array_key_exists($variant['image_id'],$variantImages)?
                    url(env('APP_URL') . ('/public/images/products/') .$variantImages[$variant['image_id']]):'',
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
    

 public function api_products_vendorss(Request $request, $customerid = null)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => implode(",", $validator->messages()->all())
            ], 200);
        }

        $vendor_id = $request->vendor_id;
        $data = array();
        $result = Product::join('product_category AS pc1', 'products.category_id', '=', 'pc1.id')
            ->join('product_category AS pc2', 'products.sub_category_id', '=', 'pc2.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->where('products.is_approved', true)
            ->where('products.vendor_id', $vendor_id)
            ->where('products.is_active', true)
            ->selectRaw('products.*, (SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS image, pc1.name as categoryName, pc2.name as subCategoryName, vendors.store_name as vendorName');


        if ($customerid !== null) {
            $result->leftJoin('wishlist', function ($join) use ($customerid) {
                $join->on('products.id', '=', 'wishlist.product_id')
                    ->where('wishlist.customer_id', $customerid);
            })
                ->selectRaw('products.*, CAST((wishlist.product_id IS NOT NULL) AS UNSIGNED) AS in_wishlist');
        }

        $result = $result->get();


        $productIds = $result->pluck('id')->toArray();


        $productVariants = ProductVerientPrice::with('product_variant_values_1', 'product_variant_values_2')->whereIn('product_id', $productIds)->get();

        foreach ($result as $row) {
            $variantsData = $productVariants->where('product_id', $row->id);

            $productVariantsData = $variantsData->toArray();

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
            'product_variants' => $productVariants,
        ]);
    }
    public function cancel_order_vendorwise($id, $orderid)
    {
        $orders = Order::find($orderid);
        if (is_null($orders)) {
            return response()->json(['status' => true, 'message' => 'Order Does\'nt exists.']);
        } else {
            $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
                ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
                ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
                ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
                ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
                ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
                ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
                ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
                ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
                ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
                ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
                ->where('order_details.vendor_id', $id)->where('orders.id', $orderid)->select('*', 'orders.orderid AS orderID', DB::raw('CONCAT("<tr><td>", cba.firstname, " ", cba.lastname, "</td></tr><tr><td>", cba.emailid, "</td></tr><tr><td>", cba.phonenumber, "</td></tr><tr><td>", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), "</td></tr><tr><td>", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode, "</td></tr><tr><td>", cba.companyname, "</td></tr>") as billingAddress'), DB::raw('CONCAT("<tr><td>", csa.firstname, " ", csa.lastname, "</td></tr><tr><td>", csa.emailid, "</td></tr><tr><td>", csa.phonenumber, "</td></tr><tr><td>", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), "</td></tr><tr><td>", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode, "</td></tr><tr><td>", csa.companyname, "</td></tr>") as shippingAddress'), 'products.name AS productName', 'products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'products.gst_rate AS perproductgst', 'order_details.product_price AS productprice', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'vendors.store_name AS storeName', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

            $vendorWiseDetail = array();
            foreach ($orderDetails as $orderDetail) {
                if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                    $vendorWiseDetail[$orderDetail->vendor_id] = array('orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => $orderDetail->business_emailid, 'products' => array());
                }
                array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'perproductgst' => $orderDetail['perproductgst'], 'store_name' => $orderDetail['storeName'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee']));
            }
            Order::where('id', $orderid)->update(['order_status' => 'Partially Cancelled']);
            OrderDetail::where('order_id', $orderid)->where('vendor_id', $id)->update(['order_status' => 'cancel']);
            Mail::send('mailtemplate.orderedcancelled', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) {
                $message->to(Session::get('customer-loggedin-email'))->subject('You order cancelled successfully.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            Mail::send('mailtemplate.orderedcancelled', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) {
                $message->to('dusad.nikhil@gmail.com')->subject('An order cancel request generated.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            foreach ($vendorWiseDetail as $vendorDetail) {
                Mail::send('mailtemplate.orderedcancelledvendorwise', array('vendorDetail' => $vendorDetail, 'orderDetail' => $orderDetails), function ($message) use ($vendorDetail) {
                    $message->to($vendorDetail['vendorEmailid'])->subject('An order cancel request generated.');
                    $message->from('info@spicebucket.net', 'Spice Bucket');
                });
            }
            return response()->json(['status' => true, 'message' => 'Order Cancelled Succesfully.']);
        }
    }
    public function cancel_order($id)
    {
        $orders = Order::find($id);
        if (is_null($orders)) {
            return response()->json(['status' => true, 'message' => 'Order Does\'nt exists.']);
        } else {
            $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
                ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
                ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
                ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
                ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
                ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
                ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
                ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
                ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
                ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
                ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
                ->where('orders.id', $id)->select('*', 'orders.orderid AS orderID', DB::raw('CONCAT("<tr><td>", cba.firstname, " ", cba.lastname, "</td></tr><tr><td>", cba.emailid, "</td></tr><tr><td>", cba.phonenumber, "</td></tr><tr><td>", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), "</td></tr><tr><td>", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode, "</td></tr><tr><td>", cba.companyname, "</td></tr>") as billingAddress'), DB::raw('CONCAT("<tr><td>", csa.firstname, " ", csa.lastname, "</td></tr><tr><td>", csa.emailid, "</td></tr><tr><td>", csa.phonenumber, "</td></tr><tr><td>", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), "</td></tr><tr><td>", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode, "</td></tr><tr><td>", csa.companyname, "</td></tr>") as shippingAddress'), 'products.name AS productName', 'products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'products.gst_rate AS perproductgst', 'order_details.product_price AS productprice', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'vendors.store_name AS storeName', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

            $vendorWiseDetail = array();
            foreach ($orderDetails as $orderDetail) {
                if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                    $vendorWiseDetail[$orderDetail->vendor_id] = array('orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => $orderDetail->business_emailid, 'products' => array());
                }
                array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'perproductgst' => $orderDetail['perproductgst'], 'store_name' => $orderDetail['storeName'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee']));
            }
           
            Order::where('id', $id)->update(['order_status' => 'cancel']);
            OrderDetail::where('order_id', $id)->update(['order_status' => 'cancel']);
            Mail::send('mailtemplate.orderedcancelled', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) {
                $message->to(Session::get('customer-loggedin-email'))->subject('You order cancelled successfully.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            Mail::send('mailtemplate.orderedcancelled', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) {
                $message->to('dusad.nikhil@gmail.com')->subject('An order cancel request generated.');
                $message->from('info@spicebucket.net', 'Spice Bucket');
            });
            foreach ($vendorWiseDetail as $vendorDetail) {
                Mail::send('mailtemplate.orderedcancelledvendorwise', array('vendorDetail' => $vendorDetail, 'orderDetail' => $orderDetails), function ($message) use ($vendorDetail) {
                    $message->to($vendorDetail['vendorEmailid'])->subject('An order cancel request generated.');
                    $message->from('info@spicebucket.net', 'Spice Bucket');
                });
            }
            return response()->json(['status' => true, 'message' => 'Order Cancelled Succesfully.']);
        }
    }

    public function check_availablity(Request $request)
    {
        $origin = $request->originPincode;
        $destination = $request->destinationPincode;

        try {
            $client = new Client();
            $response = $client->get((env('DTDCAPIPRODUCTIONURL') . '/api/custOrder/service/getServiceTypes/' . $origin . '/' . $destination), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Access-token' => env('DTDCTOKEN')
                ]
            ]);

            $apiresponse = json_decode($response->getBody());
            return response()->json(["status" => $apiresponse->status, "message" => "Available for delivery"]);
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => "Not available for delivery", "URL" => (env('DTDCAPIPRODUCTIONURL') . '/api/custOrder/service/getServiceTypes/' . $origin . '/' . $destination), "prod" => env('DTDCAPITESTINGURL')]);
        }
    }

    public function reviewProduct(Request $request)
    {

        $data = Review::where('productid', $request->productid)->where('customerid', Session::get('customer-loggedin-id'))->first();


                 $review=[]; // reset array here 
                 $Conditionlink=[]; 
                 $review['star'] =$request->star;
                 $review['review'] =$request->review;
                  
                 $Conditionlink['productid'] =$request->productid;
                 $Conditionlink['customerid'] =Session::get('customer-loggedin-id');
                  
                 //dd($link);
                 $object = Review::updateOrCreate($Conditionlink,$review);
                 $counter = 1;
                 if(!empty($request->reviewimage)){ 
                    foreach ($request->reviewimage as $image) {
                        $imageName = 'review-image-' . $counter . '-' . time() .  '.' . $image->extension();
                        $image->move(public_path('images/review-images'), $imageName);
                        $reviewImage = new ReviewImage();
                        $reviewImage->reviewid  = $object->id;
                        $reviewImage->image = $imageName;
                        $reviewImage->save();
                        $counter++;
                    }
                }

                
         if($object->id){

            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
