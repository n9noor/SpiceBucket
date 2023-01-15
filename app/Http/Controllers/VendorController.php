<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class VendorController extends Controller
{
    public function index(Request $request){
        if($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        $vendors = Vendor::all();
        return view('vendor.index', ['title' => 'Vendors - Spicebucket Administrator', 'vendors' => $vendors]);
    }
    
    public function dashboard(Request $request) {
        if($request->session()->get('vendor-logged-in') == false) {
            return redirect('/vendors/login')->with('message', "Please log in.");
        }
        return view('vendor.dashboard', ['title' => 'Dashboard - Spicebucket Vendor']);
    }
    
    public function login() {
        return view('vendor.login');
    }
    
    public function register(){
        return view('vendor.register');
    }
    
    public function registration(Request $request) {
        $vendor = new Vendor();
        $this->validate($request, [
            'gst' => 'required|unique:vendors,gst',
            'shop_name' => 'required',
            'owner_name' => 'required',
            'email' => 'required|email|unique:vendors,business_emailid',
            'phone' => 'unique:vendors,phone',
            'password' => 'required|same:passwordRep',
            'passwordRep' => 'required',
        ]);
        $vendor->gst = $request->gst;
        $vendor->store_name = $request->shop_name;
        $vendor->responsible_person = $request->owner_name;
        $vendor->business_emailid = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->phone = $request->phone;
        $vendor->save();
        return redirect('/')->with('message', 'Vendor added successfully.');
    }
    
    public function login_process(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $result = DB::table('vendors')->where('business_emailid', $request->email)->where('is_active', true)->first();
        if(!is_null($result) && Hash::check($request->password, $result->password)){
            $request->session()->put('vendor-logged-in', true);
            $request->session()->put('vendor-loggedin-name', $result->responsible_person);
            $request->session()->put('vendor-loggedin-shopname', $result->store_name);
            $request->session()->put('vendor-loggedin-id', $result->id);
            $request->session()->put('vendor-loggedin-approved', $result->is_approved);
            if($result->is_approved == 1) {
                return redirect('/vendors/dashboard')->with('message', "User logged in successfully.");
            } else {
                return redirect('/vendors/dashboard')->with('message', "Please wait for Administrator Approval.");
            }
        } else {
            return redirect('/vendors/login')->withInput($request->except('password'))->with('message', "Invalid User Credentials.");
        }
    }
    
    public function logout(Request $request){
        $request->session()->put('vendor-logged-in', false);
        $request->session()->put('vendor-loggedin-name', '');
        $request->session()->put('vendor-loggedin-rolename', '');
        $request->session()->put('vendor-loggedin-id', '');
        $request->session()->put('vendor-loggedin-approved', 0);
        return redirect('/vendors/login')->with('message', "User logged out successfully.");
    }
    
    public function verify_vendor(Request $request) {
        $this->validate($request, [
            'gst_number' => 'required|regex:/^\w+$/'
        ]);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sheet.gstincheck.co.in/check/b521d51d0078664a866a0ffe8a5ab34b/' . strtoupper($request->gst_number),
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
        if($response == false) {
            return response()->json(['status' => false], 200);
        }
        $response = json_decode($response);
        if($response->flag == true) {
            Vendor::where('gst', $request->gst_number)->update(['verified' => true]);
            return response()->json(['status' => true, 'data' => ['tradeName' => $response->data->lgnm, 'address' => $response->data->pradr->adr]], 200);
        } else {
            return response()->json(['status' => false], 200);
        }
    }
    
    public function add_vendor() {
        return view('vendor.add', ['title' => 'Add Vendor - SpiceBucket Administration']);
    }
    
    public function edit_vendor(Vendor $vendor) {
        $types = DocumentType::where('is_active', true)->get();
        $documents = is_null($vendor->document) ? array() : json_decode($vendor->document, true);
        return view('vendor.edit', ['title' => 'Edit Vendor - SpiceBucket Administration', 'vendor' => $vendor, 'types' => $types, 'documents' => $documents]);
    }
    
    public function save_vendor(Request $request) {
        $vendor = new Vendor();
        $this->validate($request, [
            'gst' => 'required|unique:vendors,gst',
            'responsible_person' => 'required',
            'store_name' => 'required',
            'store_address' => 'required',
            'email' => 'required|unique:vendors,business_emailid|regex:/^[a-z0-9.-_]+@[a-z0-9]+\.[a-z.]{2,5}$/i',
            'phone' => 'required|regex:/^\d+$/'
        ]);
        $default_password = (substr(strtolower($request->gst), -4) . substr(strtolower($request->phone), 0, 4));
        $vendor->gst = $request->gst;
        $vendor->store_name = $request->store_name;
        $vendor->responsible_person = $request->responsible_person;
        $vendor->business_emailid = $request->email;
        $vendor->password = Hash::make($default_password);
        $vendor->phone = $request->phone;
        $vendor->address = $request->store_address;
        $vendor->verified = true;
        $vendor->save();
        return redirect('/vendors')->with('message', 'Vendor Added Successfully.');
    }
    
    public function delete_vendor(Vendor $vendor){
        DB::table('vendors')->delete($vendor);
        return redirect('/vendors')->with('message', 'Vendor Deleted Successfully.');
    }
    
    public function profile(Request $request) {
        $types = DocumentType::where('is_active', true)->get();
        $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));
        $documents = is_null($vendor->document) ? array() : json_decode($vendor->document, true);
        return view('vendor.profile', ['title' => 'Profile - Spicebucket Vendor', 'vendor' => $vendor, 'types' => $types, 'documents' => $documents]);
    }
    
    public function update_profile(Request $request){
        $this->validate($request, [
            'document' => 'required',
            'document.*' => 'mimes:jpeg,jpg,png,pdf|max:2048'
        ]);
        if($request->hasFile('document')){
            $vendor = Vendor::findOrFail($request->session()->get('vendor-loggedin-id'));
            $documents = !is_null($vendor->document) ? json_decode($vendor->document, true) : array();
            $files = $request->file('document');
            foreach ($files as $type => $file) {
                $name = $type . "." . $file->extension();
                $file->move(public_path('/backend/vendor-document/' . $vendor->gst . '/'), $name);
                $documents[$type] = $name;
            }
            $vendor->document = json_encode($documents);
            $vendor->is_approved = 0;
            $vendor->save();
        }
        return redirect('/vendors/my-profile')->with('message', 'Vendor Saved Successfully.');
    }
}
