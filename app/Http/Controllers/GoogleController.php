<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback(Request $request)
    {
        try {
            
            $user = Socialite::driver('google')->user();
            
            $finduser = Customer::where('google_id', $user->id)->orWhere('emailid', $user->email)->first();
            
            if ( $finduser ) {
                if(empty($finduser->google_id) || empty($finduser->emailid)) {
                    $update = array();
                    if(empty( $finduser->google_id) ) {
                        $update['google_id'] = $user->id;
                    }
                    if(empty( $finduser->emailid) ) {
                        $update['emailid'] = $user->email;
                    }
                    Customer::where('id', $finduser->id)->update($update);
                }
                $request->session()->put('customer-logged-in', true);
                $request->session()->put('customer-loggedin-name', $finduser->name);
                $request->session()->put('customer-loggedin-email', $finduser->emailid);
                return redirect()->intended('/dashboard');
            } else {
                $newUser = Customer::create([
                    'name' => $user->name,
                    'emailid' => $user->email,
                    'google_id'=> $user->id
                ]);
                $request->session()->put('customer-logged-in', true);
                $request->session()->put('customer-loggedin-name', $user->name);
                $request->session()->put('customer-loggedin-email', $user->email);
                return redirect()->intended('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
