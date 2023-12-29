<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

if(!function_exists('getWishlistCountForLoggedIn')){
    
    function getWishlistCountForLoggedIn() {
        if(Session::get('customer-logged-in') == true){
            $result = DB::table('wishlist')->where('customer_id', Session::get('customer-loggedin-id'))->get();
            return count($result);
        } else {
            return 0;
        }
    }
}

if(!function_exists('getHeaderCategories')){
    
    function getHeaderCategories() {
        $headercategories = array();
        $categories = DB::table('product_category')->where('parent', 0)->where('is_active', true)->get();
        if($categories->count() > 0){
            foreach($categories as $category){
                $headercategory = array('id' => $category->id, 'slug' => $category->slug, 'image' => $category->image, 'name' => $category->name, 'children' => array());
                /*
                $subcategories = DB::table('product_category')->where('parent', $category->id)->where('is_active', true)->get();
                if($subcategories->count() > 0){
                    foreach($subcategories as $subcategory){
                        array_push($headercategory['children'], array('id' => $subcategory->id, 'slug' => $subcategory->slug, 'image' => $subcategory->image, 'name' => $subcategory->name));
                    }
                }
                */
                array_push($headercategories, $headercategory);
            }
        }
        return $headercategories;
    }
}

if(!function_exists('numberToWords')){
    function numberToWords($number){
        $no = round($number);
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
            } else {
                $str [] = null;
            }
        }

        $Rupees = implode(' ', array_reverse($str));
        $paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal % 10]) . " " . ($words[$decimal % 10]) : '';
        return ($Rupees ? 'Rupees ' . $Rupees : '') . $paise . " Only";
    }
}

if(!function_exists('ImageRender')){
    function ImageRender($image =[]){ //
        if(count($image['size'])!=2){
            echo "Image size should be 2 argument like array(200,200)";die;
        }
        if(empty($image['image'])){
           return url('/assets/imgs/no-image-placeholder.png'); // return placeholder image 
        }

        $BasePath = public_path($image['path_folder']); 
        // check here file not exit
        if(!file_exists($BasePath.$image['image'])){
            return url($image['path_folder'].$image['image']);
        }
        $imagethumpath = $image['path_folder'].'thumbnail/'.implode("_",$image['size']).'/';
        //remove null
        $imagethumpath= str_replace('null_','',$imagethumpath);
        $imagethumpath= str_replace('_null','',$imagethumpath);
        $destinationPathThumbnail = public_path($imagethumpath);
        \File::makeDirectory($destinationPathThumbnail, $mode = 0777, true, true);

        if(!file_exists($destinationPathThumbnail.$image['image'])){
           $img = \Image::make($BasePath.$image['image']);
            
           $img->resize($image['size'][0],$image['size'][1], function ($constraint) {
                $constraint->aspectRatio();
            });
           $img->save($destinationPathThumbnail.$image['image']);

        }
        return url($imagethumpath.$image['image']);
    }
     
}
