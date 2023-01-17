<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\ProductVerientValue;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function product_list(Request $request){
        if($request->session()->get('admin-logged-in') == false && $request->session()->get('vendor-logged-in') == false) {
            $panel = $request->session()->get('admin-logged-in') == true ? "administrator" : "vendors";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
        if($request->session()->get('admin-logged-in') == true) {
            $products = DB::table('products')->join('product_category', 'product_category.id', '=', 'products.category_id')->join('vendors', 'vendors.id', '=', 'products.vendor_id')->select('products.*', 'product_category.name AS categoryname', 'vendors.store_name AS vendor')->get();
        } else if($request->session()->get('vendor-logged-in') == true) {
            $products = DB::table('products')->join('product_category', 'product_category.id', '=', 'products.category_id')->join('vendors', 'vendors.id', '=', 'products.vendor_id')->where('products.vendor_id', $request->session()->get('vendor-loggedin-id'))->select('products.*', 'product_category.name AS categoryname')->get();
        }
        return view('products.list', ['title' => 'Products - Spicebucket Administrator', 'products' => $products]);
    }
    
    public function add_product(Request $request) {
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->get();
        $products = Product::where('vendor_id', $request->session()->get('vendor-loggedin-id'))->get();
        $variants = ProductVerient::where('vendor_id', $request->session()->get('vendor-loggedin-id'))->where('is_active', true)->get();
        $variantsValueMap = array();
        foreach($variants as $variant){
            if(!array_key_exists($variant->id, $variantsValueMap)) {
                $variantsValueMap[$variant->id] = array('name' => $variant->name, 'values' => array());
            }
        }
        $variantsValue = ProductVerientValue::where('is_active', true)->whereIn('variant_id', array_keys($variantsValueMap))->select('variant_id', DB::raw('GROUP_CONCAT(CONCAT(id, "|", value)) AS variantvalues'))->groupBy('variant_id')->get();
        foreach($variantsValue as $variant) {
            if(array_key_exists($variant->variant_id, $variantsValueMap)) {
                $variantsValueMap[$variant->variant_id]['values'] = array_map(function($value) {
                    list($key, $val) = explode("|", $value);
                    return array('id' => $key, 'value' => $val);
                }, explode(",", $variant->variantvalues));
            }
        }
        return view('products.add', ['title' => 'Add Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'products' => $products, 'variantsValueMap' => $variantsValueMap]);
    }
    
    public function edit_product(Product $product){
        $vendors = Vendor::where('is_active', true)->get();
        $categories = ProductCategory::where('is_active', true)->get();
        $productImages = ProductImage::where('product_id', $product->id)->get(); 
        $productVariant = ProductVerientPrice::leftjoin('product_variant_values AS ppv1', 'ppv1.id', '=', 'product_variant_price.variant_value_id_1')->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'ppv1.variant_id')->leftjoin('product_variant_values AS ppv2', 'ppv2.id', '=', 'product_variant_price.variant_value_id_2')->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'ppv2.variant_id')->leftjoin('product_variant_values AS ppv3', 'ppv3.id', '=', 'product_variant_price.variant_value_id_3')->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'ppv3.variant_id')->select('product_variant_price.*', 'ppv1.value AS Object1Value', 'ppv2.value AS Object2Value', 'ppv3.value AS Object3Value', 'pv1.name AS Object1', 'pv2.name AS Object2', 'pv3.name AS Object3')->where('product_id', $product->id)->get(); 
        dd($productVariant);
        return view('products.edit', ['title' => 'Edit Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'product' => $product, 'productImages' => $productImages, 'productVariant' => $productVariant]);
    }
    
    public function save_product(Request $request) {
        $product = new Product();
        $this->validate($request, [
            'vendor_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'hsn_code' => 'required|regex:/^\w+$/i',
            'sku' => 'required|regex:/^\w[\w-]+$/i',
            'barcode' => 'required',
            'origin' => 'nullable|regex:/^[a-z]+$/i',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'net_price' => 'required',
            'moq' => 'required|regex:/^\d+$/',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:png,jpg,jpeg|max:2048',
            'varient_property_manual' => 'required_unless: varient_property_copy,null',
            'varient_property_copy' => 'required_unless: varient_property_manual,null',
            'copy_from_product' => 'required_if:varient_property_copy,copy',
            'variant' => 'required_if:varient_property_manual,manual',
            'variant.*.product_mrp' => 'required_if:varient_property_manual,manual',
            'variant.*.net_price' => 'required_if:varient_property_manual,manual',
            'variant.*.discount_price' => 'required_if:varient_property_manual,manual',
            'variant.*.net_weight' => 'required_if:varient_property_manual,manual'
        ]);
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_type = $request->product_type;
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->hsn_code = $request->hsn_code;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->origin = $request->origin;
        $product->moq = $request->moq;
        $product->cost = $request->cost;
        /*
        $product->b2b_moq = $request->b2b_moq;
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
        $product->save();
        $productid = $product->id;
        
        foreach($request->variant as $varient_value_id1 => $variantsValue1){
            if(is_array($variantsValue1) && !array_key_exists('product_mrp', $variantsValue1)) {
                foreach($variantsValue1 as $varient_value_id2 => $variantsValue2){
                    if(is_array($variantsValue2) && !array_key_exists('product_mrp', $variantsValue2)) {
                        foreach($variantsValue2 as $varient_value_id3 => $variantsValue3){
                            $productVariantPrice = new ProductVerientPrice();
                            $productVariantPrice->product_id = $productid;
                            $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                            $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                            $productVariantPrice->variant_value_id_3 = $varient_value_id3;
                            $productVariantPrice->product_mrp = $variantsValue3['product_mrp'];
                            $productVariantPrice->net_price = $variantsValue3['net_price'];
                            $productVariantPrice->discount_price = $variantsValue3['discount_price'];
                            $productVariantPrice->sku = $variantsValue3['sku'];
                            $productVariantPrice->barcode = $variantsValue3['barcode'];
                            $productVariantPrice->net_weight = $variantsValue3['net_weight'];
                            $productVariantPrice->quantity = $variantsValue3['quantity'];
                            $productVariantPrice->save();
                        }
                    } else {
                        $productVariantPrice = new ProductVerientPrice();
                        $productVariantPrice->product_id = $productid;
                        $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                        $productVariantPrice->variant_value_id_2 = $varient_value_id2;
                        $productVariantPrice->product_mrp = $variantsValue2['product_mrp'];
                        $productVariantPrice->net_price = $variantsValue2['net_price'];
                        $productVariantPrice->discount_price = $variantsValue2['discount_price'];
                        $productVariantPrice->sku = $variantsValue2['sku'];
                        $productVariantPrice->barcode = $variantsValue2['barcode'];
                        $productVariantPrice->net_weight = $variantsValue2['net_weight'];
                        $productVariantPrice->quantity = $variantsValue2['quantity'];
                        $productVariantPrice->save();
                    }
                }
            } else {
                $productVariantPrice = new ProductVerientPrice();
                $productVariantPrice->product_id = $productid;
                $productVariantPrice->variant_value_id_1 = $varient_value_id1;
                $productVariantPrice->product_mrp = $variantsValue1['product_mrp'];
                $productVariantPrice->net_price = $variantsValue1['net_price'];
                $productVariantPrice->discount_price = $variantsValue1['discount_price'];
                $productVariantPrice->sku = $variantsValue1['sku'];
                $productVariantPrice->barcode = $variantsValue1['barcode'];
                $productVariantPrice->net_weight = $variantsValue1['net_weight'];
                $productVariantPrice->quantity = $variantsValue1['quantity'];
                $productVariantPrice->save();
            }
        }
        
        if($request->hasfile('product_image')){
            $counter = 1;
            foreach($request->product_image as $image) {
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
        
        return redirect('/products/list')->with('message', 'Product Added Successfully.');
    }
    
    public function update_product(Request $request, $product){
        $product = Product::findOrFail($product);
        $this->validate($request, [
            'vendor_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'hsn_code' => 'required|regex:/^\w+$/',
            'sku' => 'required|regex:/^\w+$/',
            'barcode' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'net_price' => 'required',
            'moq' => 'required',
        ]);
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_type = $request->product_type;
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->hsn_code = $request->hsn_code;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        $product->origin = $request->origin;
        $product->moq = $request->moq;
        $product->cost = $request->cost;
        /*
        $product->b2b_moq = $request->b2b_moq;
        $product->b2b_price = $request->b2b_price;
        */
        $product->product_mrp = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->net_price = $request->net_price;
        $product->taxable = $request->taxable;
        $product->tax_rate = $request->taxable_rate;
        $product->tax_amount = $request->taxable_amount;
        $product->net_price_with_tax = $request->net_price_without_tax;
        $product->video_link = json_encode($request->video_url);
        $product->save();
        return redirect('/products/list')->with('message', 'Product Updated Successfully.');
    }
    
    public function delete_product($product){
        DB::table('products')->delete($product);
        return redirect('/products/list')->with('message', 'Product Deleted Successfully.');
    }
    
    public function product_category(Request $request){
        if($request->session()->get('admin-logged-in') == false && $request->session()->get('vendor-logged-in') == false) {
            $panel = $request->session()->get('admin-logged-in') == true ? "administrator" : "vendors";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
        if($request->session()->get('admin-logged-in') == true) {
            $categories = DB::table('product_category AS p1')->leftjoin('product_category AS p2', 'p2.id', '=', 'p1.parent')->leftjoin('vendors', 'vendors.id', '=', 'p1.vendor_id')->select('p1.*', 'p2.name AS parentName', 'vendors.store_name AS vendor')->get();
        } else if($request->session()->get('vendor-logged-in') == true) {
            $categories = DB::table('product_category AS p1')->leftjoin('product_category AS p2', 'p2.id', '=', 'p1.parent')->leftjoin('vendors', 'vendors.id', '=', 'p1.vendor_id')->whereNull('p1.vendor_id')->orWhere('p1.vendor_id', $request->session()->get('vendor-loggedin-id'))->select('p1.*', 'p2.name AS parentName', 'vendors.store_name AS vendor')->get();
        }
        return view('products.category', ['title' => 'Product Categories - Spicebucket Administrator', 'categories' => $categories]);
    }
    
    public function add_category(){
        $categories = ProductCategory::where('parent', 0)->get();
        return view('products.addcategory', ['title' => 'Add Category - Spicebucket Administrator', 'categories' => $categories]);
    }
    
    public function edit_category(ProductCategory $product_category){
        $children = $this->getChildCategories($product_category->id);
        $children = explode(",", $children);
        $children = array_filter($children);
        array_push($children, $product_category->id);
        $categories = ProductCategory::where('parent', 0)->get();
        return view('products.editcategory', ['title' => 'Edit Category - Spicebucket Administrator', 'category' => $product_category, 'categories' => $categories, 'children' => $children]);
    }
    
    public function save_category(Request $request){
        $category = new ProductCategory();
        $this->validate($request, [
            'category_name' => 'required',
            'category_slug' => 'required|unique:product_category,slug',
            'category_description' => 'required',
            'category_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'category_parent' => ''
        ]);
        if($request->session()->get('vendor-logged-in') == true)
        $category->vendor_id=$request->session()->get('vendor-loggedin-id');
        $category->name = $request->category_name;
        $category->slug = $request->category_slug;
        $category->description = $request->category_description;
        $imageName = 'pc-'.time().'.'.$request->category_image->extension();
        $request->category_image->move(public_path('images/products'), $imageName);
        $category->image = $imageName;
        $category->parent = ($request->category_parent == "" ? 0 : $request->category_parent);
        $category->save();
        return redirect('/products/categories')->with('message', 'Category Added Successfully.');
    }
    
    public function update_category(Request $request, $product_category){
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
        if($request->hasFile('category_image')) {
            if(File::exists(public_path('images/products') . $category->image)){
                File::delete(public_path('images/products') . $category->image);
            }
            $imageName = 'pc-'.time().'.'.$request->category_image->extension();
            $request->category_image->move(public_path('images/products'), $imageName);
            $category->image = $imageName;
        }
        $category->save();
        return redirect('/products/categories')->with('message', 'Category Added Successfully.');
    }
    
    public function delete_category($product_category){
        DB::table('product_category')->delete($product_category);
        return redirect('/products/categories')->with('message', 'Category Deleted Successfully.');
    }
    
    private function getChildCategories($id){
        $children = array();
        $result = DB::table('product_category')->where('parent', $id)->get();
        foreach($result as $row){
            array_push($children, $row->id);
            $this->getChildCategories($row->id);
        }
        return implode(",", $children);
    }
}
