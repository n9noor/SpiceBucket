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
<link rel="stylesheet" href="{{asset('backend/vendors/@fortawesome/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/ionicons-npm/css/ionicons.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/linearicons-master/dist/web-font/style.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css')}}">
<link href="{{asset('backend/styles/css/base.css')}}" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
<div class="app-container">
<div class="h-100">
<div class="h-100 g-0 row">
<div class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7">
<div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
<div class="app-logos"><img src="{{asset('images/logo-color.png')}}" style="width:150px; margin-bottom:20px;"></div>
<div>
<form method="post" class="form-horizontal" action="/vendors/registration">
@csrf
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}" />
<div class="row">
<div class="col-md-12">
<div class="position-relative mb-3">
<label for="gst" class="form-label">
<span class="text-danger">*</span> Good and Service Tax (GST) Number
</label>
<div class="input-group">
<input name="gst" id="gst" placeholder="GST Number" type="text" class="form-control" value="{{old('gst')}}">
<button type="button" class="btn btn-primary" onclick="verify($('#gst').val())"><i class="fa fa-sign"></i> Validate</button>
</div>
@error('gst')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-12">
<div class="position-relative mb-3">
<label for="store_address" class="form-label">
<span class="text-danger">*</span> Store Address
</label>
<textarea readonly name="store_address" id="store_address" placeholder="Address of store" class="form-control">{{old('store_address')}}</textarea>
@error('store_address')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="shop_name" class="form-label">
<span class="text-danger">*</span> Store Name
</label>
<input name="shop_name" id="shop_name" placeholder="Name of store" type="text" class="form-control" value="{{old('shop_name')}}">
@error('shop_name')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="owner_name" class="form-label">
<span class="text-danger">*</span> Responsible Person
</label>
<input name="owner_name" id="owner_name" placeholder="Name of responsible person..." type="text" class="form-control" value="{{old('owner_name')}}">
@error('owner_name')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="email" class="form-label">
<span class="text-danger">*</span> Business Email
</label>
<input name="email" id="email" placeholder="Email here..." type="email" class="form-control" value="{{old('email')}}">
@error('email')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="phone" class="form-label">
Phone
</label>
<input name="phone" id="phone" placeholder="Mobile Number" type="text" class="form-control" value="{{old('phone')}}">
@error('phone')
<small class="text-danger">{{$message}}</small>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="position-relative mb-3">
<label for="password" class="form-label">
<span class="text-danger">*</span> Password
</label>
<input name="password" id="password" placeholder="Password here..." type="password" class="form-control">
@error('password')
<small class="text-danger">{{$message}}</small>
@enderror
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
<div class="mt-4 d-flex align-items-center">
<h5 class="mb-0">Already have an account?
<a href="/vendors/login" class="text-primary">Sign in</a>
</h5>
<div class="ms-auto">
<button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">Create Account</button>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="d-lg-flex d-xs-none col-lg-5">
<div class="slider-light">
<div class="slick-slider slick-initialized">
<div>
<div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
<div class="slide-img-bg" style="background-image: url('{{asset('backend/images/originals/high-angle-indian-spices-with-spoons.jpg')}}');"></div>
<div class="slider-content">
<h3>&nbsp;</h3>
<p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="{{asset('backend/vendors/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
</body>
</html>
