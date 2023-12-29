<div style="width:100%!important;background-color:#f5f5f5;margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;color:#000;height:100%;min-width:100%;font-size:14px">
    <div style="background-color:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#000000;height:100%;margin:0;padding-left:15px;padding-right:15px">
        <div align="center" style="margin:0 auto">
            <div style="text-align:center;background-color:#ffffff;margin-top:1.0em">
                <table cellpadding="5" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;border-bottom:solid 4px #e2e2e2;font-size:12px;text-align:left">
                    <tbody>
                        <tr>
                            <td style="text-align:left; width: 200px; padding-bottom:10px"><a href="https://www.spicebucket.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.spicebucket.com&amp;source=gmail&amp;ust=1680422535512000&amp;usg=AOvVaw1X5YYl_z0V_M7KhhybF0hd"><img src="https://ci3.googleusercontent.com/proxy/R6TWyZyK0MxoF7BM2sSPeil-YZRzAZp6eX6UdCd6L8N59mXH_-0LZCHSt5lfErcLPx5BECKI40eTplp2tkDhxr44cSM2w6kb_l-gdle6ReczICZ1Z3GHDsag3phMgzR1_hF8knsgW-zQFDhnjoUBGnRHyg8N=s0-d-e1-ft#https://cdn.shopaccino.com/spicebucket/images/footer-logo-spicebucket-222236_logo.png?ver=47581691" alt="Spice Bucket" style="border:none" class="CToWUd" data-bit="iit"></a></td>
                        </tr>
                       
                        <tr>
                            <td style="font-weight:bold;padding-top:10px">Dear {{Session::get('customer-loggedin-name')}}</td>
                        </tr>
                        <tr>
                            <td>As per your request, your order : {{$orderDetail[0]->orderid}} has been cancelled. If you have made payment for this order, the amount will be refunded to you in the same account from which you had made the payment. In case you had made payment in cash, we request you to share the bank account details in which we can make the payment including the IFSC code of the branch.</td>
                        </tr>
                        <tr>
                            <td>The refund process may take upto 7 working days. If you have any further queries related to your order or refund, please write to us on <a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a></td>
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
                                        
                                    </tbody>
                                </table>
                                @endforeach
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Thanks again for giving us the opportunity to serve you. We look forward to the next time you shop with us!</td>
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