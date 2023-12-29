<link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
<div style="width:100%!important;background-color:#f5f5f5;margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;color:#000;height:100%;min-width:100%;font-size:14px">
    <div style="background-color:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#000000;height:100%;margin:0;">
        <div align="center" style="margin:0 auto">
            <div style="text-align:center;background-color:#ffffff;margin-top:1.0em">
                <table cellpadding="5" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;border-bottom:solid 4px #e2e2e2;font-size:12px;text-align:left">
                    <tbody>
                        <tr>
                            <td style="text-align:center;padding-bottom:10px"><a href="https://www.spicebucket.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.spicebucket.com&amp;source=gmail&amp;ust=1680422534579000&amp;usg=AOvVaw0oNoBGzzkYcI72kv5k9gGS"><img src="https://ci5.googleusercontent.com/proxy/9DsxyyU0txh-drwJ7Dzvv1jvH-MQBCmnmPItWKZ1yV4AgMq7_sKeqUBu4wrlOSJVRb06FYSdWJkSwHwpr8YRbdMS1VBhAPjN7LkInTvGPYupNZNdGDnRndhAkM0lR2-IEXyUzZ3QdOaFTYpfnf-YOee3oFPBPt4=s0-d-e1-ft#https://cdn.shopaccino.com/spicebucket/images/footer-logo-spicebucket-222236_logo.png?ver=2087277848" alt="Spice Bucket" style="border:none" class="CToWUd" data-bit="iit"></a></td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;padding-top:10px">Dear {{Session::get('customer-loggedin-name')}}</td>
                        </tr>
                        <tr>
                            <td>We are pleased to inform you that your order has been shipped from Spice Bucket and is on its way to you!
                                You can track your order using below details. Please allow up to 24 hours for tracking to get activated on our
                                shipping partner website.
                                Order shipping via: DTDC
                                Order tracking URL: <a href="http://www.dtdc.in/tracking/shipment-tracking.asp">http://www.dtdc.in/tracking/shipment-tracking.asp</a>
                                <!-- Order tracking No: D53243953 -->
                            </td>
                        </tr>
                        <tr>
                            <td>Below, you will find details for the items that you have ordered with us.</td>
                        </tr>
                        <tr>
                            <td>
                                @php $totalGST = 0;
                                $totalAmount = 0;
                                $discountCart = 0;
                                $vendorTotalAmount =0; @endphp
                                @foreach($vendorWiseDetail as $vendorDetail)
                                <table cellpadding="5" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;text-align:left">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Order No: {{$vendorDetail['orderID']}}</strong>
                                                <br>
                                                <strong>Order Date: {{date('d/M/Y h:i A', strtotime($vendorDetail['orderDateTime']))}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:45%">
                                                <table cellpadding="3" cellspacing="0" border="0" width="100%" style="border:solid 1px #f2f2f2;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color:#f2f2f2"><strong>Billing Information</strong></td>
                                                        </tr>
                                                        {!! $vendorDetail['customerbillinginfo'] !!}
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="width:45%;padding-left:25px;vertical-align:top">
                                                <table cellpadding="3" cellspacing="0" border="0" width="100%" style="border:solid 1px #f2f2f2;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color:#f2f2f2"><strong>Shipping Information</strong></td>
                                                        </tr>
                                                        {!! $vendorDetail['customershippinginfo'] !!}
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="5" cellspacing="0" border="1" width="100%" style="border:solid 1px #f2f2f2;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
                                    <thead>
                                        <tr style="background-color:#f2f2f2">
                                            <th>Image</th>
                                            <th>Product Information</th>
                                            <th>Price</th>
                                            <th>GST</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $subTotalCartAmount = 0;
                                        @endphp
                                        @foreach($vendorDetail['products'] as $product)
                                        <tr>
                                            <td><img src="{{ env('APP_ENV') == 'production' ? url('/public/images/products/' . $product['productImage']) : url('/images/products/' . $product['productImage']) }}" alt="" style="max-width:100px" class="CToWUd" data-bit="iit"></td>
                                            <td><strong>{{$product['productname']}}</strong><br>{{$product['store_name']}}<br><br>{{$product['sku']}}<br>
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
                                            <td><i class="fa fa-rupee-sign"></i> {{number_format($product['productprice'],2)}}</td>
                                            <td><i class="fa fa-rupee-sign"></i> {{number_format($product['perproductgst'],2)}}</td>
                                            <td>{{$product['productqty']}}</td>
                                            @php
                                            $totalcartamount = ($product['productprice'] + $product['perproductgst']) * $product['productqty'];
                                            $totalGST += $product['perproductgst'] * $product['productqty'];
                                            $subTotalCartAmount += $totalcartamount;
                                            @endphp
                                            <td><i class="fa fa-rupee-sign"></i> {{number_format($totalcartamount,2)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                            <td colspan="2"><strong>Sub Total</strong></td>
                                            <td><i class="fa fa-rupee-sign"></i> {{number_format($subTotalCartAmount,2)}}</td>
                                        </tr>
                                    </tbody>

                                </table>

                                @endforeach
                            </td>
                            <table cellpadding="5" cellspacing="0" border="1" width="100%" style="border:solid 1px #f2f2f2;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
                                <tr>
                                    <td style="width: 760px;">&nbsp;</td>
                                    <td><strong>Grand Sub Total</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> {{number_format($orderDetail[0]->paymentAmount,2)}} </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>GST</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> {{number_format($totalGST,2)}}</td>
                                </tr>
                                <!-- @if($orderDetail[0]->cartDiscount > 0 )
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>Discount</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> (-) {{number_format($orderDetail[0]->cartDiscount,2)}}</td>
                                </tr>
                                @endif -->
                                @if($orderDetail[0]->cartDeliveryCharge > 0)
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>Shipping</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> {{number_format($orderDetail[0]->cartDeliveryCharge,2)}}</td>
                                </tr>
                                @endif
                                @if($orderDetail[0]->codOnCart > 0)
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>COD</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> {{number_format($orderDetail[0]->codOnCart,2)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><i class="fa fa-rupee-sign"></i> {{number_format(($subTotalCartAmount + $orderDetail[0]->cartDeliveryCharge + $orderDetail[0]->codOnCart), 2)}} </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <td>Thanks again for giving us the opportunity to serve you.</td>
                        </tr>
                        <tr>
                            <td>We look forward to the next time you shop with us!</td>
                        </tr>
                        <tr>
                            <td>The Spice Bucket team</td>
                        </tr>
                        <tr>
                            <<td style="font-size:13px;border-top:solid 1px #dddddd;padding-top:10px;padding-bottom:10px">In case you have any questions or feedback, please call us at <a href="tel:7247247070" style="text-decoration:none;color:#0d88ce"><strong>7247247070</strong></a>, or you can also write to us on <strong> <a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear:both"></div>
            <div style="padding-top:20px;background-color:#f5f5f5">
                <a href="https://www.facebook.com/spicebucketonline" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/spicebucketonline&amp;source=gmail&amp;ust=1680422534580000&amp;usg=AOvVaw0goWlw_msdsvZz8SZ1GTl0"><img src="https://ci5.googleusercontent.com/proxy/y-h3fbCcfitcdkSQuyNMONwS6A4IpE42Ei53Q40KQJ-pSRVpXYjWDGelEZ_pzGnF4bo8cOf6WQmt-HeaxYGV4PIw9AUzAdhvFRoRZjV33G9y=s0-d-e1-ft#https://www.shopaccino.net/emails/mailimages/facebook-icon.png" alt="Facebook" border="0" style="vertical-align:middle" title="Facebook" class="CToWUd" data-bit="iit"></a><a href="https://twitter.com/BucketSpices" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/BucketSpices&amp;source=gmail&amp;ust=1680422534580000&amp;usg=AOvVaw1FLukQ2Ut70NJJEQwdY0wM"><img src="https://ci4.googleusercontent.com/proxy/zwuiY29gg29rKfOF4oW1oep8GSTkAqgTp0YERYiWF7S3OAIjP1xu_lQX6VeMRjNCHex8V9ixhTWUtt08cCU07WO4cf6upbjiPvMcLWxdi6Y=s0-d-e1-ft#https://www.shopaccino.net/emails/mailimages/twitter-icon.png" alt="Twitter" border="0" style="vertical-align:middle" title="Twitter" class="CToWUd" data-bit="iit"></a> <a href="https://in.pinterest.com/spicebucketonline/_saved/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://in.pinterest.com/spicebucketonline/_saved/&amp;source=gmail&amp;ust=1680422534580000&amp;usg=AOvVaw0EwKAOqAL84XOlJSuxxaWm"><img src="https://ci3.googleusercontent.com/proxy/G8HHqQxBMzycwNh_e0i_yVgDTUPhW-KfV7waqNDy2wGr5KGanyCyNMqB0SNsrWM3kxN8bFIqRL0iGM8SbrgSbIoMdFwzchEYswpu8_eKvWTD3A=s0-d-e1-ft#https://www.shopaccino.net/emails/mailimages/pinterest-icon.png" alt="Pinterest" border="0" style="vertical-align:middle" title="Pinterest" class="CToWUd" data-bit="iit"></a>
                <div style="border-collapse:collapse;font-size:12px;color:#bdbdbd;line-height:18px;padding-top:10px;margin-bottom:2.5em">© 2023 Spice Bucket.</div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>