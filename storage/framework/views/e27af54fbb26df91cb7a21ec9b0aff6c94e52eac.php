
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Home Banner
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
        <form action="/administrator/edit-static-pages/save-home" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="bannner-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <?php if(array_key_exists('banner', $home)): ?>
                <?php for($i=0; $i<count($home['banner']); $i++): ?> <div class="homeBanner" id="home-banner-div-<?php echo e($i+1); ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="position-relative mb-3">
                                <label for="home-banner" class="form-label">Desktop Banner</label>
                                <input type="file" class="form-control" name="home[banner][]" id="home-banner-<?php echo e($i+1); ?>" />
                                <?php if(array_key_exists('banner', $home) && array_key_exists($i, $home['banner']) && strlen($home['banner'][$i]) > 0): ?>
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $home['banner'][$i]) : url(env('APP_URL') . '/images/staticImages/' . $home['banner'][$i])); ?>" height="100" width="100" />
                                <?php endif; ?>
                                <?php $__errorArgs = ['home-banner'];
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
                        <div class="col-md-5">
                            <div class="position-relative mb-3">

                                <label for="home-mobile-banner" class="form-label">Mobile Banner</label>
                                <input type="file" class="form-control" name="home[mobilebanner][]" id="home-mobile-banner-<?php echo e($i+1); ?>" />
                                <?php if(array_key_exists('mobilebanner', $home) && array_key_exists($i, $home['mobilebanner']) && strlen($home['mobilebanner'][$i]) > 0): ?>
                                <img src="<?php echo e(env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $home['mobilebanner'][$i]) : url(env('APP_URL') . '/images/staticImages/' . $home['mobilebanner'][$i])); ?>" height="100" width="100" />
                                <?php endif; ?>
                                <?php $__errorArgs = ['home-mobile-banner'];
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
                        <div class="col-md-1 mt-3">
                            <div class="position-relative">
                                <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteHomeBanner(<?php echo e($i+1); ?>, '<?php echo e(array_key_exists('mobilebanner', $home) && array_key_exists($i, $home['mobilebanner']) && strlen($home['mobilebanner'][$i]) > 0 ? $home['mobilebanner'][$i] : ''); ?>','<?php echo e(array_key_exists('banner', $home) && array_key_exists($i, $home['banner']) && strlen($home['banner'][$i]) > 0 ? $home['banner'][$i] : ''); ?>')" id="delete-home-div-<?php echo e($i+1); ?>" type="button"><i class="fa fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
            </div>
            <?php endfor; ?>
            <?php else: ?>
            <div class="homeBanner" id="home-banner-div-1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-3">
                            <label for="home-banner" class="form-label"> Desktop Banner</label>
                            <input type="file" class="form-control" name="home[banner][]" id="home-banner-1" />
                            <?php $__errorArgs = ['home-banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label for="home-mobile-banner" class="form-label"> Mobile Banner</label>
                            <input type="file" class="form-control" name="home[mobilebanner][]" id="home-mobile-banner-1" />
                            <?php $__errorArgs = ['home-mobile-banner'];
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
                    <div class="col-md-1 mt-3">
                        <div class="position-relative">
                            <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteHomeBanner(1)" id="delete-home-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
    </div>
    <button class="mt-1 btn btn-primary">Save</button>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascripts'); ?>

<script type="text/javascript" src="<?php echo e(asset('backend/js/static-page.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/staticpage/home.blade.php ENDPATH**/ ?>