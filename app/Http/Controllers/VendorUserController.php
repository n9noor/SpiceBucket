<?php

namespace App\Http\Controllers;

use App\Models\VendorsRole;
use App\Models\VendorsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VendorUserController extends Controller
{

    public function user_list(Request $request)
    {
        if ($request->session()->get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please logged in.");
        }
        $users = DB::table('vendors_users')->join('vendors_roles', 'vendors_roles.id', '=', 'vendors_users.role_id')->where('vendors_users.vendor_id', $request->session()->get('vendor-loggedin-id'))->select('vendors_users.*', 'vendors_roles.rolename')->get();
        return view('users.vendor_list', ['title' => 'Users - SpiceBucket Vendors', 'users' => $users]);
    }

    public function role_list(Request $request)
    {
        if ($request->session()->get('vendor-logged-in') == false) {
            return redirect('/sellers/login')->with('message', "Please logged in.");
        }
        $roles = VendorsRole::where('vendor_id', $request->session()->get('vendor-loggedin-id'))->get();
        return view('roles.vendor_list', ['title' => 'Roles - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function user_add()
    {
        $roles = VendorsRole::where('vendor_id', Session::get('vendor-loggedin-id'))->get();
        return view('users.vendor_add', ['title' => 'Add User - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function user_edit(VendorsUser $user)
    {
        $roles = VendorsRole::where('vendor_id', Session::get('vendor-loggedin-id'))->get();
        return view('users.vendor_edit', ['title' => 'Edit User - SpiceBucket Administration', 'user' => $user, 'roles' => $roles]);
    }

    public function user_save(Request $request)
    {
        $user = new VendorsUser();
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => '',
            'emailid' => "required|unique:vendors_users,emailid",
            'role_id' => 'required',
            'phone' => "unique:vendors_users,phone"
        ]);
        $user->vendor_id = Session::get('vendor-loggedin-id');
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->emailid = $request->emailid;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->design_property = '{"fixed-header": "1", "fixed-sidebar": "1", "fixed-footer": "1", "switch-header-cs-class": "bg-midnight-bloom header-text-light", "switch-sidebar-cs-class": "bg-midnight-bloom sidebar-text-light", "page-switch-theme-class": "body-tabs-shadow", "switch-theme-class": "app-theme-white"}';
        $user->save();
        return redirect('/sellers/users')->with('message', 'User Added Successfully.');
    }

    public function user_update(Request $request, $user)
    {
        $user = VendorsUser::findOrFail($user);
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => '',
            'emailid' => "required|unique:vendors_users,emailid,{$user->id}",
            'role_id' => 'required',
            'phone' => "unique:vendors_users,phone,{$user->id}"
        ]);
        $user->vendor_id = Session::get('vendor-loggedin-id');
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->emailid = $request->emailid;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/sellers/users')->with('message', 'User Updated Successfully.');
    }

    public function user_delete($user)
    {
        DB::table('users')->delete($user);
        return redirect('/sellers/users')->with('message', 'User Deleted Successfully.');
    }

    public function role_add()
    {
        $roles = VendorsRole::where('vendor_id', Session::get('vendor-loggedin-id'))->get();
        return view('roles.vendor_add', ['title' => 'Add role - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function role_edit(VendorsRole $role)
    {
        $roles = VendorsRole::where('vendor_id', Session::get('vendor-loggedin-id'))->get();
        return view('roles.vendor_edit', ['title' => 'Edit role - SpiceBucket Administration', 'role' => $role, 'roles' => $roles]);
    }

    public function role_save(Request $request)
    {
        $role = new VendorsRole;
        $this->validate($request, [
            'rolename' => 'required|unique:vendors_roles,rolename',
        ]);
        $role->vendor_id = Session::get('vendor-loggedin-id');
        $role->rolename = $request->rolename;
        $role->description = $request->description;
        $role->parent = $request->parent;
        $role->design_property = '{"fixed-header": "1", "fixed-sidebar": "1", "fixed-footer": "1", "switch-header-cs-class": "bg-midnight-bloom header-text-light", "switch-sidebar-cs-class": "bg-midnight-bloom sidebar-text-light", "page-switch-theme-class": "body-tabs-shadow", "switch-theme-class": "app-theme-white"}';
        $role->save();
        return redirect('/sellers/roles')->with('message', 'Role Added Successfully.');
    }

    public function role_update(Request $request, $role)
    {
        $role = VendorsRole::findOrFail($role);
        $this->validate($request, [
            'rolename' => 'required|unique:vendors_roles,rolename,' . $role->id,
        ]);
        $role->vendor_id = Session::get('vendor-loggedin-id');
        $role->rolename = $request->rolename;
        $role->description = $request->description;
        $role->save();
        return redirect('/sellers/roles')->with('message', 'Role Updated Successfully.');
    }

    public function role_delete($role)
    {
        DB::table('roles')->delete($role);
        return redirect('/sellers/roles')->with('message', 'Role Deleted Successfully.');
    }
}
