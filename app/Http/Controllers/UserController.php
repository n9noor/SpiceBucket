<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function user_list(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-view'] == 0){
            return view('wms.accessdenied');
		}
        $users = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->select('users.*', 'roles.rolename')->get();
        return view('users.list', ['title' => 'Users - SpiceBucket Administration', 'users' => $users]);
    }

    public function role_list(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-view'] == 0){
            return view('wms.accessdenied');
		}
        $roles = Role::all();
        return view('roles.list', ['title' => 'Roles - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function user_add()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-add'] == 0){
            return view('wms.accessdenied');
		}
        $roles = Role::all();
        return view('users.add', ['title' => 'Add User - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function user_edit(User $user)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-edit'] == 0){
            return view('wms.accessdenied');
		}
        $roles = Role::all();
        return view('users.edit', ['title' => 'Edit User - SpiceBucket Administration', 'user' => $user, 'roles' => $roles]);
    }

    public function user_save(UserFormRequest $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-add'] == 0){
            return view('wms.accessdenied');
		}
        $user = new User;
        $validateData = $request->validated();
        $user->firstname = $validateData['firstname'];
        $user->lastname = $validateData['lastname'];
        $user->emailid = $validateData['emailid'];
        $user->phone = $validateData['phone'];
        $user->role_id = $validateData['role_id'];
        $user->password = Hash::make($request->password);
        $role = Role::find($validateData['role_id']);
        $user->design_property = $role->design_property;
        $user->property = $role->property;
        $user->save();
        return redirect('/administrator/users')->with('message', 'User Added Successfully.');
    }

    public function user_update(UserFormRequest $request, $user)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-edit'] == 0){
            return view('wms.accessdenied');
		}
        $user = User::findOrFail($user);
        $validateData = $request->validated();
        $user->firstname = $validateData['firstname'];
        $user->lastname = $validateData['lastname'];
        $user->emailid = $validateData['emailid'];
        $user->phone = $validateData['phone'];
        $user->role_id = $validateData['role_id'];
        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/administrator/users')->with('message', 'User Updated Successfully.');
    }

    public function user_delete($user)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-list-delete'] == 0){
            return view('wms.accessdenied');
		}
        DB::table('users')->delete($user);
        return redirect('/administrator/users')->with('message', 'User Deleted Successfully.');
    }

    public function role_add()
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-add'] == 0){
            return view('wms.accessdenied');
		}
        $roles = Role::all();
        return view('roles.add', ['title' => 'Add role - SpiceBucket Administration', 'roles' => $roles]);
    }

    public function role_edit(Role $role)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-edit'] == 0){
            return view('wms.accessdenied');
		}
        $roles = Role::all();
        return view('roles.edit', ['title' => 'Edit role - SpiceBucket Administration', 'role' => $role, 'roles' => $roles, 'permission' => json_decode($role->property, true)]);
    }

    public function role_save(Request $request)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-add'] == 0){
            return view('wms.accessdenied');
		}
        $role = new Role;
        $this->validate($request, [
            'rolename' => 'required|unique:roles,rolename',
        ]);
        $role->rolename = $request->rolename;
        $role->description = $request->description;
        $role->parent = $request->parent;
        $role->design_property = '{"fixed-header": "1", "fixed-sidebar": "1", "fixed-footer": "1", "switch-header-cs-class": "bg-midnight-bloom header-text-light", "switch-sidebar-cs-class": "bg-midnight-bloom sidebar-text-light", "page-switch-theme-class": "body-tabs-shadow", "switch-theme-class": "app-theme-white"}';
        $role->property = json_encode($request->permission);
        $role->save();
        return redirect('/administrator/roles')->with('message', 'Role Added Successfully.');
    }

    public function role_update(Request $request, $role)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-edit'] == 0){
            return view('wms.accessdenied');
		}
        $role = Role::findOrFail($role);
        $this->validate($request, [
            'rolename' => 'required|unique:roles,rolename,' . $role->id,
        ]);
        $role->rolename = $request->rolename;
        $role->description = $request->description;
        $role->property = json_encode($request->permission);
        $role->save();
		
		User::where('role_id', $role->id)->update(['property' => json_encode($request->permission)]);
        return redirect('/administrator/roles')->with('message', 'Role Updated Successfully.');
    }

    public function role_delete($role)
    {
        if (Session::get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please log in.");
        }
		if(Session::get('admin-loggedin-property')['users-department-delete'] == 0){
            return view('wms.accessdenied');
		}
        DB::table('roles')->delete($role);
        return redirect('/administrator/roles')->with('message', 'Role Deleted Successfully.');
    }
}
