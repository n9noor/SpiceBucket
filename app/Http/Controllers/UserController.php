<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function user_list(Request $request) {
        if($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        $users = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->select('users.*', 'roles.rolename')->get();
        return view('users.list', ['title' => 'Users - SpiceBucket Administration', 'users' => $users]);
    }
    
    public function role_list(Request $request) {
        if($request->session()->get('admin-logged-in') == false) {
            return redirect('/administrator/login')->with('message', "Please logged in.");
        }
        $roles = Role::all();
        return view('roles.list', ['title' => 'Roles - SpiceBucket Administration', 'roles' => $roles]);
    }
    
    public function user_add(){
        $roles = Role::all();
        return view('users.add', ['title' => 'Add User - SpiceBucket Administration', 'roles' => $roles]);
    }
    
    public function user_edit(User $user){
        $roles = Role::all();
        return view('users.edit', ['title' => 'Edit User - SpiceBucket Administration', 'user' => $user, 'roles' => $roles]);
    }
    
    public function user_save(UserFormRequest $request){
        $user = new User;
        $validateData = $request->validated();
        $user->firstname = $validateData['firstname'];
        $user->lastname = $validateData['lastname'];
        $user->emailid = $validateData['emailid'];
        $user->phone = $validateData['phone'];
        $user->role_id = $validateData['role_id'];
        $user->password = Hash::make($request->password);
        $user->design_property = '{"fixed-header": "1", "fixed-sidebar": "1", "fixed-footer": "1", "switch-header-cs-class": "bg-midnight-bloom header-text-light", "switch-sidebar-cs-class": "bg-midnight-bloom sidebar-text-light", "page-switch-theme-class": "body-tabs-shadow", "switch-theme-class": "app-theme-white"}';
        $user->save();
        return redirect('/administrator/users')->with('message', 'User Added Successfully.');
    }
    
    public function user_update(UserFormRequest $request, $user){
        $user = User::findOrFail($user);
        $validateData = $request->validated();
        $user->firstname = $validateData['firstname'];
        $user->lastname = $validateData['lastname'];
        $user->emailid = $validateData['emailid'];
        $user->phone = $validateData['phone'];
        $user->role_id = $validateData['role_id'];
        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/administrator/users')->with('message', 'User Updated Successfully.');
    }

    public function user_delete($user){
        DB::table('users')->delete($user);
        return redirect('/administrator/users')->with('message', 'User Deleted Successfully.');
    }
}
