
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Discount Coupons
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/administrator/add-coupon'" title="Add Coupons" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Coupons
            </button>
        </div>
    </div>
</div>
<?php if(Session::has('message')): ?>
<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Status</th>
                        <th class="text-center">Coupon Code</th>
                        <th class="text-center">Coupon Detail</th>
                        <th class="text-center">In Stock</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
						<th class="text-center">Delete Coupon</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        
                        <td nowrap class="text-center">
                            <input data-column="is_active" data-type="coupon" data-id="<?php echo e($coupon->id); ?>" type="checkbox" <?php echo e($coupon->is_active == true ? " checked='checked'" : ""); ?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td nowrap class="text-center"><strong><?php echo e($coupon->coupon_code); ?></strong></td>
						<td nowrap class="text-center coupon-detail"><a href="javascript:void(0)" data-description='<?php echo $coupon->coupon_description; ?>'>View Detail</a></td>
                        <!--<td nowrap><?php echo $coupon->coupon_description; ?></td>-->
                        <td nowrap class="text-center"><?php echo e($coupon->coupon_usage()->count()); ?></td>
                        <td nowrap class="text-center"><?php echo e(date('d/M/y', strtotime($coupon->start_datetime))); ?></td>
                        <td nowrap class="text-center"><?php echo e(!is_null($coupon->end_datetime) ? date('d/M/y', strtotime($coupon->end_datetime)) : '-'); ?></td>
						<td nowrap class="text-center delete-button">
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/delete-coupon/<?php echo e($coupon->id); ?>"><i class="btn-icon-wrapper fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade lg sm" id="coupon-detail-modal" tabindex="-1" aria-labelledby="coupon-detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')); ?>"></script>
<script>
    $(document).off("click", ".coupon-detail a").on("click", ".coupon-detail a", function() {
        $('#coupon-detail-modal .modal-body .row .col-lg-12').html($(this).attr('data-description'));
        $('#coupon-detail-modal').modal('show');
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/coupons/index.blade.php ENDPATH**/ ?>