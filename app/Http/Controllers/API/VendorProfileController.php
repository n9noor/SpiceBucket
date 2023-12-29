<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use App\Models\ProductImage;
use App\Models\ProductVerient;
use App\Models\ProductVerientPrice;
use App\Models\Reward;
use App\Models\RewardHistory;
use App\Models\StaticPage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class VendorProfileController extends Controller
{ 
   public function vendorlogin(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(),'status' => false], 422);
            }
            $result = DB::table('vendors')->where('business_emailid', $request->email)->where('is_active', true)->first();
        
            if (!is_null($result) && Hash::check($request->password, $result->password)) {
                $responseData = [
                    'message' => 'User logged in successfully.',
                    'status' => true,
                    'vendor' => [
                        'name' => $result->responsible_person,
                        'shop_name' => $result->store_name,
                        'id' => $result->id,
                        'is_approved' => $result->is_approved
                    ]
                ];
        
                if ($result->is_approved == 1) {
                    return response()->json($responseData, 200);
                } else {
                    return response()->json(['message' => 'Please wait for Administrator Approval.','status' => true], 200);
                }
            } else {
                return response()->json(['message' => 'Invalid User Credentials.','status' => false], 401);
            }
        }
        
    



    // <--------------vendorRegistor---------------------->
    public function vendor_register_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gst' => 'required|unique:vendors,gst',
            'store_name' => 'required',
            'vendor_alias' => 'nullable|string',
            'responsible_person' => 'required',            
            'store_address' => 'required',
            'business_emailid' => 'required|email|unique:vendors,business_emailid',
            'phone' => 'required|unique:vendors,phone',
            'password' => 'required|same:passwordRep',
            'passwordRep' => 'required',
            'shipping_pincode' => 'required|numeric',
            'logo_image' => 'required|image|mimes:png,jpg,jpeg,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }

        $vendor = new Vendor();
        $vendor->gst = $request->gst;
        $vendor->store_name = $request->store_name;
        $vendor->vendor_alias = $request->vendor_alias;
        $vendor->responsible_person = $request->responsible_person;       
        $vendor->business_emailid = $request->business_emailid;
        $vendor->password = Hash::make($request->password);
        $vendor->phone = $request->phone;
        $vendor->address = $request->store_address;        
        $vendor->shipping_pincode = $request->shipping_pincode;
        $vendor->slug = strtolower(str_replace(" ", "-", $request->store_name));
        $imageName = 'vendor-logo-' . time() . '.' . $request->logo_image->extension();
        $request->logo_image->move(public_path('images/vendors'), $imageName);
        $vendor->image = $imageName;
        $vendor->save();
        return response()->json(['message' => 'Vendor registered successfully','status' => true], 201);
    }
    ////////////////////////////
    public function getVendorDetails($id)
    {
    $vendor = Vendor::find($id);

    if (!$vendor) {
        return response()->json(['message' => 'Vendor not found','status' => false], 404);
    }

    return response()->json(['vendor' => $vendor,'status' => true], 200);
    }
//////////////////////////

public function edit_profile(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(), [
            'responsible_person' => 'required',
            'store_name' => 'required',
            'store_address' => 'required',
            'logo_image' => 'mimes:jpeg,jpg,png,pdf|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'status' => false], 422);
        }
    
        $vendor = Vendor::find($id);
    
        if (!$vendor) {
            return response()->json(['message' => 'Vendor not found','status' => false], 404);
        }         
        $vendor->responsible_person = $request->responsible_person;
        $vendor->store_name = $request->store_name;
        $vendor->vendor_alias = $request->store_name;
        $vendor->address = $request->store_address;
        $vendor->phone = $request->phone;
        $vendor->shipping_pincode = $request->shipping_pincode;
        $vendor->slug = strtolower(str_replace(" ", "-", $request->store_name)); 

        if ($request->hasFile('logo_image')) {
            $imageName = 'vendor-logo-' . time() . '.' . $request->logo_image->extension();
            $request->logo_image->move(public_path('images/vendors'), $imageName);
            $vendor->image = $imageName;
    
        }
        $vendor->is_approved = 0;
        $vendor->save();
        return response()->json(['message' => 'Vendor details updated successfully','status' => true], 200);
    }


    //////////////////////////
    public function update_Vendor(Request $request, $id)
    {
    $validator = Validator::make($request->all(), [      
               
        'password' => 'nullable|string|same:passwordRep',
        'passwordRep' => 'nullable|string',
        'shipping_pincode' => 'nullablenumeric',
        'lat' => 'nullable|string',
        'long' => 'nullable|string',
        'token_id' => 'nullable|string',
        'is_active' => 'nullable|string',        
        'verified' => 'nullable|string',
        'created_by' => 'nullable|string',
        'updated_by' => 'nullable|string',
        'decline_comment' => 'nullable|string',        
        'shipping_state' => 'nullable|string',
        'shipping_country' => 'nullable|string',       
        'qac_user_id' => 'nullable|string',        
        'sliderimage.*' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
        'vendor_offer_image_1' => 'mimes:jpeg,jpg,png,pdf|max:2048',
        'vendor_offer_image_2' => 'mimes:jpeg,jpg,png,pdf|max:2048',
        'vendor_offer_image_3' => 'mimes:jpeg,jpg,png,pdf|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status' => false], 422);
    }

    $vendor = Vendor::find($id);

    if (!$vendor) {
        return response()->json(['message' => 'Vendor not found','status' => false], 404);
    }

    $vendor->password = Hash::make($request->password);
    $vendor->lat = $request->lat; 
    $vendor->long = $request->long; 
    $vendor->token_id= $request->token_id;   
    $vendor->created_by = $request->created_by;         
    $vendor->updated_by = $request->updated_by;
    $vendor->decline_comment = $request->decline_comment;
    $vendor->shipping_state = $request->shipping_state; 
    $vendor->shipping_country = $request->shipping_country; 
    $vendor->shipping_pincode = $request->shipping_pincode; 
    $vendor->qac_user_id = $request->qac_user_id;      
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
        $name = $vendor->gst.'offer-image-1.' . $request->vendor_offer_image_1->extension();
        $request->vendor_offer_image_1->move(public_path('/images/vendors'), $name);
        $vendor->vendor_offer_image_1 = $name;
    }

    if ($request->hasFile('vendor_offer_image_2')) {
        $name = $vendor->gst.'offer-image-2.' . $request->vendor_offer_image_2->extension();
        $request->vendor_offer_image_2->move(public_path('/images/vendors'), $name);
        $vendor->vendor_offer_image_2 = $name;
    }

    if ($request->hasFile('vendor_offer_image_3')) {
        $name = $vendor->gst.'offer-image-3.' . $request->vendor_offer_image_3->extension();
        $request->vendor_offer_image_3->move(public_path('/images/vendors'), $name);
       
        $vendor->vendor_offer_image_3 = $name;
    }
    $vendor->save();
    return response()->json(['message' => 'Vendor details updated successfully','status' => true], 200);
    }


///

public function uploadVendorDocuments(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'pan_card' => 'required|mimes:jpeg,jpg,png,pdf',
        'aadhaar_card' => 'required|mimes:jpeg,jpg,png,pdf',
        'gst_certificate' => 'required|mimes:jpeg,jpg,png,pdf',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors(),'status' => false], 422);
    }
    $vendor = Vendor::find($id);
    if (!$vendor) {
        return response()->json(['message' => 'Vendor not found','status' => false], 404);
    }
    $documents = [];
    // Create a new directory within the public folder
    $directory = public_path('backend\vendor-document/' . $vendor->gst);
    
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    // Upload and save the documents
    if ($request->hasFile('pan_card')) {
        $panCard = $request->file('pan_card');
        $panCardName = 'pan_card.' . $panCard->getClientOriginalExtension();
        $panCard->move($directory, $panCardName);
        $documents['pan_card'] = $panCardName;
    }

    if ($request->hasFile('aadhaar_card')) {
        $aadhaarCard = $request->file('aadhaar_card');
        $aadhaarCardName = 'aadhaar_card.' . $aadhaarCard->getClientOriginalExtension();
        $aadhaarCard->move($directory, $aadhaarCardName);
        $documents['aadhaar_card'] = $aadhaarCardName;
    }

    if ($request->hasFile('gst_certificate')) {
        $gstCertificate = $request->file('gst_certificate');
        $gstCertificateName = 'gst_certificate.' . $gstCertificate->getClientOriginalExtension();
        $gstCertificate->move($directory, $gstCertificateName);
        $documents['gst_certificate'] = $gstCertificateName;
    }

    // Save the document names in the database
    $vendor->document = json_encode($documents);
    $vendor->save();

    return response()->json(['message' => 'Documents uploaded successfully','status' => true, 'document' => $vendor->document], 201);
}



   
////////////
    public function removeUpdateDocuments(Request $request, $id)
    {
    $vendor = Vendor::find($id);
    
    if (!$vendor) {
        return response()->json(['message' => 'Vendor not found','status' => false], 404);
    }

    $documentPaths = [];
    $path = public_path('images/vendor_documents/vendor_' . $vendor->id);

    // Delete existing images and entries
    $existingDocuments = $vendor->document;
    if ($existingDocuments) {
        foreach ($existingDocuments as $existingDocument) {
            Storage::delete($existingDocument);
        }
        $vendor->document = null;
        $vendor->save();
    }

    // Upload new images
    if ($request->hasFile('pan_card')) {
        $documentPaths[] = $request->file('pan_card')->move($path, 'pan_card.jpg');
    }
    if ($request->hasFile('aadhar_card')) {
        $documentPaths[] = $request->file('aadhar_card')->move($path, 'aadhar_card.jpg');
    }
    if ($request->hasFile('gst_certificate')) {
        $documentPaths[] = $request->file('gst_certificate')->move($path, 'gst_certificate.jpg');
    }

    // Save document paths in the database
    $vendor->document = $documentPaths;
    $vendor->save();

    return response()->json(['message' => 'Documents uploaded successfully','status' => true], 201);
    }

//////
}


