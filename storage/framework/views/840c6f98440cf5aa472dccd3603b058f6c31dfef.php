 <div class="row">
    <div>
        <a href="javascript:void(0)" class="btn btn-danger btn-sm ml-2 backToOrders">Back To Orders</a>
    </div>

    <div class="col-md-12">
        <div class="tab-content account dashboard-content">
            <div id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab" class="tab-pane fade active show">
                <div class="card">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">SB Order ID: <?php echo e($orderID); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="customer-order-detail">
                                <div class="row dorder-header-sec">
                                    <div class="col-auto me-auto">
                                        <div class="order-slogan"><img width="100" src="/assets/imgs/theme/logo-color.png" alt="Nest - Laravel Multipurpose eCommerce Script"> <br></div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="order-meta"><span class="d-inline-block">Time:</span> <strong class="order-detail-value"><?php echo e(date('d/M/Y h:i A', strtotime($orderDateTime))); ?></strong></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
										<div class="order-detail-top">
											<div class="row">
												<div class="col-6 pt-2">
													<h4>Order information</h4>
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
													<div>
														 
														<div><span class="d-inline-block">Payment method:</span> <strong class="order-detail-value"> <?php echo e($vendorDetail['paymentSource'] == 'cod' ? "Cash on Delivery (COD)" : ucfirst($vendorDetail['paymentSource'])); ?></strong></div>
														<div><span class="d-inline-block">Payment status:</span> <strong class="order-detail-value"> Pending</strong></div>
														<div><span class="d-inline-block">Amount:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($totalCartAmount, 2)); ?></strong></div>
														<div><span class="d-inline-block">Tax:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($totalGST + $totalGSTShippingPrice, 2)); ?></strong></div>
														<div><span class="d-inline-block">Discount:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"> <?php echo e(number_format($discountAmount, 2)); ?></i>
															</strong></div>
														<div><span class="d-inline-block">Shipping fee:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i><?php echo e(number_format($totalBaseShippingPrice, 2)); ?> </strong></div>
														<?php if($cod_charges > 0): ?>
														<div><span class="d-inline-block">COD Charges:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i><?php echo e(number_format($cod_charges, 2)); ?> </strong></div>
														<?php endif; ?>

                                                        <div><span class="d-inline-block">Total Amount:</span> <strong class="order-detail-value"><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($totalCartAmount + $totalBaseShippingPrice + $totalGSTShippingPrice + $cod_charges - $discountAmount), 2)); ?></strong></div>

													</div>

												</div>
												<div class="col-6 pt-2 text-end">
													<h4>Customer</h4>
													<div>
														<div><span class="d-inline-block">Full Name:</span> <strong class="order-detail-value"><?php echo e($CustomerDetail['firstname']); ?> <?php echo e($CustomerDetail['lastname']); ?></strong></div>
														<div><span class="d-inline-block">Phone:</span> <strong class="order-detail-value"><?php echo e($CustomerDetail['phonenumber']); ?> </strong></div>
														<div><span class="d-inline-block">Email:</span> <strong class="order-detail-value"><?php echo e($CustomerDetail['email']); ?></strong></div>
														<div class="row">
															<div class="col-12"><span class="d-inline-block">Billing Address:</span> <strong class="order-detail-value"><?php echo e($CustomerDetail['billingAddress']); ?> </strong><br>
																 
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                    <div class="table-responsive">
                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aliasname => $orderdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <!--<h4>Seller: <a href="/brand/<?php echo e($orderdetail['storeslug']); ?>"><?php echo e($aliasname); ?></a></h4>-->
															<div class="seller-name">
																<a class="" href="/brand/<?php echo e($orderdetail['storeslug']); ?>"><?php echo e($aliasname); ?></a>
																<?php echo e($orderdetail['invoice_number'] == '' ? "Processing" : $orderdetail['invoice_number']); ?>

															</div>
                                                        </div>
                                                        
														<div class="col-md-4">
                                                         <div class="track-order">
                                                                <?php if($orderdetail['vendorwiseorderstatus'] != 'cancel'): ?>
                                                                <div class="col-auto me-auto text-end mb-3" id="trackorder"><a href="javascript:void(0)" onclick="trackYourOrder ('<?php echo e($orderdetails[0]->orderid); ?>', '<?php echo e($orderdetail['vendorID']); ?>')" class="btn btn-info btn-sm" id="trackOrder_pop">Track</a></div>
                                                                <!-- Modal -->
                                                                <!-- The Modal -->
                                                                        <div id="myModal" class="modal">

                                                                          <!-- Modal content -->
                                                                          <div class="modal-content">
                                                                            <span class="close">&times;</span>
                                                                            <p>Some text in the Modal..</p>
                                                                          </div>

                                                                        </div>
                                                                
                                                                <?php endif; ?>
                                                            </div>       

                                                        <?php if($orderdetails[0]->order_status != 'cancel' && $orderdetails[0]->order_status != 'Ready to shipping' && $orderdetails[0]->order_status != 'Shipped'): ?>
															<div class="cancel-bucket text-end">
                                                            <?php if($orderdetail['vendorwiseorderstatus'] == 'cancel'): ?>
																<a href="javascript:void(0)" style="pointer-events: none" class="btn btn-info btn-sm">Cancelled</a>
                                                                <?php else: ?>
                                                                <a href="javascript:void(0)" id="cancelordervendorwise-<?php echo e($orderdetail['vendorID']); ?>-<?php echo e($orderdetails[0]->idoforder); ?>" onclick="cancelOrderVendorwise(<?php echo e($orderdetail['vendorID']); ?>, <?php echo e($orderdetails[0]->idoforder); ?>)" class="btn btn-info btn-sm">Cancel Bucket</a>
                                                                <?php endif; ?>
															</div>
														</div>
                                                        <?php endif; ?>
                                                            
                                                        </div>

                                                    </div>
                                                </tr>
                                                <tr>
                                                    <th nowrap="">#</th>
                                                    <th nowrap="">Image</th>
                                                    <th nowrap="">Product</th>
                                                    <th nowrap="">Amount</th>
                                                    <th nowrap="">GST</th>
                                                    <th style="width: 100px;" nowrap="">Quantity</th>
                                                    <th class="price text-right" nowrap="">Total</th>
                                                    <th class="text-center" nowrap="">Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter=1; ?>
                                                <?php $__currentLoopData = $orderdetail['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="align-middle" nowrap=""><?php echo e($counter); ?></td>
                                                    <td class="align-middle" nowrap="">
                                                        <?php $imagearray=array('path_folder'=>'/images/products/','image'=>$vendor['image'],'size'=>[100,100]); 
                                                        ?>  
                                                        <img src="<?php echo e(ImageRender($imagearray)); ?>" width="50" alt="<?php echo e($vendor['productname']); ?>"></td>
                                                    <td class="align-middle" nowrap="">
                                                        <h5><?php echo e($vendor['productname']); ?></h5>
                                                        <p><small>
                                                                <?php if(!is_null($vendor['variantname1']) && !is_null($vendor['variantvalue1'])): ?>
                                                                <?php echo e($vendor['variantname1']); ?>: <?php echo e($vendor['variantvalue1']); ?>

                                                                <?php endif; ?>
                                                                <?php if(!is_null($vendor['variantname2']) && !is_null($vendor['variantvalue2'])): ?>
                                                                <?php echo e($vendor['variantname2']); ?>: <?php echo e($vendor['variantvalue2']); ?>

                                                                <?php endif; ?>
                                                                <?php if(!is_null($vendor['variantname3']) && !is_null($vendor['variantvalue3'])): ?>
                                                                <?php echo e($vendor['variantname3']); ?>: <?php echo e($vendor['variantvalue3']); ?>

                                                                <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle" nowrap=""><i class="fa fa-rupee-sign"></i> <?php echo e($vendor['subtotal']); ?></td>
                                                    <td class="align-middle" nowrap=""><i class="fa fa-rupee-sign"></i> <?php echo e($vendor['totalgst']); ?></td>
                                                    <td class="align-middle text-center" nowrap=""><?php echo e($vendor['perproductquantity']); ?></td>
                                                    <td class="align-middle" nowrap=""><i class="fa fa-rupee-sign"></i> <strong><?php echo e($vendor['totalamount']); ?></strong></td>
                                                    <td nowrap="">
                                                        <?php if($orderdetails[0]->order_status != 'cancel'): ?>
                                                        <div class="col-auto me-auto"><a href="javascript:void(0)" data-productid="<?php echo e($vendor['productid']); ?>" id="review-modal-btn" class="btn btn-info btn-sm">Review</a></div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $counter++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div> <br> <br>
                                    <div class="mt-20 row">
                                        <?php if($orderdetails[0]->order_status != 'cancel' && $orderdetails[0]->order_status != 'Ready to shipping' && $orderdetails[0]->order_status != 'Shipped'): ?>
                                        <div class="col-auto me-auto"><a id="downloadinvoicebtn" href="/public/invoices/<?php echo e($orderdetails[0]->orderid.'.pdf '); ?>" download class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i> Download Order</a></div>
                                        <div class="col-auto text-end"><a href="javascript:void(0)" id="cancelorderbtn" onclick="cancelOrder('<?php echo e($orderdetails[0]->idoforder); ?>')" class="btn btn-danger btn-sm ml-2">Cancel order</a></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade lg sm" id="review-modal" tabindex="-1" aria-labelledby="review-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form accept-charset="UTF-8" enctype="multipart/form-data" class="form-contact comment_form form-review-product">
                            <?php echo csrf_field(); ?>
                            
                            <input type="hidden" id="productid" name="productid" value="">
                            <div class="form-group"><label>Quality</label>
                                <div class="rate"><input type="radio" id="star1" name="star" value="1"><label for="star1" title="text">1 star</label><input type="radio" id="star2" name="star" value="2"><label for="star2" title="text">2 star</label><input type="radio" id="star3" name="star" value="3"><label for="star3" title="text">3 star</label><input type="radio" id="star4" name="star" value="4"><label for="star4" title="text">4 star</label><input type="radio" id="star5" name="star" value="5" checked="checked"><label for="star5" title="text">5 star</label></div>
                            </div>
                            <div class="form-group"><textarea name="comment" id="comment" cols="50" rows="9" placeholder="Write Comment" class="form-control w-200"></textarea></div>
                            <div class="form-group">
                                <script type="text/x-custom-template" id="review-image-template"><span class="image-viewer__item" data-id="__id__"><img src= alt="Preview" class="img-responsive d-block"><span class="image-viewer__icon-remove"><i class="fi-rs-cross"></i></span></span></script>
                                <div class="image-upload__viewer d-flex">
                                    <div class="image-viewer__list position-relative">
                                        <div class="image-upload__uploader-container">
                                            <div class="d-table">
                                                <div class="image-upload__uploader"><i class="fi-rs-camera image-upload__icon"></i>
                                                    <div class="image-upload__text">Upload photos</div><input type="file" id="reviewimages" name="images[]" data-max-files="6" accept="image/png,image/jpeg,image/jpg" multiple="multiple" data-max-size="2048" data-max-size-message="The __attribute__ must not be greater than __max__ kilobytes." class="image-upload__file-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="loading">
                                            <div class="half-circle-spinner">
                                                <div class="circle circle-1"></div>
                                                <div class="circle circle-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div><span class="help-block d-inline-block"> You can upload up to 6 photos, each photo maximum size is 2048 kilobytes </span></div>
                            </div>
                            <div class="form-group"><button type="button" class="button button-contactForm" id="review-submit-btn">Submit Review</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("trackOrder_pop");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
    $(document).off("click", "#review-modal-btn").on("click", "#review-modal-btn", function() {
        var productid = $(this).attr('data-productid')
        $('#review-modal #productid').val(productid);
        $('#review-modal').modal('show');
    });

    $(document).off("click", "#review-submit-btn").on("click", "#review-submit-btn", function() {

        var productid = $('#review-modal #productid').val();
        var star = $('input[name="star"]:checked').val();
        var review = $('#comment').val();
        var fformdata = new FormData();

        var files = $("#reviewimages").get(0).files;    
        for (var i = 0; i < files.length; i++) {
            fformdata.append('reviewimage[]', files[i]);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fformdata.append('productid', productid);
        fformdata.append('star', star);
        fformdata.append('review', review);

        $.ajax({
            type: 'post',
            url: '/products/review-product',
            data: fformdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                if (response.status == true) {
                    alertify.success('Review saved successfully');
                    $('#review-modal').modal('hide');
                } else {
                    alertify.error('Review not added');
                }
            },
            dataType: 'json'
        })

    });



    function cancelOrder(id) {
        var status = alertify.confirm("Are you sure to cancel this order?", function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/cancel-order/' + id,
                success: function(result) {
                    if (result.status == true) {
                        alertify.success(result.message);
                        $('#cancelorderbtn').attr('disabled', true);
                        $('#downloadinvoicebtn').attr('disabled', true);
                        window.location.reload();
                    } else {
                        alertify.error(result.message);
                    }
                },
                dataType: 'json'
            });
        });
    }


    function cancelOrderVendorwise(id, orderid) {
        var status = alertify.confirm("Are you sure to cancel this order for this vendor?", function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/cancel-order-vendorwise/' + id + '/' + orderid,
                success: function(result) {
                    if (result.status == true) {
                        alertify.success(result.message);
                        $('#cancelordervendorwise-' + id + "-" + orderid).parent().append('<a href="javascript:void(0)" style="pointer-events: none" class="btn btn-info btn-sm">Cancelled</a>');
                        $('#cancelordervendorwise-' + id + "-" + orderid).remove();
                    } else {
                        alertify.error(result.message);
                    }
                },
                dataType: 'json'
            });
        });
    }
</script><?php /**PATH /var/www/spicebucket/resources/views/invoice.blade.php ENDPATH**/ ?>