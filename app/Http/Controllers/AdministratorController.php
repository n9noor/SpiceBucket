<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVerient;
use App\Models\ProductVerientValue;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

class AdministratorController extends Controller
{
    public function index(Request $request){
        if($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        return view('wms.dashboard', ['title' => 'Dashboard - SpiceBucket Administration']);
    }
    
    public function login(Request $request){
        if($request->session()->get('admin-logged-in') == true) {
            return redirect('/administrator/dashboard')->with('message', "Please logged in.");
        }
        return view('wms.login');
    }
    
    public function login_process(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $result = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('emailid', $request->email)->select('users.*', 'roles.rolename')->first();
        if(!is_null($result) && Hash::check($request->password, $result->password)){
            $request->session()->put('admin-logged-in', true);
            $request->session()->put('admin-loggedin-name', $result->firstname . " " . $result->lastname);
            $request->session()->put('admin-loggedin-rolename', $result->rolename);
            $request->session()->put('admin-loggedin-id', $result->id);
            return redirect('/administrator/dashboard')->with('message', "User logged in successfully.");
        } else {
            return redirect('/administrator/login')->withInput($request->except('password'))->with('message', "Invalid User Credentials.");
        }
    }
    
    public function logout(Request $request){
        $request->session()->put('admin-logged-in', false);
        $request->session()->put('admin-loggedin-name', '');
        $request->session()->put('admin-loggedin-rolename', '');
        $request->session()->put('admin-loggedin-id', '');
        return redirect('/administrator/login')->with('message', "User logged out successfully.");
    }
    
    public function vendor_documenttype(Request $request){
        $type = DocumentType::all();
        return view('wms.documents', ['title' => 'Vendor Documents - SpiceBucket Administration', 'types' => $type]);
    }
    
    public function approve_status(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = Vendor::where('id', $request->id)->first();
        
        if(!is_null($result)){
            $updateArray = ['is_approved' => $request->status];
            if($request->status == 2){
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
    
    public function save_documenttype(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = DocumentType::where('type', $request->type)->first();
        if($request->id != 0){
            $result = DocumentType::where('type', $request->type)->where('id', '<>', $request->id)->first();
        }
        
        if(!is_null($result)){
            return response()->json([
                'ok' => false,
                'message' => "Type already available."
            ], 200);
        } else {
            if($request->id == 0) {
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
    
    public function update_status(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required',
            'column' => 'required',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => $validator->errors()
            ], 200);
        }
        switch($request->type){
            case 'product':
                $result = Product::where('id', $request->id)->first();
                
                if(!is_null($result)){
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
                $result = ProductCategory::where('id', $request->id)->first();
                
                if(!is_null($result)){
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
                $result = Vendor::where('id', $request->id)->first();
                
                if(!is_null($result)){
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
                $result = User::where('id', $request->id)->first();
                
                if(!is_null($result)){
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
                $result = DocumentType::where('id', $request->id)->first();
                
                if(!is_null($result)){
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
                case 'document_type':
                    $result = DocumentType::where('id', $request->id)->first();
                    
                    if(!is_null($result)){
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
                    $result = ProductVerient::where('id', $request->id)->first();
                    
                    if(!is_null($result)){
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
                    $result = ProductVerientValue::where('id', $request->id)->first();
                    
                    if(!is_null($result)){
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
                    