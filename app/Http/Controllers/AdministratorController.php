<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\DocumentType;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVerient;
use App\Models\ProductVerientValue;
use App\Models\StaticPage;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorsUser;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use League\CommonMark\Node\Block\Document;

class AdministratorController extends Controller
{
    public function map_vendor_qac(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json(['status' => false, 'message' => 'Please login'], 200);
        }
		if(Session::get('admin-loggedin-property')['seller-qac-assignment'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
        $validator = Validator::make($request->all(), [
            'qacid' => 'required|numeric',
            'vendorid' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        try {
            Vendor::where('id', $request->vendorid)->update(['qac_user_id' => $request->qacid]);
            return response()->json([
                'status' => true,
                'message' => "QAC Mapped Successfully to Vendor."
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    public function map_vendor_tabcategory(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json(['status' => false, 'message' => 'Please login'], 200);
        }
		if(Session::get('admin-loggedin-property')['seller-tab-assignment'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
        $validator = Validator::make($request->all(), [
            'tab_category' => 'required',
            'vendorid' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        try {
            Vendor::where('id', $request->vendorid)->update(['tab_category' => $request->tab_category]);
            return response()->json([
                'status' => true,
                'message' => "Tab Category updated successfully for Vendor."
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    public function index(Request $request)
    {
        if ($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->where('is_approved', true)->count();
        $inactiveProducts = Product::where('is_active', false)->where('is_approved', true)->count();
        $pendingProducts = Product::where('is_approved', false)->count();
        $totalOrders = Order::count();
        $pendingOrders = OrderDetail::where('order_status', 'pending')->distinct()->count('order_id');
        $cancelOrders = OrderDetail::where('order_status', 'cancel')->distinct()->count('order_id');
        $returnOrders = OrderDetail::where('order_status', 'return')->distinct()->count('order_id');
        $todaysOrders = OrderDetail::where(DB::raw('DATE(created_at) = ' . date('Y-m-d')))->distinct()->count('order_id');
        $totalincome = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')->distinct()->sum('total_amount');
        $todayincome = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')->where(DB::raw('DATE(order_details.created_at) = ' . date('Y-m-d')))->distinct()->sum('total_amount');

        return view('wms.dashboard', ['title' => 'Dashboard - Spicebucket Administrator', 'totalProducts' => $totalProducts, 'totalOrders' => $totalOrders, 'todaysOrders' => $todaysOrders, 'pendingOrders' => $pendingOrders, 'cancelOrders' => $cancelOrders, 'activeProducts' => $activeProducts, 'inactiveProducts' => $inactiveProducts, 'pendingProducts' => $pendingProducts, 'totalincome' => $totalincome, 'todayincome' => $todayincome, 'returnOrders' => $returnOrders]);
    }

    public function login(Request $request)
    {
        if ($request->session()->get('admin-logged-in') == true) {
            return redirect('/administrator/dashboard')->with('message', "Please logged in.");
        }
        return view('wms.login');
    }

    public function login_process(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $result = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('emailid', $request->email)->select('users.*', 'roles.rolename')->first();
        if (!is_null($result) && Hash::check($request->password, $result->password)) {
            $request->session()->put('admin-logged-in', true);
            $request->session()->put('admin-loggedin-name', $result->firstname . " " . $result->lastname);
            $request->session()->put('admin-loggedin-rolename', $result->rolename);
            $request->session()->put('admin-loggedin-id', $result->id);
            $request->session()->put('admin-loggedin-property', json_decode($result->property, true));
            $request->session()->put('admin-loggedin-designproperty', json_decode($result->design_property, true));
            return redirect('/administrator/dashboard')->with('message', "User logged in successfully.");
        } else {
            return redirect('/administrator/login')->withInput($request->except('password'))->with('message', "Invalid User Credentials.");
        }
    }

    public function logout(Request $request)
    {
        $request->session()->put('admin-logged-in', false);
        $request->session()->put('admin-loggedin-name', '');
        $request->session()->put('admin-loggedin-rolename', '');
        $request->session()->put('admin-loggedin-id', '');
        $request->session()->put('admin-loggedin-property', '');
        $request->session()->put('admin-loggedin-designproperty', '');
        return redirect('/administrator/login')->with('message', "User logged out successfully.");
    }

    public function vendor_documenttype(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['vendor-required-document-view'] == 0){
            return view('wms.accessdenied');
		}
        $type = DocumentType::all();
        return view('wms.documents', ['title' => 'Vendor Documents - SpiceBucket Administration', 'types' => $type]);
    }

    public function approve_status(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json([
                'ok' => false,
                'message' => "Please login."
            ], 200);
        }
		if(Session::get('admin-loggedin-property')['seller-approve'] == 0){
            return response()->json([
                'ok' => false,
                'message' => "Access Denied."
            ], 200);
		}
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = Vendor::where('id', $request->id)->first();

        if (!is_null($result)) {
            $updateArray = ['is_approved' => $request->status];
            if ($request->status == 2) {
                $updateArray['decline_comment'] = $request->comment;
            }
            Vendor::where('id', $request->id)->update($updateArray);
            return response()->json([
                'ok' => true
            ], 200);
        } else {
            return response()->json([
                'ok' => false,
                'message' => "No Vendor available."
            ], 200);
        }
    }

    public function product_approve_status(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json([
                'ok' => false,
                'message' => "Please login."
            ], 200);
        }
		if(Session::get('admin-loggedin-property')['product-list-approve'] == 0){
            return response()->json([
                'ok' => false,
                'message' => "Access Denied."
            ], 200);
		}
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = Product::where('id', $request->id)->first();

        if (!is_null($result)) {
            $updateArray = ['is_approved' => $request->status];
            if ($request->status == 2) {
                $updateArray['decline_comment'] = $request->comment;
            }
            Product::where('id', $request->id)->update($updateArray);
            return response()->json([
                'ok' => true
            ], 200);
        } else {
            return response()->json([
                'ok' => false,
                'message' => "No product available."
            ], 200);
        }
    }

    public function save_documenttype(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json(['status' => false, 'message' => 'Please login'], 200);
        }
		if(Session::get('admin-loggedin-property')['vendor-required-document-add'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = DocumentType::where('type', $request->type)->first();
        if ($request->id != 0) {
            $result = DocumentType::where('type', $request->type)->where('id', '<>', $request->id)->first();
        }

        if (!is_null($result)) {
            return response()->json([
                'ok' => false,
                'message' => "Type already available."
            ], 200);
        } else {
            if ($request->id == 0) {
                DB::table('doucment_type')->insert([
                    'type' => $request->type
                ]);
            } else {
                DB::table('doucment_type')->where('id', $request->id)->update([
                    'type' => $request->type
                ]);
            }
            return response()->json([
                'ok' => true
            ], 200);
        }
    }

    public function update_status(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return response()->json(['status' => false, 'message' => 'Please login'], 200);
        }
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required',
            'column' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        switch ($request->type) {
            case 'static_pages':
		if(Session::get('admin-loggedin-property')['static-page-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = StaticPage::find($request->id);
                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    StaticPage::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No user available."
                    ], 200);
                }
                break;
            case 'vendors_users':
                $result = VendorsUser::find($request->id);
                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    VendorsUser::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No user available."
                    ], 200);
                }
                break;
            case 'offer':
		if(Session::get('admin-loggedin-property')['offer-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = Offer::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    Offer::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No offer available."
                    ], 200);
                }
                break;
            case 'coupon':
		if(Session::get('admin-loggedin-property')['discount-coupon-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = Coupon::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    Coupon::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No coupon available."
                    ], 200);
                }
                break;
            case 'product':
		if(Session::get('admin-loggedin-property')['product-list-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = Product::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    Product::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Vendor available."
                    ], 200);
                }
                break;
            case 'product_category':
		if(Session::get('admin-loggedin-property')['product-category-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = ProductCategory::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    ProductCategory::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Vendor available."
                    ], 200);
                }
                break;
            case 'vendors':
		if(Session::get('admin-loggedin-property')['seller-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = Vendor::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    Vendor::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Vendor available."
                    ], 200);
                }
                break;
            case 'users':
		if(Session::get('admin-loggedin-property')['users-list-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = User::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    User::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No User available."
                    ], 200);
                }
                break;
            case 'document_type':
		if(Session::get('admin-loggedin-property')['vendor-required-document-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = DocumentType::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    DocumentType::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Document Type available."
                    ], 200);
                }
                break;
            case 'product_variants':
		if(Session::get('admin-loggedin-property')['variant-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = ProductVerient::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    ProductVerient::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Variant Type available."
                    ], 200);
                }
                break;
            case 'product_variant_values':
		if(Session::get('admin-loggedin-property')['variant-active'] == 0){
			return response()->json(['status' => false, 'message' => 'Access Denied'], 200);
		}
                $result = ProductVerientValue::where('id', $request->id)->first();

                if (!is_null($result)) {
                    $updateArray = [$request->column => $request->status];
                    ProductVerientValue::where('id', $request->id)->update($updateArray);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "No Variant Type Value available."
                    ], 200);
                }
                break;
            default:
                return response()->json([
                    'status' => false,
                    'message' => "Not valid request."
                ], 200);
        }
    }
}
