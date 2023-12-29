<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      
      <title>Seller to Customer</title>
       <style>
		  
		  h1, p, h2, h3, h5, a{
			  margin: 0px;
		  
		  }
		  
            
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
		  
		  .total-block tr:nth-child(even) {
				  background-color: #f2f2f2;
		  }
      </style>
   </head>
   <body>
	   <table class="wraaper_invoice" width="660" style="width:660px; margin: 0px auto; border: 1px solid grey; padding: 28px; border-radius: 8px;">
         <tbody>
            <tr>
               <td>
					  <table width="100%">
					  	<tbody>
						  	<tr>
								<td width="30%" align="left" style="text-align: left;">
									<a href="https://www.spicebucket.com" style="text-align:center;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.spicebucket.com&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_">
									<img src="https://spicebucket.com/assets/imgs/logoSB.png" height="80" width="150" alt="Spice Bucket" style="border:none" class="CToWUd" data-bit="iit">
									</a>
								</td>
								<td width="70%" align="right" style="text-align: right;">
									<h4>Tax Invoice/Bill of Supply/Cash Memo</h4>
									<p>(Original for Recipient)</p>
									<h6 style="font-size:18px; margin-top: 10px; margin-bottom: 0px;"><b>Order ID: </b> {{$vendorDetail['invoiceNumber']}} 
									</h6>
								</td>
							</tr>
						  </tbody>
					  </table>
				   <hr>


               <table>
                  <tbody>
                     <tr>
                        <td>
                           <h2><p>Dear {{ucwords($vendorDetail['vendor_alias'])}} ,</p></h2>
                        </td>
                     </tr>
                     <tr>
                        <td style="font-size: 14px; line-height: 20px;">
                           Thank you for your order on
                           <a href="https://www.spicebucket.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.spicebucket.com&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_">https://www.spicebucket.com</a> Your order has been successfully placed. Please do
                           save your order number as to track your order status and it will be referenced in your communication with us.
                         
                        </td>
                     </tr>
                     
                     <tr>
                        <td style="font-size: 14px; line-height: 20px; text-align: center;">
                           <strong>Below, you will find details for the items that you have ordered with us.</strong>
                            
                        </td>
                     </tr>
                  </tbody>
                 </table> 
				   
                  
                     <div style="border:2px solid #858585; padding: 10px;">
                        
                        <table cellpadding="5" cellspacing="0" border="1" width="100%" style="text-align: center; border: solid 1px #a8a8a8;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
                           <thead style="font-weight: 800px; color: #000;">
                              <tr style="background-color:#f2f2f2">
                                 <th style="text-align: center;">S.no</th>
                                 <th style="text-align: center;">Image</th>
                                 <th>Product Information</th>
                                 <th style="text-align: center;">Unit Price</th>
                                 <th style="text-align: center;">qty</th>
                                 <th style="text-align: center;">Net Amount</th>
                                 <th style="text-align: center;">Tax Rate</th>
                                 <th style="text-align: center;">Tax Amount</th>
                                 <th style="text-align: center;">Total Amount</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php $counter=1; $subamount=0; $gstamount=0; $vendorshippingGST = 0; $vendorShippingCharge = 0;@endphp
                              @foreach($vendorDetail['products'] as $product)
                              <tr style="color: #454141;">
                                 <td style="text-align: center;">{{$counter}}</td>
                                 <td style="text-align: center;">
                                    @php $imagearray=array('path_folder'=>'/images/products/','image'=>$product['productImage'],'size'=>[100,100]);

                                @endphp 
                               
                               <img src="{{ImageRender($imagearray)}}" alt="" height="auto" width="70" class="CToWUd" data-bit="iit"> 
                                 </td>
                                 <td>
                                    <strong>{{$product['productname']}}</strong>
                                    <br>{{$product['store_name']}}
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
                                    {{$product['productqty']}}
                                 </td>
                                 <td style="text-align: center;"><i class="fa fa-rupee-sign"></i> {{number_format(($product['productprice'] * $product['productqty']),2)}}</td>
                                 <td style="text-align: center;">
                                    {{$product['gst_rate']}}%
                                 </td>
                                 <td style="text-align: center;"><i class="fa fa-rupee-sign"></i> {{number_format(($product['perproductgst'] * $product['productqty']),2)}}</td>
                                 <td style="text-align: center;"><i class="fa fa-rupee-sign"></i> {{number_format((($product['productprice'] * $product['productqty']) + ($product['perproductgst'] * $product['productqty'])), 2)}}</td>
                              </tr>
                              @php 
                              $subamount += round(($product['productprice'] * $product['productqty']), 2); 
                              $gstamount += round(($product['perproductgst'] * $product['productqty']), 2);
                              $counter++; 
                              if($vendorshippingGST < $product['gst_rate']){
                              $vendorshippingGST = $product['gst_rate'];
                              }
                              @endphp
                              @endforeach
                           </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between; align-items: center; ">
                           <div style="width: 100%; ">
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td><b>Sub Total:</b></td>
                                    <td style="float: right;" align="right"><b>{{number_format($subamount, 2)}}</b></td>
                                 </tr>
                              </table>
                              @php
                              $baseshippingprice = round(($vendorDetail['shippingFee'] * 100) / (100 + $vendorshippingGST), 2); 
                              $gstshippingprice = round(($vendorDetail['shippingFee'] - $baseshippingprice), 2);							
                              @endphp
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td><b>Tax Amount:</b></td>
                                    <td style="float: right;" align="right"><b>{{number_format(($gstamount + $gstshippingprice), 2)}}</b></td>
                                 </tr>
                              </table>
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td><b>Discount:</b></td>
                                    <td style="float: right;" align="right"><b>(-) {{number_format($vendorDetail['discount'], 2)}}</b></td>
                                 </tr>
                              </table>
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td><b>Shipping Fees:</b></td>
                                    <td style="float: right;" align="right"><b>{{number_format($baseshippingprice, 2)}}</b></td>
                                 </tr>
                              </table>
                              @if($vendorDetail['paymentSource'] == 'cod')
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td><b>COD: () </b></td>
                                    <td style="float: right;" align="right"><b>{{number_format($vendorDetail['cod_charges'], 2)}}</b></td>
                                 </tr>
                              </table>
                              @endif
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 10px; border-top: none !important; ">
                                 <tr style="border-bottom: 2px solid #454141 ;">
                                    <td ><b>Grand Total: </b></td>
                                    <td style="float: right;" align="right"><b>{{number_format(($subamount + $gstamount - $vendorDetail['discount'] + $vendorDetail['shippingFee'] + $vendorDetail['cod_charges']), 2)}}</b></td>
                                 </tr>
                              </table>
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 14px; border-top: none !important; font-weight: 600;">
                                 <tr>
                                    <td>
                                       <p>Amount In Words: {{numberToWords($subamount + $gstamount - $vendorDetail['discount'] + $vendorDetail['shippingFee'] + $vendorDetail['cod_charges'])}}</p>
                                    </td>
                                 </tr>
                              </table>
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 14px; border-top: none !important; font-weight: 600;">
                                 <tr>
                                    <td style="text-align: right;">
                                       <p>For {{$vendorDetail['store_name']}}: <br><br>Authorized Signatory </p>
                                    </td>
                                 </tr>
                              </table>
                              <table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 12px; border-top: none !important; font-weight: 400;">
                                 <tr>
                                    <td style="text-align: left;">
                                       <p><strong>Terms & Conditions:</strong>
                                          <br>
                                          The goods sold are intended for end user consumption Not for resale. <br>
                                          This is a computer generated invoice and does not require signature. <br>
                                          For any assistance or feedback please mail us on <a href="mailto:info@spicebucket.com" style="color:#e3273A;">info@spicebucket.com</a> or call our customer care number <a href="tel:+91 120 4268011" style="color: #e3273A">+91 120 4268011</a>.
                                       </p>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div style="clear: both;"></div>
                     <div style="clear: both;"></div>
                     <div style="clear: both;"></div>
                     <div style="clear: both;"></div>
                     <div style="clear: both;"></div>
                     <div style="text-align:center;">
                        <br />
                        <p>In case you have any questions or feedback, please call us at </p>
                        <a href="tel:7247247070" style="text-decoration:none;color:#0d88ce" target="_blank">
                        <strong>7247247070</strong>
                        </a>, or you can also write to us on
                        <strong>
                        <a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a>
                        </strong>
                        <div class="social_icons" style="background-color: #ffffff; margin-top: 20px; display: flex; align-items: center; padding: 10px 25px; justify-content: center;" class="mobile-social-icon">
                           <a class="instagram" href="https://www.instagram.com/spicebucketonline/">
                              <img  height="24" width="24" src="http://spicebucket.com/public/assets/imgs/icons/facebook.png" alt="Facebook">
                           </a>
                           
                           <a class="instagram" href="https://www.instagram.com/spicebucketonline/">
                              <img  height="24" width="24" src="http://spicebucket.com/public/assets/imgs/icons/instagram.png" alt="Instagram">
                           </a>
							
                           <a class="linkedin" href="https://www.linkedin.com/company/spice-bucket-e-retail-pvt-ltd/">
                              <img  height="24" width="24" src="http://spicebucket.com/public/assets/imgs/icons/linkedin.png" alt="LinkedIn">
                           </a>
                           
							<a class="twitter" href="https://twitter.com/BucketSpices">
							   <img  height="24" width="24" src="http://spicebucket.com/public/assets/imgs/icons/twitter.png" alt="Twitter"> 
                           </a>
                           
                           <a class="youtube" href="https://www.youtube.com/channel/UCEILpLNAKcwQWcotRiGSWVw">
                             <img height="24" width="24" src="http://spicebucket.com/public/assets/imgs/icons/youtube.png" alt="Youtube">
                           </a>
                        </div>
                     </div>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>