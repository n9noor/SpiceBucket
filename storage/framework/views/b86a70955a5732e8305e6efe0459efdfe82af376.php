<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login - SpiceBucket Vendor</title>
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
<div class="h-100">
<div class="h-100 g-0 row">
<div class="d-none d-lg-block col-lg-4">
<div class="slider-light">
<div class="slick-slider">
<div>
<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
<div class="slide-img-bg" style="background-image: url('<?php echo e(asset('backend/images/originals/spices-wooden-board-spoons.jpg')); ?>');"></div>
<div class="slider-content">
<h3>&nbsp;</h3>
<p>&nbsp;</p>
</div>
</div>
</div>
<div>
<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
<div class="slide-img-bg" style="background-image: url('<?php echo e(asset('backend/images/originals/high-angle-indian-spices-with-spoons.jpg')); ?>');"></div>
<div class="slider-content">
<h3>&nbsp;</h3>
<p>&nbsp;</p>
</div>
</div>
</div>
<div>
<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
<div class="slide-img-bg" style="background-image: url('<?php echo e(asset('backend/images/originals/spoons-with-powder-condiments-copy-space.jpg')); ?>');"></div>
<div class="slider-content">
<h3>&nbsp;</h3>
<p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
<div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
<div class="app-logos"><img src="<?php echo e(asset('images/logo-color.png')); ?>" style="width:150px; margin-bottom: 20px;"></div>
<h4 class="mb-0">
<span class="d-block">Welcome back,</span>
<span>Please sign in to your account.</span>
</h4>
<!--<h6 class="mt-3">No account?<a href="register.html" class="text-primary">Sign up now</a></h6>-->
<div class="divider row"></div>
<div>
<?php if(Session::has('message')): ?>
<div class='alert alert-danger'><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<form method="post" action="/sellers/login_process" class="form-horizontal">
<?php echo csrf_field(); ?>
<div class="row">
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="loginusername" class="form-label">Email</label>
<input name="email" id="loginusername" placeholder="Email here..." type="email" class="form-control" value="<?php echo e(old('email')); ?>" />
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
<label for="loginpassword" class="form-label">Password</label>
<input name="password" id="loginpassword" placeholder="Password here..." type="password" class="form-control" />
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
</div>
<div class="position-relative form-check mb-3">
<input name="check" id="keep-me-logged-in" type="checkbox" class="form-check-input">
<label for="keep-me-logged-in" class="form-label form-check-label">Keep me logged in</label>
</div>
<div class="divider row"></div>
<div class="d-flex align-items-center">
<div class="ms-auto">
<a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a>
<button id="btn-login" class="btn btn-primary btn-lg">Login to Dashboard</button>
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
<!-- plugin dependencies -->
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/jquery/dist/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/slick-carousel/slick/slick.min.js')); ?>"></script>
<!-- custome.js -->
<script type="text/javascript" src="<?php echo e(asset('backend/js/carousel-slider.js')); ?>"></script>
</body>
</html>
<?php /**PATH /var/www/spicebucket/resources/views/vendor/login.blade.php ENDPATH**/ ?>