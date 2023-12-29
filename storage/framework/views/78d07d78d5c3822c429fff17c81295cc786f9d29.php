
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Profile: <?php echo e($vendor->store_name); ?>

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
        <form action="/sellers/update-profile" method="post" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="gst" class="form-label">Good and Service Tax (GST) Number</label>
                        <input name="gst" readonly="readonly" id="gst" placeholder="GST Number" type="text" class="form-control" value="<?php echo e($vendor->gst); ?>">
                        <?php $__errorArgs = ['gst'];
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
                        <label for="responsible_person" class="form-label">Responsible Person</label>
                        <input name="responsible_person" id="responsible_person" placeholder="Responsible Person" type="text" class="form-control" value="<?php echo e($vendor->responsible_person); ?>">
                        <?php $__errorArgs = ['responsible_person'];
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
                        <label for="store_name" class="form-label">Store Name</label>
                        <input name="store_name" id="store_name" placeholder="Store Name" type="text" class="form-control" value="<?php echo e($vendor->store_name); ?>">
                        <?php $__errorArgs = ['store_name'];
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
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input name="brand_name" id="brand_name" placeholder="Brand Name" type="text" class="form-control" value="<?php echo e($vendor->vendor_alias); ?>">
                        <?php $__errorArgs = ['brand_name'];
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
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="store_address" class="form-label">Store Address</label>
                        <textarea name="store_address" id="store_address" placeholder="Store Address" class="form-control"><?php echo e($vendor->address); ?></textarea>
                        <?php $__errorArgs = ['store_address'];
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
                        <label for="email" class="form-label">
                            Business Email
                        </label>
                        <div class="input-group">
                            <input name="email" readonly="readonly" id="email" placeholder="Email here..." type="email" class="form-control" value="<?php echo e($vendor->business_emailid); ?>">
                            <?php if($vendor->email_verified == true): ?>
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            <?php else: ?>
                            <button type="button" class="btn btn-primary" onclick="verifyEmail($('#email').val())"><i class="fa fa-sign"></i> Verify</button>
                            <?php endif; ?>
                        </div>
                        <?php $__errorArgs = ['email'];
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
                        <label for="alternateemail" class="form-label">
                            Alternate Business Email
                        </label>
                        <div class="input-group">
                            <input name="alternateemail" id="alternateemail" placeholder="Email here..." type="email" class="form-control" value="<?php echo e($vendor->alternateemail_business_emailid); ?>">
                            <?php if($vendor->alternate_email_verified == true): ?>
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            <?php else: ?>
                            <button type="button" class="btn btn-primary" onclick="verifyAltEmail($('#alternateemail').val())"><i class="fa fa-sign"></i> Verify</button>
                            <?php endif; ?>
                        </div>
                        <?php $__errorArgs = ['alternateemail'];
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
                        <label for="phone" class="form-label">
                            Phone
                        </label>
                        <div class="input-group">
                            <input name="phone" id="phone" placeholder="Mobile Number" type="text" class="form-control" value="<?php echo e($vendor->phone); ?>">
                            <?php if($vendor->phone_verified == true): ?>
                            <button type="button" class="btn btn-success"><i class="fa fa-sign"></i> Verified</button>
                            <?php else: ?>
                            <button type="button" class="btn btn-primary" onclick="verifyPhone($('#phone').val())"><i class="fa fa-sign"></i> Verify</button>
                            <?php endif; ?>
                        </div>
                        <?php $__errorArgs = ['phone'];
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
                        <label for="shipping_pincode" class="form-label">
                            Shipping Pincode
                        </label>
                        <input name="shipping_pincode" id="shipping_pincode" placeholder="Shipping Pincode" type="text" class="form-control" value="<?php echo e($vendor->shipping_pincode); ?>">
                        <?php $__errorArgs = ['shipping_pincode'];
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
                        <label for="image" class="form-label">
                            Logo
                        </label>
                        <input name="image" id="image" type="file" class="form-control">
                        <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor->image) : url('/images/vendors/' . $vendor->image)); ?>" class="img-thumbnail" />
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
            </div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/vendor-function.js')); ?>"></script>
<div class="modal fade" id="verify-otp-modal" tabindex="-1" role="dialog" aria-labelledby="verify-otp-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verify-otp-modal-title">Enter OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="position-relative mb-3">
                            <input type="hidden" id="verify-type" name="verify-type" />
                            <input name="otpchar" id="otpchar" type="text" class="form-control" />
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id='verify-otp'>Verify</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/vendor/profile.blade.php ENDPATH**/ ?>