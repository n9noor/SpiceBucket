<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Register - SpiceBucket Vendor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/ionicons-npm/css/ionicons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/linearicons-master/dist/web-font/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css')); ?>">
    <link href="<?php echo e(asset('backend/styles/css/base.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="registeration-page">
                <div class="g-0 row">
					<div class="d-lg-flex d-xs-none col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider slick-initialized">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('<?php echo e(asset('backend/images/originals/high-angle-indian-spices-with-spoons.jpg')); ?>');"></div>
                                        <div class="slider-content">
                                            <div class="app-logos"><img src="<?php echo e(asset('images/logo-color.png')); ?>" style="width:150px; margin-bottom:20px;"></div>
                                            <div class="registration-left">
												<h3>India's First Online Spices & Food Items Store </h3>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="seller-regi">
								<h2>Welcome to Seller Registration Form</h2>
								<hr>

                                 <?php if(Session::has('message')): ?>
                                <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
                                    <script>
                                       setTimeout(function() {
                                           window.location.href = "/"
                                       }, 2000); // 2 second
                                    </script>
                                <?php endif; ?>
							</div>
                            <div>
                                <form method="post" enctype="multipart/form-data" class="form-horizontal" action="/sellers/registration">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="token" id="token" value="<?php echo e(csrf_token()); ?>" />
                                    <div class="row">
										<!-- html for radio button to ask which purpose the seller is here -->
										<div class="col-md-3">
											<p>Registration for:</p>
										</div>
										<div class="form-check form-check-inline col-md-2">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
										  <label class="form-check-label" for="inlineCheckbox1">B2C</label>
										</div>
										<div class="form-check form-check-inline col-md-2">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
										  <label class="form-check-label" for="inlineCheckbox2">B2B</label>
										</div>
										<div class="form-check form-check-inline col-md-2">
										  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
										  <label class="form-check-label" for="inlineCheckbox3">Both</label>
										</div>
										<div class="col-md-3"></div>
										<!-- html for radio button to ask which purpose the seller is here -->
										
                                        <div class="col-md-12">
                                            <div class="position-relative mb-3">
                                                <label for="gst" class="form-label">
                                                    <span class="text-danger">*</span> Good and Service Tax (GST) Number
                                                </label>
                                                <div class="input-group">
                                                    <input name="gst" id="gst" placeholder="GST Number" type="text" class="form-control" value="<?php echo e(old('gst')); ?>">
                                                    <button type="button" class="btn btn-primary" onclick="verify($('#gst').val())"><i class="fa fa-sign"></i> Validate</button>
                                                    <input type="hidden" id="verified" name="verified" value="0" />
                                                </div>
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
                                        <div class="col-md-12">
                                            <div class="position-relative mb-3">
                                                <label for="store_address" class="form-label">
                                                    <span class="text-danger">*</span> Store Address
                                                </label>
                                                <textarea readonly name="store_address" id="store_address" placeholder="Address of store" class="form-control"><?php echo e(old('store_address')); ?></textarea>
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
                                                <label for="shop_name" class="form-label">
                                                    <span class="text-danger">*</span> Company Name
                                                </label>
                                                <input name="shop_name" id="shop_name" placeholder="Enter Company Name" type="text" class="form-control" value="<?php echo e(old('shop_name')); ?>">
                                                <?php $__errorArgs = ['shop_name'];
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
                                                <label for="owner_name" class="form-label">
                                                    <span class="text-danger">*</span> Contact Person
                                                </label>
                                                <input name="owner_name" id="owner_name" placeholder="Enter name" type="text" class="form-control" value="<?php echo e(old('owner_name')); ?>">
                                                <?php $__errorArgs = ['owner_name'];
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
                                                <label for="brand_name" class="form-label">
                                                    <span class="text-danger">*</span> Brand Name
                                                </label>
                                                <input name="brand_name" id="brand_name" placeholder="Enter Brand Name" type="text" class="form-control" value="<?php echo e(old('brand_name')); ?>">
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
                                        <div class="col-md-6">
                                            <div class="position-relative mb-3">
                                                <label for="email" class="form-label">
                                                    <span class="text-danger">*</span> Business Email
                                                </label>
                                                <input name="email" id="email" placeholder="Enter Business Email here" type="email" class="form-control" value="<?php echo e(old('email')); ?>">
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
                                        <div class="col-md-6">
                                            <div class="position-relative mb-3">
                                                <label for="phone" class="form-label">
                                                    Phone
                                                </label>
                                                <input name="phone" id="phone" placeholder="Eneter Mobile Number" type="text" class="form-control" value="<?php echo e(old('phone')); ?>">
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
                                                    Pincode
                                                </label>
                                                <input name="shipping_pincode" id="shipping_pincode" placeholder="Enter Pincode" type="text" class="form-control" value="<?php echo e(old('shipping_pincode')); ?>">
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
                                        <div class="col-md-6">
                                            <div class="position-relative mb-3">
                                                <label for="password" class="form-label">
                                                    <span class="text-danger">*</span> Password
                                                </label>
                                                <input name="password" id="password" placeholder="Password here..." type="password" class="form-control">
                                                <?php $__errorArgs = ['password'];
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
                                                <label for="passwordRep" class="form-label">
                                                    <span class="text-danger">*</span> Repeat Password
                                                </label>
                                                <input name="passwordRep" id="passwordRep" placeholder="Repeat Password here..." type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center seller-registration-frm">
                                        <h5 class="mb-0">Already have an account?
                                            <a href="/sellers/login" class="text-primary">Sign in</a>
                                        </h5>
                                        <div class="ms-auto">
                                            <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">Create Account</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('backend/vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/vendors/toastr/build/toastr.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/vendor-function.js')); ?>"></script>
</body>

</html><?php /**PATH /var/www/spicebucket/resources/views/vendor/register.blade.php ENDPATH**/ ?>