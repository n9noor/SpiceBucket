<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function __construct()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
    }

    public function index()
    {
		if(Session::get('admin-loggedin-property')['customer-view'] == 0){
			return view('wms.accessdenied');
		}
        $customers = Customer::join('customer_address', 'customer_address.customer_id', '=', 'customers.id')->join('pincode_master', 'pincode_master.pincode', '=', 'customer_address.pincode')->whereNotNull('customers.phone')->whereNotNull('customers.emailid')->select('customers.name', 'customers.phone', 'customers.emailid', 'pincode_master.city', 'pincode_master.state', 'customer_address.pincode')->get();
        return view('customer.list', ['title' => 'Spicebucket Administrator | Customers', 'customers' => $customers]);
    }
}
