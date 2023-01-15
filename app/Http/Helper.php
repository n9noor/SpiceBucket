<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

if(!function_exists('getFinancialYear')) {
    
    function getFinancialYear($inputDate, $format="Y"){
        $date=date_create($inputDate);
        if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
            $financial_year = (date_format($date,$format)) . '-' . (date_format($date,$format)+1);
        } else {//On or Before March (FY is previous year - current year)
            $financial_year = (date_format($date,$format)-1) . '-' . date_format($date,$format);
        }
        
        return $financial_year;
    }
    
}

if(!function_exists('sendSMS')) {
    
    function sendSMS($phonenumber = array(), $message = '') {
        $apikey = "Ad5ec6f7afbd00f675543f6fd607c0ad8";
        if(!is_array($phonenumber)) {
            $url = "https://alerts.prioritysms.com/api/v4/?api_key=" . $apikey;
            $url.= "&method=sms&message=" . urlencode($message) . "&to=" . urlencode($phonenumber) . "&sender=SPIBUK";
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST'
            ));
            
            $smsresponse = curl_exec($curl);
            curl_close($curl);
            
            return $smsresponse;
        } else {
            $smsresponse = array();
            foreach($phonenumber as $phone) {
                $url = "https://alerts.prioritysms.com/api/v4/?api_key=" . $apikey;
                $url.= "&method=sms&message=" . urlencode($message) . "&to=" . urlencode($phone) . "&sender=SPIBUK";
                
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST'
                ));
                
                $smsresponse[$phone] = curl_exec($curl);
                curl_close($curl);
            }
            return $smsresponse;
        }
    }
    
}

if(!function_exists('getRandomGeneratedString')){
    
    function getRandomGeneratedString($length) {
        $token = Str::random($length);
        $result = DB::table('customers')->where('token_id', $token)->first();
        if(is_null($result)){
            return $token;
        } else {
            return getRandomGeneratedString($length);
        }
    }
}