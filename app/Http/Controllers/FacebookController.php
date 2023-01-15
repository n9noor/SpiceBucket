<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleFacebookCallback(Request $request) {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = Customer::where('facebook_id', $user->id)->orWhere('emailid', $user->email)->first();
            if($finduser){
                if(empty($finduser->google_id) || empty($finduser->emailid)) {
                    $update = array();
                    if(empty($finduser->facebook_id) ) {
                        $update['facebook_id'] = $user->id;
                    }
                    if(empty($finduser->emailid) ) {
                        $update['emailid'] = $user->email;
                    }
                    Customer::where('id', $finduser->id)->update($update);
                }
                $request->session()->put('customer-logged-in', true);
                $request->session()->put('customer-loggedin-name', $finduser->name);
                $request->session()->put('customer-loggedin-email', $finduser->emailid);
                return redirect()->intended('/dashboard');
            }else{
                $newUser = Customer::create([
                    'emailid' => $user->email,
                    'name' => $user->name,
                    'facebook_id'=> $user->id
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
