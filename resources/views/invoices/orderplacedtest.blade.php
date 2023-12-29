<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <style>
        
        table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
            max-width: 700px;
  border: 1px solid #ddd;
            padding: 20px;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
        
        
       
         td {
         padding: 6px;
         }
         .social_icons a{
         margin: 0px 16px;
         }
         .fa-brands {
         font-size: 28px;
         color: white;
         }
        
        /*#invoice { width: 19cm; padding: 1cm; }
          */
         
     </style>
    <div id="invoice" class="" style="width: 700px; display: inline-block; margin: 0px auto; border: 1px solid #dddddd;">
        <div style="display: grid; justify-content: space-between; align-items: center; width: 700px;" width="700">
            <div class="top-invice" style="float: left; width: 30%;">
                <a href="{{env('APP_URL')}}" style="text-align:center;" target="_blank" data-saferedirecturl="https://www.google.com/url?q={{env('APP_URL')}}&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_">
                    <img src="{{env('APP_URL')}}/assets/imgs/logoSB.png" height="80" width="150" alt="Spice Bucket" style="border:none" class="CToWUd" data-bit="iit">
                </a>
            </div>
            <div style="width: 70%; padding:10px; text-align: right; float: right; display: inline-block;">
                <p style="font-size: 12px;">Spice Bucket Invoice ID: <strong>{{$orderID}}</strong></p>
                <p style="font-size: 12px;">Invoice Date : <strong>{{date('d/M/Y h:i A', strtotime($orderDateTime))}}</strong></p>
            </div>
        </div>
        
        
        
        <div style="width: 695px; margin: 0px auto;">
            <br />
            <p>Dear {{Session::get('customer-loggedin-name')}}</p>
            <p style="font-size: 12px;">
                Thank you for your order on
                <a href="{{env('APP_URL')}}" target="_blank" data-saferedirecturl="https://www.google.com/url?q={{env('APP_URL')}}&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_">{{env('APP_URL')}}</a> Your order has been successfully placed. Please do save your order number as to track your order status and it will be referenced in your communication with us.
            </p>

            <p style="text-align:center; font-size: 12px;"><strong>Below, you will find details for the items that you have ordered with us.</strong></p>
        </div>

        
            @php
        $totalSubCartAmount = $totalGST = $totalCartAmount = $totalBaseShippingPrice = $totalGSTShippingPrice = 0;
        @endphp
        @foreach($vendorWiseDetail as $vendorDetail)
        
        <div style="border:2px solid #858585; padding: 10px; width: 670px; margin: 0px auto;">
            <p>
                <strong style="float: left; font-size: 16px;">
                {{$vendorDetail['vendor_alias']}}
                </strong>
                <strong style="float: right; font-size: 12px;">
                    Seller Order No: 
                </strong>
            </p>
            <table cellpadding="5" cellspacing="0" border="1" width="" style="text-align: center; border: solid 1px #a8a8a8;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left; width: 685px;">
                <thead style="font-weight: 800px; color: #000;">
                    <tr style="background-color:#f2f2f2">
                        <th style="text-align: center;">S.no</th>
                        <th style="text-align: center;">Image</th>
                        <th>Product Information</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">GST</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $vendortotal = 0; $vendorGSTTotal = 0; $vendorsubTotal = 0; $vendorshippingGST = 0; $vendorShippingCharge = 0;
                    @endphp
                    @foreach($vendorDetail['products'] as $product)
                    <tr style="color: #454141;">
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">
                          
                            @php $imagearray=array('path_folder'=>'/images/products/','image'=>$product['productImage'],'size'=>[100,100]);

                       @endphp 
                      
                      <img src="{{ImageRender($imagearray)}}" alt="" height="auto" width="70" class="CToWUd" data-bit="iit"> 
                        </td>
                        <td>
                            <strong>{{$product['productname']}}</strong>
                            <br>{{$vendorDetail['store_name']}}
                            <br>{{$product['sku']}}
                            <br>
                            @if(!is_null($product['productvariantname1']) && !is_null($product['variantvalue1']))
                            {{$product['productvariantname1']}}: {{$product['variantvalue1']}}
                            @endif
                            @if(!is_null($product['productvariantname2']) && !is_null($product['variantvalue2']))
                            , {{$product['productvariantname2']}}: {{$product['variantvalue2']}}
                            @endif
                            @if(!is_null($product['productvariantname3']) && !is_null($product['variantvalue3']))
                            , {{$product['productvariantname3']}}: {{$product['variantvalue3']}}
                            @endif
                        </td>
                        <td style="text-align: center;">
                        <i class="fa fa-rupee-sign"></i> {{number_format($product['productprice'],2)}}
                        </td>
                        <td style="text-align: center;">
                        <i class="fa fa-rupee-sign"></i> {{number_format($product['perproductgst'],2)}}
                        </td>
                        <td style="text-align: center;">{{$product['productqty']}}</td>
                        <td style="text-align: center;">
                            @php
                            $totalcartamount = ($product['productprice'] + $product['perproductgst']) * $product['productqty'];
                            $vendorsubTotal += $product['productprice'] * $product['productqty'];
                            $vendortotal += $totalcartamount;
                            $vendorGSTTotal += $product['perproductgst'] * $product['productqty'];
                            if($vendorshippingGST < $product['gst_rate']){
                                $vendorshippingGST = $product['gst_rate'];
                            }
                            $vendorShippingCharge = $product['shippingCharge'];
                            @endphp
                            <i class="fa fa-rupee-sign"></i> {{number_format($totalcartamount,2)}}
                        </td>
                    </tr>
                    @endforeach
                    @php
                    $baseshippingprice = round(($vendorShippingCharge * 100) / (100 + $vendorshippingGST), 2); 
                    $gstshippingprice = round(($vendorShippingCharge - $baseshippingprice), 2);

                    $totalSubCartAmount += $vendorsubTotal;
                    $totalGST += $vendorGSTTotal;
                    $totalCartAmount += $vendortotal;
                    $totalBaseShippingPrice += $baseshippingprice;
                    $totalGSTShippingPrice += $gstshippingprice;
                    @endphp
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between; align-items: center; width:660px; ">
                <div style="width:280px">
                    &nbsp;
                </div>
                <div style="width: 350; float: right">
                    <table style="width: 100%; border: 1px solid #454141; color:#000; float:right; font-size: 10px; border-top: none !important; ">
                        <tr style="border-bottom: 2px solid #454141;">
                            <td>Subtotal:</td>
                            <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format($vendorsubTotal, 2)}}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid #454141 ;">
                            <td>Tax:</td>
                            <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format(($vendorGSTTotal + $gstshippingprice), 2)}}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid #454141 ;">
                            <td>Shipping Fee:</td>
                            <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format($baseshippingprice, 2)}}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid #454141 ;">
                            <td><b>Total Amount:</b></td>
                            <td style="float: right ;"><b>{{number_format(($vendortotal + $vendorShippingCharge), 2)}}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
        @endforeach

        <div style="display: flex; position: relative; justify-content: space-between; align-items: center; border: 1px solid #454141; color:#000; font-size: 13px; border-top: none !important; width: 695px;  ">
            <div style="width: 350px; ">
                <div style="text-align:center; margin-top: 5px;">

                    <p>Thanks again for giving us the opportunity to serve you.We look forward to the next time you shop with us!</p>

                    <h3> Spice Bucket Team</h3>
                </div>
                <p style="float: right; position: absolute; bottom: 0; left: 20px;">*Terms & Conditions Accepted </p>
            </div>

            <div style="width: 350px; ">

                <table style="width: 300px; float: right; border: 1px solid #454141; color:#000; font-size: 13px; border-top: none !important; ">
                    <tr style="border-bottom: 2px solid #454141;">
                        <td>Sub Total:</td>
                        <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format(($totalSubCartAmount), 2)}}</td>

                    </tr>
                    <tr style="border-bottom: 2px solid #454141 ;">
                        <td>Tax:</td>
                        <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format(($totalGST + $totalGSTShippingPrice), 2)}}</td>

                    </tr>
                    <tr style="border-bottom: 2px solid #454141 ;">
                        <td>Discount:</td>
                        <td style="float: right ;"> (-) <i class="fa fa-rupee-sign"></i> {{number_format(($discountAmount), 2)}}</td>

                    </tr>
                    <tr style="border-bottom: 2px solid #454141 ;">
                        <td>Shipping Fee:</td>
                        <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format(($totalBaseShippingPrice), 2)}}</td>

                    </tr>
                    <tr style="border-bottom: 2px solid #454141 ;">
                        <td>COD:</td>
                        <td style="float: right ;"><i class="fa fa-rupee-sign"></i> {{number_format(($cod_charges), 2)}}</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #454141 ;">
                        <td><b>Grand Total:</b></td>
                        <td style="float: right ; color: red;"><b><i class="fa fa-rupee-sign"></i> {{number_format(($totalCartAmount + $totalBaseShippingPrice + $totalGSTShippingPrice + $cod_charges - $discountAmount), 2)}}</b></td>
                    </tr>
                </table>




            </div>
        </div>










        <div style="text-align:center; width:695px; ">
            <br />
            <p>In case you have any questions or feedback, please call us at </p>
            <a href="tel:7247247070" style="text-decoration:none;color:#0d88ce" target="_blank">
                <strong>7247247070</strong>
            </a>, or you can also write to us on


            <strong>
                <a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a>
            </strong>
            <div class="social_icons" style="background-color: #454141; margin-top: 20px; display: flex; align-items: center; padding: 10px 25px; justify-content: center; width: 695px;" class="mobile-social-icon">
                <a href="#">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <!-- <img  height="24" width="24" src="{{env('APP_URL')}}/assets/imgs/theme/icons/icon-facebook-white.svg" alt=""></a></li> -->

                <a class="instagram" href="https://www.instagram.com/spicebucketonline/">
                    <i class="fa-brands fa-instagram"></i>
                    <!-- <img  height="24" width="24" src="{{env('APP_URL')}}/assets/imgs/theme/icons/icon-instagram-white.svg" alt=""> -->
                </a>

                <a class="linkedin" href="https://www.linkedin.com/company/spice-bucket-e-retail-pvt-ltd/">
                    <i class="fa-brands fa-linkedin"></i>
                    <!-- <img  height="24" width="24" src="{{env('APP_URL')}}/public/images/staticImages/static-linkedin-image-1686249957.png" alt=""> -->
                </a>

                <a class="twitter" href="https://twitter.com/BucketSpices">
                    <i class="fa-brands fa-twitter"></i>
                    <!-- <img  height="24" width="24" src="{{env('APP_URL')}}/assets/imgs/theme/icons/icon-twitter-white.svg" alt=""> -->
                </a>

                <a class="pintrest" href="https://in.pinterest.com/spicebucketonline/_saved/">
                    <i class="fa-brands fa-pinterest"></i>
                    <!-- <img  height="24" width="24" src="{{env('APP_URL')}}/assets/imgs/theme/icons/icon-pinterest-white.svg" alt=""> -->
                </a>

                <a class="youtube" href="https://www.youtube.com/channel/UCEILpLNAKcwQWcotRiGSWVw">
                    <i class="fa-brands fa-youtube"></i>
                    <!-- <img height="24" width="24" src="{{env('APP_URL')}}/assets/imgs/theme/icons/icon-youtube-white.svg" alt=""> -->
                </a>
            </div>
        </div>

</body>

</html>