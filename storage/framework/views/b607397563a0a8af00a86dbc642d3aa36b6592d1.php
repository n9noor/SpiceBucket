<link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
<div style="width:100%!important;background-color:#f5f5f5;margin:0px;padding:0px;font-family:Arial,Helvetica,sans-serif;color:#000;height:100%;min-width:100%;font-size:14px">
	<div style="background-color:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#000000;height:100%;margin:0;">
		<div align="center" style="margin:0 auto">
			<div style="text-align:center;background-color:#ffffff;margin-top:1.0em">
				<table cellpadding="5" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;background-color:#ffffff;color:#666666;border-bottom:solid 4px #e2e2e2;font-size:12px;text-align:left">
					<tbody>
						<tr>
							<td style="text-align:left;padding-bottom:10px">
								<a href="https://www.spicebucket.com" target="_blank" data-saferedirecturl="https://www.spicebucket.com">
									<img src="https://spicebucket.com/assets/imgs/logoSB.png" alt="Spice Bucket" style="border:none; width: 200px;" class="CToWUd" data-bit="iit" />
								</a>
							</td>
						</tr>
						<tr>
							<td style="font-weight:bold;padding-top:10px">Dear Customer, <?php echo e(Session::get('customer-loggedin-name')); ?></td>
						</tr>
						<tr>
							<td>Thank you for your order on <a href="https://www.spicebucket.com">https://www.spicebucket.com</a> Your order has been successfully placed. Please do save your order number as to track your order status and it will be referenced in your communication with us.
							</td>
						</tr>
						<tr>
							<td>Below, you will find details for the items that you have ordered with us.</td>
						</tr>
						<tr>
							<td>
								<?php
								$totalSubCartAmount = $totalGST = $totalCartAmount = $totalBaseShippingPrice = $totalGSTShippingPrice = 0;
								?>
								<?php $__currentLoopData = $vendorWiseDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendorDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
								$vendortotal = 0; $vendorGSTTotal = 0; $vendorsubTotal = 0; $vendorshippingGST = 0; $vendorShippingCharge = 0;
								?>
								<?php $__currentLoopData = $vendorDetail['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<div style="width: 800px;">
									<!--<table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 13px; border-top: none !important; ">
										<tr style="border-bottom: 2px solid #454141;">
											<td>Subtotal:</td>
											<td style="float: right ;"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($totalSubCartAmount), 2)); ?></td>
										</tr>
										<tr style="border-bottom: 2px solid #454141 ;">
											<td>Tax:</td>
											<td style="float: right ;"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($totalGST + $totalGSTShippingPrice), 2)); ?></td>
										</tr>
										<tr style="border-bottom: 2px solid #454141 ;">
											<td>Discount:</td>
											<td style="float: right ;"> (-) <i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($discountAmount), 2)); ?></td>
										</tr>
										<tr style="border-bottom: 2px solid #454141 ;">
											<td>Shipping Fee:</td>
											<td style="float: right ;"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($totalBaseShippingPrice), 2)); ?></td>
										</tr>
										<tr style="border-bottom: 2px solid #454141 ;">
											<td>COD Charges:</td>
											<td style="float: right ;"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($cod_charges), 2)); ?></td>
										</tr>
										<tr style="border-bottom: 2px solid #454141 ;">
											<td><b>Grand Total Amount:</b></td>
											<td style="float: right ; color: red;"><b><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($totalCartAmount + $totalBaseShippingPrice + $totalGSTShippingPrice + $cod_charges - $discountAmount), 2)); ?></b></td>
										</tr>
									</table>-->

									<table style="width: 100%; border: 1px solid #454141; color:#000; font-size: 13px; border-collapse: collapse;">
										<tr style="">
											<th width="100" style="width:100px; border: 1px solid #454141; text-align: center;">Subtotal:</th>
											<th width="100" style="width:100px; border: 1px solid #454141; text-align: center;">Tax:</th>
											<th width="100" style="width:100px; border: 1px solid #454141; text-align: center;">Discount:</th>
											<th width="150" style="width:100px; border: 1px solid #454141; text-align: center;">Shipping Fee:</th>
											<th width="150" style="width:100px; border: 1px solid #454141; text-align: center;">COD Charges:</th>
											<th width="200" style="width:100px; border: 1px solid #454141; text-align: center;">Grand Total Amount:</th>
										</tr>
										<tr>
											<td nowrap="" style="width: 100px; border: 1px solid #454141; text-align: center;" width="100"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($totalSubCartAmount), 2)); ?></td>
											<td nowrap="" style="width: 100px; border: 1px solid #454141; text-align: center;" width="100"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($totalGST + $totalGSTShippingPrice), 2)); ?></td>
											<td nowrap="" style="width: 100px; border: 1px solid #454141; text-align: center;" width="100"> (-) <span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($discountAmount), 2)); ?></td>
											<td nowrap="" style="width: 150px; border: 1px solid #454141; text-align: center;" width="150"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($totalBaseShippingPrice), 2)); ?></td>
											<td nowrap="" style="width: 150px; border: 1px solid #454141; text-align: center;" width="150"><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($cod_charges), 2)); ?></td>
											<td nowrap="" style="width: 200px; border: 1px solid #454141; text-align: center; color: #e3273A;" width="200"><b><span><img src="<?php echo e(URL::to('/')); ?>/images/indian-rupee-sign.png"  width="8" alt="Rupees SB" style="border:none" class="CToWUd" data-bit="iit"></span> <?php echo e(number_format(($totalCartAmount + $totalBaseShippingPrice + $totalGSTShippingPrice + $cod_charges - $discountAmount), 2)); ?></b></td>
										</tr>	
									</table>
								</div>
							</td>
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
							<td style="font-size:13px;border-top:solid 1px #dddddd;padding-top:10px;padding-bottom:10px">In case you have any questions or feedback, please call us at 
															
									
								<a href="tel:7247247070" style="text-decoration:none;color:#0d88ce">
									<strong>7247247070</strong>
								</a>, or you can also write to us on 
										
								<strong>
									<a href="mailto:info@spicebucket.com" style="text-decoration:none;color:#0d88ce" target="_blank">info@spicebucket.com</a>
								</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
</div><?php /**PATH /var/www/spicebucket/resources/views/mailtemplate/orderplaced.blade.php ENDPATH**/ ?>