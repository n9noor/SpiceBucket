<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorRazorpayController extends Controller
{
    public function razorpay()
    {        
        return view('razor.index');
    }

    public function payment(Request $request)
    {        
        $input = $request->all();        
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
                $request->session()->put('error',$e->getMessage());
                return redirect()->back();
            }            
        }
        
        $request->session()->put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}
