
 
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
 
<?php /**PATH /var/www/spicebucket/resources/views/mailtemplate/orderplaced_variable.blade.php ENDPATH**/ ?>