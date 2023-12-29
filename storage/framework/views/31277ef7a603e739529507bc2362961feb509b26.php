<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Invoice</title>
      <style>
		  
		  h1, p, h2, h3, h5, a{
			  margin: 0px;
			  
		  }
		  
         .wraaper_invoice{
         width:100%;
         margin-top: 20px;
         border: 1px solid grey;
         padding:  5px 28px;
         border-radius: 8px;
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
      <div id="invoice" class="wraaper_invoice container-fluid" style="border: 1px solid grey; border-radius: 8px; width: 660px; margin: 0px auto; padding: 28px;" width="660">
         <table width="100%" align="center" background="#ffffff">
		  	<tbody>
			 	<tr>
					<td style="width: 30%; display: inline-block;" width="300">
						<a href="<?php echo e(env('APP_URL')); ?>" style="text-align:center;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=<?php echo e(env('APP_URL')); ?>&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_">
										   <img src="<?php echo e(URL::to('/')); ?>/assets/imgs/logoSB.png" height="80" width="150" alt="Spice Bucket" style="border:none" class="CToWUd" data-bit="iit">
					</td>
					<td style="width: 70%;" align="right">
						<div>
							<h6 style="font-size: 20px; margin: 0px;">Order ID: <strong><?php echo e($orderID); ?></strong></h6>
							<h6 style="font-size:14px; margin-top: 10px; margin-bottom: 0px;">Order Date : <strong><?php echo e(date('d/M/Y h:i A', strtotime($orderDateTime))); ?></strong></h6>
							<h6 style="font-size: 14px; margin: 0px;">SB Order ID: <strong><?php echo e($orderID); ?></strong></h6>

					  </div>
					</td>
				</tr>
			 </tbody>
		  </table>
		  
         <hr>
		<table>
		  	<tbody>
				<tr>
					<td>
						<h2><p>Dear Seller, <!--<?php echo e(ucwords($vendorDetail['vendor_alias'])); ?> , --></p></h2>
					</td>
				</tr>
				<tr>
					<td style="font-size: 14px; line-height: 20px;">
						you have recived an order from 
						<a href="<?php echo e(env('APP_URL')); ?>" target="_blank" data-saferedirecturl="https://www.google.com/url?q=<?php echo e(env('APP_URL')); ?>&;source=gmail&amp;ust=1686467254397000&amp;usg=AOvVaw3kg-NixqNIf4tdgGhgY14_"><?php echo e(env('APP_URL')); ?></a>. Please proceed the order as soon as possible. 
					</td>
				</tr>
				
				<tr>
					<td style="font-size: 14px; line-height: 20px; text-align: center;">
						<strong>Below, you will find details for the items that you have recived from Spice Bucket.</strong>
					</td>
				</tr>
			</tbody>
		  </table> 
		  <br>
		   <?php
                     $totalSubCartAmount = $totalGST = $totalCartAmount = $totalBaseShippingPrice = $totalGSTShippingPrice = 0;
                     ?>
                     <?php $__currentLoopData = $vendorWiseDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendorDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div style="border:2px solid #858585; padding: 10px;">
		  <table width="100%">
		  	<tbody>
			 
				<tr>
					<td style="font-size: 18px;" align="left">
						<strong>  <?php echo e($vendorDetail['vendor_alias']); ?></strong>
					</td>
					<!--<td align="right">
						<strong>Seller Order no: 9817009630</strong>
					</td>-->
				</tr>  
			</tbody>
		  </table>
         
         <table cellpadding="5" cellspacing="0" border="1" width="100%" style="text-align: center; border: solid 1px #a8a8a8;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;font-size:12px;line-height:18px;text-align:left">
            <thead style="font-weight: 800px; color: #000;" >
               <tr style="background-color:#f2f2f2">
                  <th style="text-align: center;">S.no</th>
                  <th width="50" style="text-align: center;">Image</th>
                  <th>Product Information</th>
                  <th style="text-align: center;">Price</th>
                  <th style="text-align: center;">GST</th>
                  <th style="text-align: center;">Quantity</th>
                  <th style="text-align: center;">Total Amount</th>
               </tr>
            </thead>
            <tbody>
			<?php
                              $vendortotal = 0; $vendorGSTTotal = 0; $vendorsubTotal = 0; $vendorshippingGST = 0; $vendorShippingCharge = 0;
                              ?>
                              <?php $__currentLoopData = $vendorDetail['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr style="color: #454141;">
                  <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                  <td width="50" style="text-align: center;">
     						 <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$product['productImage'],'size'=>[100,100]);

                       ?> 
                      
                      <img src="<?php echo e(ImageRender($imagearray)); ?>" alt="" height="auto" width="70" class="CToWUd" data-bit="iit"> 
                  </td>
                  <td>
                     <strong><?php echo e($product['productname']); ?></strong>
                     <br><?php echo e($vendorDetail['store_name']); ?>

                                    <br><?php echo e($product['sku']); ?>

                                    <br>
									 <?php if(!is_null($product['productvariantname1']) && !is_null($product['variantvalue1'])): ?>
                                    <?php echo e($product['productvariantname1']); ?>: <?php echo e($product['variantvalue1']); ?>

                                    <?php endif; ?>
                                    <?php if(!is_null($product['productvariantname2']) && !is_null($product['variantvalue2'])): ?>
                                    , <?php echo e($product['productvariantname2']); ?>: <?php echo e($product['variantvalue2']); ?>

                                    <?php endif; ?>
                                    <?php if(!is_null($product['productvariantname3']) && !is_null($product['variantvalue3'])): ?>
                                    , <?php echo e($product['productvariantname3']); ?>: <?php echo e($product['variantvalue3']); ?>

                                    <?php endif; ?>
                  </td>
                  <td style="text-align: center;">
                     <i></i> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format($product['productprice'],2)); ?>

                  </td>
                  <td style="text-align: center;">
                     <i></i> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format($product['perproductgst'],2)); ?>

                  </td>
                  <td style="text-align: center;"><?php echo e($product['productqty']); ?></td>
                  <td style="text-align: center;">
                      
					  <?php
                                    $totalcartamount = ($product['productprice'] + $product['perproductgst']) * $product['productqty'];
                                    $vendorsubTotal += $product['productprice'] * $product['productqty'];
                                    $vendortotal += $totalcartamount;
                                    $vendorGSTTotal += $product['perproductgst'] * $product['productqty'];
                                    if($vendorshippingGST < $product['gst_rate']){
                                    $vendorshippingGST = $product['gst_rate'];
                                    }
                                    $vendorShippingCharge = $product['shippingCharge'];
                                    ?>
									<span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format($totalcartamount,2)); ?>

                  </td>
               </tr>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php
                              $baseshippingprice = round(($vendorShippingCharge * 100) / (100 + $vendorshippingGST), 2); 
                              $gstshippingprice = round(($vendorShippingCharge - $baseshippingprice), 2);
                              $totalSubCartAmount += $vendorsubTotal;
                              $totalGST += $vendorGSTTotal;
                              $totalCartAmount += $vendortotal;
                              $totalBaseShippingPrice += $baseshippingprice;
                              $totalGSTShippingPrice += $gstshippingprice;
                              ?>
            </tbody>
         </table>
         <div style="display: flex; justify-content: space-between; align-items: center; ">
			 
			 <!--<table class="total-block" width="100%" align="right" style="">
			 	<tbody>
				 	<tr>
						<td style="padding: 0px;">
							<table style="width: 100%; color:#000; font-size: 14px; border-top: none !important; ">
							  <tr style="border-bottom: 2px solid #454141;">
								 <td>Subtotal:</td>
								 <td style="float: right; text-align: right;" align="right"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format($vendorsubTotal, 2)); ?></td>
							  </tr>
							  <tr style="border-bottom: 2px solid #454141 ;">
								 <td>Tax:</td>
								 <td style="float: right; text-align: right;" align="right"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($vendorGSTTotal + $gstshippingprice), 2)); ?></td>
							  </tr>
							  <tr style="border-bottom: 2px solid #454141 ;">
								 <td>Shipping Fee:</td>
								 <td style="float: right; text-align: right;" align="right"> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format($baseshippingprice, 2)); ?></td>
							  </tr>
							  
							  <tr style="border-bottom: 2px solid #454141;">
								 <td><b>Total Amount:</b></td>
								 <td style="float: right; text-align: right;" align="right">
									 <b><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($vendortotal + $vendorShippingCharge), 2)); ?></b></td>
							  </tr>
						   </table>
						</td>
					</tr>
				 </tbody>
			 </table>-->
         </div>
      </div>
      <div style="clear: both;" ></div>
	
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
      <div style="position: relative; justify-content: space-between; align-items: center; border: 1px solid #454141; color:#000; font-size: 13px; border-top: none !important;  ">
		  <table width="100%" style="width: 100%; border-collapse: collapse;">
		  	<tbody>
			  	<tr>
					<td width="50%">
						<div style="text-align:center; margin-top: 5px;">
						   <p>Thanks again for giving us the opportunity to serve you.We look forward to the next time you shop with us!</p>
						   <h3> Spice Bucket Team</h3>
							<br>
							<p style="font-size: 12px;">*Terms & Conditions Accepted </p>
						</div>
					</td>
					<td width="50%" align="right">
						<table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 13px; border-top: none !important; border-collapse: collapse;">
						   <tr style="border-bottom: 2px solid #454141; border-collapse: collapse;">
							  <td>Subtotal:</td>
							  <td style="float: right ;"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($totalSubCartAmount), 2)); ?></td>
						   </tr>
						 
						   <tr style="border-bottom: 2px solid #454141 ;">
							  <td>Tax:</td>
							  <td style="float: right ;"> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($totalGST + $totalGSTShippingPrice), 2)); ?></td>
						   </tr>
						     <tr style="border-bottom: 2px solid #454141 ;">
							  <td>Shipping Fee:</td>
							  <td style="float: right ;"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($totalBaseShippingPrice), 2)); ?></td>
						   </tr>
						     <tr style="border-bottom: 2px solid #454141 ;">
							  <td>Discount:</td>
							  <td style="float: right ;"> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($discountAmount), 2)); ?></td>
						   </tr>  

						  <tr style="border-bottom: 2px solid #454141 ;">
							  <td>COD Charges:</td>
							  <td style="float: right ;"> <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span><?php echo e(number_format(($cod_charges), 2)); ?></td>
						   </tr>
							
							
						  
						   <tr style="border-bottom: 2px solid #454141 ;">
							  <td><b>Grand Total Amount:</b></td>
							  <td style="float: right ; color: red;"><b><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> 

							  <?php echo e(number_format(($totalCartAmount + $totalBaseShippingPrice + $totalGSTShippingPrice + $cod_charges - $discountAmount), 2)); ?></b></td>
						   </tr>
						</table>
					</td>
				</tr>
			  </tbody>
		  </table>
         
      </div>
      <div style="text-align:center;">
         <br/>
         <p>In case you have any questions or feedback, please call us at </p>
         <a href="tel:7247247070" style="text-decoration:none;color:#0d88ce" target="_blank">
         <strong>7247247070</strong>
         </a>, or you can also write to us on 
         <strong>
         <a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a>
         </strong>
         <div class="social_icons" style="background-color: #ffffff; margin-top: 20px; display: flex; align-items: center; padding: 10px 25px; justify-content: center;" class="mobile-social-icon">
                          
                              <img  height="24" width="24" src="https://spicebucket.com/public/assets/imgs/icons/facebook.png" alt="Facebook">
                         
                           &nbsp;&nbsp;
                          
                              <img  height="24" width="24" src="https://spicebucket.com/public/assets/imgs/icons/instagram.png" alt="Instagram">
                         
						&nbsp;&nbsp;	
                           
                              <img  height="24" width="24" src="https://spicebucket.com/public/assets/imgs/icons/linkedin.png" alt="LinkedIn">
                           
                           &nbsp;&nbsp;
							
							   <img  height="24" width="24" src="https://spicebucket.com/public/assets/imgs/icons/twitter.png" alt="Twitter"> 
                           
                           &nbsp;&nbsp;
                           
                             <img height="24" width="24" src="https://spicebucket.com/public/assets/imgs/icons/youtube.png" alt="Youtube">
                           
                        </div>
      </div>
	 </div>
	   <br>
   </body>
</html><?php /**PATH /var/www/spicebucket/resources/views/invoices/VenorWiseOrder.blade.php ENDPATH**/ ?>