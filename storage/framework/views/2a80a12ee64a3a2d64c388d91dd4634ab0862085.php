

<?php $__env->startSection("content"); ?>

<style>
    .mobile-view-table{
        display: none !important;
    }
      @media (max-width: 600px){
/*.web-view{
    display:none!important; 
}*/

.detail-extralink{
    width: 100px;
    margin-left: 10px;
}

.mobile-view-table {
    display:block!important;
}
}
.btn{
    padding: 3px 6px !important;
}


.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    
    margin-bottom: 0px !important;
}
.right-tableslayout  .table>:not(caption)>*> *{
    border-right: 1px solid grey !important;
    padding: .5rem 0px;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

hr {
    margin: 9px 0px !important;
}
p{
    margin-bottom: 0px !important;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.table thead {
    display: contents;
}
</style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<main class="main">
    <div class="page-header breadcrumb-wrap">

        <div class="container">

            <div class="breadcrumb">

                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                <span></span> Cart

            </div>

        </div>

    </div>

    <div class="container mb-80 mt-10 web-view"> 

        <div class="row">

            <div class="col-lg-8 mb-10">

                <div class="d-flex justify-content-between">

                    <h6 class="text-body">There are <span class="text-brand"><?php echo e(count(array_keys(Session::get('customer-cart')))); ?></span> products in your cart, Please Proceed checkout  </h6>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <div class="table-responsive shopping-summery">

                    <?php 
					$subprice=$gstprice=$totalprice=0; 
					$shippingbasepriceforBrand = 
					array(); $netpriceforBrand = array(); ?>

                    <?php if(!empty($customercart)): ?>

                    <?php $__currentLoopData = $customercart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_name => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <table class="table table-wishlist">

                        <thead class="text-center">

                            <!-- <tr>

                                <td colspan="7">

                                    <h2>Visit Store: <a target="_blank" href="/brand/<?php echo e($cart['storeslug']); ?>"><?php if(is_null($cart['vendor_alias'])): ?>

                                            <?php echo e($store_name); ?>


                                            <?php else: ?>

                                            <?php echo e($cart['vendor_alias']); ?>


                                            <?php endif; ?></a></h2>

                                </td>

                            </tr> -->

                            <?php

                            $flag = 0;

                            $remainingAmount=499;

                            $vendorcartPrice = array_column($cart['child'], 'totalprice');

                            $vendorcartQuantity = array_column($cart['child'], 'quantity');

                            $vendorcartPriceWithoutTax = array_column($cart['child'], 'price');
                            $achievedAmount = 0;
                            $achievedPercent = 0; 
                            $remainingPercent = 100;
                            ?>

                                <?php for($i=0; $i < count($vendorcartQuantity); $i++): ?> 
                                    <?php 
                                        $remainingAmount -= $vendorcartPrice[$i];
                                        $achievedAmount += $vendorcartPrice[$i];
                                    ?> 
                                    <?php if($remainingAmount <=0): ?> 
                                        <?php 
                                            $flag=1; break; 
                                        ?> 
                                    <?php endif; ?> 
                                <?php endfor; ?> 
                                
                                <?php if($remainingAmount >0): ?> 
                                    <?php
                                        $achievedPercent = round( ( ($achievedAmount * 100)/499));
                                        $remainingPercent = (100 - $achievedPercent);
                                    ?>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="4" class="text-left">
                                        <div style="display:flex; align-items: center;" class="justify-content-between">
											<h2 style="padding-left: 0px;margin-top: 0px; color:#585CFC !important;">Visit Store: <a target="_blank" href="/brand/<?php echo e($cart['storeslug']); ?>">
                                                <?php if(is_null($cart['vendor_alias'])): ?>
                                                    <?php echo e($store_name); ?>

                                                <?php else: ?>
                                                    <?php echo e($cart['vendor_alias']); ?>

                                                <?php endif; ?></a>
											</h2> 
											<!--<div class="mt-0">
												<small class="cart-PageNoteAd fa-bounce">Note: Add <i class="fa fa-rupee-sign"></i><?php echo e($remainingAmount); ?> More For Free Shipping</small>
											</div>-->
										</div>
										
                                    </td>
                                    
                                    
                                </tr>
                                <?php if($flag==1): ?>
                                    <tr>
                                        <td class="free-delivery-note free" colspan="7" id="remaining-amount-for-free-delievery-<?php echo e($cart['storeid']); ?>">
                                            <small>Note: Congratulation you are eligible for free Shipping for this seller.</small>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td class="free-delivery-note remain" style="padding-left: 10px;" colspan="7" id="remaining-amount-for-free-delievery-<?php echo e($cart['storeid']); ?>">
                                            <div class="container-fluid">
                                            <!--achievedAmount: Rs. <?php echo e(number_format((float)$achievedAmount, 2, '.', '')); ?>

                                            remainingprogressbar: Rs. <?php echo e(number_format((float)(499 - $achievedAmount), 2, '.', '')); ?>-->
                                            
                                                <div class="progress">
                                                    <div class="progress-bar  green-progressbar-start progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo e($achievedPercent); ?>" 
                                                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($achievedPercent); ?>%">
                                                        Rs. <?php echo e(number_format((float)$achievedAmount, 2, '.', '')); ?>

                                                    </div>
                                                    <div class="progress-bar remainingprogressbar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo e(100 - $achievedPercent); ?>" 
                                                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e(100 - $achievedPercent); ?>%" style="color:#333333;">
                                                        Rs. <?php echo e(number_format((float)(499 - $achievedAmount), 2, '.', '')); ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <marquee width="100%" direction="left" height="auto">
                                                    <small>Note: Add <i class="fa fa-rupee-sign"></i> <?php echo e(number_format((float)$remainingAmount, 2, '.', '')); ?> More For Free Shipping</small>
                                            </marquee>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                

                        </thead>

                        <tbody class="scroll-cart text-center">
                            <tr class="main-heading">

                                    <th nowrap=""colspan="2" class="pl-10">Product</th>

                                    <th nowrap="">Unit Price</th>

                                    <th nowrap="" >GST</th>

                                    <th nowrap="">Quantity</th>

                                    <th nowrap="">Subtotal</th>

                                    <th nowrap="">Remove</th>

                                </tr>

                            <?php $__currentLoopData = $cart['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e($product['wallet_amount']); ?>

                            <tr id="cart-row-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" class="pt-30">
                                <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$product['image'],'size'=>[100,100]); 
                                                        ?>  
                                <td valign="top" nowrap="" width="70" class="image product-thumbnail pl-10"><img src="<?php echo e(imageRender($imagearray)); ?>" alt="#"></td>

                                <td valign="top"  style="text-align:left;" nowrap="" width="250" class="product-des product-name">

                                    <h6 class="mb-5"><a href="/product/<?php echo e($product['slug']); ?>"><span class="product-name mb-10 text-heading"><?php echo e($product['title']); ?></span></a></h6>

                                    <p class="d-block mb-0 sold-by"><small><span>Brand: </span> <a href="/brand/<?php echo e($cart['storeslug']); ?>">

                                                <?php if(is_null($cart['vendor_alias'])): ?>

                                                <?php echo e($store_name); ?>


                                                <?php else: ?>

                                                <?php echo e($cart['vendor_alias']); ?>


                                                <?php endif; ?> </a></small></p>

                                    <p class="mb-0"><small><?php echo e($product['variant']); ?></small></p>

                                </td>

                                <td valign="top" nowrap="" class="price" data-title="Price">

                                    <h4 class="text-body"><i class="fa fa-rupee-sign"></i><?php echo e(number_format($product['price'], 2)); ?></h4>

                                </td>

                                <td valign="top" nowrap="" class="price" data-title="gstPrice">

                                    <h4 class="text-body"><i class="fa fa-rupee-sign"></i><?php echo e(number_format($product['gst_amount'], 2)); ?></h4>

                                </td>

                                <td valign="top" style="text-align:center;" nowrap="" width="150" class="text-center detail-info" data-title="Stock">

                                    <div class="detail-extralink d-flex">

                                        <div class="detail-sign"><a href="javascript:void(0)" id="cart__quantity-minus-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" class="qty-down cart__quantity__minus"><i class="fi-rs-minus"></i></a></div>

                                        <div class="detail-qty border radius">

                                            <input name="quantity" type="text" class="cart__quantity__input cart__quantity-input-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" id="cart__quantity-input-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" value="<?php echo e($product['quantity']); ?>" readonly>

                                            <input type="hidden" id="min-quantity-input-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" value="<?php echo e($product['minoq']); ?>" name="min-quantity-input" />

                                            <input type="hidden" id="max-quantity-input-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" value="<?php echo e($product['maxoq']); ?>" name="max-quantity-input" />

                                        </div>

                                        <div class="detail-sign"><a href="javascript:void(0)" id="cart__quantity-plus-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>" class="qty-up cart__quantity__plus"><i class="fi-rs-plus"></i></a></div>

                                    </div>

                                </td>

                                <td valign="top" nowrap="" class="price" data-title="Price">

                                    <h4 class="text-brand"><i class="fa fa-rupee-sign"></i> <span id="price-span-<?php echo e($product['productid']); ?>-<?php echo e($product['variantid']); ?>"><?php echo e(number_format($product['totalprice'], 2)); ?></span></h4>

                                </td>

                                <td valign="top" nowrap="" class="action text-center" data-title="Remove"><a href="javascript:void(0)" onclick="removeCart(<?php echo e($product['productid']); ?>, <?php echo e($product['variantid']); ?>)" class="text-body"><i class="fi-rs-trash"></i></a></td>

                            </tr>

                            <?php

                            $subprice += $product['price'] * $product['quantity'];

                            $gstprice += $product['gst_amount'] * $product['quantity'];

                            $totalprice += $product['totalprice'];

                            if(!array_key_exists($cart['storeid'], $netpriceforBrand)){

                            $netpriceforBrand[$cart['storeid']] = 0;

                            }

                            $netpriceforBrand[$cart['storeid']] += $product['totalprice'];

                            if(!array_key_exists($cart['storeid'], $shippingbasepriceforBrand)){

                            $shippingbasepriceforBrand[$cart['storeid']] = $cart['shippingGstAmount'];

                            }

                            ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                        

                    </table>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php else: ?>

                    <table class="table table-wishlist">

                        <thead>

                            <tr class="main-heading">

                                <th nowrap="" scope="col" colspan="2" class="pl-30">Product</th>

                                <th nowrap="" scope="col">Unit Price</th>

                                <th nowrap="" scope="col">GST</th>

                                <th nowrap="" scope="col">Quantity</th>

                                <th nowrap="" scope="col">Subtotal</th>

                                <th nowrap="" scope="col" align="center">Remove</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td colspan="6" class="pl-30">Your Cart is Empty</td>

                            </tr>

                        </tbody>

                    </table>

                    <?php endif; ?>

                    <?php

                    $shippingforbrand = array_map(function($item){

                    if ($item <= 149) { return 50; } else if($item <=349 && $item> 149) {

                        return 70;

                        } else if($item <=498 && $item> 349){

                            return 100;

                            }else{

                            return 0;

                            }

                            }, $netpriceforBrand);

                            array_walk($shippingforbrand, function(&$item, $key) use ($shippingbasepriceforBrand) {

                                $item = array('shippingprice' => $item, 'baseshippingprice' => round(($item * 100) / (100 + $shippingbasepriceforBrand[$key]), 2), 'gstshippingprice' => round(($item - ($item * 100) / (100 + $shippingbasepriceforBrand[$key])), 2));

                            });

                            ?>

                </div>

                <div class="divider-2 mb-30"></div>

                <div class="cart-action d-flex justify-content-between">

                    <a class="btn " href="/offers"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="border p-md-4 cart-totals ml-30">

                    <div class="table-responsive">

                        <table class="table no-border">

                            <tbody>

                                <tr>

                                    <td nowrap="" class="cart_total_label">

                                        <h6 class="text-muted">Subtotal</h6>

                                    </td>
									
									

                                    <td nowrap="" class="cart_total_amount">

                                        <h4 class="text-brand text-end"><i class="fa fa-rupee-sign"></i> <span id="sub-cart-price"><?php echo e(number_format($subprice,2)); ?></span></h4>

                                    </td>

                                </tr>
								
								 
								

                                <tr>

                                    <td nowrap="" class="cart_total_label">

                                        <h6 class="text-muted">Tax</h6>

                                    </td>

                                    <td nowrap="" class="cart_total_amount">

                                        <h4 class="text-brand text-end"><i class="fa fa-rupee-sign"></i> <span id="gst-cart-price"><?php echo e(number_format($gstprice + array_sum(array_column($shippingforbrand, 'gstshippingprice')),2)); ?></span></h4>

                                    </td>

                                </tr>

                                <!--<tr>

                                    <td scope="col" colspan="2">

                                        <div class="divider-2 mt-10 mb-10"></div>

                                    </td>

                                </tr>-->

                                <tr>

                                    <td nowrap="" class="cart_total_label">

                                        <h6 class="text-muted">Shipping Fee</h6>

                                    </td>

                                    <td nowrap="" class="cart_total_amount">

                                        <h4 class="text-end text-brand"><i class="fa fa-rupee-sign"></i> <span id="shipping-cart-price"><?php echo e(number_format(array_sum(array_column($shippingforbrand, 'baseshippingprice')), 2)); ?></span></h4>

                                    </td>

                                </tr>

                                <!--<tr>

                                    <div class="divider-2 mt-10 mb-10"></div>

                                    </td>

                                </tr>-->

                                <tr>

                                    <td nowrap="" class="cart_total_label">

                                        <h6 class="text-muted">Total</h6>

                                    </td>

                                    <td nowrap="" class="cart_total_amount">

                                        <h4 class="text-brand text-end"><i class="fa fa-rupee-sign"></i> <span id="total-cart-price">
										<div id="tots">  </div>
										<?php 
										//print_r($shippingforbrand);?>
										<?php echo e(number_format((
										$totalprice + array_sum(array_column($shippingforbrand, 'shippingprice')
										
										)),2)); ?></span> </h4>

                                    </td>

                                </tr>
								
								

                            </tbody>

                        </table>

                    </div>

                    <a href="/checkout" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>

                </div>

            </div>

        </div>

    </div>

</div>


</main>

<?php $__env->stopSection(); ?>
<script>
$(document).on("click", ".checks", function() {
			  if ($(this).prop('checked') == true) {
				//var price = $(this).attr("data-price"); //price 17.94
				var price = 70; 
				alert(price);
				alert("First");
				var tots = Number(20);
			
				var ffp = Number(price) + Number(tots);
				alert(ffp);
				$('.walletaddon').text(ffp);
			  } else if ($(this).prop('checked') == false) {
			  alert("Second");
				var price = 70;
				alert(price);
				var tots = Number(20);
				
				var ffp =   Number(price) - Number(tots);
				$('.walletaddon').text(ffp);
			  }
		});
	</script>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/cart.blade.php ENDPATH**/ ?>