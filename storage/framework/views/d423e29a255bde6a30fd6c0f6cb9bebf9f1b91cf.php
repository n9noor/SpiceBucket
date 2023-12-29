
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div>
                Orders
            </div>
        </div>
    </div>
</div>
<div class="mb-3 p-3 card">
    <form method="post" id="order-search-frm" class="form-horizontal mx-2">
        <?php echo csrf_field(); ?>
        <div class="row">
			
            <div class="col-md-10">
                <div class="position-relative">
                    <button type="button" class="btn btn-primary" id="daterange">
                        <i class="fa fa-calendar pe-1"></i>
                        <span></span>
                        <i class="fa ps-1 fa-caret-down"></i>
                    </button>
                    <input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="<?php echo e(old('formdate')); ?>">
                    <input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="<?php echo e(old('todate')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
            </div>
        </div>
    </form>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive" style="">
            <table class="table table-bordered table-striped" style="">
                <thead>
                    <tr>
                        <th nowrap class="no-sort">#</th>
                        <th nowrap class="default-sort">Created At</th>
                        <th nowrap>Order Id</th>
                        <th nowrap>Customer Name</th>
                        <?php if(session('admin-logged-in') == true): ?>
                        <th nowrap>Vendor</th>
                        <?php endif; ?>
                        <th nowrap>Amount</th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Discount</th>
                        <th nowrap>Shipping</th>
                        <th nowrap>COD</th>
                        <th nowrap>Total Amount</th>
                        <th nowrap>Payment Method</th>
                        <th nowrap>Payment Status</th>
                        <th nowrap>Status</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td nowrap><a href="/sellers/orders/view/<?php echo e($order->idoforder); ?>/<?php echo e($order->vendor_id); ?>">View</a></td>
                        <td data-sort="<?php echo e(strtotime($order->order_datetime)); ?>" nowrap><?php echo e(date('d/M/Y h:i A', strtotime($order->order_datetime))); ?></td>
                        <td nowrap><?php echo e($order->orderid); ?></td>
                        <td nowrap><?php echo e(is_null($order->customerName) ? ($order->firstname . " " . $order->lastname) : $order->customerName); ?> </td>
                        <?php if(session('admin-logged-in') == true): ?>
                        <td nowrap><?php echo e($order->vendor); ?></td>
                        <?php endif; ?>
                        <?php
                        $baseshippingprice = round(($order->shipping_charges * 100) / (100 + $order->gst_rate), 2);
                        $gstshippingprice = $order->shipping_charges - $baseshippingprice;
                        ?>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->totalOrderPrice, 2)); ?> </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format(($order->OrderGSTPrice + $gstshippingprice), 2)); ?> </td>
                        <?php if($order->discount > 0): ?>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->discount, 2)); ?> </td>
                        <?php else: ?>
                        <td nowrap><i class="fa fa-rupee-sign"></i> 0.00</td>
                        <?php endif; ?>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($baseshippingprice, 2)); ?> </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->cod_charges, 2)); ?> </td>
                        <td style="text-align: center;" nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->totalOrderPrice + $order->OrderGSTPrice + $order->shipping_charges + $order->cod_charges - $order->discount, 2)); ?> </td>
                        <td nowrap><?php echo e(strtoupper($order->payment_source)); ?></td>
                        <td nowrap><?php echo e(ucwords($order->payment_status)); ?></td>
                        <td nowrap><?php echo e(ucwords(($order->order_status == 'cancel') ? "cancelled" : $order->order_status)); ?></td>
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
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/moment/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/order-details.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/orders/orderlist.blade.php ENDPATH**/ ?>