<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Vendor;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class SellerNotificationController extends Controller
{
    use SoftDeletes;
    protected $dates = [ 'deleted_at' ];
    
    public function index(Request $request){
        try {
            //abort_if(Gate::denies('message_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $notifications = Notification::where('source', 1)
                            ->orderBy('id','ASC')
                            ->get();
            return view('admin.notification.index',
                        ['title' => 'Notification - SpiceBucket Administrator',
                         'notifications'=>$notifications,
                         'source'=>'Seller']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function add(){
        try {
            //abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data=[];
            $data['source'] = 1;
            $customers = Vendor::where('is_active', 1)
                                ->orderBy('id', 'ASC')
                                ->get();
            return view('admin.notification.add' , ['data'=>$data,
                                        'title' => 'Add Notification - SpiceBucket Administrator',
                                        'customers'=>$customers,
                                        'source'=>'Seller']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id){ 
        try {
          //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            $data['source'] = 1;
            $customers = Vendor::where('is_active', 1)
                                ->orderBy('id', 'ASC')
                                ->get();
            if($data['id'] != ''){
                $data['res'] = Notification::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            return view('admin.notification.add' , ['data'=>$data,
                                        'title' => 'Edit Notification - SpiceBucket Administrator',
                                        'customers'=>$customers,
                                        'source'=>'Seller']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function view($id){ 
        try {
          //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            if($data['id'] != ''){
                $data['res'] = Notification::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            return view('admin.notification.view' , ['data'=>$data,'title' => 'Edit Notification - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    function save(Request $request){
        try {
           // abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data = $request->except('_method','_token','submit');
            $rules =  [ 
                'subject' => 'required|string|min:3|unique:notifications,subject,'.$request->input('id').',id,deleted_at,NULL',
                'message' => 'required'
            ];

            if ($request->sendoption == 1) {
                $rules['customers'] =  'required';
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->Back()->withInput()->withErrors($validator);
            }
         
            if (!empty($request->customers) && ($request->sendoption == 1)) {
                $data['customers'] = implode(", ", $request->customers);
            }
            elseif ($request->sendoption == 2) {
                $sellers = Vendor::where('is_active', 1)
                                ->orderBy('id', 'ASC')
                                ->get();
                $vendors = [];
                foreach($sellers as $seller){
                    array_push($vendors, $seller->id);
                }
                $data['customers'] =  implode(", ", $vendors);
            }
            

            if($record = Notification ::create($data)){
                Session::flash('message', 'Notification has been  Successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'Data not saved!');
                Session::flash('alert-class', 'alert-danger');
            }
            return redirect("/administrator/notification/sellers");

            //$data['userList'] = UserModel::where(['user_type'=>'signage'])->get();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-success');
        }
    }

    public function list(Request $request){
        try {
            //abort_if(Gate::denies('message_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $notifications = Notification::where('source', 2)
                            ->orderBy('id','ASC')
                            ->get();
            return view('admin.notification.index',['title' => 'Notification - SpiceBucket Administrator','notifications'=>$notifications,'source'=>'Customer']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function add_customer(){
        try {
            //abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data=[];
            $data['source'] = 2;
            $customers = Customer::where('is_active', 1)
                            ->orderBy('id', 'ASC')
                            ->get();
            return view('admin.notification.add' , ['data'=>$data,
                                    'title' => 'Add Notification - SpiceBucket Administrator', 
                                    'customers'=>$customers,
                                    'source'=>'Customer']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit_customer($id){ 
        try {
          //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            $data['source'] = 2;
            $customers = Customer::where('is_active', 1)
                                ->orderBy('id', 'ASC')
                                ->get();
            if($data['id'] != ''){
                $data['res'] = Notification::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            return view('admin.notification.add' , ['data'=>$data,
                                        'title' => 'Edit Notification - SpiceBucket Administrator',
                                        'customers'=>$customers,
                                        'source'=>'Customer']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function save_customer(Request $request){
        try {
            
           // abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data = $request->except('_method','_token','submit');
            $rules =  [ 
                'subject' => 'required|string|min:3|unique:notifications,subject,'.$request->input('id').',id,deleted_at,NULL',
                'message' => 'required'
            ];

            if ($request->sendoption == 1) {
                $rules['customers'] =  'required';
            }
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->Back()->withInput()->withErrors($validator);
            }
            if (!empty($request->customers) && ($request->sendoption == 1)) {
                $data['customers'] = implode(", ", $request->customers);
            }
            elseif ($request->sendoption == 2) {
                $customers = Customer::where('is_active', 1)
                                ->orderBy('id', 'ASC')
                                ->get();
                $custmr = [];
                foreach($customers as $customer){
                    array_push($custmr, $customer->id);
                }
                $data['customers'] =  implode(", ", $custmr);
            }
            if($record = Notification ::create($data)){
                Session::flash('message', 'Notification has been  Successfully!');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'Data not saved!');
                Session::flash('alert-class', 'alert-danger');
            }
            return redirect("/administrator/notification/customers");
            //$data['userList'] = UserModel::where(['user_type'=>'signage'])->get();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-success');
        }
    }

    public function seller_notifications(Request $request){
        try {
            // //abort_if(Gate::denies('message_index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $search_id = session('vendor-loggedin-id');
            $notifications = Notification::where('source', 1)
                            ->whereRaw("find_in_set('".$search_id."',notifications.customers)")
                            ->orderBy('id','ASC')
                            ->get();
            
            /**Update notifications count */
            // $search_vendor_id = session('vendor-loggedin-id');
            $count = 0;
            foreach($notifications as $notification){
                if(!$notification->is_active)
                    $count++;
            }
            
            $request->session()->put('notificationCount', $count);

            return view('vendor.notifications.list',
                        ['title' => 'Notification - SpiceBucket Administrator',
                         'notifications'=>$notifications,
                         'source'=>'Seller']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function seller_notifications_view($id, Request $request){
        try {
          //  abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $data['id'] = $id;
            if($data['id'] != ''){
                $data['res'] = Notification::where(DB::raw('md5(id)'), $id)->first();
                $data['id'] = $data['res']->id; 
            }
            /**change status */
            // $data_update['id'] = $id;
            $data_update['is_active'] = 1;
            $wh['id'] = $data['id'];
            $data_update['updated_at'] = date('Y-m-d H:i:s');
            Notification::where($wh)->update($data_update);

            /**Update notifications count */
            $search_vendor_id = session('vendor-loggedin-id');
            $notifications = Notification::where('source', 1)
                                ->where('is_active', 0)
                                ->whereRaw("find_in_set('".$search_vendor_id."',notifications.customers)")
                                ->orderBy('id','ASC')
                                ->count();
            
            $request->session()->put('notificationCount', $notifications);

            return view('vendor.notifications.view' , ['data'=>$data,'title' => 'Edit Notification - SpiceBucket Administrator']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}