
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Sale Summary
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th nowrap>Order Month</th>
                        <th nowrap>Total Orders</th>
                        <th nowrap>Order Amount</th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Shipping Amount</th>
                        <th nowrap>Payable Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td nowrap><?php echo e($order->order_month); ?></td>
                        <td nowrap><?php echo e($order->total_orders); ?></td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->order_amount, 2)); ?> </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->tax_amount, 2)); ?> </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->shipping_amount, 2)); ?> </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> <?php echo e(number_format($order->order_amount + $order->tax_amount + $order->shipping_amount, 2)); ?> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/reports/sale_summary.blade.php ENDPATH**/ ?>