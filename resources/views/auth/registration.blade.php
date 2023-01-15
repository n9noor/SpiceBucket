@extends('layout')
@section('content')
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
<div class="container">
<div class="row">
<div class="col-12">
<div class="row ec_breadcrumb_inner">
<div class="col-md-6 col-sm-12">
<h2 class="ec-breadcrumb-title">Register</h2>
</div>
<div class="col-md-6 col-sm-12">
<!-- ec-breadcrumb-list start -->
<ul class="ec-breadcrumb-list">
<li class="ec-breadcrumb-item"><a href="/">Home</a></li>
<li class="ec-breadcrumb-item active">Register</li>
</ul>
<!-- ec-breadcrumb-list end -->
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Ec breadcrumb end -->

<!-- Start Register -->
<section class="ec-page-content section-space-p">
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<div class="section-title">
<h2 class="ec-bg-title">Register</h2>
<h2 class="ec-title">Register</h2>
<p class="sub-title mb-3">Best place to buy and sell digital products</p>
</div>
</div>
<div class="ec-register-wrapper">
<div class="ec-register-container">
<div class="ec-register-form">
<form action="/registration-process" method="post">
@csrf
<span class="ec-register-wrap ec-register">
<label for="name">Name*</label>
<input type="text" id="name" name="name" placeholder="Enter your name" required value="{{old('name')}}" />
@error('name')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-register-wrap ec-register-half">
<label for="email">Email*</label>
<input type="email" id="email" name="email" placeholder="Enter your email add..." required value="{{old('email')}}" />
@error('email')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-register-wrap ec-register-half">
<label for="mobile_number">Phone Number*</label>
<input type="text" id="mobile_number" name="mobile_number" placeholder="Enter your phone number" required value="{{old('mobile_number')}}" />
@error('mobile_number')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-register-wrap ec-register-half">
<label for="password">Password*</label>
<input type="password" name="password" id="password" placeholder="Enter your password..." required />
@error('password')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-register-wrap ec-register-half">
<label for="confirm_password">Confirm Password*</label>
<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password..." required />
@error('confirm_password')
<small class="text-danger">{{$message}}</small>
@enderror
</span>
<span class="ec-register-wrap ec-register-btn">
<button class="btn btn-primary" type="submit">Register</button>
</span>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- End Register -->
@endsection