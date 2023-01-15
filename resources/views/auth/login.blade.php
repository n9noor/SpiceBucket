@extends('layout')
@section('content')

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
<div class="container">
<div class="row">
<div class="col-12">
<div class="row ec_breadcrumb_inner">
<div class="col-md-6 col-sm-12">
<h2 class="ec-breadcrumb-title">Login</h2>
</div>
<div class="col-md-6 col-sm-12">
<!-- ec-breadcrumb-list start -->
<ul class="ec-breadcrumb-list">
<li class="ec-breadcrumb-item"><a href="/">Home</a></li>
<li class="ec-breadcrumb-item active">Login</li>
</ul>
<!-- ec-breadcrumb-list end -->
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Ec breadcrumb end -->

<!-- Ec login page -->
<section class="ec-page-content section-space-p">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<div class="section-title">
<h2 class="ec-bg-title">Log In</h2>
<h2 class="ec-title">Log In</h2>
<p class="sub-title mb-3">Best place to buy and sell digital products</p>
</div>
</div>
<div class="ec-login-wrapper">
<div class="ec-login-container">
<div class="ec-login-form">
<form action="/login-process" method="post">
@csrf
<span class="ec-login-wrap">
<label>Email Address OR Phone*</label>
<input type="text" name="email" placeholder="Enter your email address or Phone number" id="email" required value="{{old('email')}}" />
@error('email')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-login-wrap ec-login-btn">
<button class="btn btn-primary" id="send-otp" type="button">Send OTP</button>
</span>
<span class="ec-login-wrap login-otp-span">
<label>OTP*</label>
<input type="text" name="password" placeholder="Enter received OTP" id="password" required />
@error('password')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<!--
<span class="ec-login-wrap ec-login-fp">
<label><a href="#">Forgot Password?</a></label>
</span>
-->
<span class="ec-login-wrap ec-login-btn login-otp-span">
<button class="btn btn-primary" type="submit">Login</button>
<!-- <a href="registeration" class="btn btn-secondary">Register</a> -->
</span>
<hr />
<div class="row">
<div class="col-md-6">
<div class="flex items-center justify-end mt-4">
<a class="ml-1 btn btn-primary" style="padding:5px;border-radius:7px;font-size:14px;width:191px;height:40px;text-transform:capitalize;" href="{{ url('login/google') }}">
<i class="ecicon eci-google-plus-square eci-2x" aria-hidden="true"></i>&nbsp;&nbsp;Login with Google
</a>
</div>
</div>
<div class="col-md-6">
<div class="flex items-center justify-end mt-4">
<a class="ml-1 btn btn-primary" href="{{ url('login/facebook') }}" style="padding:5px;border-radius:7px;font-size:12px;width:191px;height:40px;text-transform:capitalize;">
<i class="ecicon eci-facebook-square eci-2x" aria-hidden="true"></i>&nbsp;&nbsp;Login with Facebook
</a>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection