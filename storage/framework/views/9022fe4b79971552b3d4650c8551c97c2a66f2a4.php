
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Settings: <?php echo e($vendor->store_name); ?>

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
        <form action="/sellers/update-setting" method="post" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label class="form-label">Slider Images</label>
                        <?php $counter = count($sliderImages); ?>
                        <?php $__currentLoopData = $sliderImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <input name="sliderimage[]" type="file" class="form-control mb-1">
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $image['image']) : url('/images/vendors/' . $image['image'])); ?>" class="img-thumbnail" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <select name="slidercategory[]" class="form-control mb-1">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e($image['category'] == $category->id ? "selected='selected'" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-1 mb-2">
                                <button type="button" onclick="deleteSliderImage('<?php echo e($image['image']); ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <input name="sliderimage[]" type="file" class="form-control mb-1">
                            </div>
                            <div class="col-md-3">
                                <select name="slidercategory[]" class="form-control mb-1">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="add-vendor-slider-image-btn" onclick="addSliderImage()" class="btn btn-danger"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <?php $__errorArgs = ['sliderimage'];
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
				<div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                <?php $vendor_offer_image_1 = is_null($vendor->vendor_offer_image_1) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_1, true); ?>
                                <label for="vendor_offer_image_1" class="form-label">Offer Image 1</label>
                                <input name="vendor_offer_image_1" id="vendor_offer_image_1" type="file" class="form-control mt-1">
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_1['image']) : url('/images/vendors/' . $vendor_offer_image_1['image'])); ?>" class="img-thumbnail" />
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
                            <select name="vendor_offer_category_1" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($vendor_offer_image_1['category'] == $category->id ? "selected='selected'" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                <?php $vendor_offer_image_2 = is_null($vendor->vendor_offer_image_2) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_2, true); ?>
                                <label for="vendor_offer_image_2" class="form-label">Offer Image 2</label>
                                <input name="vendor_offer_image_2" id="vendor_offer_image_2" type="file" class="form-control mt-1">
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_2['image']) : url('/images/vendors/' . $vendor_offer_image_2['image'])); ?>" class="img-thumbnail m-2" />
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
                            <select name="vendor_offer_category_2" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($vendor_offer_image_2['category'] == $category->id ? "selected='selected'" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                <?php $vendor_offer_image_3 = is_null($vendor->vendor_offer_image_3) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_3, true); ?>
                                <label for="vendor_offer_image_3" class="form-label">Offer Image 3</label>
                                <input name="vendor_offer_image_3" id="vendor_offer_image_3" type="file" class="form-control  mt-1">
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_3['image']) : url('/images/vendors/' . $vendor_offer_image_3['image'])); ?>" class="img-thumbnail m-2" />
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
                            <select name="vendor_offer_category_3" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($vendor_offer_image_3['category'] == $category->id ? "selected='selected'" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="position-relative mb-3 document-style">
                        <label for="document-<?php echo e(str_replace(' ', '-', strtolower($type->type))); ?>" class="form-label"><?php echo e($type->type); ?></label>
                        <input name="document[<?php echo e(str_replace(' ', '_', strtolower($type->type))); ?>]" id="document-<?php echo e(str_replace(' ', '-', strtolower($type->type))); ?>" type="file" class="form-control">
                        <?php if(array_key_exists(str_replace(' ', '_', strtolower($type->type)), $documents)): ?>
                        <?php if(substr($documents[str_replace(' ', '_', strtolower($type->type))], -4) == ".pdf"): ?>
                        <a class="m-2" target="_blank" href="<?php echo e(env('APP_ENV') == 'production' ? url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])); ?>"><img src="<?php echo e(asset('/images/pdficon.png')); ?>" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                        <?php else: ?>
                        <a class="m-2" target="_blank" href="<?php echo e(env('APP_ENV') == 'production' ? url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])); ?>"><img src="<?php echo e(env('APP_ENV') == 'production' ? asset('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : asset('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])); ?>" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php $__errorArgs = ["document[<?php echo e(str_replace(' ', '_', strtolower($type->type))); ?>]"];
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__errorArgs = ["document"];
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
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/vendor-function.js')); ?>"></script>
<script>
    function addSliderImage() {
        var count = $('#add-vendor-slider-image-btn').parent().parent().parent().find('.row').length;
        var html = '<div class="row">' +
            '<div class="col-md-8">' +
            '<input name="sliderimage[]" type="file" class="form-control mb-1">' +
            '</div>' +
            '<div class="col-md-3">' +
            '<select name="slidercategory[]" class="form-control mb-1"><option value=""></option>';
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        html += '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>';
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        html += '</select>' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" id="add-vendor-slider-image-btn" onclick="$(this).parent().parent().remove();" class="btn btn-danger"><i class="fa fa-trash"></i></button>' +
            '</div>' +
            '</div>';
        $('#add-vendor-slider-image-btn').parent().parent().parent().find('label').after(html);
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/vendor/settings.blade.php ENDPATH**/ ?>