
<?php $__env->startSection("content"); ?>
<!--<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Orders
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
    </div>
</div>-->
<div class="mb-3 p-3 card">
<h2>Order Detail</h2>
	<hr>
    <form method="post" id="order-search-frm" class="form-horizontal mx-2">
        <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="orderno" class="form-label">Order No:</label>
                            <input type="text" class="form-control" name="orderno" id="orderno" placeholder="Enter Order No" value="<?php echo e(old('orderno')); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="paymentmode" class="form-label">Payment Mode:</label>
                            <select class="form-control" name="paymentmode" id="paymentmode">
                                <option value="">All</option>
                                <option value="cash">Cash</option>
                                <option value="prepaid">Prepaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative mb-3">
                            <label for="paymentstatus" class="form-label">Payment Status:</label>
                            <select class="form-control" name="paymentstatus" id="paymentstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                    </div>
					</div>
					<div class="row">
					<div class="col-md-4">
						<div class="position-relative mb-3">
							<label class="control-label form-label">Date Range:</label><br>
							<button type="button" class="btn btn-primary" id="daterange" style="width: 100%;">
								<i class="fa fa-calendar pe-1"></i>
								<span></span>
								<i class="fa ps-1 fa-caret-down"></i>
							</button>
							<input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="<?php echo e(old('formdate')); ?>">
							<input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="<?php echo e(old('todate')); ?>">
						</div>
					</div>
					<div class="col-md-3">
                        <div class="position-relative mb-3">
                            <label for="deliverystatus" class="form-label">Delivery Status:</label>
                            <select class="form-control" name="deliverystatus" id="deliverystatus">
                                <option value="">All</option>
                                <?php $__currentLoopData = $delivery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->delivery_status); ?>"><?php echo e($status->delivery_status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="position-relative mb-3">
                            <label for="orderstatus" class="form-label">Order Status:</label>
                            <select class="form-control" name="orderstatus" id="orderstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="complete">Completed</option>
                                <option value="cancel">Cancelled</option>
                                <option value="return">Returned</option>
                            </select>
                        </div>
                    </div>
					<div class="col-md-2 mt-4">
						<button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
					</div>
                </div>
            <!--<div class="col-md-3">
                <div class="position-relative mb-3">
                    <label class="control-label form-label">Date Range;</label>
                    <button type="button" class="btn btn-primary" id="daterange">
                        <i class="fa fa-calendar pe-1"></i>
                        <span></span>
                        <i class="fa ps-1 fa-caret-down"></i>
                    </button>
                    <input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="<?php echo e(old('formdate')); ?>">
                    <input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="<?php echo e(old('todate')); ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="deliverystatus" class="form-label">Delivery Status:</label>
                            <select class="form-control" name="deliverystatus" id="deliverystatus">
                                <option value="">All</option>
                                <?php $__currentLoopData = $delivery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->delivery_status); ?>"><?php echo e($status->delivery_status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="orderstatus" class="form-label">Order Status:</label>
                            <select class="form-control" name="orderstatus" id="orderstatus">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="complete">Completed</option>
                                <option value="cancel">Cancelled</option>
                                <option value="return">Returned</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 mt-4">
                <button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
            </div>-->
    </form>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered dark" style="width:100%; overflow-x:scroll; overflow-y:auto !important;">
                <thead>
                    <tr>
                        <th nowrap>Order No</th>
                        <th nowrap class="default-sort">Order Date</th>
                        <th nowrap>Dispatch Date</th>
                        <th nowrap>Delivered Date</th>
                        <th nowrap>Customer Name</th>
                        <?php if(session('admin-logged-in') == true): ?>
                        <th nowrap>Seller</th>
                        <?php endif; ?>
                        <th nowrap>Gross Amount</th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Discount</th>
                        <th nowrap>Shipping</th>
                        <th nowrap>COD</th>
                        <th nowrap>Total Amount</th>
                        <th nowrap>Total Quantity</th>
                        <th nowrap>Payment Method</th>
                        <th nowrap>Payment Status</th>
                        <th nowrap>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td nowrap><a href="/sellers/orders/view/<?php echo e($order->idoforder); ?>/<?php echo e($order->vendor_id); ?>"><?php echo e($order->orderid); ?></a></td>
                        <td data-sort="<?php echo e(strtotime($order->order_datetime)); ?>" nowrap><?php echo e(date('dS M Y, h:i A', strtotime($order->order_datetime))); ?></td>
                        <td data-sort="<?php echo e(strtotime($order->tentative_dispatch_date)); ?>" nowrap><?php echo e(!is_null($order->tentative_dispatch_date) ? date('dS M Y, h:i A', strtotime($order->tentative_dispatch_date)) : ""); ?></td>
                        <td data-sort="<?php echo e(strtotime($order->tentative_delivery_date)); ?>" nowrap><?php echo e(!is_null($order->tentative_delivery_date) ? date('dS M Y, h:i A', strtotime($order->tentative_delivery_date)) : ""); ?></td>
                        <td nowrap><?php echo e(is_null($order->customerName) ? ($order->firstname . " " . $order->lastname) : $order->customerName); ?> </td>
                        <?php if(session('admin-logged-in') == true): ?>
                        <td nowrap><?php echo e($order->vendor); ?></td>
                        <?php endif; ?>
                        <?php
                        $baseshippingprice = round(($order->shipping_charges * 100) / (100 + $order->gst_rate), 2);
                        $gstshippingprice = $order->shipping_charges - $baseshippingprice;
                        ?>
                        <td style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->totalOrderPrice, 2)); ?> </td>
                        <td  style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($order->OrderGSTPrice + $gstshippingprice), 2)); ?> </td>
                        <?php if($order->discount > 0): ?>
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->discount, 2)); ?> </td>
                        <?php else: ?>
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> 0.00</td>
                        <?php endif; ?>
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($baseshippingprice, 2)); ?> </td>
                        <td  style="text-align: center;"  nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->cod_charges, 2)); ?> </td>
                        <td  style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->totalOrderPrice + $order->OrderGSTPrice + $order->shipping_charges + $order->cod_charges - $order->discount, 2)); ?> </td>
                        <td  style="text-align: center;"  nowrap><?php echo e(strtoupper($order->quantity)); ?></td>
                        <td nowrap><?php echo e($order->payment_source == 'cod' ? "Cash On Delivery" : "Razorpay"); ?></td>
                        <td nowrap><?php echo e($order->payment_status == 'pending' ? ucwords($order->payment_status) : "Received"); ?></td>
                        <td nowrap><?php echo e(ucwords($order->order_status)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('stylesheets'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/vendors/datatables.net-buttons/css/bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap-table/dist/bootstrap-table.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>-->
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/moment/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/generate-report.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/reports/order.blade.php ENDPATH**/ ?>