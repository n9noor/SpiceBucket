<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Offer;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
use Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Mail as MailModel;
use App\Models\Notification;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        if (Session::get('admin-loggedin-rolename') == 'Administrator') {
            $vendors = Vendor::all();
        } else {
            $vendors = Vendor::where('qac_user_id', Session::get('admin-loggedin-id'))->get();
        }
        $users = User::where('role_id', 2)->get();
        return view('vendor.index', ['title' => 'Vendors - Spicebucket Administrator', 'vendors' => $vendors, 'users' => $users]);
    }

    public function dashboard(Request $request)
    {
        if ($request->session()->get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $totalProducts = Product::where('vendor_id', Session::get('vendor-loggedin-id'))->count();
        $activeProducts = Product::where('vendor_id', Session::get('vendor-loggedin-id'))->where('is_active', true)->where('is_approved', true)->count();
        $inactiveProducts = Product::where('vendor_id', Session::get('vendor-loggedin-id'))->where('is_active', false)->where('is_approved', true)->count();
        $pendingProducts = Product::where('vendor_id', Session::get('vendor-loggedin-id'))->where('is_approved', false)->count();
        $totalOrders = OrderDetail::where('vendor_id', Session::get('vendor-loggedin-id'))->distinct()->count('order_id');
        $pendingOrders = OrderDetail::where('vendor_id', Session::get('vendor-loggedin-id'))->where('order_status', 'pending')->distinct()->count('order_id');
        $cancelOrders = OrderDetail::where('vendor_id', Session::get('vendor-loggedin-id'))->where('order_status', 'cancel')->distinct()->count('order_id');
        $returnOrders = OrderDetail::where('vendor_id', Session::get('vendor-loggedin-id'))->where('order_status', 'return')->distinct()->count('order_id');
        $todaysOrders = OrderDetail::where('vendor_id', Session::get('vendor-loggedin-id'))->where(DB::raw('DATE(created_at) = ' . date('Y-m-d')))->distinct()->count('order_id');
        $totalincome = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')->where('order_details.vendor_id', Session::get('vendor-loggedin-id'))->distinct()->sum('total_amount');
        $todayincome = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')->where('order_details.vendor_id', Session::get('vendor-loggedin-id'))->where(DB::raw('DATE(order_details.created_at) = ' . date('Y-m-d')))->distinct()->sum('total_amount');

        $search_vendor_id = session('vendor-loggedin-id');
        $notifications = Notification::where('source', 1)
                            ->where('is_active', 0)
                            ->whereRaw("find_in_set('".$search_vendor_id."',notifications.customers)")
                            ->orderBy('id','ASC')
                            ->count();
        
        $request->session()->put('notificationCount', $notifications);

        return view('vendor.dashboard', ['title' => 'Dashboard - Spicebucket Vendor', 'totalProducts' => $totalProducts, 'totalOrders' => $totalOrders, 'todaysOrders' => $todaysOrders, 'pendingOrders' => $pendingOrders, 'cancelOrders' => $cancelOrders, 'activeProducts' => $activeProducts, 'inactiveProducts' => $inactiveProducts, 'pendingProducts' => $pendingProducts, 'totalincome' => $totalincome, 'todayincome' => $todayincome, 'returnOrders' => $returnOrders]);
    }

    public function login()
    {
        if (Session::get('vendor-logged-in') == true) {
            return redirect('/sellers/dashboard');
        }
        return view('vendor.login');
    }

    public function register()
    {
        return view('vendor.register');
    }

    public function registration(Request $request)
    {
          
        $vendor = new Vendor();
        $this->validate($request, [
            'gst' => 'required|unique:vendors,gst',
            'shop_name' => 'required',
            'owner_name' => 'required',
            'brand_name' => 'required',
            'store_address' => 'required',
            'email' => 'required|email|unique:vendors,business_emailid',
            'phone' => 'unique:vendors,phone',
            'password' => 'required|same:passwordRep',
            'passwordRep' => 'required',
            'shipping_pincode' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:1024',
        ]);
        $vendor->gst = $request->gst;
        $vendor->store_name = $request->shop_name;
        $vendor->responsible_person = $request->owner_name;
        $vendor->vendor_alias = $request->brand_name;
        $vendor->business_emailid = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->phone = $request->phone;
        $vendor->address = $request->store_address;
        $vendor->verified = $request->verified;
        $vendor->shipping_pincode = $request->shipping_pincode;
        $vendor->slug = strtolower(str_replace(" ", "-", $request->shop_name));
        $imageName = 'vendor-logo-' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/vendors'), $imageName);
        $vendor->image = $imageName;
        $vendor->save();
        if($vendor->id){
             $mailContent = MailModel::GetMailDetail(8);
                if(!empty($mailContent)){

                $mailbody = $mailContent['message'];          
                 // replace otp here 
                $content =  str_replace("{{SELLER}}",$vendor->responsible_person,$mailbody);  
                Mail::send('mailtemplate.mailbody', array('content' => $content), function ($message) use ($request,$mailContent) {
                        $message->to($request->email)->subject($mailContent['subject']);
                        $message->from($mailContent['from_email'], $mailContent['from_name']);
                });      
            }else{
                die('Please contact to us');
            }
        }
        return redirect('/sellers/register')->with('message', 'Thank you for your registration on Spice Bucket our executive will contact back to you soon!');
    }

    public function login_process(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $result = DB::table('vendors')->where('business_emailid', $request->email)->where('is_active', true)->first();
        if (!is_null($result) && Hash::check($request->password, $result->password)) {
            $request->session()->put('vendor-logged-in', true);
            $request->session()->put('vendor-loggedin-name', $result->responsible_person);
            $request->session()->put('vendor-loggedin-shopname', $result->store_name);
            $request->session()->put('vendor-loggedin-id', $result->id);
            $request->session()->put('vendor-loggedin-approved', $result->is_approved);
            if ($result->is_approved == 1) {
                return redirect('/sellers/dashboard')->with('message', "User logged in successfully.");
            } else {
                return redirect('/sellers/dashboard')->with('message', "Please wait for Administrator Approval.");
            }
        } else {
            return redirect('/sellers/login')->withInput($request->except('password'))->with('message', "Invalid User Credentials.");
        }
    }

    public function logout(Request $request)
    {
        $request->session()->put('vendor-logged-in', false);
        $request->session()->put('vendor-loggedin-name', '');
        $request->session()->put('vendor-loggedin-rolename', '');
        $request->session()->put('vendor-loggedin-id', '');
        $request->session()->put('vendor-loggedin-approved', 0);
        return redirect('/sellers/login')->with('message', "User logged out successfully.");
    }

    public function verify_vendor(Request $request)
    {
        $this->validate($request, [
            'gst_number' => 'required|regex:/^\w+$/'
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sheet.gstincheck.co.in/check/dcf6c948ada382ecce2796c64fec8d02/' . strtoupper($request->gst_number),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if ($response == false) {
            return response()->json(['status' => false], 200);
        }
        $response = json_decode($response);
        if ($response->flag == true) {
            Vendor::where('gst', $request->gst_number)->update(['verified' => true]);
            return response()->json(['status' => true, 'data' => ['tradeName' => $response->data->lgnm, 'address' => $response->data->pradr->adr]], 200);
        } else {
            return response()->json(['status' => false], 200);
        }
    }

    public function add_vendor()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
        return view('vendor.add', ['title' => 'Add Vendor - SpiceBucket Administration']);
    }

    public function edit_vendor(Vendor $vendor)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
        $types = DocumentType::where('is_active', true)->get();
        $documents = is_null($vendor->document) ? array() : json_decode($vendor->document, true);
        return view('vendor.edit', ['title' => 'Edit Vendor - SpiceBucket Administration', 'vendor' => $vendor, 'types' => $types, 'documents' => $documents]);
    }

    public function save_vendor(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
        $vendor = new Vendor();
        $this->validate($request, [
            'gst' => 'required|unique:vendors,gst',
            'responsible_person' => 'required',
            'store_name' => 'required',
            'store_address' => 'required',
            'email' => 'required|unique:vendors,business_emailid|regex:/^[a-z0-9.-_]+@[a-z0-9]+\.[a-z.]{2,5}$/i',
            'phone' => 'required|regex:/^\d+$/',
            'shipping_pincode' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:1024',
        ]);
        $default_password = (substr(strtolower($request->gst), -4) . substr(strtolower($request->phone), 0, 4));
        $vendor->gst = $request->gst;
        $vendor->store_name = $request->store_name;
        $vendor->responsible_person = $request->responsible_person;
        $vendor->business_emailid = $request->email;
        $vendor->password = Hash::make($default_password);
        $vendor->phone = $request->phone;
        $vendor->address = $request->store_address;
        $vendor->vendor_alias = $request->vendor_alias;
        $vendor->shipping_pincode = $request->shipping_pincode;
        $vendor->slug = strtolower(str_replace(" ", "-", $request->store_name));
        $imageName = 'vendor-logo-' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/vendors'), $imageName);
        $vendor->image = $imageName;
        $vendor->verified = true;
        $vendor->save();
        return redirect('/sellers')->with('message', 'Vendor Added Successfully.');
    }

    public function delete_vendor(Vendor $vendor)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
        DB::table('vendors')->delete($vendor);
        return redirect('/sellers')->with('message', 'Vendor Deleted Successfully.');
    }

    public function profile(Request $request)
    {
        if (Session::get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));
        return view('vendor.profile', ['title' => 'Profile - Spicebucket Vendor', 'vendor' => $vendor]);
    }

    public function settings(Request $request)
    {
        if (Session::get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));
        $types = DocumentType::where('is_active', true)->get();
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $documents = is_null($vendor->document) ? array() : json_decode($vendor->document, true);
        $sliderImages = !is_null($vendor->vendor_slider_image) ? json_decode($vendor->vendor_slider_image, true) : array();
        if ($sliderImages == null) {
            $sliderImages = array();
        }
        return view('vendor.settings', ['title' => 'Settings - Spicebucket Vendor', 'types' => $types, 'vendor' => $vendor, 'documents' => $documents, 'sliderImages' => $sliderImages, 'categories' => $categories]);
    }

    public function update_profile(Request $request)
    {
        if (Session::get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $this->validate($request, [
            'responsible_person' => 'required',
            'store_name' => 'required',
            'store_address' => 'required',
            'image' => 'mimes:jpeg,jpg,png,pdf|max:2048'
        ]);
        $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));
        $vendor->responsible_person = $request->responsible_person;
        $vendor->store_name = $request->store_name;
        $vendor->vendor_alias = $request->brand_name;
        $vendor->address = $request->store_address;
        $vendor->phone = $request->phone;
        $vendor->shipping_pincode = $request->shipping_pincode;

        if ($request->hasFile('image')) {
            $imageName = 'vendor-logo-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/vendors'), $imageName);
            $vendor->image = $imageName;
        }
        $vendor->is_approved = 0;
        $vendor->save();
        return redirect('/sellers/my-profile')->with('message', 'Vendor Saved Successfully.');
    }

    public function update_setting(Request $request)
    {
        if (Session::get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please log in.");
        }
        $this->validate($request, [
            'document.*' => 'mimes:jpeg,jpg,png,pdf|max:2048',
            'sliderimage.*' => 'mimes:jpeg,jpg,png,pdf|max:2048',
            'vendor_offer_image_1' => 'mimes:jpeg,jpg,png,pdf|max:2048',
            'vendor_offer_image_2' => 'mimes:jpeg,jpg,png,pdf|max:2048',
            'vendor_offer_image_3' => 'mimes:jpeg,jpg,png,pdf|max:2048'
        ]);
        $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));

        $documents = !is_null($vendor->document) ? json_decode($vendor->document, true) : array();
        if ($request->hasFile('document')) {
            $files = $request->file('document');
            if (!File::isDirectory(public_path('/backend/vendor-document/' . $vendor->gst . '/'))) {
                File::makeDirectory(public_path('/backend/vendor-document/' . $vendor->gst . '/'), 0777, true, true);
            }
            foreach ($files as $type => $file) {
                $name = $type . "." . $file->extension();
                $file->move(public_path('/backend/vendor-document/' . $vendor->gst . '/'), $name);
                $documents[$type] = $name;
            }
            $vendor->document = json_encode($documents);
        }

        $sliderImages = !is_null($vendor->vendor_slider_image) ? json_decode($vendor->vendor_slider_image, true) : array();
        if ($sliderImages == null) {
            $sliderImages = array();
        }
        if ($request->hasFile('sliderimage')) {
            $counter = 1;
            $files = $request->sliderimage;
            foreach ($files as $key => $file) {
                $name = 'vendor-page-slider-' . time() . $counter . "." . $file->extension();
                $file->move(public_path('/images/vendors'), $name);
                array_push($sliderImages, array('image' => $name, 'category' => $request->slidercategory[$key]));
                $counter++;
            }
            $vendor->vendor_slider_image = json_encode($sliderImages);
        }

        if ($request->hasFile('vendor_offer_image_1')) {
            $name = 'vendor-page-offer-image-1.' . $request->vendor_offer_image_1->extension();
            $request->vendor_offer_image_1->move(public_path('/images/vendors'), $name);
            $vendor->vendor_offer_image_1 = json_encode(array('image' => $name, 'category' => $request->vendor_offer_category_1));
        }

        if ($request->hasFile('vendor_offer_image_2')) {
            $name = 'vendor-page-offer-image-2.' . $request->vendor_offer_image_2->extension();
            $request->vendor_offer_image_2->move(public_path('/images/vendors'), $name);
            $vendor->vendor_offer_image_2 = json_encode(array('image' => $name, 'category' => $request->vendor_offer_category_2));
        }

        if ($request->hasFile('vendor_offer_image_3')) {
            $name = 'vendor-page-offer-image-3.' . $request->vendor_offer_image_3->extension();
            $request->vendor_offer_image_3->move(public_path('/images/vendors'), $name);
            $vendor->vendor_offer_image_3 = json_encode(array('image' => $name, 'category' => $request->vendor_offer_category_3));
        }
        $vendor->save();
        return redirect('/sellers/settings')->with('message', 'Vendor Saved Successfully.');
    }

    public function deletesliderbanner_image(Request $request)
    {
         
        if (Session::get('vendor-logged-in') == false) {
            return response()->json(['status' => false]);
        }
        $vendor = Vendor::findOrFail(Session::get('vendor-loggedin-id'));
        if ($vendor == null) {
            return response()->json(['status' => false]);
        }
        $images = !is_null($vendor->vendor_slider_image) ? json_decode($vendor->vendor_slider_image, true) : array();
       

        foreach($images as $key=>$img){
            if (in_array($request->imageid, $img)) {
                unset($images[$key]);
                if (file_exists(public_path('/images/vendors/') . $request->imageid)) {
                    unlink(public_path('/images/vendors/') . $request->imageid);
                 }
            }
        } 
         
        sort($images);
        $vendor->vendor_slider_image = json_encode($images);
        $vendor->save();
        return response()->json(['status' => true]);
    }

    public function api_vendors()
    {
        $vendors = array();
        $getvendors = Vendor::where('is_active', true)->where('is_approved', 1)->get();
        foreach ($getvendors as $vendor) {
            array_push($vendors, array('id' => $vendor->id, 
            'store_name' => $vendor->store_name,
             'responsible_person' => $vendor->responsible_person,
             'slug' => $vendor->slug,
              'alias' => $vendor->vendor_alias, 
             'image' => url(env('APP_URL') . ('/public/images/vendors/') . $vendor->image)));
        }
        return response()->json([
            'status' => true,
            'vendors' => $vendors
        ]);
    }
///
public function api_store_details(Request $request)
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
        $vendorid = $request->vendor_id;
        $whereData = array(['products.is_active', true]);
        if (!empty($request->max_price) && $request->max_price > 0) {
            array_push($whereData, ['product_variant_price.net_price', '>=', $request->min_price]);
            array_push($whereData, ['product_variant_price.net_price', '<=', $request->max_price]);
            array_push($whereData, ['product_variant_price.discount_percentage', '>=', $request->min_discount]);
            array_push($whereData, ['product_variant_price.discount_percentage', '<=', $request->max_discount]);
        }

        $searchcategories = $request->searchcategories;
        $selectedvendor = Vendor::where('id', $vendorid)->where('is_active', 1)->where('is_approved', 1)->first();

        if ($selectedvendor == null) {
            abort(404);
        }
        $column = 'products.created_at';
        switch ($request->sortby) {
            case 'relevance':
                $column = "products.id";
                break;
            case 'discount':
                $column = "product_variant_price.discount_percentage";
                break;
            case 'name':
                $column = "products.name";
                break;
            case 'rating':
                $column = "products.id";
                break;
            case 'created':
                $column = "products.created_at";
                break;
            case 'price':
                $column = "product_variant_price.net_price";
                break;
        }
        $sorting = $request->has('orderby') ? $request->orderby : 'desc';
        $products = Product::join('product_category', 'products.category_id', '=', 'product_category.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('product_variant_price', function ($joins) {
                $joins->on('product_variant_price.product_id', '=', 'products.id');
                $joins->on('product_variant_price.mark_as_default', '=', DB::raw('1'));
            })
            ->leftjoin('product_images', 'product_images.id', '=', 'product_variant_price.image_id')
            ->where('products.is_approved', true)->where($whereData)
            ->where('products.vendor_id', $selectedvendor->id)
            ->when(!is_null($searchcategories) && !empty($searchcategories) && is_array($searchcategories), function ($query) use ($searchcategories) {
                $query->whereIn('products.category_id', $searchcategories);
            })
            ->selectRaw('products.*, product_images.image, product_category.slug as categoryslug, product_variant_price.net_price as net_price,product_variant_price.product_mrp as product_mrp, product_category.name as categoryName, vendors.store_name as vendorName, vendors.vendor_alias as vendorNickName, vendors.slug as vendor_slug')->orderBy($column, $sorting)->groupBy('products.id')->get();
        $headercategories = getHeaderCategories();
        $header = StaticPage::where('url', 'mobile-app-home')->first();
        
        $categories = ProductCategory::with('product_category')->where('parent', 0)->where('is_active', true)->get();
        $vendors = Vendor::where('is_active', true)->orderBy('vendor_alias', 'ASC')->orderBy('store_name', 'ASC')->get();
        $popularstores = Offer::leftjoin('vendors', 'vendors.id', '=', 'offers.vendor_id')->leftjoin('product_category', 'product_category.id', '=', 'offers.category_id')->where('offers.is_active', true)->where('offers.is_featured', true)->where('offers.featured_category',  'popular_stores')->select("offers.*", "vendors.slug AS vendor_slug", "product_category.slug AS category_slug")->get();
        return response()->json(['activePage' => '', 'products' => $products, 'headercategories' => $headercategories, 'vendors' => $vendors, 'mobile_app_home' => ($header == null ? array() : json_decode($header->description, true)), 'categories' => $categories, 'selectedvendor' => $selectedvendor, 'popularstores' => $popularstores]);
    }
    
    public function api_store_detail(Request $request)
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
        $vendorid = $request->vendor_id;
        $vendor = Vendor::where('id', $vendorid)->first();

        if ($vendor == null) {
            return response()->json([
                'status' => false,
                'message' => 'Store not available.'
            ], 200);
        }

        $documents = json_decode($vendor->document, true);
        if (!is_null($documents))
            array_walk($documents, function (&$item) use ($vendor) {
                $item = url(env('APP_URL') . ('/public/backend/vendor-document/' . $vendor->gst . '/') . $item);
            });
            $url = 'mobile-app-home';
            $page = StaticPage::where('url', $url)->first();
        
            

            if(!empty($vendor->vendor_slider_image)){
                $data = json_decode($vendor->vendor_slider_image, true);

            }
            //dd($data);
            $filters_data=[];
            if(!empty($data)){
                foreach($data as $key=>$value){
                    $imagearray=array('path_folder'=>'/images/vendors/','image'=>$value['image'],'size'=>[250,250]);
                    $filters_data[]=array('image'=>   ImageRender($imagearray));
                }
            }
             

        return response()->json([
            'status' => true,
            'store_info' => array(
                'store_name' => $vendor->store_name,
                'contact_person' => $vendor->responsible_person,
                'emailid' => $vendor->business_emailid,
                'phone' => $vendor->phone,
                'alias' => $vendor->vendor_alias,
                'gst' => $vendor->gst,
                'address' => $vendor->address,
                'document' => $documents,                
                'image' => url(env('APP_URL') . ('/public/images/vendors/') . $vendor->image),
                'shipping_pincode' => $vendor->shipping_pincode,
                'images'=>$filters_data
            )
        ], 200);
    }

    public function api_store_offer(Request $request)
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
        $vendorid = $request->vendor_id;
        $vendor = Vendor::where('id', $vendorid)->first();
        if ($vendor == null) {
            return response()->json([
                'status' => false,
                'message' => 'Store not available.'
            ], 200);
        }

        $offers = Offer::where('vendor_id', $vendor->id)
        ->where('offers.featured_category', '!=', 'popular_stores')
        ->where('offers.is_active', true)
        ->get();
        if (count($offers) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No offer available for store.'
            ], 200);
        }
        $availableOffer = array();
        foreach ($offers as $offer) {
            array_push($availableOffer, array(
                'page' => ((is_null($offer->vendor_id) || $offer->vendor_id == "") ? 'categroy' : 'brand'),
                'category_id' => $offer->category_id,
                'vendor_id' => $offer->vendor_id,
                'category_slug' => $offer->category_slug,
                'vendor_slug' => $offer->vendor_slug,
                'image' => url(env('APP_URL') . '/public/images/offers/' . $offer->imagepath),
                'heading' => $offer->heading,
                'sub_heading' => $offer->sub_heading
            ));
        }
        $offerCount = count($availableOffer);
        return response()->json([
            'status' => true,
            'offer_count' => $offerCount,
            'offers' => $availableOffer
        ], 200);
    }

    public function api_store_categorey(Request $request)
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
    
        $vendorid = $request->vendor_id;
        $vendor = Vendor::where('id', $vendorid)->first();
       
        if ($vendor == null) {
            return response()->json([
                'status' => false,
                'message' => 'Vendor not available.'
            ], 200);
        }
    
        $categoryIds = Product::where('vendor_id', $vendorid)
            ->pluck('category_id');
           
    
        $productCategories = ProductCategory::whereIn('id', $categoryIds)
            ->get();
    
        return response()->json([
            'status' => true,
            'productCategories' => $productCategories
        ], 200);
    }
    
}
