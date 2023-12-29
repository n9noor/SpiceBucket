
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Offers
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/offer/add'" title="Add Offer" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Offer
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th class="no-sort">Active</th>
                        <th class="no-sort">Image</th>
                        <th class="default-sort">Heading</th>
                        <th>Vendor</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Featured Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/offer/edit/<?php echo e($offer->id); ?>"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/offer/delete/<?php echo e($offer->id); ?>"><i class="btn-icon-wrapper fa fa-trash"></i></a>
                        </td>
                        <td><input data-column="is_active" data-type="offer" data-id="<?php echo e($offer->id); ?>" type="checkbox" <?php echo e($offer->is_active == true ? " checked='checked'" : ""); ?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                        <td><img width="75" height="75" src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/offers/' . $offer->imagepath) : url('/images/offers/' . $offer->imagepath)); ?>" alt="<?php echo e($offer->heading); ?>" class="img-thumbnail" /></td>
                        <td><?php echo e($offer->heading); ?></td>
                        <td><?php echo e($offer->store_name); ?></td>
                        <td><?php echo e($offer->category); ?> / <?php echo e($offer->sub_category); ?></td>
                        <td><?php if($offer->is_featured == 1): ?> <div class="mb-2 me-2 badge bg-success">Yes</div> <?php else: ?> <div class="mb-2 me-2 badge bg-danger">No</div> <?php endif; ?></td>
                        <td>
                            <?php switch($offer->featured_category):
                            case ("most_popular_brands"): ?>
                            Most Popular Brands
                            <?php break; ?>
                            <?php case ("latest_offers"): ?>
                            Latest Offers
                            <?php break; ?>
                            <?php case ("top_selling_brands"): ?>
                            Top Selling Brands
                            <?php break; ?>
                            <?php case ("deal_of_the_day"): ?>
                            Deal of the Day
                            <?php break; ?>
                            <?php case ("highly_discounted_offers"): ?>
                            Highly Discounted Offer
                            <?php break; ?>
                            <?php case ("new_at_spice_bucket"): ?>
                            New At Spice Bucket
                            <?php break; ?>
                            <?php case ("daily_essential_needs"): ?>
                            Daily Essential Needs
                            <?php break; ?>
                            <?php case ("popular_stores"): ?>
                            Popular Stores
                            <?php break; ?>
                            <?php case ("bestsellers"): ?>
                            Bestsellers
                            <?php break; ?>
                            <?php case ("recommended_for_you"): ?>
                            Recommended For You
                            <?php break; ?>
                            <?php endswitch; ?>
                        </td>
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
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/offers.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/offers/list.blade.php ENDPATH**/ ?>