
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Offer
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="/offer/update/<?php echo e($offer->id); ?>" enctype="multipart/form-data" method="post" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Choose Image" />
                        <img width="100" height="100" src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/offers/' . $offer->imagepath) : url('/images/offers/' . $offer->imagepath)); ?>" class="img-thumbnail" />
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Heading" value="<?php echo e($offer->heading); ?>" />
                        <?php $__errorArgs = ['heading'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="sub_heading" class="form-label">Sub Heading</label>
                        <input type="text" class="form-control" name="sub_heading" id="sub_heading" placeholder="Enter Sub Heading" value="<?php echo e($offer->heading); ?>" />
                        <?php $__errorArgs = ['sub_heading'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative mb-3">
                        <label for="discount_upto" class="form-label">Discount Upto</label>
                        <input type="text" class="form-control" name="discount_upto" id="discount_upto" placeholder="Enter Sub Heading" value="<?php echo e($offer->discount_upto); ?>" />
                        <?php $__errorArgs = ['discount_upto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="vendorid" class="form-label">Vendors</label>
                        <select class="form-control" name="vendorid" id="vendorid" placeholder="Select Vendor">
                            <option value=""></option>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($offer->vendor_id == $vendor->id ? "selected='selected'" : ""); ?> value="<?php echo e($vendor->id); ?>"><?php echo e($vendor->store_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['vendorid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="categoryid" class="form-label">Category</label>
                        <select class="form-control" name="categoryid" id="categoryid" placeholder="Select Category">
                            <option value=""></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e($offer->category_id == $category->id ? "selected='selected'" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['categoryid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" <?php echo e($offer->is_featured == 1 ? "checked='checked'" : ""); ?>  name="is_featured" id="is_featured">
                        <label class="form-check-label" for="is_featured">
                            Is Featured?
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <select class="form-control" name="featured_category" id="featured_category" placeholder="">
                        <option value=""></option>
                        <option <?php echo e($offer->featured_category == "most_popular_brands" ? "selected='selected'" : ""); ?> value="most_popular_brands">Most Popular Brands</option>
                        <option <?php echo e($offer->featured_category == "latest_offers" ? "selected='selected'" : ""); ?> value="latest_offers">Latest Offers</option>
                        <option <?php echo e($offer->featured_category == "top_selling_brands" ? "selected='selected'" : ""); ?> value="top_selling_brands">Top Selling Brands</option>
                        <option <?php echo e($offer->featured_category == "deal_of_the_day" ? "selected='selected'" : ""); ?> value="deal_of_the_day">Deal of the Day</option>
                        <option <?php echo e($offer->featured_category == "highly_discounted_offers" ? "selected='selected'" : ""); ?> value="highly_discounted_offers">Highly Discounted Offer</option>
                        <option <?php echo e($offer->featured_category == "new_at_spice_bucket" ? "selected='selected'" : ""); ?> value="new_at_spice_bucket">New At Spice Bucket</option>
                        <option <?php echo e($offer->featured_category == "daily_essential_needs" ? "selected='selected'" : ""); ?> value="daily_essential_needs">Daily Essential Needs</option>
                        <option <?php echo e($offer->featured_category == "popular_stores" ? "selected='selected'" : ""); ?> value="popular_stores">Popular Stores</option>
                        <option <?php echo e($offer->featured_category == "bestsellers" ? "selected='selected'" : ""); ?> value="bestsellers">Bestsellers</option>
                        <option <?php echo e($offer->featured_category == "recommended_for_you" ? "selected='selected'" : ""); ?> value="recommended_for_you">Recommended For You</option>
                    </select>
                </div>
            </div>
            <button class="mt-1 mb-3 btn btn-primary">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/offers.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/offers/edit.blade.php ENDPATH**/ ?>