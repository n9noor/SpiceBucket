<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVerient;
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
        return view('products.edit', ['title' => 'Edit Product - Spicebucket Administrator', 'catgories' => $categories, 'vendors' => $vendors, 'product' => $product]);
    }
    
    public function save_product(Request $request){
        dd($request->variant);
        $product = new Product();
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
            'variant.*.product_mrp' => 'required',
            'variant.*.net_price' => 'required',
            'variant.*.discount_price' => 'required',
            'variant.*.b2b_price' => 'required',
            'variant.*.net_weight' => 'required'
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
        $product->b2b_moq = $request->b2b_moq;
        $product->b2b_price = $request->b2b_price;
        $product->product_mrp = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->net_price = $request->net_price;
        $product->taxable = $request->taxable;
        $product->tax_rate = $request->taxable_rate;
        $product->tax_amount = $request->taxable_amount;
        $product->net_price_with_tax = $request->net_price_without_tax;
        $product->video_link = json_encode($request->video_url);
        $product->save();
        $productid = $product->id;

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
        $product->b2b_moq = $request->b2b_moq;
        $product->b2b_price = $request->b2b_price;
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
